<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use app\modules\drawing\models\DrawingDepartment;
use app\models\Tag;

class DrawingBreadcrumbsHeaderWidget extends Widget 
{
    public $dwg;
	public $category;

    public function run()
    {
		$dwg_id = Yii::$app->request->get('dwg_id');
		if ($this->category) $this->dwg = DrawingDepartment::getOne($dwg_id, false, DrawingDepartment::STATUS_ACTIVE);
		$this->dwg->getAlias();
        $breadcrumbs = $this->getBreadcrumbs();
        return $this->render('drawing_breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
    }
    
     private function getBreadcrumbs()
    {
        $breadcrumbs = '<ul class="nav navbar-nav" id="top-breadcrumbs-link"><li><a href="/">'.$this->dwg->catName.'</a></li> '; 
        $parents = $this->getArrayParents();
        $parents = array_reverse($parents);
        //Debug($parents);
        foreach ($parents as $parent) {
            $breadcrumbs .= '<li>';
            $breadcrumbs .= '<a href="'.Url::to(['/drawing/'.$parent->category, 'dwg_id' => $parent->id]).'">'.$parent->alias.'</a>';
			$breadcrums .= '<span class="glyphicon glyphicon-chevron-right top-breadcrumbs-chevron" aria-hidden="true">';
            $breadcrumbs .= '</li>';
        } 
        return $breadcrumbs.'<li>
								<a href="#" onclick="return false" style="text-decoration: none; cursor: default;">'.$this->dwg->alias.'</a>
								<span class="glyphicon glyphicon-chevron-right top-breadcrumbs-chevron" aria-hidden="true">
							</li>
							</ul>';   
    }

    private function getArrayParents()
    {
        $parents = [];
        $dwg = null;
        
        if ($this->dwg->parent_id) {
            if ($this->dwg->category = 'department') $dwg = DrawingDepartment::findOne(['id' => $this->dwg->parent_id]); 
            else $dwg = DrawingWorks::findOne(['id' => $this->dwg->parent_id]);
            if (!$dwg) return $parents;
            $dwg->getAlias();
            $parents[] = $dwg;   
        }
        else return $parents;
        
        if ($dwg->parent_id) {
            if ($this->dwg->category = 'department') $dwg = DrawingDepartment::findOne(['id' => $dwg->parent_id]); 
            else $dwg = DrawingWorks::findOne(['id' => $dwg->parent_id]);
            if (!$dwg) return $parents;
            $dwg->getAlias();
            $parents[] = $dwg;   
        }
        else return $parents;
        
        if ($dwg->parent_id) {
            if ($this->dwg->category = 'department') $dwg = DrawingDepartment::findOne(['id' => $dwg->parent_id]); 
            else $dwg = DrawingWorks::findOne(['id' => $dwg->parent_id]);
            if (!$dwg) return $parents;
            $dwg->getAlias();
            $parents[] = $dwg;   
        }
        else return $parents;
        
        if ($dwg->parent_id) {
            if ($this->dwg->category = 'department') $dwg = DrawingDepartment::findOne(['id' => $dwg->parent_id]); 
            else $dwg = DrawingWorks::findOne(['id' => $dwg->parent_id]);
            if (!$dwg) return $parents;
            $dwg->getAlias();
            $parents[] = $dwg;   
        }
        else return $parents;
        return $parents;
    }

}

