<?php

namespace app\modules\order\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\order\models\Order;
use app\modules\order\logic\OrderLogic;

class OrderListExcelCreateController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    public $activeSheet;
    public $objPHPExcel;
    public $styleBorder;
    public $orders;
    public $styleData;
    public $styleNameOrder;
    
    public function actionIndex() 
    { 
        $this->orders = Order::getListForFile();
        $this->objPHPExcel = new \PHPExcel();
        $this->setActiveSheet();
        $this->setSetup();
        $this->setTitles();
        $this->setStyleBorders();
        $this->setStyleData();
        $this->setStyleNameOrder();
        $this->setDataOrders();
        $this->setStyleTitles();
             
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename='orders.xls'");

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
    
    private function setWidthOfColumn()
    {
        $this->activeSheet->getColumnDimension('A')->setWidth(10);
        $this->activeSheet->getColumnDimension('B')->setWidth(10);
        $this->activeSheet->getColumnDimension('C')->setWidth(100);
        $this->activeSheet->getColumnDimension('D')->setWidth(15);    
        $this->activeSheet->getColumnDimension('E')->setWidth(15);    
        $this->activeSheet->getColumnDimension('F')->setWidth(15);    
    }
    
    private function setTitles()
    {
        $this->activeSheet->getRowDimension('1')->setRowHeight(20);
        $this->activeSheet->setCellValue('A1','Дата');
        $this->activeSheet->setCellValue('B1','№заказа');
        $this->activeSheet->setCellValue('C1','Наименование заказа');
        $this->activeSheet->setCellValue('D1','Служба');    
        $this->activeSheet->setCellValue('E1','Заказчик');    
        $this->activeSheet->setCellValue('F1','Примечание');    
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
    }
    
    private function setStyleTitles()
    {
        $style_titles = [
            'font'=>['bold' => true, 'name' => 'Times New Roman','size' => 12],
	       'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER],
	       //'fill' => ['type' => \PHPExcel_STYLE_FILL::FILL_SOLID, 'color' => ['rgb' => 'CFCFCF']]
        ];
        $this->activeSheet->getStyle('A1:F1')->applyFromArray($style_titles);    
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