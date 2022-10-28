<?php
error_reporting(1);
class ProductFilterRepository extends DjModel {
	################## Home Page ###############
	
	public function getAllParentCategories() {
		$info = $this->select('kr_category.*')->from('kr_product_categoryid')
                    ->join('kr_category', 'kr_category.categoryID = kr_product_categoryid.categoryID and kr_category.IsActive = 1')
                    ->where(['kr_product_categoryid.IsActive' => 1, 'kr_category.parent_id' => 0])
                    ->groupBy('kr_category.categoryID')
                    ->get();
		if( isset( $info ) && !empty( $info )) {
			return $info;
		} else {
			return false;
		}
	}

    public function getFilterDetails($category_id = '')
    {
        $info       = $this->select('m.attributeid,cat.categoryId,m.attributename,m.attribute_type,m.iconsdisplay,kdrp.dropdown_id,kdrp.dropdown_values,kdrp.dropdown_images,kdrp.dropdown_unit,m.sortingOrder')
                    ->from('kr_product p')
                    ->join('kr_product_categoryid pc', 'pc.product_id = p.product_id AND pc.IsActive = 1')
                    ->join('kr_category cat', 'cat.categoryID = pc.categoryID AND cat.categoryID = pc.categoryID AND cat.IsActive = 1')
                    ->join('kr_product_attr_combi kadrp', 'kadrp.base_productId = p.product_id AND kadrp.IsActive = 1')
                    ->join('kr_dropdown kdrp', "FIND_IN_SET(kdrp.dropdown_id,REPLACE(kadrp.attr_combi_id, '_', ',')) AND kdrp.isactive = 1 AND kdrp.lang_id = '1'")
                    ->join('kr_m_attributes m', "m.attributeId = kdrp.attributeId AND m.IsActive = 1 AND m.lang_id = '1'")
                    ->where('p.IsActive', 1)
                    ->where('p.lang_id', 1);

        if( !empty( $category_id ) ) {
            $info   = $this->whereRaw('cat.parentId = '.$category_id.' or cat.categoryId = '.$category_id);
        }
        
        $info       = $this->groupBy(' m.attributeid,kdrp.dropdown_id')
                    ->havingRaw('m.attributeid IS NOT NULL')
                    ->orderBy('m.attributeid,kdrp.dropdown_id,m.sortingOrder', 'ASC')
                    ->get();
		if( isset( $info ) && !empty( $info )) {
			return $info;
		} else {
			return false;
		}
    }

    public function getMinAndMaxPrice()
    {
        $info = $this->select('MIN(productprice) as min_price, MAX(productprice) as max_price')
                    ->from('kr_product_attribute_multiple')
                    ->where(['IsActive' => 1, 'isdefault' => 1] )->first();
		if( isset( $info ) && !empty( $info )) {
			return $info;
		} else {
			return false;
		}
    }

