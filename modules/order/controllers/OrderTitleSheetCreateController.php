<?php

namespace app\modules\order\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\order\models\Order;
use app\modules\order\logic\OrderLogic;

class OrderTitleSheetCreateController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    public $activeSheet;
    public $objPHPExcel;
    public $styleBorder;
    public $order;
    public $styleData;
    public $styleCenter;
    public $styleNameOrder;
    
    public function actionIndex($order_id) 
    { 
        $this->order = Order::findOne($order_id);
        $this->order->getNumber()->countWeightOrder()->convertLocation();
        //debug($this->order);
        $this->objPHPExcel = new \PHPExcel();
        $this->setActiveSheet();
        $this->setSetup();
        $this->setTitles();
        $this->setInfoOrder();
        $this->setHeaderAndFooter();
        $this->setStyleBorders();
        $this->setWeight();
        $this->setFooter();
        $this->setDataOrder();
        $this->setStyleFieldOrder();
        $this->setTotalStyle();
        $this->setStyleFieldBoss();
             
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename='title-order.xls'");

        $objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }
    
    private function setActiveSheet() 
    {
        $this->objPHPExcel->setActiveSheetIndex(0);
        $this->activeSheet = $this->objPHPExcel->getActiveSheet();    
    }
    
    private function setSetup()
    {
        $this->setPageSetup();
        $this->setHeaderAndFooter();
        $this->setFont();
        $this->setWidthOfColumn();   
    }
    
    private function setPageSetup() 
    {
        $this->activeSheet->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);//ORIENTATION_PORTRAIT
        $this->activeSheet->getPageSetup()->SetPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
						
        $this->activeSheet->getPageMargins()->setTop(0.75);
        $this->activeSheet->getPageMargins()->setRight(0.25);
        $this->activeSheet->getPageMargins()->setLeft(0.75);
        $this->activeSheet->getPageMargins()->setBottom(0.75);   
    }
    
    private function setHeaderAndFooter()
    {
        //$this->activeSheet->setTitle("Лист 1");	
        $this->activeSheet->getHeaderFooter()->setOddHeader("&L&14Инвентарный №".$this->order->inventory);	
        //$this->activeSheet->getHeaderFooter()->setOddFooter('&L&B'.$this->activeSheet->getTitle().'&RСтраница &P из &N');   
    }
    
    private function setFont()
    {
        $this->objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $this->objPHPExcel->getDefaultStyle()->getFont()->setSize(10);   
    }
    
    private function setWidthOfColumn()
    {   
        foreach(range('A','Z') as $columnID) {
            $this->activeSheet->getColumnDimension($columnID)->setWidth(5);
        } 
    }
    
    private function setTitles()
    { 
        //set height row 
        $this->activeSheet->getRowDimension('1')->setRowHeight(60);
        $this->activeSheet->getRowDimension('2')->setRowHeight(60);
        $this->activeSheet->getStyle('A1:Z1')->getAlignment()->setWrapText(true);
        //fill field
        $this->activeSheet->setCellValue('A1','ДМК');
        $this->activeSheet->setCellValue('E1','Дата получения заказа');
        $this->activeSheet->setCellValue('G1','Дата открытия заказа');
        $this->activeSheet->setCellValue('I1','Дата закрытия заказа');    
        $this->activeSheet->setCellValue('K1','Заказ');    
        $this->activeSheet->setCellValue('S1','Статья затрат'); 
        $this->activeSheet->setCellValue('U1','Заказчик'); 
        $this->activeSheet->setCellValue('X1','№ заказа'); 
        //$this->activeSheet->setCellValue('A2','цех, отдел'); 
        //merge field
        $this->activeSheet->mergeCells('A1:D1');
        $this->activeSheet->mergeCells('A2:D2');
        $this->activeSheet->mergeCells('E1:F1');
        $this->activeSheet->mergeCells('E2:F2');
        $this->activeSheet->mergeCells('G1:H1');
        $this->activeSheet->mergeCells('G2:H2');
        $this->activeSheet->mergeCells('I1:J1');
        $this->activeSheet->mergeCells('I2:J2');
        $this->activeSheet->mergeCells('K1:R2');
        $this->activeSheet->mergeCells('S1:T1');
        $this->activeSheet->mergeCells('S2:T2');
        $this->activeSheet->mergeCells('U1:W1');
        $this->activeSheet->mergeCells('U2:W2');
        $this->activeSheet->mergeCells('X1:Z1');
        $this->activeSheet->mergeCells('X2:Z2');
    }
    
    private function setInfoOrder()
    {
        //set height row 
        $this->activeSheet->getRowDimension('3')->setRowHeight(40);
        $this->activeSheet->getRowDimension('4')->setRowHeight(35);
        $this->activeSheet->getRowDimension('5')->setRowHeight(35);
        //merge field
        $this->activeSheet->mergeCells('A3:I3');
        $this->activeSheet->mergeCells('A4:I5');
        $this->activeSheet->mergeCells('J3:S3');
        $this->activeSheet->mergeCells('J4:S5');
        $this->activeSheet->mergeCells('T3:Z3');
        $this->activeSheet->mergeCells('T4:Z4');
        $this->activeSheet->mergeCells('T5:Z5');  
        //fill field
        $this->activeSheet->setCellValue('A3','Агрегат, механизм');
        $this->activeSheet->setCellValue('J3','Узел');
        $this->activeSheet->setCellValue('T3','Принять к изготовлению');
        $this->activeSheet->setCellValue('T4','Срок исполнения ________________');  
        $this->activeSheet->setCellValue('T5','Директор РСЦ ___________________');
    }
    
    private function setWeight()
    {
        //set height row 
        $this->activeSheet->getRowDimension('6')->setRowHeight(40); 
        $this->activeSheet->getRowDimension('7')->setRowHeight(25);
        $this->activeSheet->getRowDimension('8')->setRowHeight(25);
        $this->activeSheet->getRowDimension('9')->setRowHeight(25); 
        //merge field
        $this->activeSheet->mergeCells('A6:E6');
        $this->activeSheet->mergeCells('A7:E7');
        $this->activeSheet->mergeCells('A8:E8');
        $this->activeSheet->mergeCells('A9:E9');
        $this->activeSheet->mergeCells('F6:H6');
        $this->activeSheet->mergeCells('F7:H7');
        $this->activeSheet->mergeCells('F8:H8');
        $this->activeSheet->mergeCells('F9:H9');
        $this->activeSheet->mergeCells('I6:K6');
        $this->activeSheet->mergeCells('I7:K7');
        $this->activeSheet->mergeCells('I8:K8');
        $this->activeSheet->mergeCells('I9:K9');
        $this->activeSheet->mergeCells('L6:N6');
        $this->activeSheet->mergeCells('L7:N7');
        $this->activeSheet->mergeCells('L8:N8');
        $this->activeSheet->mergeCells('L9:N9');
        $this->activeSheet->mergeCells('A6:E6');
        $this->activeSheet->mergeCells('A7:E7');
        $this->activeSheet->mergeCells('A8:E8');
        $this->activeSheet->mergeCells('A9:E9');
        $this->activeSheet->mergeCells('O6:Q6');
        $this->activeSheet->mergeCells('O7:Q7');
        $this->activeSheet->mergeCells('O8:Q8');
        $this->activeSheet->mergeCells('O9:Q9');
        $this->activeSheet->mergeCells('R6:T6');
        $this->activeSheet->mergeCells('R7:T7');
        $this->activeSheet->mergeCells('R8:T8');
        $this->activeSheet->mergeCells('R9:T9');
        $this->activeSheet->mergeCells('U6:Z6');
        $this->activeSheet->mergeCells('U7:Z7');
        $this->activeSheet->mergeCells('U8:Z8');
        $this->activeSheet->mergeCells('U9:Z9');
        //fill field
        $this->activeSheet->setCellValue('A6','Весовые данные');
        $this->activeSheet->setCellValue('A7','С обработкой');
        $this->activeSheet->setCellValue('A8','Без обработки');
        $this->activeSheet->setCellValue('F6','Чугунное литье');
        $this->activeSheet->setCellValue('I6','Стальное литье');
        $this->activeSheet->setCellValue('L6','Цветное литье');
        $this->activeSheet->setCellValue('O6','Поковка');
        $this->activeSheet->setCellValue('R6','Из проката');
        $this->activeSheet->setCellValue('U6','Всего'); 
    }
    
    private function setFooter()
    {
        //set height row 
        $this->activeSheet->getRowDimension('10')->setRowHeight(70);
        $this->activeSheet->getRowDimension('11')->setRowHeight(70);
        //merge field
        $this->activeSheet->mergeCells('A10:K10');
        $this->activeSheet->mergeCells('A11:K11');
        $this->activeSheet->mergeCells('L10:Z10');
        $this->activeSheet->mergeCells('L11:Z11');
        //fill field 
        $this->activeSheet->setCellValue('A10','Содержание или характер работы');
        $this->activeSheet->setCellValue('L10','Запасные части, новое оборудование, сменное оборудование, метизы,
        инструменты и приспособления, ремонт и ревизия.');
        //style
        $this->activeSheet->getStyle('L10')->getAlignment()->setWrapText(true);  
    }
    
    private function setDataOrder()
    {
        $this->activeSheet->setCellValue('A2','РСЦ РМЦ');
        //equipment
        $equipment = $this->order->equ_blank ? $this->order->equ_blank : '';
        $this->activeSheet->setCellValue('A4', $equipment);
        //unit
        $unit = $this->order->unit_blank ?  $this->order->unit_blank : '';
        $this->activeSheet->setCellValue('J4', $unit);
        $this->activeSheet->setCellValue('A11', $this->order->description); 
        $this->activeSheet->setCellValue('S2', $this->order->type);
        $this->activeSheet->setCellValue('U2', 'РСЦ ЦРМО  стан 400/200');
        $this->activeSheet->setCellValue('X2', $this->order->number);
        $this->activeSheet->setCellValue('U7', $this->order->weight.'кг');
        $this->activeSheet->setCellValue('L11','Нач. участка РСЦ ЦРМО(СПС)                     Лисецкий В.Р.');   
        //style
        $this->activeSheet->getStyle('U2')->getAlignment()->setWrapText(true);
    }
    
    private function setStyleBorders()
    {
        $this->styleBorder = [
	       'borders'=> [
		      //'outline' => ['style'=>\PHPExcel_Style_Border::BORDER_THICK],
		      'allborders'=>['style'=>\PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb'=>'000']]
	       ]
        ];  
        $this->activeSheet->getStyle('A1:Z11')->applyFromArray($this->styleBorder);  
    }
    
    private function setStyleFieldOrder()
    {
        $style_order = [
            'font'=>['bold' => true, 'size' => 20],
	       'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER],
        ];
        $this->activeSheet->getStyle('K1')->applyFromArray($style_order);    
    }
    
    private function setStyleFieldBoss()
    {
        $style_boss = ['font'=>['bold' => true, 'size' => 12]];
        $this->activeSheet->getStyle('L11')->applyFromArray($style_boss);    
    }
    
    private function setTotalStyle()
    {
        $style_total = [
            'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]
        ];
        $this->activeSheet->getStyle('A1:Z11')->applyFromArray($style_total);
    }
    
    
   
    
    public function setStyleFieldDate()
    {
            $style_tdate = array(
    	'alignment' => array(
    		'horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_RIGHT,
    	),
    	'fill' => array(
    		'type' => \PHPExcel_STYLE_FILL::FILL_SOLID,
    		'color'=>array(
    			'rgb' => 'CFCFCF'
    		)
    	),
    	'borders' => array(
    		'right' => array(
    		'style'=>\PHPExcel_Style_Border::BORDER_NONE
    		)
    	
    	)
    
    
    );
    
    $this->activeSheet->getStyle('A4:C4')->applyFromArray($style_tdate);
    
    $style_date = array(
    	
    	'fill' => array(
    		'type' => \PHPExcel_STYLE_FILL::FILL_SOLID,
    		'color'=>array(
    			'rgb' => 'CFCFCF'
    		)
    	),
    	'borders' => array(
    		'left' => array(
    			'style'=>\PHPExcel_Style_Border::BORDER_NONE
    		)
    	
    	),
    );
    
    $this->activeSheet->getStyle('D4')->applyFromArray($style_date);    
    }
    

    
}