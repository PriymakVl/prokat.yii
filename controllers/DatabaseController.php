<?php
namespace app\controllers;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\controllers\BaseController;
use app\models\Objects;
use app\modules\applications\models\Application;
use app\modules\applications\models\Applicationold;

class DatabaseController extends BaseController 
{
    public function actionIndex()
    {
        $files = ['11430015.tif', '11636986.tif'];  
        foreach ($files as $file) {
            $this->open($file);
        } 
        exit('end');
    }
    
    public function actionIndex2() 
    {
        $file = 'files/vendor/danieli/11430015.tif';
        if (file_exists($file)) {
// сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
        if (ob_get_level()) {
            ob_end_clean();
        }
        // заставляем браузер показать окно сохранения файла
        //header('Content-Description: File Transfer');
        //header('Content-Type: application/octet-stream');
        //header('Content-Disposition: attachment; filename=' . basename($file));
        //header('Content-Transfer-Encoding: binary');
        //header('Expires: 0');
        //header('Cache-Control: must-revalidate');
        //header('Pragma: public');
        //header('Content-Length: ' . filesize($file));
        // читаем файл и отправляем его пользователю
        readfile($file);
        exit('end');
    }
    
    }
    
    private function open($filename) 
    {
        $file = 'files/vendor/danieli/'.$filename;
        //$filename = basename($file);
        //debug($filename);
        header ("Content-Type: application/octet-stream");
        header ("Accept-Ranges: bytes");
        header ("Content-Length: ".filesize($file));
        header('Content-Transfer-Encoding: binary');
        header ("Content-Disposition: attachment; filename=".$filename);  
        readfile($file);
        return true;   
    }
    
}