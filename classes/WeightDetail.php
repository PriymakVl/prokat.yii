<?php

namespace app\classes;

use app\classes\interfaces\ConfigApp;
use app\classes\traits\CommonFunctions;

class WeightDetail
{
    static private $dimensions;
    static private $density;
    
    
    static public function calculate($dimensions, $material)
    {
        self::$dimensions = $dimensions;
        self::setDensity($material);
        switch ($dimensions['type']) {
            case 'bolt': return self::calculateWeightBolt();
            case 'nut': return self::calculateWeightNut();
            case 'shaft': return self::calculateWeightShaft();
            case 'bush': return self::calculateWeightBush();
            case 'bar': return self::calculateWeightBar();
            default: return null;
        }   
    }
    
    static private function setDensity($material)
    {
        self::$density = ($material == 'ОЦС 5-5-5') ? 8.8 : 7.85; 
    }
    
    static private function calculateWeightBar()
    {
        $height = self::$dimensions['height'];
        $width = self::$dimensions['width'] / 1000;
        $length = self::$dimensions['length'] / 1000;
        $square = bcmul($width, $length, 6);
        $volume = bcmul($square, $height, 6); 
        return bcmul($volume, self::$density, 2);  
    }
    
    static private function calculateWeightBush() {
        $in_volume = self::countVolumeCylinder(self::$dimensions['in_diam'], self::$dimensions['height']);
        $out_volume = self::countVolumeCylinder(self::$dimensions['out_diam'], self::$dimensions['height']);
        if ($in_volume > $out_volume) {
            \Yii::$app->session->setFlash('error-order-item', 'Вес не посчитан внутренний диаметр втулки больше наружного');
            return false;    
        }
        $bush_volume = $out_volume - $in_volume;
        return bcmul($bush_volume, self::$density, 2);
    }
    
    static private function calculateWeightShaft() {
        $volume = self::countVolumeCylinder(self::$dimensions['diam'], self::$dimensions['length']);
        return bcmul($volume, self::$density, 2);
    }
    
    static private function calculateWeightBolt() {
        $data = file('files/data/bolt_weight.txt');
        $threads = explode(';', $data[0]);
        $index = array_search(self::$dimensions['thread'], $threads);
        
        for ($i = 1; $i < count($data); $i++) {
            $row = explode(';', $data[$i]);
            if ($row[0] == self::$dimensions['length']) {
                return round(($row[$index] / 1000), 3, PHP_ROUND_HALF_UP);   
            }
            else continue;    
        }
        return false;
    }
    
    static private function countVolumeCylinder($diam, $height)
    {
        $radius = ($diam / 2) / 1000;
        $square = bcmul($radius, $radius, 6);
        $area = bcmul($square, M_PI, 6);
        return bcmul($area, $height, 6);
    }

    static private function countWeightHexahedron($in_diam, $length)
    {
        $weights_metеr = ['10'=>'0.68', '13'=>'1.15', '16'=>'1.74', '18'=>'2.2', '21'=>'3', '24'=>'3.92', '27'=>'5.33',
            '30'=>'6.12', '34'=>'7.86', '36'=>'8.81', '41'=>'11,99', '46'=>'14.95', '55'=>'20.58', '65'=>'28.7', '75'=>'38.24'];
        $weight_meter = $weights_metеr[$in_diam];
        return bcmul($weight_meter, ($length / 1000), 3); 
    }
    
    static private function calculateWeightNut()
    {
        $weights = ['5' => '0.001', '6' => '0.002', '8' => '0.005', '10' => '0.011', '12' => '0.015', '14' => '0.025', '16' => '0.033', 
        '18' => '0.047', '20' => '0.063', '22' => '0.077', '24' => '0.107', '27' => '0.161', '30' => '0.225', '36' => '0.377', '42' => '0.624', '48' => '0.956'];
        return $weights[self::$dimensions['thread']];
    }
}