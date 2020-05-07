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

    // 회원가입 시 중복 체크를 하기 위해 사용자 정보를 db로부터 가져오는 메소드
    public function fetchAllUser()
    {
        $userID = 'forsythia01@gmail.com';

        $tableName = 'user';

        $statement = App::get('database')->selectTable($tableName);
        $userList = App::get('database')->fetchAllByArray($statement);

        $this->returnedData = ['userList' => $userList];
    }

    public function checkLoginInput($userID, $password)
    {
        $tableName = 'user';
        $dataClass = 'app\data\UserInfo';

        $userInfo = App::get('database')->fetchLoginData($tableName, $userID, $password, $dataClass);

        if ($userInfo == null) {
            $message = '아이디 혹은 비밀번호를 확인해주세요';
            $this->returnedData = [
                'userID' => $userID,
                'loginError' => $message
            ];
        }
        return $userInfo;
    }

    public function startSession($userInfo)
    {
        $userID =  $userInfo[0]->getUserID();
        $nickName = $userInfo[0]->getNickName();
        $sex = $userInfo[0]->getSex();

        // 세션에 사용자 정보를 등록한다
        $_SESSION['userID'] = $userID;
        $_SESSION['nickName'] = $nickName;
        $_SESSION['sex'] = $sex;
    }
}
