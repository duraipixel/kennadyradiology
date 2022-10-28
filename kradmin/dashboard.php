<?php 

$menudisp = "dashboard";
include "includes/header.php"; 
include "includes/Mdme-functions.php";

$mdme = getMdmeDashboard($db, ''); 


///////////for order totals of various statuses

$rslt_order = getDashbrdCounts($db, 'order','');	
$ordtotal = $rslt_order['total'];
$ordpending = $rslt_order['pending'];
$ordconfirmed = $rslt_order['confirmed'];
$ordcanceled = $rslt_order['canceled'];
$ordrdelivered = $rslt_order['delivered'];


//////for sales count for various currencies
$rslt_sales = getDashbrdCounts($db, 'sales','');

$rslt_activity = getDashbrdCounts($db, 'activity','');

$rslt_ordr = getDashbrdCounts($db, 'custorders','');
	


//////for products count 
$rslt_products = getDashbrdCounts($db, 'products','');
//print_r($rslt_products); exit;
$prdtotal = $rslt_products['total'];	
$activep = $rslt_products['activep'];	
$prdinact = $rslt_products['inactcnt'];	
$prdlowstock = $rslt_products['lowstockcnt'];	
$prdsoldoutcnt = $rslt_products['soldoutcnt'];	


//////for customers count 
$rslt_cust = getDashbrdCounts($db, 'customers','');
$totcust = $rslt_cust['totcust'];	
$custinact = $rslt_cust['custinact'];	
//$prdlowstock = $rslt_products['lowstockcnt'];	


if($_REQUEST['datmon'] == 'Y')
{
$strchk = "select daynum, count(order_id) as orders, case when date_added <> '' then date_format(date_added,'%Y-%m') else date_format(DATE_ADD(NOW(), INTERVAL - daynum month),'%Y-%m') end as datad  from(SELECT t*1 daynum
        FROM
            (SELECT 1 t UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) A
            
        ORDER BY daynum ) aa left join ".TPLPrefix."orders ord on aa.daynum = month(ord.date_added) group by daynum order by datad limit 0, 12";
		
		
		$res = $db->get_rsltset($strchk);
		$arra = "";
		$arrb = '';
		for($i=0;$i<count($res);$i++)
		{
			$arra .=   "\"".getdateFormat($db,$res[$i]['datad'])."\"";
			$arrb .= $res[$i]['orders'].",";
			if($i != count($res))
			{
			$arra .= ',';
			}
			$arrc .= "{y: '".getdateFormat($db,$res[$i]['datad'])."', item1: ".$res[$i]['orders']."},";
		//$arr1[$i] = array($res[$i]['date_field'],$res[$i]['orders']);
		}
}
else if($_REQUEST['datmon'] == 'D')
{
$strchk = "select count(order_id) as orders,daynum, dathr from (select NOW() - INTERVAL daynum HOUR as dathr, daynum  from(SELECT t*1 daynum
        FROM
            (SELECT 1 t UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12 UNION SELECT 13  UNION SELECT 13 UNION SELECT 14 UNION SELECT 15 UNION SELECT 16 UNION SELECT 17 UNION SELECT 18 UNION SELECT 19 UNION SELECT 20  UNION SELECT 21 UNION SELECT 22 UNION SELECT 23) A ) aa) mytabl left join ".TPLPrefix."orders ord on mytabl.daynum = hour(ord.date_added) and DATE_FORMAT(ord.date_added,'%Y-%m-%d') = DATE_FORMAT(now(),'%Y-%m-%d') group by daynum order by daynum limit 0, 24 ";
			$res = $db->get_rsltset($strchk);
		$arra = "";
		$arrb = '';
		for($i=0;$i<count($res);$i++)
		{
			$arra .=   "\"".getdateFormat($db,$res[$i]['dathr'])."\"";
			$arrb .= $res[$i]['orders'].",";
			if($i != count($res))
			{
			$arra .= ',';
			}
			$arrc .= "{y: '".$res[$i]['dathr']."', item1: ".$res[$i]['orders']."},";
		//$arr1[$i] = array($res[$i]['date_field'],$res[$i]['orders']);
		}
			
}
else
{
	$strchk = "select date_field,count(order_id) as orders from (SELECT date_field
	FROM
	(
		SELECT
			MAKEDATE(YEAR(NOW()),1) +
			INTERVAL (MONTH(NOW())-2) MONTH +
			INTERVAL daynum DAY date_field
		FROM
		(
			SELECT t*10+u daynum
			FROM
				(SELECT 0 t UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) A,
				(SELECT 0 u UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
				UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
				UNION SELECT 8 UNION SELECT 9) B
			ORDER BY daynum
		) AA
	) AAA
	WHERE MONTH(date_field) <= MONTH(NOW()) ) mntabl left join ".TPLPrefix."orders ord on DATE_FORMAT(ord.date_added,'%Y-%m-%d') = DATE_FORMAT(mntabl.date_field,'%Y-%m-%d') group by mntabl.date_field limit 0,32";
	
	
	
	$res = $db->get_rsltset($strchk);
	$arra = "";
	$arrb = '';
	for($i=0;$i<count($res);$i++)
	{
		$arra .=   "\"".getdateFormat($db,$res[$i]['date_field'])."\"";
		$arrb .= $res[$i]['orders'].",";
		if($i != count($res))
		{
		$arra .= ',';
		}
		$arrc .= "{y: '".getdateFormat($db,$res[$i]['date_field'])."', item1: ".$res[$i]['orders']."},";
	//$arr1[$i] = array($res[$i]['date_field'],$res[$i]['orders']);
	}
	
	

}



