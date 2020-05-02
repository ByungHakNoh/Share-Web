<?php

namespace app\models;

require 'app/data/UserInfo.php';

use core\App;
use core\mvc\Model;

class UserModel extends Model
{
    // 회원가입 성공 시 데이터베이스에 회원 정보 저장하는 메소드
    public function uploadUser($userID, $password, $nickName, $sex)
    {

        App::get('database')->insertData('user', [
            'user_id' => '"' . $userID . '"',
            'password' => '"' . $password . '"',
            'nick_name' => '"' . $nickName . '"',
            'sex' => '"' . $sex . '"'
        ]);
    }

    // 로그인 
    public function fetchAllUser()
    {
        $userID = 'forsythia01@gmail.com';

        $tableName = 'user';
        // $keyValueData = ['user_id' => $userID];
        $dataClass = 'app\data\UserInfo';


        $statement = App::get('database')->selectTable($tableName);
        $userList = App::get('database')->fetchAllByArray($statement);

        $this->returnedData = ['userList' => $userList];
    }
}