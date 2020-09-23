<?php

namespace app\controllers;

use core\mvc\Controller;

// 사용자의 request를 수신받는다.

// 모델 클래스를 생성하고 필요한 데이터를 DB에서 받아온다.

// 받아온 데이터를 view에 넣고 view 객체를 생성한다.
class PagesController extends Controller
{
    // 홈페이지
    public function home()
    {
        // 처음 방문한 경우 하루 동안 쿠키 저장
        if (!isset($_COOKIE['visited'])) {
            setcookie('visited', true, time() + 86400);

            $ip = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];

            $model = $this->createModel('UserModel');
            $model->uploadAdminData($ip, $userAgent);
        }

        $startNumber = 0;
        $endNumber = 9;

        // 자유계시판, 브랜드 모델 생성 
        $boardModel = $this->createModel('BoardModel');
        $brandModel = $this->createModel('PagesModel');

        // 자유계시판 중 조회수별, 최신 순으로 데이터를 가져오기
        $boardModel->fetchDataByID($startNumber, $endNumber, 'desc');
        $boardModel->fetchDataByHit($startNumber, $endNumber, 'desc');
        // top 3 브랜드 정보 가져오기
        $brandModel->getBestBrand();

        $viewData = [
            'brandData' => $brandModel->getReturnedData(),
            'boardData' => $boardModel->getReturnedData()
        ];

        $view = $this->createView('home', $viewData);
        return $view->loadView();
    }

    // 패션 뉴스 크롤링 페이지
    public function news()
    {
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        $model = $this->createModel('PagesModel');
        // $model->readFile('app/data/FashionNews.csv');
        $model->readLocalFile('app/data/FashionNews.csv');

        $viewData = $model->getReturnedData();
        $viewData['currentPage'] = $currentPage;
        $view = $this->createView('news', $viewData);
        return $view->loadView();
    }

    // 브랜드 선호도 페이지
    public function brand()
    {
        $model = $this->createModel('PagesModel');

        if (isset($_POST['start'])) {

            $startNumber = $_POST['start'];
            $limitNumber = $_POST['limit'];

            $model->getBrandDataByID($startNumber, $limitNumber);
            $brandData = $model->getReturnedData();
            exit(json_encode($brandData));
        } else if (isset($_POST['id'])) {

            $brandID = $_POST['id'];
            $nickName = $_POST['nickName'];
            $rateNumber = $_POST['rateNumber'];
            $totalVotes = $_POST['totalVotes'];
            $averageRate = $_POST['averageRate'];

            $model->uploadBrandRating($brandID, $nickName, $rateNumber);
            $response = $model->uploadBrand($brandID, $totalVotes, $averageRate, $rateNumber);
            exit(json_encode($response));
        } else {

            if (isset($_SESSION['nickName'])) {

                $nickName = $_SESSION['nickName'];
                $model->getbrandRatingData($nickName);
            }
            $model->getBestBrand();
            $viewData = $model->getReturnedData();
            $view = $this->createView('brand', $viewData);
            return $view->loadView();
        }
    }

    // 방송 보기 페이지
    public function broadcast()
    {
        $model = $this->createModel('UserModel');

        if (isset($_POST['donationMoney'])) {
            $nickName = $_POST['nickName'];
            $donationMoney = $_POST['donationMoney'];

            $model->uploadDonationMoney($nickName, $donationMoney);
            exit();
        } else {

            if (isset($_SESSION['nickName'])) {
                $nickName = $_SESSION['nickName'];
                $donationMoney = $model->fetchDonationData($nickName);
            } else {
                $nickName = null;
                $donationMoney = null;
            }

            $viewData = [
                'nickName' => $nickName,
                'donationMoney' => $donationMoney
            ];
            $view = $this->createView('hackathon', $viewData);
            return $view->loadView();
        }
    }

    // 쿠키 관련 post 메소드 처리하는 페이지
    public function cookieHandler()
    {

        // 홈페이지의 '오늘 광고 그만보기'를 눌렀을 경우
        if (isset($_POST['notToday'])) {
            setcookie('notToday', true, time() + 86400);

            header("Location:/");
            exit;
        }
    }
}
