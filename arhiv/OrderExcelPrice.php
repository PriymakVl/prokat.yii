<?php

namespace app\modules\order\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\order\models\Order;
use app\modules\order\models\Tovar;
use app\modules\order\logic\OrderLogic;

class OrderExcelCreateController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    public $priceList;
    public $activeSheet;
    public $objPHPExcel;
    public $styleWrap;
    public $stylePrice;
    
    private function setActiveSheet() 
    {
        $this->objPHPExcel->setActiveSheetIndex(0);
        $this->activeSheet = $this->objPHPExcel->getActiveSheet();    
    }
    
    private function setPageSetup() 
    {
        $this->activeSheet->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $this->activeSheet->getPageSetup()->SetPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
						
        $this->activeSheet->getPageMargins()->setTop(1);
        $this->activeSheet->getPageMargins()->setRight(0.75);
        $this->activeSheet->getPageMargins()->setLeft(0.75);
        $this->activeSheet->getPageMargins()->setBottom(1);   
    }
    
    private function setHeaderAndFooter()
    {
        $this->activeSheet->setTitle("Прайс лист");	
        $this->activeSheet->getHeaderFooter()->setOddHeader("&CШапка нашего прайс листа");	
        $this->activeSheet->getHeaderFooter()->setOddFooter('&L&B'.$this->activeSheet->getTitle().'&RСтраница &P из &N');   
    }
    
    private function setFont()
    {
        $this->objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $this->objPHPExcel->getDefaultStyle()->getFont()->setSize(8);   
    }
    
    private function setWidthOfColumn()
    {
        $this->activeSheet->getColumnDimension('A')->setWidth(7);
        $this->activeSheet->getColumnDimension('B')->setWidth(80);
        $this->activeSheet->getColumnDimension('C')->setWidth(10);
        $this->activeSheet->getColumnDimension('D')->setWidth(10);    
    }
    
    private function setTitleField()
    {
        $this->activeSheet->mergeCells('A1:D1');
        $this->activeSheet->getRowDimension('1')->setRowHeight(40);
        $this->activeSheet->setCellValue('A1','Техно мир');    
    }
    
    private function setSubTitleField()
    {
        $this->activeSheet->mergeCells('A2:D2');
        $this->activeSheet->setCellValue('A2','Компьютеы и комплектующие на любой вкус и цвет');    
    }
    
    private function setDateField()
    {
        $this->activeSheet->mergeCells('A4:C4');
        $this->activeSheet->setCellValue('A4','Дата создания прайслиста');
        $date = date('d-m-Y');
        $this->activeSheet->setCellValue('D4',$date);
        $this->activeSheet->getStyle('D4')->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX14);    
    }
    
    private function setColumnName()
    {
        $this->activeSheet->setCellValue('A6','№п.п');
        $this->activeSheet->setCellValue('B6','Имя');
        $this->activeSheet->setCellValue('C6','Цена');
        $this->activeSheet->setCellValue('D6','кол-во');    
    }
    
    private function setDataFields()
    {
        $row_start = 7;
        $i = 0;
        foreach($this->priceList as $item) {
        	$row_next = $row_start + $i;
        	$this->activeSheet->setCellValue('A'.$row_next,$item['id']);
        	$this->activeSheet->setCellValue('B'.$row_next,$item['name']);
        	$this->activeSheet->setCellValue('C'.$row_next,$item['price']);
        	$this->activeSheet->setCellValue('D'.$row_next,$item['quantity']);
            $this->activeSheet->getStyle('A7:D'.($i+6))->applyFromArray($this->stylePrice);
            $this->activeSheet->getStyle('A1:D'.($i+6))->applyFromArray($this->styleWrap);
        	$i++;
        }    
    }
    
    private function setStyleWrap()
    {
        $this->styleWrap = [
	       'borders'=> [
		      'outline' => ['style'=>\PHPExcel_Style_Border::BORDER_THICK],
		      'allborders'=>['style'=>\PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb'=>'696969']]
	       ]
        ];    
    }
    
    private function setStyleHeader()
    {
        $style_header = [
            'font'=>['bold' => true, 'name' => 'Times New Roman','size' => 20],
	       'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER],
	       'fill' => ['type' => \PHPExcel_STYLE_FILL::FILL_SOLID, 'color' => ['rgb' => 'CFCFCF']]
        ];
        $this->activeSheet->getStyle('A1:D1')->applyFromArray($style_header);    
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
    
    private function setSetup()
    {
        $this->setPageSetup();
        $this->setHeaderAndFooter();
        $this->setFont();
        $this->setWidthOfColumn();   
    }
    
    private function nameField() 
    {
        $this->setTitleField();
        $this->setSubTitleField();
        $this->setDateField();
        $this->setColumnName();   
    }
    
    private function setStyleFields()
    {
        $this->setStyleWrap();
        $this->setStyleHeader();
        $this->setStyleSlogan();
        $this->setStyleFieldDate();
        $this->setStyleFieldHeaderPrice();    
    }
    
    public function actionIndex() 
    { 
        $this->priceList = Tovar::find()->asArray()->all();
        $this->objPHPExcel = new \PHPExcel();
        $this->setActiveSheet();
        $this->setSetup();
        $this->nameField();
        $this->setStyleFields();
        $this->setDataFields();
        
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename='simple.xls'");

        $objWriter = \PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }
    
    
}