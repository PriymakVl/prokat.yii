<?php


namespace app\modules\drawing\models\forms;

use app\models\forms\ModelForm;

class NoteDrawingForm extends ModelForm
{   
    public $note;

    public function rules() {
        return [
            ['note', 'default', 'value' => ''],
        ];
    }
    
    
    public function updateNote($dwg, $file)
    {
        if ($dwg->category == 'works') {
            $file->note = $this->note;
            return $file->save();
        }
        $dwg->note = $this->note;
        return $dwg->save(); 
    }

}

