<?php
class checkcategorypath extends Model {


	function getCategoryAll()
	{
		$allcat = $this->get_rsltset("SELECT c.categoryID,c.categoryCode FROM ".TPLPrefix."category c group by c.categoryCode order by c.sortingOrder,c.categoryID ");	
		
		return $allcat;
	}

	function searchCategoryId($searchtext,$arrays,$fieldname="key",$returnvalue="value")
		{
			
			 foreach ($arrays as $arr) {
				 
				   if (strtolower($arr[$fieldname])==strtolower($searchtext)) { 
						 return $arr[$returnvalue];
				}
				//die();
			 }
		   return '';	
		}

	function getStoreConfigPlugin()
	{
		$qryconfig="SELECT  cnfg.key, cnfg.value  FROM ".TPLPrefix."configuration cnfg 
					WHERE cnfg.IsActive <>2   ";

		$resinfo=$this->get_rsltset($qryconfig);
		
		$GLOBALS['allcon']=$resinfo;
		
		 $GLOBALS['allcategories'] = $this->get_rsltset("SELECT c.*, group_concat(DISTINCT i.catimage
        ORDER BY i.ordering ASC  SEPARATOR '|') as catimage FROM ".TPLPrefix."category c left join ".TPLPrefix."categoryimage i on i.categoryID=c.categoryID and i.IsActive = 1 WHERE c.IsActive = 1 group by c.categoryCode order by c.sortingOrder,c.categoryID ");
		
	}	

	function getConfigvalue($searchtext)
		{	
		 foreach ($GLOBALS['allcon'] as $arr) {
				
				   if (strtolower($arr["key"])==strtolower($searchtext)) {				 	
						 return $arr["value"];
				}			
			 }
		   return '';	
		}	
		
	/*function subCategories($searchtext,$arrays,&$subcat)
		{			
			foreach ($arrays as $arr) {
				   if (strtolower($arr['parentId'])==strtolower($searchtext)) {
							$subcat[]=$arr;
							 $this->getProductPath($arr['categoryID'],$subcat);	
					}
			 }
		   return $subcat;	
		} */
}

?>