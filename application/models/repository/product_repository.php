<?php
error_reporting(1);
class ProductRepository extends DjModel {
	################## Home Page ###############
	
	public function getSingleInfo($table, $where) {
		$info = $this->from($table)->where($where)->first();
		if( isset( $info ) && !empty( $info )) {
			return $info;
		} else {
			return false;
		}
	}

	public function updateData($table, $data, $where) {
		$this->update($table, $data, $where);
	}

	public function getAllInfo($table, $where = [], $order_by = [], $like = [], $group_by = '') {
		$info = $this->from($table);
		if( !empty( $where )) {
			$info = $this->where($where);
		}
		if( !empty( $order_by ) ) {
			$keys = array_keys($order_by);
			$column = $keys[0];
			$order = $order_by[$column];
			$info = $this->orderBy($column, $order);
		}
		if( !empty( $like ) ) {
			$this->like($like);
		}
		if( !empty( $group_by ) ) {
			$this->groupBy($group_by);
		}
		$info = $this->get();

		if( isset( $info ) && !empty( $info )) {
			return $info;
		} else {
			return false;
		}
	}

	public function getProductIngredientsAll($where = []) {
		$info = $this->select('dc_product_attributes.*')->from( 'dc_product_attributes' )
				->join('am_product', 'am_product.product_id = dc_product_attributes.product_id')
				->where($where)->get();

		if( isset( $info ) && !empty( $info )) {
			return $info;
		} else {
			return false;
		}
	}

    function productPricevariationFilter($producturl, $attributeid = '' )
	{
        $details        = $this->select('m_att.attributeid, m_att.attributename,m_att.attribute_type,m_att.iconsdisplay,m_att.attributecode,drp.dropdown_id,drp.dropdown_values,drp.dropdown_images,drp.dropdown_unit, adrp.price,adrp.sku,adrp.product_attr_combi_id, adrp.attr_combi_id,max(adrp.isDefault) as isDefault')
                            ->from(TPLPrefix."product p" )
                            ->join(TPLPrefix."product_categoryid pc", "pc.product_id=p.product_id and pc.IsActive=1")
                            ->join(TPLPrefix."category cat", "cat.categoryID=pc.categoryID and cat.categoryID=pc.categoryID and  cat.IsActive=1 and cat.lang_id = ".$_SESSION['lang_id'])
                            ->join(TPLPrefix."taxmaster t", "t.taxId=p.taxId and t.IsActive=1" )
                            ->join(TPLPrefix."product_attr_combi adrp", "adrp.base_productId=p.product_id and adrp.IsActive=1 and adrp.outofstock = 0 ", 'LEFT')
                            ->join(TPLPrefix."dropdown drp", "find_in_set(drp.dropdown_id, REPLACE(adrp.attr_combi_id,'_',','))   and drp.isactive=1 and drp.lang_id = ".$_SESSION['lang_id'], "LEFT")
                            ->join(TPLPrefix."attributes att", "att.attributeId = drp.attributeId and att.isCombined=1 and att.isactive=1", "LEFT")
                            ->join(TPLPrefix."m_attributes m_att", "m_att.attributeid = drp.attributeId   and m_att.isactive=1 and drp.lang_id = ".$_SESSION['lang_id'], 'LEFT')
                            ->where(['p.IsActive' => 1, 'p.lang_id' => $_SESSION['lang_id'], 'p.product_url' => $producturl] )
                            ->whereNotNull('m_att.attributeid ');
        if( !empty( $attributeid ) ) {
            $details    = $this->where( ['m_att.attributeid' => $attributeid ] );
            $details    = $this->groupBy('m_att.attributeid,drp.dropdown_id');
        } else {
            $details    = $this->groupBy('m_att.attributename');
        }
        $details        = $this->orderBy(' m_att.sortingOrder,m_att.attributeid', 'ASC')
                            ->get();

        if( isset( $details ) && !empty( $details )) {
            return $details;
        } else {
            return false;
        }
		 	
	}

