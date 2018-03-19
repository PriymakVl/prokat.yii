<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\modules\objects\widgets\ObjectBreadcrumbsHeaderWidget;
use app\modules\drawing\widgets\DrawingBreadcrumbsHeaderWidget;

class HeaderWidget extends Widget {

    public function run()
    {
        $template = $this->getTemplate();
        if ($template == 'obj_breadcrumbs') return ObjectBreadcrumbsHeaderWidget::widget();  
        else if ($template == 'dwg_department_breadcrumbs')  return DrawingBreadcrumbsHeaderWidget::widget(['category' => 'department']);
        return $this->render("header/$template");

    }

    

    private function getTemplate()
    {
        switch(Yii::$app->controller->id) {
            case 'main': return 'search_object'; break;
            case 'list': return 'search_object'; break;
            case 'default': return 'search_object'; break;
            case 'drawing-department': return $this->getTemplateForActionDrawingDepartmentController(); break;
            case 'drawing-object': return 'breadcrumbs'; break;
            case 'drawing-works': return $this->getTemplateForActionDrawingworksController(); break;
            case 'object': return $this->getTemplateForActionObjectController(); break;
            case 'object-drawing': return 'obj_breadcrumbs'; break;
            case 'object-specification': return $this->getTemplateForActionSpecificationController(); break;
            case 'search': return $this->getTemplateForActionSearchController(); break;
            case 'order': return 'search_order'; break;
            case 'order-content': return 'search_order'; break;
            case 'order-act': return $this->getTemplateForActionOrderActController(); break;
            case 'application': return $this->getTemplateForActionApplicationController(); break;
            default: return 'empty';
        }       
    }

    private function getTemplateForActionObjectController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'form': return 'search_object'; break;
            case 'index': return 'obj_breadcrumbs'; break;
            case 'orders': return 'obj_breadcrumbs'; break;
            default: return 'empty';
        }    
    }

    private function getTemplateForActionSearchController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'object-code': return 'search_object'; break;
            case 'object-name': return 'search_object'; break;
            case 'order': return 'search_order'; break;
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
    
    private function getTemplateForActionDrawingDepartmentController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'list': return 'search_department_dwg'; break;
            case 'index': return 'obj_breadcrumbs'; break;
            case 'form': return 'obj_breadcrumbs'; break;
            default: return 'empty';
        }    
    }
    
    private function getTemplateForActionApplicationController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'list': return 'search_app'; break;
            case 'index': return 'search_app'; break;
            default: return 'empty';
        }    
    }
    
    private function getTemplateForActionSpecificationController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'main': return 'search_object'; break;
            case 'index': return 'obj_breadcrumbs'; break;
            default: return 'empty';
        }    
    }
    
    private function getTemplateForActionOrderActController() 
    {
        switch(Yii::$app->controller->action->id) {
            case 'list': return 'search_act'; break;
            case 'index': return 'search_act'; break;
            default: return 'empty';
        }    
    }

}

