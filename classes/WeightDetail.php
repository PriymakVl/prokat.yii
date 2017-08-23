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
        self::$density = ($material == 'ÎÖÑ 5-5-5') ? 8.8 : 7.85; 
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
    
     private function calculateWeightBush() {
        $in_volume = self::countVolumeCylinder(self::$dimensions['in_diam'], self::$dimensions['height']);
        $out_volume = self::countVolumeCylinder(self::$dimensions['out_diam'], self::$dimensions['height']);
        $bush_volume = $out_volume - $in_volume;
        return bcmul($bush_volume, self::$density, 2);
    }
    
    private function calculateWeightShaft() {
        $volume = self::countVolumeCylinder(self::$dimensions['diam'], self::$dimensions['length']);
        return bcmul($volume, self::$density, 2);
    }
    
    private function calculateWeightBolt() {
        $rod_volume = self::countVolumeCylinder(self::$dimensions['thread'], self::$dimensions['length']);
        $head_volume = self::countHeadVolumeBolt();
        $volume = $rod_volume + $head_volume;
        return bcmul($volume, self::$density, 2);  
    }
    
    private function countVolumeCylinder($diam, $height)
    {
        $radius = ($diam / 2) / 1000;
        $square = bcmul($radius, $radius, 6);
        $area = bcmul($square, M_PI, 6);
        return bcmul($area, $height, 6);
    }
    
    private function countVolumeHexahedron($side, $height)
    {
        $const = 2.1213;
        $area = bcmul($const, ($side / 1000), 6);
        return bcmul($area, $height, 6);
    }
    
    private function countHeadVolumeBolt()
    {
        $side = self::getLengthSideHeadBolt();
        $height = self::getHeightHeadBolt();
        return self::countVolumeHexahedron($side, $height);
    }
    
    private function getLengthSideHeadBolt()
    {
        $sizes = ['6' => '5', '8' => '7.5', '10' => '8', '12' => '9', '14' => '10.5', '16' => '12', '18' => '13.5',
        '20' => '15', '22' => '17', '24' => '18', '27' => '20.5', '30' => '23', '36' => '27.5', '42' => '32.5', '48' => '37.5'];
        return $sizes[self::$dimensions['thread']];
    }
    
    private function getHeightHeadBolt()
    {
        $sizes = ['6' => '4', '8' => '5.3', '10' => '6.4', '12' => '7.5', '14' => '8.8', '16' => '10', '18' => '12',
        '20' => '12.5', '22' => '14', '24' => '15', '27' => '17', '30' => '18.7', '36' => '22.5', '42' => '26', '48' => '30'];
        return $sizes[self::$dimensions['thread']];
    }
}