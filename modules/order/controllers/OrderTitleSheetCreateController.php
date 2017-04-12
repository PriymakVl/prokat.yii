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
    public $styleNameOrder;
    
    public function actionIndex($order_id) 
    { 
        $this->order = Order::findOne($order_id);
        $this->objPHPExcel = new \PHPExcel();
        $this->setActiveSheet();
        $this->setSetup();
        $this->setTitles();
        $this->setInfoOrder();
        $this->setStyleBorders();
        //$this->setStyleData();
        //$this->setStyleNameOrder();
        //$this->setDataOrders();
        $this->setStyleFieldOrder();
        $this->setStyleTitles();
             
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
        //$this->setWidthOfColumn();   
    }
    
    private function setPageSetup() 
    {
        $this->activeSheet->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);//ORIENTATION_PORTRAIT
        $this->activeSheet->getPageSetup()->SetPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
						
        $this->activeSheet->getPageMargins()->setTop(1);
        $this->activeSheet->getPageMargins()->setRight(0.25);
        $this->activeSheet->getPageMargins()->setLeft(0.75);
        $this->activeSheet->getPageMargins()->setBottom(1);   
    }
    
    private function setHeaderAndFooter()
    {
        $this->activeSheet->setTitle("Лист 1");	
        //$this->activeSheet->getHeaderFooter()->setOddHeader("&CШапка нашего прайс листа");	
        //$this->activeSheet->getHeaderFooter()->setOddFooter('&L&B'.$this->activeSheet->getTitle().'&RСтраница &P из &N');   
    }
    
    private function setFont()
    {
        $this->objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $this->objPHPExcel->getDefaultStyle()->getFont()->setSize(10);   
    }
    
