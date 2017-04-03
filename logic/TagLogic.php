<?php

namespace app\logic;

use app\classes\interfaces\ConfigApp;
use app\classes\traits\CommonFunctions;
use app\models\Tag;

class TagLogic extends BaseLogic
{
    public static function getArrayAliasAndName($tags) 
    {
        $convert = [];
        foreach ($tags as $tag) {
            $convert[$tag->alias] = $tag->name;
        }
        return $convert;
    }
}





