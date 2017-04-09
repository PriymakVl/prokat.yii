<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\modules\objects\widgets\ObjectBreadcrumbsHeaderWidget;

class HeaderWidget extends Widget {

    public function run()
    {
        $template = $this->getTemplate();
        if ($template == 'breadcrumbs') return ObjectBreadcrumbsHeaderWidget::widget();    
        return $this->render("header/$template");

    }

    

    private function getTemplate()
    {
        switch(Yii::$app->controller->id) {
            case 'main': return 'search_code'; break;
            case 'list': return 'search_code'; break;
            case 'default': return 'search_code'; break;
            case 'drawingdepartment': return 'search_department_dwg'; break;
            case 'drawingobject': return 'breadcrumbs'; break;
            case 'drawingworks': return $this->getTemplateForActionDrawingworksController(); break;
            case 'object': return $this->getTemplateForActionObjectController(); break;
            case 'object-drawing': return 'breadcrumbs'; break;
            case 'object-specification': return 'breadcrumbs'; break;
            case 'search': return $this->getTemplateForActionSearchController(); break;
            case 'order': return 'search_order'; break;
            case 'order-content': return 'search_order'; break;
            default: return 'empty';
        }       
    }

    private function getTemplateForActionObjectController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'form': return 'search_code'; break;
            case 'index': return 'breadcrumbs'; break;
            default: return 'empty';
        }    
    }

    private function getTemplateForActionSearchController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'code': return 'search_code'; break;
            default: return 'empty';
        }    
    }
    
    private function getTemplateForActionDrawingWorksController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'list': return 'search_works_dwg'; break;
            case 'index': return 'search_works_dwg'; break;
            default: return 'empty';
        }    
    }

}

