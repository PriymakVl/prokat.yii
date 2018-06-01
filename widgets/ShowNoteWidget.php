<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\StringHelper;

class ShowNoteWidget extends Widget
{
    public $note;
    public $lengthMax;
    public $suffix = ' ...';

    public function run()
    {
        $length_str = iconv_strlen($this->note, 'utf-8');
        //debug($this->note);
        if ($this->lengthMax < $length_str) $cutnote =  StringHelper::truncate($this->note, $this->lengthMax);
        return $this->render('show_note', ['cutnote' => $cutnote, 'fullnote' => $this->note]);
    }

}

