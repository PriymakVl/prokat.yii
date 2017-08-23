<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectDrawingWidget extends Widget 
{
    public $drawings;
    public $category;
    public $obj_id;

    public function run()
    {
        if ($this->category == 'vendor' && $this->drawings['vendor']) {
            //$revisions = $this->getRevisions($this->drawings['vendor']);
            $revision = $this->drawings['vendor'][0]->revision;
            return $this->render('objectdrawing/vendor', ['drawings' => $this->drawings['vendor'], 'obj_id' => $this->obj_id, 'revision' => $revision]);    
        }
        else if ($this->category == 'works' && $this->drawings['works']) return $this->render('objectdrawing/department', ['drawings' => $this->drawings['works'], 'obj_id' => $this->obj_id]);
        else if ($this->category == 'department' && $this->drawings['department']) return $this->render('objectdrawing/department', ['drawings' => $this->drawings['department'], 'obj_id' => $this->obj_id]);
        else if ($this->category == 'standard' && $this->drawings['standard']) return $this->render('objectdrawing/standard', ['drawings' => $this->drawings['standard'], 'obj_id' => $this->obj_id]);
    }
    
    private function getRevisions($drawings)
    {
        foreach ($drawings as $dwg) {
            //if ($dwg->revision[0] === '0' && strlen($dwg->revision) > 1) $revision = substr($dwg->revision, 1);
            //else $revision = $dwg->revision;
            $revisions[] = $dwg->revision;
        }
        $revisions = array_unique($revisions);
        return array_reverse($revisions);
    }

}

