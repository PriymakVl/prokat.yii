<?php

namespace app\modules\letters\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\letters\models\Letter;
use app\modules\letters\forms\LetterForm;
use app\modules\letters\logic\LetterLogic;

class LetterController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($letter_id) 
    { 
        $letter = Letter::getOne($letter_id);
        $letter->getWhom()->getCopy()->getNumber()->convertDate($letter);
        return $this->render('index', compact('letter'));
    }
    
    public function actionList($to = null, $state = null)
    {
        $params = LetterLogic::getParams($to, $state);
        $list = Letter::getLetterList($params);
        $pages = Letter::$pages;
        //debug($list[0]);
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($letter_id = null) 
    { 
        $letter = Letter::getOne($letter_id, null);
        if ($letter) $letter->convertDate($letter, false)->getWhomPosition()->getWhomName();
        $form = new LetterForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($letter)) { 
            $this->redirect(['/letter', 'letter_id' => $form->letter_id]);
            //else $this->redirect(['/order/', 'letter_id' => $form->order_id, 'state' => Letter::STATE_DRAFT]);
        }   
        return $this->render('form', compact('letter', 'form'));
    }
    
   
    
}