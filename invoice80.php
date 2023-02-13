<?php
//call the FPDF library
require('fpdf/fpdf.php');
include_once'connectdb.php';

$id= $_GET['id']; 
$select=$pdo->prepare("select * from tbl_invoice where invoice_id=$id");
$select->execute();     //where invoice_no=$id                
//$row = $select->fetch(PDO::FETCH_ASSOC) ;
$row = $select->fetch(PDO::FETCH_OBJ);
$pdf = new FPDF('P','mm',array(80,200));
//add new page
$pdf->AddPage();
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',16);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(60 ,8,'CYBARG INC.',1,1,"C");
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,5,'2271  PROGRESS WAY , NEW YORK-USA',0,1,"C");
$pdf->Cell(60,5,'PHONE NUMBER : 347-853-9584',0,1,"C");
$pdf->Cell(60,5,'EMAIL ADDRESS : billing@cybarg.com ',0,1,"C");
$pdf->Cell(60,5,'WEBSITE : www.cybarg.com ',0,1,"C");
$pdf->Line(7,38,72,38);
$pdf->Ln(1);//Line break
$pdf->SetFont('Arial','BI',8);
$pdf->Cell(20,4,'Bill To :',0,0,"");
$pdf->SetFont('Courier','BI',8);
$pdf->Cell(40,4, $row->customer_name,0,1,"");
$pdf->SetFont('Arial','BI',8);
$pdf->Cell(20,4,'Invoice No :',0,0,"");
$pdf->SetFont('Courier','BI',8);
$pdf->Cell(40,4, $row->invoice_id,0,1,"");
$pdf->SetFont('Arial','BI',8);
$pdf->Cell(20,4,'Date :',0,0,"");
$pdf->SetFont('Courier','BI',8);
$pdf->Cell(40,4, $row->order_date,0,1,"");
//$pdf->Line(5,53,70,53);
//$pdf->Ln(2);//Line break

$y_axis_initial = 53;
    $pdf->SetY($y_axis_initial);
    $pdf->SetX(7);
    $row_height = 5;
    $y_axis = $y_axis_initial + $row_height;



    //initialize counter
    $i = 0;


 $select=$pdo->prepare("select * from tbl_invoice_details where invoice_id=$id ");
//select * from invoice_details inner join invoice using(invoice_no) where invoice_no=$id       
      $select->execute();                    
                          
       
           $pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(208,208,208);
$pdf->Cell(34,5,'PRODUCT',1,0,"L");
$pdf->Cell(11,5,'PRICE',1,0,"C");
$pdf->Cell(8,5,'QTY',1,0,"C");
$pdf->Cell(12,5,'TOTAL',1,1,"C");
           
           
           
 while( $item = $select->fetch(PDO::FETCH_OBJ) ) { 
   
    // $pdf->SetY($y_axis);
        $pdf->SetX(7);
     
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(34,5,$item->product_name,1,0,"");
$pdf->Cell(11,5,$item->price,1,0,"C");
$pdf->Cell(8,5,$item->qty,1,0,"C");
$pdf->Cell(12,5,$item->price*$item->qty,1,1,"C");
     //Go to next row
     
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;

}

 
       $pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'SUBTOTAL',1,0,"L");
$pdf->Cell(20,5,$row->subtotal,1,1,"C");

$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'TAX(5%)',1,0,"L");
$pdf->Cell(20,5,$row->tax,1,1,"C");

$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'DISCOUNT',1,0,"L");
$pdf->Cell(20,5,$row->discount,1,1,"C");



$pdf->SetX(7);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'GRAND TOTAL',1,0,"L");
$pdf->Cell(20,5,'$'.$row->total,1,1,"C");


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'PAID',1,0,"L");
$pdf->Cell(20,5,$row->paid,1,1,"C");


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'DUE',1,0,"L");
$pdf->Cell(20,5,$row->due,1,1,"C");


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(20,5,'',0,0,"");
//$pdf->Cell(11,5,'',0,0,"");
$pdf->Cell(25,5,'PAYMENT TYPE',1,0,"L");
$pdf->Cell(20,5,$row->payment_type,1,1,"C");


$pdf->SetX(7);
$pdf->Cell(20,5,'',0,1,"");

$pdf->SetX(5);
$pdf->SetFont('Courier','B',8);
$pdf->Cell(25,5,'Important Notice :',0,1,"");
$pdf->SetX(5);
$pdf->SetFont('Arial','',6);
$pdf->Cell(75,5,'No item will be replaced or refunded if you dont have the invoice with you. 
',0,2,"");
$pdf->SetX(5);
$pdf->Cell(75,5,'You can refund within 2 days of purchase.',0,1,"");
       

$pdf->Output();


?>



/////////////


 
    






