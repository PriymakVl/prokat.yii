<?php

namespace app\modules\drawing\models;

use yii\data\Pagination;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDepartment extends BaseModel
{
    public $fullNumber;
    public $catName = 'Цех';
    public $category = 'department';
    public $objects;

    public $services;
    
    const PAGE_SIZE = 30;
    
    public static function tableName()
    {
        return 'drawings_department';
    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }
    
    public static function getListDepartment($params)
    {
        $query = self::find()->filterWhere($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['id' => SORT_DESC])->all();
        return self::executeMethods($list, ['getFullNumber']);
    }

    public function getFullNumber()
    {
        $year = date('y', $this->date ? $this->date : time());
        $this->fullNumber = '27.'.$year.'.'.$this->number;
        return $this;
    }

    public function convertService()
    {  
        $this->service = $this->convertTag('service', $this->service);
        return $this;
    }
    
    public static function getAllForObject($obj)
    {
        $drawings = self::findAll(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);
        if ($drawings) return self::executeMethods($drawings, ['getFullNumber']);
        else return null; 
    }

//    public function getObjects()
//    {
//        if (!$this->code) return false;
//        $this->objects = Objects::findAll(['code' => $this->code, 'status' => self::STATUS_ACTIVE]);
//        if ($this->objects) $this->objects[0]->getName();
//        return $this;
//    }
    
    //public static function saveDwg($form, $obj, $dwg = null)
//    {
//        if (isset($form->dwg_id) && !$dwg) $dwg = self::findOne($form->dwg_id);
//        else if (!$dwg) $dwg = new DrawingDepartment(); 
//        if (!$dwg->number) $dwg->number = DrawingLogic::getNewNumberDepartmentDwg();
//        if (isset($form->numberDepartmentDwg)) $dwg->number = $form->numberDepartmentDwg;
//        $dwg->designer = $form->designerDepartmentDwg;
//        $dwg->obj_id = $obj->id;
//        $dwg->code = $obj->code;
//        $dwg->date = time();
//        $dwg->name = $form->nameDepartmentDwg;
//        if ($form->noteDwg) $dwg->note = $form->noteDwg;
//        $dwg->save();
//        self::uploadFileDraft($form, $dwg, 'draft');
//        self::uploadFileDraft($form, $dwg, 'kompas');
//        return true;
//    }
    
    //private static function uploadFileDraft($form, $dwg, $prefix) 
//    {
//        $draft = UploadedFile::getInstance($form, 'department_'.$prefix);
//        if (!$draft) return false;
//        $filename = $dwg->id.'_'.$prefix.'.'.$draft->extension;
//        $path = $prefix == 'kompas' ? 'files/department/kompas/'.$filename : 'files/department/'.$filename;
//        $draft->saveAs($path); 
//        if ($prefix == 'kompas') $dwg->file_cdw = $filename; 
//        else $dwg->file = $filename;
//        return $dwg->save();  
//     }
    
    

}