	public function getProductMultiAttributes($product_id, $where = [] ) {

		$details 			= $this->from('kr_product_attribute_multiple');
		if( isset( $where ) && !empty( $where ) ) {
			$details		= $this->where( $where );
		}
		$details			= $this->where('isActive', 1);
		$details 			= $this->get();
		if( isset( $details ) && !empty( $details )) {
            return $details;
        } else {
            return false;
        }

	}

	public function getProductTypeAttributes($product_id) {
		$details 			= $this->select('kpm.productprice, kr_dropdown.dropdown_values as product_type_name, kpm.product_type, kr_dropdown.attributeId as attribute_id')->from('kr_product_attribute_multiple kpm')
								->join('kr_dropdown', 'kr_dropdown.dropdown_id = kpm.product_type')
								->where(['kpm.product_id' =>  $product_id, 'kpm.IsActive' => 1] );
 
		$details			= $this->groupBy('kpm.product_type');
		$details			= $this->get();
		if( isset( $details ) && !empty( $details )) {
            return $details;
        } else {
            return false;
        }
	}

	public function getSizeAttributes($product_id, $product_type_id = '' ) {
		$details 			= $this->select('kpm.productprice, size.dropdown_values as size_name, kpm.size as dropdown_id, size.attributeId as attribute_id')->from('kr_product_attribute_multiple kpm')
								->join('kr_dropdown', 'kr_dropdown.dropdown_id = kpm.product_type')
								->join('kr_dropdown as size', 'size.dropdown_id = kpm.size')
								->where(['kpm.product_id' =>  $product_id, 'kpm.IsActive' => 1] );
		if( !empty( $product_type_id ) ) {
			$details 		= $this->where('kpm.product_type', $product_type_id);
		}
		$details			= $this->groupBy('kpm.size');
		$details			= $this->get();
		if( isset( $details ) && !empty( $details )) {
            return $details;
        } else {
            return false;
        }
	}

	public function getLeadEquanceAttributes($product_id, $product_type_id = '', $size_id = '' ) {
		$details 			= $this->select('kpm.colorid, kpm.productprice, leadEq.dropdown_values as lead_equalance_name, kpm.leadequivalnce as dropdown_id, leadEq.attributeId as attribute_id')
								->from('kr_product_attribute_multiple kpm')
								->join('kr_dropdown', 'kr_dropdown.dropdown_id = kpm.product_type')
								->join('kr_dropdown as size', 'size.dropdown_id = kpm.size')
								->join('kr_dropdown as leadEq', 'leadEq.dropdown_id = kpm.leadequivalnce')
								->where(['kpm.product_id' =>  $product_id, 'kpm.IsActive' => 1] );
		if( !empty( $product_type_id ) ) {
			$details 		= $this->where('kpm.product_type', $product_type_id);
		}
		if( !empty( $size_id ) ) {
			$details 		= $this->where('kpm.size', $size_id);
		}
		$details			= $this->groupBy('kpm.leadequivalnce');
		$details			= $this->get();
		if( isset( $details ) && !empty( $details )) {
            return $details;
        } else {
            return false;
        }
	}

	public function getCoreMaterialAttributes($product_id, $product_type_id = '', $size_id='', $lead_id = '' ) {
		$details 			= $this->select('kpm.productprice, material.dropdown_values as lead_name, kpm.materialid as dropdown_id, material.attributeId as attribute_id')->from('kr_product_attribute_multiple kpm')
								->join('kr_dropdown', 'kr_dropdown.dropdown_id = kpm.product_type')
								->join('kr_dropdown as size', 'size.dropdown_id = kpm.size')
								->join('kr_dropdown as leadEq', 'leadEq.dropdown_id = kpm.leadequivalnce')
								->join('kr_dropdown as material', 'material.dropdown_id = kpm.materialid')
								->where(['kpm.product_id' =>  $product_id, 'kpm.IsActive' => 1] );
		if( !empty( $product_type_id ) ) {
			$details 		= $this->where('kpm.product_type', $product_type_id);
		}
		if( !empty( $size_id ) ) {
			$details 		= $this->where('kpm.size', $size_id);
		}
		if( !empty( $lead_id ) ) {
			$details 		= $this->where('kpm.leadequivalnce', $lead_id);
		}
		$details			= $this->groupBy('kpm.materialid');
		$details			= $this->get();
		if( isset( $details ) && !empty( $details )) {
            return $details;
        } else {
            return false;
        }
	}

