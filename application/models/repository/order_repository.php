<?php
error_reporting(1);
class OrderRepository extends DjModel {

    public function getOrderProductInfo( $order_product_id ) {
        $details = $this->from('kr_orders_products')
                    ->select('kr_orders_products.*')
                    ->join('kr_orders', 'kr_orders.order_id = kr_orders_products.order_id')
                    ->where( 'kr_orders_products.order_product_id', $order_product_id )
                    ->first();
        if( isset( $details ) && !empty($details ) ) {
        return $details;
        } else {
        return null;
        }
    }

    public function getOrderItems( $where ) {
        $details = $this->from('kr_orders_products')->select('kr_orders_products.*')
                        ->join('kr_orders', 'kr_orders.order_id = kr_orders_products.order_id')
                        ->where( $where )
                        ->get();
        if( isset( $details ) && !empty($details ) ) {
            return $details;
        } else {
            return null;
        }
    }


}