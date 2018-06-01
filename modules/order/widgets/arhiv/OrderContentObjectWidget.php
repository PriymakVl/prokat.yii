<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;
use app\modules\objects\models\Objects;

class OrderContentObjectWidget extends Widget 
{
    public $item;

    public function run()
    {
        $object = Objects::findOne(['id' => $this->item->obj_id, 'status' => Objects::STATUS_ACTIVE]);
        if ($object) {
            $object->getParent()->getName()->countSimilar(); 
            //debug($object);
            return $this->render('order_content_object', ['item' => $this->item, 'object' => $object]);   
        }
    }

}

