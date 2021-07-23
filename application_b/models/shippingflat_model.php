<?php
class shippingflat_model extends Model {
	################## shipping Flat Page ###############
	
	function shippingfunction($shippingcode)
	{
		$shippingcode=$this->real_escape_string($shippingcode);
		$shipping_Qtr = "select * from ".TPLPrefix."shipping_flat where shippingId =? and IsActive=1 "; 
		
		/*$shipping_Qtr = " select s.* from mam_shipping_flat s  
						left join mam_country c on find_in_set(s.countryid,c.countryid) and c.IsActive=1
						left join mam_state st on find_in_set(s.stateid ,st.stateid)  and c.countryid = st.countryid and st.IsActive=1
						left join mam_city ct on find_in_set(s.cityid ,ct.cityid)  and ct.stateid = st.stateid and ct.IsActive=1
						where s.shippingId =1 and s.IsActive=1
						and (case when s.cityid is not null then ct.cityid in ('1')
								when s.stateid is not null then st.stateid in ('1')
								when s.countryid is not null then c.countryid in ('2')
						end ) limit 0,1 ";
	*/
		
		//echo $shipping_Qtr; exit;
		$resulst=$this->get_a_line_bind($shipping_Qtr,array($shippingcode));	
		//echo "<pre>"; print_r($resulst); exit;
		return $resulst;
		
	}
	
}

?>