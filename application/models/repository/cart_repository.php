<?php
error_reporting(1);
class CartRepository extends DjModel {
	################## Home Page ###############
	public function getSingleCartItem( $product_id = '' ) {
		$table = 'kr_cart_products';
		
		$info = $this->from($table);
		$info = $this->join('kr_carts', 'kr_carts.cart_id = kr_cart_products.cart_id and kr_carts.IsActive = 1')
				->where(['kr_cart_products.IsActive' => 1]);
		
		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			$customer_id 		=  $_SESSION['Cus_ID'];;
			$info = $this->where(['kr_carts.customer_id' => $customer_id ]);
		} else {
			$info = $this->where(['kr_carts.sessionId' => session_id() ]);
		}
		if( !empty( $product_id ) ) {
			$info = $this->where(['kr_cart_products.product_id' => $product_id] );
		}
		$info = $this->first();
		if( isset( $info ) && !empty( $info )) {
			return $info;
		} else {
			return false;
		}
	}
	
	public function cartList() {
 
		$this->select('DISTINCT kr_product.product_name,kr_product.sku,kr_product.product_url,kr_carts_products_attribute.cart_product_attr_id, kr_cart_products.*, kr_dropdown.dropdown_values, 
		kr_product_images.img_path,kr_product_images.product_img_id, cat.categoryID, cat.categoryCode, cat.hsncode,cat.categoryName')
				->from('kr_cart_products')
				->join('kr_carts', 'kr_carts.cart_id = kr_cart_products.cart_id and kr_carts.IsActive=1')
				->join('kr_product', 'kr_product.product_id = kr_cart_products.product_id')
				->join( 'kr_product_categoryid procat', 'procat.product_id = kr_product.product_id and procat.IsActive = 1' )
        		->join( 'kr_category cat', 'cat.categoryID = procat.categoryID' )
				->join('kr_carts_products_attribute', 'kr_carts_products_attribute.cart_product_id = kr_cart_products.cart_product_id')
				->join( 'kr_dropdown', 'kr_carts_products_attribute.Attribute_value_id = kr_dropdown.dropdown_id', 'LEFT')
				->join( 'kr_product_images', 'kr_product_images.colorid = kr_dropdown.dropdown_id and kr_product_images.IsActive = 1 and kr_product_images.product_id = kr_cart_products.product_id and (kr_product_images.ordering = 1 or kr_product_images.isbasedefault)', 'left' );

		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			$customer_id 		=  $_SESSION['Cus_ID'];;
			$this->where(['kr_carts.customer_id' => $customer_id ]);
		} else {
			$this->where(['kr_carts.sessionId' => session_id() ]);
		}
		$this->where(['kr_cart_products.IsActive' => 1, 'kr_carts.IsActive' => 1]);
		$this->groupBy('kr_cart_products.cart_product_id');
		$this->orderBy('kr_product_images.ordering', 'ASC');
		
		$list 					= $this->get();

		if( isset( $list ) && !empty( $list )) {
			return $list;
		} else {
			return null;
		}

	}

	public function checkExistCartProduct() {

		if($_SESSION['Cus_ID']!='' && $_SESSION['cus_group_id']!=''){
			$customer_id 		=  $_SESSION['Cus_ID'];;
			$this->where(['kr_carts.customer_id' => $customer_id ]);
		} else {
			$this->where(['kr_carts.sessionId' => session_id() ]);
		}
		$filters = $_REQUEST;
		if( isset( $filters ) ) {
			foreach( $filters as $key => $valu )
			{
				$valu = trim($valu);
				if(strpos($key,"selattr_")!== false)
				{
					if($valu!=""){
						$this->whereRaw('FIND_IN_SET( '.$valu.', attr_combi_id ) > 0');
					}
				}
				if(strpos($key,"iconatt_")!== false)
				{
					if($valu!=""){
						$this->whereRaw('FIND_IN_SET( '.$valu.', attr_combi_id ) > 0');
					}
				}	
			}
		}

		$this->from('kr_carts')->select('kr_cart_products.*')
			->join( 'kr_cart_products', 'kr_cart_products.cart_id = kr_carts.cart_id and kr_cart_products.IsActive = 1 and kr_cart_products.product_id = '.$filters['proid'])
			->join( 'kr_carts_products_attribute', 'kr_carts_products_attribute.cart_product_id = kr_cart_products.cart_product_id and kr_carts_products_attribute.IsActive = 1' );
		$details = $this->first();

		if( isset( $details ) && !empty( $details ) ) {
			return $details;
		} else {
			return null;
		}

	}

	public function getProductAttributeCombination($product_id) {
		$filters = $_REQUEST;
		if( isset( $filters ) ) {
			foreach( $filters as $key => $valu )
			{
				$valu = trim($valu);
				if(strpos($key,"selattr_")!== false)
				{
					if($valu!=""){
						$this->whereRaw('FIND_IN_SET( '.$valu.', attr_combi_id ) > 0');
					}
				}
				if(strpos($key,"iconatt_")!== false)
				{
					if($valu!=""){
						$this->whereRaw('FIND_IN_SET( '.$valu.', attr_combi_id ) > 0');
					}
				}	
			}
		}
		$this->from('kr_product_attr_combi')->select('*');
		$this->where( 'base_productId', $product_id );
		$details = $this->first();

		if( isset( $details ) && !empty( $details ) ) {
			return $details;
		} else {
			return null;
		}
	}
}