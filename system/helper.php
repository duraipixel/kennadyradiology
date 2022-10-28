<?php 
$pdoDj = new DjModel();

function globalConfig( string $field_name) {
    global $pdoDj;
    $info = $pdoDj->select('value')->from('kr_configuration')->where('IsActive', 1)
                ->where('kr_configuration.key', $field_name)->first();
    if( isset( $info ) && !empty( $info )) {
        return $info->value;
    } else {
        return false;
    }
}

function ss($data = '') {
    echo '<pre>';
    print_r( $data );
    die;
}

function getCartProductQty($product_id) {

    global $pdoDj;
    $pdoDj->select('kr_cart_products.*')->from('kr_carts')->where('kr_carts.IsActive', 1);
    if( $_SESSION['Cus_ID'] != '' && $_SESSION['cus_group_id'] != '' ) {
        $pdoDj->where(['kr_carts.customer_id' =>  $_SESSION['Cus_ID'], 'kr_carts.customer_group_id' =>  $_SESSION['cus_group_id'] ] );
    } else {
        $pdoDj->where('kr_carts.sessionId', session_id() );
    }
    $pdoDj->join('kr_cart_products', 'kr_cart_products.cart_id = kr_carts.cart_id');
    $pdoDj->join('kr_product', 'kr_cart_products.product_id = kr_product.product_id and kr_product.IsActive = 1');
    $pdoDj->where(['kr_cart_products.product_id' => $product_id, 'kr_cart_products.IsActive' => 1 ]);
    $pdoDj->groupBy('kr_cart_products.cart_product_id');
    $info = $pdoDj->first();
    
    if( isset( $info ) && !empty( $info )) {
        return $info->product_qty;
    } else {
        return null;
    }
    
}

function getCartProductAttributes($cartProduct_id) {
    global $pdoDj;

    $pdoDj->select(' kr_cart_products.*,
                    kr_dropdown.dropdown_values,
                    kr_dropdown.dropdown_id,
                    kr_m_attributes.attributename,
                    kr_m_attributes.attributecode,
                    kr_product_images.img_path,
                    kr_product_images.product_img_id')
            ->from('kr_cart_products')
            ->where(['kr_cart_products.IsActive' => 1, 'kr_cart_products.cart_product_id' => $cartProduct_id]);
    if( $_SESSION['Cus_ID'] != '' && $_SESSION['cus_group_id'] != '' ) {
        $pdoDj->where(['kr_carts.customer_id' =>  $_SESSION['Cus_ID'], 'kr_carts.customer_group_id' =>  $_SESSION['cus_group_id'] ] );
    } else {
        $pdoDj->where('kr_carts.sessionId', session_id() );
    }

    $pdoDj->join('kr_carts', 'kr_carts.cart_id = kr_cart_products.cart_id AND kr_carts.IsActive = 1');
    $pdoDj->join('kr_carts_products_attribute', 'kr_carts_products_attribute.cart_product_id = kr_cart_products.cart_product_id');
    $pdoDj->join('kr_dropdown', 'kr_carts_products_attribute.Attribute_value_id = kr_dropdown.dropdown_id', 'LEFT');
    $pdoDj->join('kr_m_attributes', 'kr_m_attributes.attributeid = kr_carts_products_attribute.Attribute_id', 'LEFT');
    $pdoDj->join('kr_product_images', 'kr_product_images.colorid = kr_dropdown.dropdown_id', 'LEFT' );

    $pdoDj->groupBy('kr_carts_products_attribute.cart_product_attr_id');
    $info = $pdoDj->get();
    
    if( isset( $info ) && !empty( $info )) {
        return $info;
    } else {
        return null;
    }

}

function getCartProductImages( $cartProductId ) {
    global $pdoDj;

    $pdoDj->from( 'kr_carts_products_attribute' )->select('kr_product_images.*')
            ->join( 'kr_cart_products', 'kr_cart_products.cart_product_id = kr_carts_products_attribute.cart_product_id' )
            ->join( 'kr_product_images', 'kr_product_images.colorid = kr_carts_products_attribute.Attribute_value_id and kr_product_images.product_id = kr_cart_products.product_id' )
            ->where(['kr_carts_products_attribute.cart_product_id' => $cartProductId, 'Attribute_id' => 1, 'kr_carts_products_attribute.IsActive' => 1 ] )
            ->orderRaw(' kr_product_images.isbasedefault DESC, kr_product_images.ordering ASC limit 1');
    $info = $pdoDj->first();
    if( isset( $info ) && !empty( $info )) {
        return $info;
    } else {
        return null;
    }

            
}

?>