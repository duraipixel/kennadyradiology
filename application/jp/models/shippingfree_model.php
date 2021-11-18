<?php
class shippingfree_model extends Model {
	################## shipping Free Page ###############
	
	function shippingfunction($shippingcode)
	{
		$shippingcode=$this->real_escape_string($shippingcode);
		$shipping_Qtr = "select * from ".TPLPrefix."shipping_flat where shippingId =? and IsActive=1 "; 
		$resulst=$this->get_a_line_bind($shipping_Qtr,array($shippingcode));
		return $resulst;
		
	}
	
}

?>