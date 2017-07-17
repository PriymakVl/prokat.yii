<?php

namespace app\modules\applications\models;

use yii\web\ForbiddenHttpException;
use app\models\BaseModel;
use app\modules\applications\logic\ApplicationLogic;
use app\modules\applications\models\ApplicationProduct;

class ApplicationContent extends BaseModel
{

    public $product;
    public $sum;
    
    public static function tableName()
    {
        return 'applications_content_test';
    }
    
    public function behaviors()
    {
    	return ['application-logic' => ['class' => ApplicationLogic::className()]];
    }
    
    public static function getItemsOfApplication($app_id)
    {
        $content = self::find()->where(['status' => self::STATUS_ACTIVE, 'app_id' => $app_id])
                    ->orderBy(['rating' => SORT_DESC])->all();
        $content = self::executeMethods($content, ['getProduct', 'countSum']);
        return $content;
    }
    
    public function getProduct()
    {
        $this->product = ApplicationProduct::getOne($this->product_id, false, self::STATUS_ACTIVE);
        return $this;
    }
    
    public function countSum() {
        if ((int)$this->price) {
            $sum = bcmul($this->need, $this->price, 2);
            $this->sum = $sum.' '.$this->currency;    
        }    
    }
    
    public function copyItem($order_id)
    {
        $this->id = null;
        $this->order_id = $order_id;
        $this->setIsNewRecord(true);
        if (!$this->save(false)) throw new ForbiddenHttpException('error '.__METHOD__); 
    }

//    public static function searchByDrawing($dwg)
//    {
//        $result = self::find()->where(['status' => STATUS_ACTIVE])->filterWhere(['like', 'drawing', $dwg])->all();
//        if (empty($result)) return [];
//        if (count($result) == 1) $orders = Order::findAll(['id' => $result[0]->order_id]);
//        else $orders = OrderLogic::getArrayOrders($result);
//        self::executeMethods($orders, ['getNumber']);
//        return $orders;
//    }
    
}





