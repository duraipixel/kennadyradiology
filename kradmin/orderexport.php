<?php
include_once("include/config_db.php");
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';

   $str_all= " SELECT t1.*,Date_Format(t1.date_added,'%d-%m-%Y') as date,Date_Format(t1.date_added,'%H:%i') as time,t2.order_statusName as order_status,(case when t1.payment_method='COD' then 'Unsuccess' else 'Success' end) as paymentstatus,t4.product_sku,t4.order_product_id,t4.product_name,t4.product_qty,t4.product_price,t4.product_id,t4.tax_type,t4.tax_value,t4.tax_name,t5.img_path,t6.countryname as billingcountry,t7.statename as billingstate,t8.countryname as shippingcountry,t9.statename as shippingstate,t10.Attribute_Name,t10.Attribute_value_name,t4.IsCustomtool, t4.CustomtoolImg  FROM  ".TPLPrefix."orders t1  left join ".TPLPrefix."order_status t2 on t2.order_statusId = t1.order_status_id inner join ".TPLPrefix."orders_products t4 on t1.order_id=t4.order_id and t4.IsActive=1
      left join ".TPLPrefix."orders_products_attribute t10 on t10.order_product_id=t4.order_product_id and t10.IsActive=1 
	 left join ".TPLPrefix."product_images t5 on t5.product_id=t4.product_id and t5.IsActive=1 and t5.ordering=1 inner join ".TPLPrefix."country t6 on t1.payment_country_id=t6.countryid and t6.IsActive=1 inner join ".TPLPrefix."state t7 on t1.paymentStateId=t7.stateid and t7.IsActive=1 inner join ".TPLPrefix."country t8 on t1.shipping_country_id=t8.countryid and t8.IsActive=1 inner join ".TPLPrefix."state t9 on t1.shipping_state_id=t9.stateid and t9.IsActive=1  where  t1.IsActive=1 and t1.order_status_id IN (1,2,3) group by t4.order_product_id "; 
 	 
/*
$str_all="select t1.date_added,t1.order_reference,op.product_name,op.product_sku,op.product_qty,op.product_price,op.tax_value,op.subtotal,concat(t1.billing_fname,' ',t1.billing_lname) as billingcustomer,t1.payment_address_1,t1.payment_city,t1.billing_state,t1.payment_postcode,t1.billing_mobile,t1.shipping_address,t1.shipping_city,t1.shipping_state,t1.shipping_pincode,t1.shipping_gstno,t1.billing_email,t1.awbno,t2.countryname as billcountry,t3.statename as billstate,t5.countryname as shipcountry,t6.statename as shipstate from ".TPLPrefix."orders as t1 inner join ".TPLPrefix."orders_products as op on t1.orderID=op.orderID inner join ".TPLPrefix."country t2 on t1.payment_country=t2.countryid and t2.IsActive=1 inner join ".TPLPrefix."state t3 on t1.paymentStateId=t3.stateid and t3.IsActive=1 inner join ".TPLPrefix."country t5 on t1.shipping_country=t5.countryid and t5.IsActive=1 inner join ".TPLPrefix."state t6 on t1.shipping_state=t6.stateid and t6.IsActive=1  where 1=1 and t1.order_status =1";*/

$result = $db->get_rsltset($str_all);

  
	 
	
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Auctionproduct");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Order Date')
            ->setCellValue('B1', 'Order ID')
			->setCellValue('C1', 'Product Name')
 			->setCellValue('D1', 'SKU')
			->setCellValue('E1', 'Quantity')
			->setCellValue('F1', 'Price')
			->setCellValue('G1', 'Tax')
			->setCellValue('H1', 'Sub Total')
			->setCellValue('I1', 'Billing Name')
			->setCellValue('J1', 'Billing Address')
			->setCellValue('K1', 'Billing City')
			->setCellValue('L1', 'Billing State')
			->setCellValue('M1', 'Pincode')
			->setCellValue('N1', 'Contact')
			->setCellValue('O1', 'Shipping Address')
			->setCellValue('P1', 'Shipping City')
			->setCellValue('Q1', 'Shiping State')
			->setCellValue('R1', 'Pincode')
			->setCellValue('S1', 'GST')
			->setCellValue('T1', 'Email ID') 
			->setCellValue('U1', 'Tracking')
			;
 
// Miscellaneous glyphs, UTF-8
$num_row = 1;
foreach ($result as $value) {
	
   $num_row++;
   
 $product = $value['product_name'];
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$num_row, $value['date'])
                ->setCellValue('B'.$num_row, $value['order_reference'])
				->setCellValue('C'.$num_row,  $value['product_name'])
				->setCellValue('D'.$num_row, $value['product_sku'])
				->setCellValue('E'.$num_row, $value['product_qty'])
				->setCellValue('F'.$num_row, $value['product_price'])
				->setCellValue('G'.$num_row, $value['tax_value'])
				->setCellValue('H'.$num_row, $value['cart_total'])
				->setCellValue('I'.$num_row, $value['firstname'].' '.$value['lastname'])
				->setCellValue('J'.$num_row, $value['payment_address_1'])
				->setCellValue('K'.$num_row, $value['payment_city'])
				->setCellValue('L'.$num_row, $value['billingstate'])
				->setCellValue('M'.$num_row, $value['payment_postcode'])
				->setCellValue('N'.$num_row, $value['payment_telephone'])
				->setCellValue('O'.$num_row, $value['shipping_address_1'])
				->setCellValue('P'.$num_row, $value['shipping_city'])
				->setCellValue('Q'.$num_row, $value['shippingstate']) 
				->setCellValue('R'.$num_row, $value['shipping_postcode'])
				->setCellValue('S'.$num_row, $value['payment_gstno'])
				->setCellValue('T'.$num_row, $value['email'])
				->setCellValue('U'.$num_row, $value['awbno']);
				
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client's web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="orderlist.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