?>
<?php include "common/dpselect-functions.php";?>
<?php include "includes/top.php";?>

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
<div class="overlay"></div>
<div class="cs-overlay"></div>

<!--  BEGIN SIDEBAR  -->

<?php include "includes/sidebar.php";?>

<!--  END SIDEBAR  --> 

<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
        <h3>Dashboard - Report for the month of (<?php echo date('F Y');?>)</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12"> <span class="typo-section-head">
        <h3>Order Information</h3>
        </span>
        <div class="row">
          <div class="col-xl-3 mb-4">
            <div class="widget-content widget-content-area br-4">
              <div class="unique-visits">
                <div class="row">
                  <div class="col-md-7 col-sm-7 col-7 mb-3">
                    <p class="u-v-value mb-0 d-flex"><?php echo $ordtotal; ?></p>
                  </div>
                  <div class="col-md-5 col-sm-5 col-5">
                    <p class="u-v-value mb-0 d-flex"><i class="flaticon-cart-bag order-icons"></i></p>
                  </div>
                  <div class="col-md-12">
                    <p class="u-v-txt mb-0">Total Order </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 mb-4">
            <div class="widget-content widget-content-area br-4">
              <div class="unique-visits">
                <div class="row">
                  <div class="col-md-7 col-sm-7 col-7 mb-3">
                    <p class="u-v-value mb-0 d-flex"><?php echo $ordpending; ?></p>
                  </div>
                  <div class="col-md-5 col-sm-5 col-5">
                    <p class="u-v-value mb-0 d-flex"><i class="flaticon-money order-icons"></i></p>
                  </div>
                  <div class="col-md-12">
                    <p class="u-v-txt mb-0">Payment Pending</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-2 mb-4">
            <div class="widget-content widget-content-area br-4">
              <div class="unique-visits">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-6 mb-3">
                    <p class="u-v-value mb-0 d-flex"><?php echo $ordconfirmed; ?></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-6"> </div>
                  <div class="col-md-12">
                    <p class="u-v-txt-blue mb-0">Confirmed <i class="flaticon-single-circle-tick order-icons"></i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-2 mb-4">
            <div class="widget-content widget-content-area br-4">
              <div class="unique-visits">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-6 mb-3">
                    <p class="u-v-value mb-0 d-flex"><?php echo $ordrdelivered; ?></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-6"> </div>
                  <div class="col-md-12">
                    <p class="u-v-txt-green mb-0">Delivered <i class="flaticon-fill-car order-icons"></i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-2 mb-4">
            <div class="widget-content widget-content-area br-4">
              <div class="unique-visits">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-6 mb-3">
                    <p class="u-v-value mb-0 d-flex"><?php echo $ordcanceled; ?></p>
                  </div>
                  <div class="col-md-6 col-sm-6 col-6"> </div>
                  <div class="col-md-12">
                    <p class="u-v-txt-red mb-0">Cancelled <i class="flaticon-circle-cross order-icons"></i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	 
      <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12  ">
        <div class="row layout-spacing">
		 <?php if($_SESSION['RoleId'] != 12){?>
          <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12"> <span class="typo-section-head">
            <h3>Product Information</h3>
            </span>
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
                <div class="widget-content widget-content-area br-4 p-0">
                  <div class="customer-satisfaction text-center">
                    <h6 class="c-s-title mt-3 mb-3">Total Products</h6>
                    <p class="c-s-stats mb-4"><?php echo $prdtotal; ?></p>
                    <div class="d-flex justify-content-center">
                      <div class="invoices">
                        <div class=" align-self-center d-m-i-green  mr-1 data-marker"></div>
                        <span class="i-green">Active</span>
                        <p class="i-green-value  mt-1"><?php echo $activep;?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
                <div class="widget-content widget-content-area br-4 invoices">
                  <div class="titlehead">&nbsp;</div>
                  <div style="">&nbsp;</div>
                  <div class="row text-center mt-4">
                    <div class="col-md-12 mt-2 mb-4">
                      <div class="d-flex justify-content-center">
                        <div class=" align-self-center d-m-i-due  mr-1 data-marker"></div>
                        <span class="i-due">InActive</span> </div>
                      <p class="i-due-value  mt-1"><?php echo $prdinact; ?></p>
                    </div>
                    <div class="col-md-12">
                      <div class="d-flex justify-content-center">
                        <div class=" align-self-center d-m-i-overdue  mr-1 data-marker"></div>
                        <span class="i-overdue">Soldout</span> </div>
                      <p class="i-overdue-value  mt-1"> <?php echo $prdsoldoutcnt; ?></p>
                    </div>
                  </div>
                </div>
              </div>
           
              
              
              
            </div>
          </div>
          
          <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="row">
             <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12  "> <span class="typo-section-head">
                <h3>Customer Information</h3>
                </span></div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
                <div class="widget-content widget-content-area br-4 p-0">
                  <div class="customer-satisfaction text-center">
                    <h6 class="c-s-title mt-3 mb-3">Total Customer</h6>
                    <p class="c-s-stats mb-4"><?php echo $totcust; ?></p>
                    <div class="d-flex justify-content-center">
                      <div class="invoices">
                        <div class=" align-self-center d-m-i-green  mr-1 data-marker"></div>
                        <span class="i-green">Active</span>
                        <p class="i-green-value  mt-1"><?php echo $rslt_cust['customer']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  
			  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
                <div class="widget-content widget-content-area br-4 p-0">
                  <div class="customer-satisfaction text-center">
                    <h6 class="c-s-title mt-3 mb-3">&nbsp;</h6>
                    <p class="c-s-stats mb-4"><?php echo $totcust; ?></p>
                    <div class="d-flex justify-content-center">
                      <div class="invoices">
                        <div class=" align-self-center d-m-i-due  mr-1 data-marker"></div>
                        <span class="i-due">InActive</span>
                        <p class="i-due-value  mt-1"><?php echo $rslt_cust['custinact']; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  
               
              </div>
              </div>
	  <?php }?>	  
			  
          <div class="col-xl-12">
            <div class="widget-content widget-content-area br-4 p-0">
              <div class="recent-activity">
                <div class="recent-activity-header">
                  <h6 class="mb-0">Latest Orders</h6>
                </div>
                <div class="recent-activity-body">
                  <div class="table-responsive mt-3">
                    <table class="table">
                      <tbody>
                        <?php
								for($m=0;$m<count($rslt_ordr);$m++)
								{
								?>
                        <tr>
                          <td><div class="d-flex">
                              <div class="f-head"> <img src="assets/img/90x90.jpg" class="rounded-circle mr-4 mCS_img_loaded" alt="user"> </div>
                              <div class="f-body">
                                <p class="a-f-comment mb-1"> <span class="usr-name">#<?php echo $rslt_ordr[$m]['order_reference'];?></span> <i class="flaticon-user-9"></i> <?php echo $rslt_ordr[$m]['Customer_Names'];?> </p>
                                <p class="meta-info mb-0"> <span class="a-f-meta-usr-name mr-2"><i class="flaticon-next"></i> <?php echo $rslt_ordr[$m]['order_status'];?> </span> <span class="a-f-meta-time"><i class="flaticon-stopwatch-1"></i> <?php echo date('d/m/Y h:i A',strtotime($rslt_ordr[$m]['date_added']));?></span> <?php echo $rslt_ordr[$m]['total'];?> </p>
                              </div>
                            </div></td>
                          <td class="text-right"><a href="orders_view.php?orderId=<?php echo $rslt_ordr[$m]['order_id'];?>"  class="btn btn-outline-secondary btn-reply-action mb-3">View</a></td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center  pb-4"> <a href="orders_mng.php" class="btn btn-secondary btn-rounded mt-1">View More</a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  END CONTENT PART  --> 
  
</div>
<!-- END MAIN CONTAINER --> 

<!--  BEGIN FOOTER  -->
<?php include('includes/footer.php');?>