	public function getFabricAttributes($product_id, $product_type_id = '', $size_id = '', $lead_id = '', $material_id = '' ) {
		$details 			= $this->select('kpm.productprice, fabc.dropdown_values as fab_name, kpm.fabricid as dropdown_id, fabc.attributeId as attribute_id')->from('kr_product_attribute_multiple kpm')
								->join('kr_dropdown', 'kr_dropdown.dropdown_id = kpm.product_type')
								->join('kr_dropdown as size', 'size.dropdown_id = kpm.size')
								->join('kr_dropdown as leadEq', 'leadEq.dropdown_id = kpm.leadequivalnce')
								->join('kr_dropdown as material', 'material.dropdown_id = kpm.materialid')
								->join('kr_dropdown as fabc', 'fabc.dropdown_id = kpm.fabricid')
								->where(['kpm.product_id' =>  $product_id, 'kpm.IsActive' => 1] );
		if( !empty( $product_type_id ) ) {
			$details 		= $this->where('kpm.product_type', $product_type_id);
		}
		if( !empty( $size_id ) ) {
			$details 		= $this->where('kpm.size', $size_id);
		}
		if( !empty( $lead_id ) ) {
			$details 		= $this->where('kpm.leadequivalnce', $lead_id);
		}
		if( !empty( $material_id ) ) {
			$details 		= $this->where('kpm.materialid', $material_id);
		}
		$details			= $this->groupBy('kpm.fabricid');
		$details			= $this->get();
		if( isset( $details ) && !empty( $details )) {
            return $details;
        } else {
            return false;
        }
	}

	public function getColorAttributes($product_id, $product_type_id, $size_id, $lead_id = '', $material_id = '' ) {
		$details 				= $this->select('kpm.colorid, kpm.productprice, material.dropdown_values as lead_name, kpm.materialid as dropdown_id, material.attributeId as attribute_id')->from('kr_product_attribute_multiple kpm')
								->join('kr_dropdown', 'kr_dropdown.dropdown_id = kpm.product_type')
								->join('kr_dropdown as size', 'size.dropdown_id = kpm.size')
								->join('kr_dropdown as leadEq', 'leadEq.dropdown_id = kpm.leadequivalnce')
								->join('kr_dropdown as material', 'material.dropdown_id = kpm.materialid')
								->where(['kpm.product_id' =>  $product_id, 'kpm.IsActive' => 1] );
		if( !empty( $product_type_id ) ) {
			$details 			= $this->where('kpm.product_type', $product_type_id );
		}
		if( !empty( $size_id ) ) {
			$details 			= $this->where('kpm.size', $size_id );
		}
		if( !empty( $lead_id ) ) {
			$details 			= $this->where('kpm.leadequivalnce', $lead_id );
		}
		if( !empty( $material_id ) ) {
			$details 			= $this->where('kpm.materialid', $material_id );
		}
		
		$details			= $this->first();
		if( isset( $details ) && !empty( $details )) {
            return $details;
        } else {
            return false;
        }
	}

	public function getColorImages( $Inarray ) {

		$details	 = $this->select('kr_dropdown.*')->from('kr_dropdown')->whereIN( 'dropdown_id', $Inarray)
						->get();
		if( isset( $details ) && !empty( $details )) {
			return $details;
		} else {
			return false;
		}
	}
 
	public function insertCommon($ins_data, $table_name  ) {
        return $this->insert( $ins_data, $table_name );
    }

	public function updateCommon($table, $update_data, $where ) {
		return $this->update( $table, $update_data, $where );
	}
}