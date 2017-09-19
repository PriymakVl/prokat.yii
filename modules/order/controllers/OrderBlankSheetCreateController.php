<?php

namespace app\modules\order\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;
use app\modules\order\logic\OrderLogic;

class OrderBlankSheetCreateController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    public $activeSheet;
    public $objPHPExcel;
    public $styleBorder;
    public $styleWork;
    public $order;
    public $content;
    public $styleContent;
    public $rowEndContent;
    public $rowEndWork;
    
    public function actionIndex($order_id) 
    { 
        $this->order = Order::findOne($order_id);
        $this->order->getNumber()->convertDate($this->order)->convertService($this->order)->convertType()->countWeightOrder()
            ->getFullCustomer()->getFullIssuer()->convertLocation()->getWork(false);
        $this->content = OrderContent::getItemsOfOrder($this->order->id);
        $this->objPHPExcel = new \PHPExcel();
        $this->setActiveSheet();
        $this->setSetup();
        $this->setWidthOfColumn();
        $this->setStyleBorders();
        $this->setNameOrder();
        $this->setInfoOrder();
        $this->setTitleContent();
        $this->setContent();
        if ($this->order->work) $this->setWorkOrder();
        if ($this->order->note) $this->setNoteOrder();
        //$this->setStyleTitles();
             
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename='blank-order.xls'");

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
        $this->activeSheet->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);//ORIENTATION_LANDSCAPE
        $this->activeSheet->getPageSetup()->SetPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
						
        $this->activeSheet->getPageMargins()->setTop(0.25);
        $this->activeSheet->getPageMargins()->setRight(0.25);
        $this->activeSheet->getPageMargins()->setLeft(0.75);
        $this->activeSheet->getPageMargins()->setBottom(0);   
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
        $this->activeSheet->getColumnDimension('A')->setWidth(15);
        $this->activeSheet->getColumnDimension('B')->setWidth(5);
        $this->activeSheet->getColumnDimension('C')->setWidth(45);
        $this->activeSheet->getColumnDimension('D')->setWidth(5);    
        $this->activeSheet->getColumnDimension('E')->setWidth(10);     
        $this->activeSheet->getColumnDimension('F')->setWidth(10);     
    }
    
    private function setNameOrder()
    {
        //set height row 
        $this->activeSheet->getRowDimension('1')->setRowHeight(15);
        $this->activeSheet->getRowDimension('2')->setRowHeight(15);
        $this->activeSheet->getRowDimension('3')->setRowHeight(15);

        $this->activeSheet->setCellValue('A1','Номер заказа');
        $this->activeSheet->setCellValue('A2','Наименование');
        $this->activeSheet->setCellValue('A3','Дата выдачи');

        $this->activeSheet->setCellValue('B1', $this->order->number);
        $this->activeSheet->setCellValue('B2', $this->order->name);
        $this->activeSheet->setCellValue('B3', $this->order->date);

        //merge field
        $this->activeSheet->mergeCells('B1:F1');
        $this->activeSheet->mergeCells('B2:F2');
        $this->activeSheet->mergeCells('B3:F3');
        //border
        $this->activeSheet->getStyle('A1:F3')->applyFromArray($this->styleBorder);
    }
    
    private function setInfoOrder()
    {
        //set height row 
        $this->activeSheet->getRowDimension('5')->setRowHeight(15);
        $this->activeSheet->getRowDimension('6')->setRowHeight(15);
        $this->activeSheet->getRowDimension('7')->setRowHeight(15);
        $this->activeSheet->getRowDimension('8')->setRowHeight(15);
        $this->activeSheet->getRowDimension('9')->setRowHeight(15);
        $this->activeSheet->getRowDimension('10')->setRowHeight(15);

        $this->activeSheet->setCellValue('A5','Агрегат, механизм');
        $this->activeSheet->setCellValue('A6','Узел');
        $this->activeSheet->setCellValue('A7','Инвент. номер');
        $this->activeSheet->setCellValue('A8','Заказал');
        $this->activeSheet->setCellValue('A9','Выдал');
        $this->activeSheet->setCellValue('A10','Вес заказа');

        $this->activeSheet->setCellValue('B5', $this->order->equipment);
        $this->activeSheet->setCellValue('B6', $this->order->unit);
        $this->activeSheet->setCellValue('B7', $this->order->inventory);
        $this->activeSheet->setCellValue('B8', $this->order->customer);
        $this->activeSheet->setCellValue('B9', $this->order->issuer);
        $this->activeSheet->setCellValue('B10', $this->order->weight);

        //merge field
        $this->activeSheet->mergeCells('B5:F5');
        $this->activeSheet->mergeCells('B6:F6');
        $this->activeSheet->mergeCells('B7:F7');
        $this->activeSheet->mergeCells('B8:F8');
        $this->activeSheet->mergeCells('B9:F9');
        $this->activeSheet->mergeCells('B10:F10');
        //border
        $this->activeSheet->getStyle('A5:F10')->applyFromArray($this->styleBorder);
    }
    
    private function setWorkOrder()
    {
        //title
        $row_title = $this->rowEndContent + 1;
        $this->activeSheet->setCellValue('A'.$row_title, 'Характер работы');
        $style_title = ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]];
        $this->activeSheet->getStyle('A'.$row_title.':F'.$row_title)->applyFromArray($style_title);
        $this->activeSheet->mergeCells('A'.$row_title.':F'.$row_title);
        //debug($this->order->work);
        $row_start = $this->rowEndContent + 2;
        $count = count($this->order->work);
        $this->rowEndWork = $row_start + $count;
        
        for ($i = 0; $i < $count; $i++) {
            $num = $i + $row_start; 
            $this->activeSheet->setCellValue('A'.$num, ($i + 1).') '.$this->order->work[$i]);    
            $this->activeSheet->mergeCells('A'.$num.':F'.$num);
            $this->activeSheet->getStyle('A'.$num)->getAlignment()->setWrapText(true);
            $this->activeSheet->getStyle('A'.$num.':F'.$num)->applyFromArray($this->styleBorder);
            $this->activeSheet->getRowDimension($num)->setRowHeight(15);
        }      
    }
    
    private function setTitleContent()
    {
        //set height row 
        $this->activeSheet->setCellValue('A12', 'Содержание заказа');
        $style_title = ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]];
        $this->activeSheet->getStyle('A12:F12')->applyFromArray($style_title);
        $this->activeSheet->mergeCells('A12:F12');
        $this->activeSheet->getRowDimension('12')->setRowHeight(15);
        $this->activeSheet->getRowDimension('13')->setRowHeight(15);
        
        $this->activeSheet->setCellValue('A13','Номер чертежа');
        $this->activeSheet->setCellValue('B13','Поз.');
        $this->activeSheet->setCellValue('C13','Наименование');
        $this->activeSheet->setCellValue('D13','Кол.');
        $this->activeSheet->setCellValue('E13','Материал');
        $this->activeSheet->setCellValue('F13','Вес');  
        $this->activeSheet->getStyle('A13:F13')->applyFromArray($this->styleBorder);
        $style_field = ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]];
        $this->activeSheet->getStyle('A13:F13')->applyFromArray($style_field);        
    }
    
    private function setContent()
    {
        $row_start = 14;
        $count = count($this->content);
        $this->rowEndContent = $row_start + $count;
        for ($i = 0; $i < $count; $i++) {
            $num = $i + $row_start;
            if ($this->content[$i]) {
                $variant = $this->content[$i]->variant ? PHP_EOL.'вариант '.$this->content[$i]->variant : '';
                $sheet = ($this->content[$i]->sheet != 1) ? PHP_EOL.'лист '.$this->content[$i]->sheet : '';
                $this->activeSheet->setCellValue('A'.$num, $this->content[$i]->drawing.$variant.$sheet);
           	    $this->setItem($num, $this->content[$i]);
                $dimensions = $this->content[$i]->dimensions ? PHP_EOL.$this->content[$i]->dimensions : '';
            	$this->activeSheet->setCellValue('C'.$num, $this->content[$i]->name.$dimensions);
                $this->activeSheet->setCellValue('D'.$num, $this->content[$i]->count);
                $this->activeSheet->setCellValue('E'.$num, $this->content[$i]->material);
                $this->activeSheet->setCellValue('F'.$num, $this->content[$i]->weight.PHP_EOL.$this->content[$i]->weightAll);
        //        if ($this->content[$i]->delivery) {
//                    $this->activeSheet->mergeCells('G'.$num.':L'.$num);
//                    $this->activeSheet->setCellValue('G'.$num, 'Доставляет заказчик');
//                    $this->activeSheet->getStyle('G'.$num)->applyFromArray($this->styleContent);    
//                }
            }
            //$this->activeSheet->getStyle('C'.$num)->applyFromArray(['font'=>['size' => 12]]);
//            $this->activeSheet->getStyle('C'.$num)->getAlignment()->setWrapText(true);
//            $this->activeSheet->getStyle('A'.$num)->getAlignment()->setWrapText(true);
//            $this->activeSheet->getStyle('A3:M'.$num)->applyFromArray($this->styleBorder);
//            $this->activeSheet->getStyle('A3:F'.$num)->applyFromArray($this->styleContent); 
            $this->activeSheet->getStyle('A'.$num.':'.'F'.$num)->getAlignment()->setWrapText(true);
            $this->setStyleContentOrder($num);
//            $this->activeSheet->getRowDimension($num)->setRowHeight(50);
            //if ($this->content[$i]->children) $i = $this->setChildren($num, $i, $this->content[$i]->children);
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
    
    private function setNoteOrder()
    {
        //title
        $row_title = $this->rowEndWork ? $this->rowEndWork + 1 : $this->rowEndContent + 1;
        $this->activeSheet->setCellValue('A'.$row_title, 'Примечание');
        $style_title = ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]];
        $this->activeSheet->getStyle('A'.$row_title.':F'.$row_title)->applyFromArray($style_title);
        $this->activeSheet->mergeCells('A'.$row_title.':F'.$row_title); 
        
        $num = $row_title + 1;
        $this->activeSheet->setCellValue('A'.$num, $this->order->note); 
        $this->activeSheet->mergeCells('A'.$num.':F'.$num); 
        $this->activeSheet->getStyle('A'.$num.':F'.$num)->getAlignment()->setWrapText(true);
        $this->activeSheet->getStyle('A'.$num.':F'.$num)->applyFromArray($this->styleBorder); 
        $this->activeSheet->getRowDimension($num)->setRowHeight(50);
        $this->activeSheet->getStyle('A'.$num)->applyFromArray(['alignment' => ['vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP]]); 
    }
    
    private function setItem($num, $item)
    {
        //debug($item, false);
        if ($item->item) $this->activeSheet->setCellValue('B'.$num, $item->item);
        else if ($item->children && !$item->item) $this->activeSheet->setCellValue('B'.$num, 'Сб');  
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
    
//    private function setStyleTitles()
//    {
//        $alignment = ['alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]];
//        $font = ['font' => ['bold' => true]];
//        $this->activeSheet->getStyle('A5:F5')->applyFromArray($alignment);    
//        $this->activeSheet->getStyle('A5:F5')->applyFromArray($font); 
//        $this->activeSheet->getStyle('A5:F5')->applyFromArray($this->styleBorder);   
//    }
    
    private function setStyleContentOrder($num)
    {
        $alignment = ['alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]];
        $alignment_name = ['alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER]];
        $this->activeSheet->getStyle('A'.$num.':F'.$num)->applyFromArray($alignment);
        $this->activeSheet->getStyle('C'.$num)->applyFromArray($alignment_name);
        $this->activeSheet->getStyle('A'.$num.':F'.$num)->applyFromArray($this->styleBorder);
    }
    
}