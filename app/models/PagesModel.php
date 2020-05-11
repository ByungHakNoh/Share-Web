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
}
