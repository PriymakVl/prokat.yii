<?php


namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use app\modules\drawing\models\DrawingWorksFile;

class NoteDrawingForm extends BaseForm
{   
    public $note;

    public function rules() {
        return [
            ['note', 'default', 'value' => ''],
        ];
    }
    
    
    public function updateNote($dwg, $file_id)
    {
        if ($dwg->category == 'works') {
            $file = DrawingWorksFile::getOne($file_id, __METHOD__, self::STATUS_ACTIVE);
            $file->note = $this->note;
            return $file->save();
        }
        $dwg->note = $this->note;
        return $dwg->save(); 
    }

}

