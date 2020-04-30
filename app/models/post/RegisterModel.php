<?php

namespace app\models\post;

use core\App;

class RegisterModel
{
    public function uploadUser($userID, $password, $passwordCheck)
    {
        $directUrl = 'login';

        if ($password === $passwordCheck) {

            App::get('database')->insertData('User', [
                'userID' => '"' . $userID . '"',
                'password' => '"' . $password . '"'
            ]);

            header("Location:/{$directUrl}");
        } else {

            // 바꿔야함
            echo '다시 해야함';
        }


        exit;
    }
}
