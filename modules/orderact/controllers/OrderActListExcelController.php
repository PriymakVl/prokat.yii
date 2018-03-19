<?php

namespace app\modules\orderact\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\logic\OrderActLogic;

class OrderActListExcelController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    public $activeSheet;
    public $objPHPExcel;
    public $styleBorder;
    public $acts;
    public $styleData;
    public $styleNameOrder;
    public $rowNum = 3; //number row data acts

    
    public function actionIndex($ids)
    {
        $this->acts = OrderAct::getListForFileSave($ids);
        if (empty($this->acts)) return $this->redirect(Yii::$app->request->referrer);
        $this->objPHPExcel = new \PHPExcel();
        $this->setActiveSheet();
        $this->setSetup();
        $this->setColumnName();
        $this->setStyleBorders();
        $this->setTitle();
        $this->setStyleData();
        $this->loopActs();
//        $this->setDataOrders();
        $this->setStyleColumnName();
             
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename='acts.xls'");

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
        $this->activeSheet->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);//ORIENTATION_LANDSCAPE)
        $this->activeSheet->getPageSetup()->SetPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
						
        $this->activeSheet->getPageMargins()->setTop(0.4);
        $this->activeSheet->getPageMargins()->setRight(0.1);
        $this->activeSheet->getPageMargins()->setLeft(0.2);
        $this->activeSheet->getPageMargins()->setBottom(0.4);
    }
    
    private function setHeaderAndFooter()
    {
        //$this->activeSheet->getHeaderFooter()->setOddFooter();
    }
    
    private function setFont()
    {
        $this->objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
        $this->objPHPExcel->getDefaultStyle()->getFont()->setSize(12);   
    }
    
    private function setWidthOfColumn()
    {
        $this->activeSheet->getColumnDimension('A')->setWidth(4);
        $this->activeSheet->getColumnDimension('B')->setWidth(7);
        $this->activeSheet->getColumnDimension('C')->setWidth(7);
        $this->activeSheet->getColumnDimension('D')->setWidth(12);
        $this->activeSheet->getColumnDimension('E')->setWidth(26);
        $this->activeSheet->getColumnDimension('F')->setWidth(8);
        $this->activeSheet->getColumnDimension('G')->setWidth(9);
        $this->activeSheet->getColumnDimension('H')->setWidth(12);
    }
    
    private function setColumnName()
    {
        $this->activeSheet->getRowDimension('2')->setRowHeight(20);
        $this->activeSheet->setCellValue('A2','№');
        $this->activeSheet->setCellValue('B2','№акта');
        $this->activeSheet->setCellValue('C2','Изгот');
        $this->activeSheet->setCellValue('D2','Чертеж');
        $this->activeSheet->setCellValue('E2','Наименование детали');
        $this->activeSheet->setCellValue('F2','Кол-во');
        $this->activeSheet->setCellValue('G2','№ заказа');
        $this->activeSheet->setCellValue('H2','Заказал');
    }

    private function setDataActContent($act)
    {
        foreach($act->content as $item) {
            $this->activeSheet->getRowDimension($this->rowNum)->setRowHeight(15);
        	$this->activeSheet->setCellValue('A'.$this->rowNum, $this->rowNum - 2);
        	$this->activeSheet->setCellValue('B'.$this->rowNum, $act->number);
        	$this->setColumnDepartment($act->department, $this->rowNum);
        	$this->activeSheet->setCellValue('D'.$this->rowNum, mb_substr($item->drawing, 0, 10, 'utf-8'));
        	$this->activeSheet->setCellValue('E'.$this->rowNum, mb_substr($item->name, 0, 10, 'utf-8'));
        	$this->activeSheet->setCellValue('F'.$this->rowNum, $item->count);
        	$this->activeSheet->setCellValue('G'.$this->rowNum, $act->order_num);
        	$this->activeSheet->setCellValue('H'.$this->rowNum, $act->customer);

            $this->activeSheet->getStyle('A3:H'.($this->rowNum))->applyFromArray($this->styleBorder);
            $this->activeSheet->getStyle('A3:H'.($this->rowNum))->applyFromArray($this->styleData);
            //$this->activeSheet->getStyle('E'.$this->rowNum)->applyFromArray(['alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT]]);//style column name detail
            $this->rowNum++;
        }
    }

    private function setColumnDepartment($department, $row_num)
    {
        $department = OrderActLogic::convertDepartment($department);
        if (mb_strlen($department, 'utf-8') > 4) $department = mb_substr($department, 0, 4, 'utf-8');
        if ($department == 'Учас') $department = 'УИМ';
        $this->activeSheet->setCellValue('C'.$row_num, $department);
    }

    private function loopActs()
    {
        foreach ($this->acts as $act) {
            if (empty($act->content)) continue;
            $this->setDataActContent($act);
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
    
    private function setStyleColumnName()
    {
        $style_column_name = [
            'font'=>['bold' => true, 'name' => 'Times New Roman','size' => 12],
	       'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER],
	       'fill' => ['type' => \PHPExcel_STYLE_FILL::FILL_SOLID, 'color' => ['rgb' => 'CFCFCF']]
        ];
        $this->activeSheet->getStyle('A2:H2')->applyFromArray($style_column_name);
//        $this->activeSheet->getStyle('A2:H2')->applyFromArray($this->styleBorder);
        $this->activeSheet->getRowDimension(2)->setRowHeight(20);
    }

    private function setStyleData()
    {
        $this->styleData = [
            'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER],
        ];
    }
    

   private function setTitle()
   {
       $style_title = [
           'font'=>['bold' => true, 'name' => 'Times New Roman','size' => 14],
           'alignment' => ['horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER, 'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER],
       ];
       $this->activeSheet->getRowDimension('1')->setRowHeight(25);
       $this->activeSheet->setCellValue('A1','Перечень актов за февраль 2018г');
       $this->activeSheet->mergeCells('A1:H1');
       $this->activeSheet->getStyle('A1:H1')->applyFromArray($this->styleBorder);
       $this->activeSheet->getStyle('A1')->applyFromArray($style_title);
   }

    

    

    

    

    
    
    
    
}