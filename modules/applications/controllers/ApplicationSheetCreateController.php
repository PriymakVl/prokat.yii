<?php

namespace app\modules\applications\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\applications\models\Application;
use app\modules\applications\models\ApplicationContent;
use app\modules\applications\logic\ApplicationLogic;

class ApplicationSheetCreateController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    public $activeSheet;
    public $objPHPExcel;
    public $styleBorder;
    public $app;
    public $content;
    public $styleContent;
    
    public function actionIndex($app_id) 
    { 
        $this->app = Application::findOne($app_id);
        $this->app->getFullOutNumber();
        $this->content = ApplicationContent::getItemsOfApplication($this->app->id);
        //debug($this->app);
        $this->objPHPExcel = new \PHPExcel();
        $this->setActiveSheet();
        $this->setSetup();
        $this->setWidthOfColumn();
        $this->setOutNum();
        //$this->setTitles();
        //$this->setStyleWork();
        //$this->setWorkOrder();
        //$this->setStyleBorders();
        //$this->setStyleContentOrder();
        //$this->setContent();
        //debug('end');
        //$this->setStyleFieldOrder();
        $this->setStyleTitles();
             
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename='application.xls'");

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
						
        $this->activeSheet->getPageMargins()->setTop(0.75);
        $this->activeSheet->getPageMargins()->setRight(0.25);
        $this->activeSheet->getPageMargins()->setLeft(0.75);
        $this->activeSheet->getPageMargins()->setBottom(0.75);   
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
        $this->objPHPExcel->getDefaultStyle()->getFont()->setSize(12);   
    }
    
    private function setWidthOfColumn()
    {
        $this->activeSheet->getColumnDimension('A')->setWidth(15);
        $this->activeSheet->getColumnDimension('B')->setWidth(40);
        $this->activeSheet->getColumnDimension('C')->setWidth(30);
        $this->activeSheet->getColumnDimension('D')->setWidth(20);    
        $this->activeSheet->getColumnDimension('E')->setWidth(30);    
        $this->activeSheet->getColumnDimension('F')->setWidth(20);
        $this->activeSheet->getColumnDimension('G')->setWidth(30);
        $this->activeSheet->getColumnDimension('H')->setWidth(20);
        $this->activeSheet->getColumnDimension('I')->setWidth(15);     
    }
    
    private function setOutNum() 
    {
        $this->activeSheet->getRowDimension('1')->setRowHeight(15);
        //$this->activeSheet->getRowDimension('1')->setRowHeight(15);
        
        $this->activeSheet->setCellValue('A1', $this->app->out_num);    
    }
    
    private function setTitles()
    {
        //set height row 
        $this->activeSheet->getRowDimension('1')->setRowHeight(20);
        $this->activeSheet->getRowDimension('2')->setRowHeight(60);
        //font alignment
        $this->activeSheet->getStyle('B1')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('D1')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('E1')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('F1')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('G2')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('H2')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('I2')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('J2')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('K2')->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('L2')->getAlignment()->setTextRotation(90);
        //wrap перенос слова
        //$this->activeSheet->getStyle('A1')->getAlignment()->setWrapText(true);
        //fill field
        $this->activeSheet->setCellValue('A1','№ чертежа');
        $this->activeSheet->setCellValue('B1','№ позиции');
        $this->activeSheet->setCellValue('C1','Наименование детали');
        $this->activeSheet->setCellValue('D1',' Количество');    
        $this->activeSheet->setCellValue('E1',' Марка стали');    
        $this->activeSheet->setCellValue('F1',' Вес'); 
        $this->activeSheet->setCellValue('G1','Цехи исполнители'); 
        $this->activeSheet->setCellValue('M1','Характер работы');
        //row 2
        $this->activeSheet->setCellValue('G2',' модельн.');
        $this->activeSheet->setCellValue('H2',' литейн.');
        $this->activeSheet->setCellValue('I2',' кузнеч.');
        $this->activeSheet->setCellValue('J2',' р-котел.'); 
        $this->activeSheet->setCellValue('K2',' механич.');
        $this->activeSheet->setCellValue('L2',' кусты');
        //merge field
        $this->activeSheet->mergeCells('A1:A2');
        $this->activeSheet->mergeCells('B1:B2');
        $this->activeSheet->mergeCells('C1:C2');
        $this->activeSheet->mergeCells('D1:D2');
        $this->activeSheet->mergeCells('E1:E2');
        $this->activeSheet->mergeCells('F1:F2');
        $this->activeSheet->mergeCells('G1:L1');
        $this->activeSheet->mergeCells('M1:M2');
    }
    
    private function setWorkOrder()
    {
        $row_start = 3;
        for ($i = 0; $i < 10; $i++) {
            $num = $i + $row_start; 
            if ($this->order->work[$i]) {
                $this->activeSheet->setCellValue('M'.$num, ($i + 1).') '.$this->order->work[$i]);    
            }
            $this->activeSheet->getStyle('M'.$num)->applyFromArray($this->styleWork);
        }      
    }
    
    private function setContent()
    {
        $row_start = 3;
        for ($i = 0; $i < 10; $i++) {
            $num = $i + $row_start;
            if ($this->content[$i]) {
                $this->activeSheet->setCellValue('A'.$num, $this->content[$i]->drawing);
           	    $this->setItem($num, $this->content[$i]);
            	$this->activeSheet->setCellValue('C'.$num, $this->content[$i]->name);
                $this->activeSheet->setCellValue('D'.$num, $this->content[$i]->count);
                $this->setMaterial($num, $this->content[$i]->material);
                $this->setWeight($num, $this->content[$i]); 
            }
            $this->activeSheet->getStyle('A3:M'.$num)->applyFromArray($this->styleBorder);
            $this->activeSheet->getStyle('A3:F'.$num)->applyFromArray($this->styleContent); 
            $this->activeSheet->getStyle('C'.$num)->getAlignment()->setWrapText(true);
            $this->activeSheet->getRowDimension($num)->setRowHeight(40);
            if ($this->content[$i]->children) $i = $this->setChildren($num, $i, $this->content[$i]->children);
        }    
    }
    
    private function setChildren($num, $i, $children)
    {
        $end = 10 - $i++;
        for ($j = 0; $j < $end; $j++) {
            $num++;
            //debug($children[$j]);
            $this->activeSheet->setCellValue('A'.$num, $children[$j]->drawing);
       	    $this->setItem($num, $children[$j]);
        	$this->activeSheet->setCellValue('C'.$num, $children[$j]->name);
            $this->activeSheet->setCellValue('D'.$num, $children[$j]->count);
            $this->setMaterial($num, $children[$j]->material);
            $this->setWeight($num, $children[$j]); 
            //style
            $this->activeSheet->getStyle('A3:M'.$num)->applyFromArray($this->styleBorder);
            $this->activeSheet->getStyle('A3:F'.$num)->applyFromArray($this->styleContent); 
            $this->activeSheet->getRowDimension($num)->setRowHeight(40);
        } 
        return $j + $i;   
    }
    
    private function setWeight($num, $object)
    {
        if ($object->weight === '0,00') return;
        if (!$object->count || !$object->weightAll) return;
        $weight = $object->weight.' '.$object->weightAll;
        $this->activeSheet->setCellValue('F'.$num, $weight);
        $this->activeSheet->getStyle('F'.$num)->getAlignment()->setWrapText(true);
        if (strlen($object->weight) > 4 || strlen($object->weightAll) > 4) {
            $this->activeSheet->getStyle('F'.$num)->applyFromArray(['font'=>['size' => 7]]);
        }    
    }
    
    private function setItem($num, $item)
    {
        //debug($item, false);
        if ($item->item) $this->activeSheet->setCellValue('B'.$num, $item->item);
        else if ($item->children && !$item->item) $this->activeSheet->setCellValue('B'.$num, 'Сб');  
    }
    
    private function setMaterial($num, $material)
    {
   	    $this->activeSheet->setCellValue('E'.$num, $material); 
        if (iconv_strlen($material) < 5) return; 
        $this->activeSheet->getStyle('E'.$num)->getAlignment()->setTextRotation(90);
        $this->activeSheet->getStyle('E'.$num)->applyFromArray(['font'=>['size' => 7]]);   
    }
    
    private function setStyleBorders()
    {
        $this->styleBorder = [
	       'borders'=> [
		      //'outline' => ['style'=>\PHPExcel_Style_Border::BORDER_THICK],
		      'allborders'=>['style'=>\PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb'=>'000']]
	       ]
        ];  
        $this->activeSheet->getStyle('A1:M2')->applyFromArray($this->styleBorder); 
    }
    
    private function setStyleTitles()
    {
        $style_center = ['alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]];
        $style_goriz_center = ['alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_BOTTOM]];
        $this->activeSheet->getStyle('A1')->applyFromArray($style_center);
        $this->activeSheet->getStyle('C1')->applyFromArray($style_center);
        $this->activeSheet->getStyle('G1')->applyFromArray($style_center);
        $this->activeSheet->getStyle('M1')->applyFromArray($style_center);
        $this->activeSheet->getStyle('B1')->applyFromArray($style_goriz_center);
        $this->activeSheet->getStyle('G2:L2')->applyFromArray($style_goriz_center); 
        $this->activeSheet->getStyle('D1:F1')->applyFromArray($style_goriz_center);    
    }
    
    private function  setStyleWork()
    {
        $this->styleWork = [
            'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP]
        ];    
    }
    
    private function setStyleContentOrder()
    {
        $this->styleContent = [
            'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]
        ];
    }
    
    private function setStyleCellMaterial($num, $item)
    {
        
    }
    
}