<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectDrawingWidget extends Widget 
{
    public $drawings;
    public $category;
    public $obj_id;
    private $newRevision;
    private $oldRevision;

    public function run()
    {
        if ($this->category == 'danieli') {
            $this->getRevisions();
            return $this->render('objectdrawing/danieli', ['drawings' => $this->drawings, 'obj_id' => $this->obj_id, 'new_revision' => $this->newRevision, 'old_revision' => $this->oldRevision]);    
        }
        else if ($this->category == 'works') return $this->render('objectdrawing/works', ['drawings' => $this->drawings, 'obj_id' => $this->obj_id]);
        else if ($this->category == 'department') return $this->render('objectdrawing/department', ['drawings' => $this->drawings, 'obj_id' => $this->obj_id]);
        else if ($this->category == 'standard_danieli') return $this->render('objectdrawing/standard_danieli', ['drawings' => $this->drawings, 'obj_id' => $this->obj_id]);
        else if ($this->category == 'sundbirsta') return $this->render('objectdrawing/sundbirsta', ['drawings' => $this->drawings, 'obj_id' => $this->obj_id]);
    }
    
    private function getRevisions()
    {
        foreach ($this->drawings as $dwg) {
            $revisions[] = $dwg->revision;
        }
        $revisions = array_unique($revisions);
        $this->newRevision = $revisions[0];
        if (count($revisions) > 1) $this->oldRevision = true;
    }

}

