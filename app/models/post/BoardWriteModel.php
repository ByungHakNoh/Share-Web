<?php

namespace app\models\post;

use core\App;
use DOMDocument;

class BoardWriteModel
{

    public function uploadScript($writer, $title, $content)
    {
        // 작성자 수정해야함
        $content = $this->prepareImageContent($content);
        $directUrl = 'board';

        $this->saveToDatabase($writer, $title, $content);
        header("Location:/{$directUrl}");
        exit;
    }

    private function prepareImageContent($content)
    {
        if (strpos($content, '<img') && strpos($content, ';base64')) {

            if (strpos($content, ';base64')) {

                $doc = new DOMDocument();
                $doc->loadHTML('<?xml encoding="utf-"?>' . $content);

//코드 정렬이 맞지 않아 php 열고 닫아줌 -> 추후 수정 요망
?>
<?php
                $tags = $doc->getElementsByTagName('img');

                foreach ($tags as $tag) {

                    // string으로 인코딩된 base64 이미지 가져오기
                    $srcStr = $tag->getAttribute('src');
                    $base64EncData = substr($srcStr, ($pos = strpos($srcStr, 'base64,')) ? $pos + 7 : 0);
                    $base64EncData = substr($base64EncData, 0, -1);

                    // base64로 된 이미지를 디코드하여 이미지로 변환
                    $img = base64_decode($base64EncData);

                    // 파일의 타입 가져오기
                    $dataInfo = explode(";", $srcStr)[0];
                    $fileExt = str_replace('data:image/', '', $dataInfo);

                    // 고유한 이름을 부여하여 이미지 파일이름을 정하고 파일 객체 생성
                    $newImageName = str_replace(".", "", uniqid("free-board:", true));
                    $filename = $newImageName . '.' . $fileExt;
                    $file = 'src/image/image-database/' . $filename;

                    // 이미지 서버 컴퓨터에 저장하기
                    file_put_contents($file, $img);
                    $imgUrl = 'http://192.168.56.1/' . $file;

                    // Update the forum thread text with an img tag for the new image
                    // $newImageTag = '<img src="' . $imgUrl . '" />';

                    $tag->setAttribute('src', $imgUrl);
                    $tag->setAttribute('data-original-filename', $tag->getAttribute('data-filename'));
                    $tag->removeAttribute('data-filename');
                }

                $content = $doc->saveHTML();
                return $content;
            }
            return $content;
        }
        return $content;
    }


    private function saveToDatabase($wrtier, $title, $content)
    {
        $date = date('Y-m-d');

        App::get('database')->insertData('free_board', [
            'writer' => '"' . $wrtier . '"',
            'title' => '"' . $title . '"',
            'date' => '"' . $date . '"',
            'content' => "'" . $content . "'"
        ]);
    }
}