    public function getDefaultProductList( $showType = '', $searchString = [] ) {
       
        $filters                = [];
        if( empty( $showType ) ) {
            if( isset( $_SESSION['product_filter'] ) && !empty( $_SESSION['product_filter'] )  ) {
                $filters        = $_SESSION['product_filter'];
            }
        }
        // ss( $filters );
        $this->select( 'cat.categoryID, cat.categoryCode, cat.hsncode,cat.categoryName,pro.product_id, pro.product_name, pro.sku, multipro.*, pro_img.img_path, pro.product_url' )
                        ->from( 'kr_product pro' );
        if( empty( $filters ) ) {
            $this->join( 'kr_product_attribute_multiple multipro', 'pro.product_id = multipro.product_id and pro.IsActive = 1 AND multipro.isdefault = 1', 'LEFT' );
        } else {
            $this->join( 'kr_product_attribute_multiple multipro', 'pro.product_id = multipro.product_id and pro.IsActive = 1', 'LEFT' );
            foreach ($filters as $key => $value) {
                if( $key == 'Size' ) {
                    $this->whereIN( 'multipro.size', $value );
                } else if( $key == 'Core Material' ) {
                    $this->whereIN( 'multipro.materialid', $value );
                } else if( $key == 'Fabric' ) {
                    $this->whereIN( 'multipro.fabricid', $value );
                } else if( $key == 'Lead Equivalnce' ) {
                    $this->whereIN( 'multipro.leadequivalnce', $value );
                } else if( $key == 'Product Type' ) {
                    $this->whereIN( 'multipro.product_type', $value );
                } else if( $key == 'min_price' ) {
                    if($value != 0 ) {
                        $this->whereRaw( 'multipro.productprice >= '.$value );
                    }
                } else if( $key == 'max_price' ) {
                    if($value != 0 ) {
                        $this->whereRaw( 'multipro.productprice <='.$value );
                    }
                } else if( $key == 'selsortby' ) {
                    if( isset( $value ) && !empty( $value ) ) {
                        if( $value == 1 ) { //selsortby  = 1 -> Product Name Ascending
                            $this->orderBy('pro.product_name', 'ASC');
                        } else if( $value == 2 ) {//selsortby  = 2 -> Product Name decending
                            $this->orderBy('pro.product_name', 'DESC');
                        } else if( $value == 3 ) {//selsortby  = 3 -> Price Low to High
                            $this->orderBy('multipro.productprice', 'ASC');
                        } else if( $value == 4 ) {//selsortby  = 4 -> Price High to Low
                            $this->orderBy('multipro.productprice', 'DESC');
                        }
                    }
                } else if( $key == 'Color' ) {
                    $this->whereIN( 'pro_img.colorid', $value );
                } else if( $key == 'subcatid' ) {
                    if( isset( $value ) && !empty( $value ) ) {
                        $this->whereIN( 'procat.categoryID', $value );
                    }
                }
            }
        }
        if( !empty( $searchString )) {
            $this->like($searchString);
        }

        if( !empty( $showType )) {

            if( $showType == 'related' ) {

            } else if( $showType == 'bestSelling' ) {

                $this->join('kr_orders_products op', 'op.product_id=pro.product_id and op.IsActive=1' );
                $this->join('kr_orders o', 'o.order_id=op.order_id and o.IsActive=1');
                $this->orderBy('SUM(op.product_qty)', 'DESC');
               
            } else {
                $this->where($showType, 1);
            }
            
        }
        
        $this->join( 'kr_product_categoryid procat', 'procat.product_id = pro.product_id and procat.IsActive = 1' );
        $this->join( 'kr_category cat', 'cat.categoryID = procat.categoryID' );
        $this->join( 'kr_product_images pro_img', 'pro_img.product_id = multipro.product_id and pro_img.IsActive = 1 and pro_img.isbasedefault = 1' );
        $this->where(['pro.IsActive' => 1] );
        $this->groupBy('pro.product_id');
        $details = $this->get();
        
        if( isset( $details ) && !empty( $details ) ) {
            return $details;
        } else {
            return null;
        }
    }  

    public function getProductInfo($product_url = '', $where = []) {

        $this->select( 'cat.categoryID, cat.categoryCode, cat.hsncode,cat.categoryName,pro.product_id, pro.product_name,pro.longdescription, pro.sku as mainSku, multipro.*, pro_img.colorid as defaultColorId,pro_img.product_img_id,pro_img.img_path, pro.product_url' )
                        ->from( 'kr_product pro' )
                        ->join( 'kr_product_attribute_multiple multipro', 'pro.product_id = multipro.product_id and pro.IsActive = 1 AND multipro.isdefault = 1', 'LEFT' )
                        ->join( 'kr_product_categoryid procat', 'procat.product_id = pro.product_id' )
                        ->join( 'kr_category cat', 'cat.categoryID = procat.categoryID' )
                        ->join( 'kr_product_images pro_img', 'pro_img.product_id = multipro.product_id and pro_img.IsActive = 1 and pro_img.isbasedefault = 1' )
                        ->where(['pro.IsActive' => 1] );
        if( !empty( $product_url ) ) {
            $this->where('pro.product_url', $product_url);
        }
        if( !empty( $where ) ) {
            $this->where($where);
        }
        
        $details    = $this->groupBy('pro.product_id')
                        ->first();

        if( isset( $details ) && !empty( $details ) ) {
            return $details;
        } else {
            return false;
        }
    }   

}