//    private function setWidthOfColumn()
//    {
//        $this->activeSheet->getColumnDimension('A')->setWidth(10);
//        $this->activeSheet->getColumnDimension('B')->setWidth(10);
//        $this->activeSheet->getColumnDimension('C')->setWidth(100);
//        $this->activeSheet->getColumnDimension('D')->setWidth(15);    
//        $this->activeSheet->getColumnDimension('E')->setWidth(15);    
//        $this->activeSheet->getColumnDimension('F')->setWidth(15);    
//    }
    
    private function setTitles()
    {
        //set width column
        $this->activeSheet->getColumnDimension('A')->setWidth(20);
        $this->activeSheet->getColumnDimension('B')->setWidth(10);
        $this->activeSheet->getColumnDimension('C')->setWidth(10);
        $this->activeSheet->getColumnDimension('D')->setWidth(10);    
        $this->activeSheet->getColumnDimension('E')->setWidth(50);    
        $this->activeSheet->getColumnDimension('F')->setWidth(10);
        $this->activeSheet->getColumnDimension('G')->setWidth(20);
        $this->activeSheet->getColumnDimension('H')->setWidth(20); 
        //set height row 
        $this->activeSheet->getRowDimension('1')->setRowHeight(60);
        $this->activeSheet->getRowDimension('2')->setRowHeight(60);
        $this->activeSheet->getStyle('A1:H1')->getAlignment()->setWrapText(true);
        //fill field
        $this->activeSheet->setCellValue('A1','Завод');
        $this->activeSheet->setCellValue('B1','Дата получения заказа');
        $this->activeSheet->setCellValue('C1','Дата открытия заказа');
        $this->activeSheet->setCellValue('D1','Дата закрытия заказа');    
        $this->activeSheet->setCellValue('E1','Заказ');    
        $this->activeSheet->setCellValue('F1','Статья затрат'); 
        $this->activeSheet->setCellValue('G1','Заказчик'); 
        $this->activeSheet->setCellValue('H1','№ заказа'); 
        $this->activeSheet->setCellValue('A2','цех, отдел'); 
        //merge field
        $this->activeSheet->mergeCells('E1:E2');
    }
    
    private function setInfoOrder()
    {
        //set height row 
        $this->activeSheet->getRowDimension('3')->setRowHeight(50);
        $this->activeSheet->getRowDimension('4')->setRowHeight(70);
        //merge field
        $this->activeSheet->mergeCells('A3:D3');
        $this->activeSheet->mergeCells('A4:D4');
        $this->activeSheet->mergeCells('F3:H3');
        $this->activeSheet->mergeCells('F4:H4');  
        //fill field
        $this->activeSheet->setCellValue('A3','Агрегат, механизм');
        $this->activeSheet->setCellValue('E3','Узел');
        $this->activeSheet->setCellValue('F3','Принять к изготвлению');  
    }
    
    private function setDataOrders()
    {
        $row_start = 2;
        $i = 0;
        foreach($this->orders as $order) {
        	$row_next = $row_start + $i;
            $this->activeSheet->getRowDimension($i + 2)->setRowHeight(20);
        	$this->activeSheet->setCellValue('A'.$row_next,$order->date);
        	$this->activeSheet->setCellValue('B'.$row_next,$order->number);
        	$this->activeSheet->setCellValue('C'.$row_next,$order->name);
        	$this->activeSheet->setCellValue('D'.$row_next,$order->service);
        	$this->activeSheet->setCellValue('E'.$row_next,$order->customer);
            $this->activeSheet->getStyle('A1:F'.($i + 2))->applyFromArray($this->styleBorder);
            $this->activeSheet->getStyle('A2:F'.($i + 2))->applyFromArray($this->styleData);
            $this->activeSheet->getStyle('C1:C'.($i + 2))->applyFromArray($this->styleNameOrder);
        	$i++;
        }    
    }
    
    private function setStyleBorders()
    {
        $this->styleBorder = [
	       'borders'=> [
		      //'outline' => ['style'=>\PHPExcel_Style_Border::BORDER_THICK],
		      'allborders'=>['style'=>\PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb'=>'000']]
	       ]
        ];  
        $this->activeSheet->getStyle('A1:H2')->applyFromArray($this->styleBorder);  
    }
    
    private function setStyleFieldOrder()
    {
        $style_order = [
            'font'=>['bold' => true, 'size' => 20],
	       'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER],
        ];
        $this->activeSheet->getStyle('E1')->applyFromArray($style_order);    
    }
    
    private function setStyleTitles()
    {
        $style_titles = [
            //'font'=>['bold' => true, 'name' => 'Times New Roman','size' => 12],
	       'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER],
	       //'fill' => ['type' => \PHPExcel_STYLE_FILL::FILL_SOLID, 'color' => ['rgb' => 'CFCFCF']]
        ];
        $this->activeSheet->getStyle('A1:H1')->applyFromArray($style_titles);    
    }
    
    private function setStyleData()
    {
        $this->styleData = [
            'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]
        ];
    }
    
    private function setStyleNameOrder()
    {
        $this->styleNameOrder = [
            'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT]
        ];    
    }
    
    private function setStyleSlogan()
    {
                $style_slogan = array(
        	'font'=>array(
        		'bold' => true,
        		'italic' => true,
        		'name' => 'Times New Roman',
        		'size' => 13,
        		'color'=>array(
        			'rgb' => '8B8989'
        		)	
        	),
        	'alignment' => array(
        		'horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
        		'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
        	),
        	'fill' => array(
        		'type' => \PHPExcel_STYLE_FILL::FILL_SOLID,
        		'color'=>array(
        			'rgb' => 'CFCFCF'
        		)
        	),
        	'borders' => array(
        		'bottom' => array(
        		'style'=>\PHPExcel_Style_Border::BORDER_THICK
        		)
        	
        	)
        );
        $this->activeSheet->getStyle('A2:D2')->applyFromArray($style_slogan);    
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
    
    private function setStyleFieldHeaderPrice()
    {
        $style_hprice = array(
	'alignment' => array(
		'horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
	),
	'fill' => array(
		'type' => \PHPExcel_STYLE_FILL::FILL_SOLID,
		'color'=>array(
			'rgb' => 'CFCFCF'
		)
	),
	'font'=>array(
		'bold' => true,
		'italic' => true,
		'name' => 'Times New Roman',
		'size' => 10
	),
	


);

$this->activeSheet->getStyle('A6:D6')->applyFromArray($style_hprice);

$this->stylePrice = array(
	'alignment' => array(
		'horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
	)
	

);    
    }
    
    private function setStyleFields()
    {
        $this->setStyleWrap();
        $this->setStyleHeader();
        $this->setStyleSlogan();
        $this->setStyleFieldDate();
        $this->setStyleFieldHeaderPrice();    
    }
    
    
    
    
}