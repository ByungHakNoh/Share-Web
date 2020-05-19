<?php

namespace app\models;

require 'app/data/BrandData.php';

use core\mvc\Model;
use core\App;

class PagesModel extends Model
{

    public function getBrandDataByID($startNumber, $limitNumber)
    {
        $table = 'brand';
        $order = 'desc';
        $columnName = 'id';
        $brandData = App::get('database')->fetchLimitedArray($table, $columnName, $order, $startNumber, $limitNumber);
        $this->returnedData['brandDataByID'] = $brandData;
    }

    public function getbrandRatingData($nickName)
    {
        $table = 'brand_rating';
        $keyValueData = ['nick_name' => '"' . $nickName . '"'];
        $ratingRecord =  App::get('database')->fetchArrayByName($table, $keyValueData);
        $this->returnedData['ratingRecord'] = $ratingRecord;
    }

    public function getBestBrand()
    {
        $table = 'brand';
        $columnName  = 'average_rate';
        $order = 'desc';
        $startNumber = 0;
        $limitNumber = 3;
        $dataClass = 'app\data\BrandData';
        $bestBrands = App::get('database')->fetchLimitedValues($table, $columnName, $order, $startNumber, $limitNumber, $dataClass);
        $this->returnedData['bestBrands'] = $bestBrands;
    }

    public function uploadBrandRating($brandID, $nickName, $rateNumber)
    {
        $table = 'brand_rating';

        App::get('database')->insertData($table, [
            'brand_id' => $brandID,
            'nick_name' => '"' . $nickName . '"',
            'rating' => $rateNumber
        ]);
    }

    public function uploadBrand($brandID, $totalVotes, $averageRate, $rateNumber)
    {
        $table = 'brand';
        $dataClass = 'app\data\BrandData';
        $brandData =  App::get('database')->fetchValueByID($table, $brandID, $dataClass);

        $oldAverage = $brandData[0]->getAverageRate();
        $totalVotes = $totalVotes + 1;
        $newAverage = $oldAverage + ($rateNumber - $oldAverage) / $totalVotes;

        App::get('database')->updateBrand($table, $brandID, [
            'averageRate' => $newAverage,
            'totalVotes' => $totalVotes
        ]);

        return $newAverage;
    }

    // 로컬 파일데이터를 읽는 메소드 -> 부모클래스에 추가해도 됨
    public function readLocalFile($filename, $retbytes = TRUE)
    {
        define('CHUNK_SIZE', 1024 * 1024);
        $buffer = '';
        $cnt    = 0;
        $handle = fopen($filename, 'rb');

        if ($handle === false) {
            return false;
        }

        // 
        while (!feof($handle)) {
            $buffer = fread($handle, CHUNK_SIZE);
            ob_flush();
            flush();

            if ($retbytes) {
                $cnt += strlen($buffer);
            }
        }
        fclose($handle);

        // memo : true를 통해 stdClass를 array로 변환
        $dataList = json_decode($buffer, true);
        $this->returnedData['scrapData'] = $dataList;
    }
}
