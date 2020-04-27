<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $writer = '노병학';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $content = prepareImageContent($content);
    echo gettype($content);
    echo $title;

    if (
        empty($title)
        || empty($content)
    ) {

        echo "<script language='javascript'>alert('제목 또는 내용을 입력해주세요');</script>";
    } else {

        saveToDatabase($app, $writer, $title, $content);
        echo "<script language='javascript'>alert('자유 계시판에 글을 올렸습니다')
        document.location.href='/board';</script>";
    }
}

require 'views/view_write.php';


// 메소드 관련 부분 추후 다른 파일로 이동할 수 있다.

// 이미지 컨텐츠가 있을 때 이미지를 서버 컴퓨터 저장소에 저장 후 url을 저장하는 메소드
// html 형식으로 저장
function prepareImageContent($content)
{
    if (strpos($content, '<img') && strpos($content, ';base64')) {

        if (strpos($content, ';base64')) {

            $doc = new DOMDocument();
            $doc->loadHTML($content);

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

function saveToDatabase($app, $wrtier, $title, $content)
{
    $date = date('Y-m-d');

    $app['database']->insertData('FreeBoard', [
        'writer' => '"' . $wrtier . '"',
        'title' => '"' . $title . '"',
        'date' =>  '"' . $date . '"',
        'content' => "'" . $content . "'"
    ]);
}