<?php declare(strict_types=1);
class HomeController {
    public function index(): void {
        $isLive = false;
        $latestVideos = [];
        try {
            require_once ROOT_PATH.'/core/YouTubeSync.php';
            $yt = new YouTubeSync();
            $isLive = $yt->checkLive();
            $latestVideos = $yt->getLatestVideos(3);
        } catch(Exception $e) {}
        $dailyVerse = defined('DAILY_VERSE') ? DAILY_VERSE : '수고하고 무거운 짐 진 자들아 다 내게로 오라 내가 너희를 쉬게 하리라 (마태복음 11:28)';
        $shuttleInfo = defined('SHUTTLE_SCHEDULE') ? SHUTTLE_SCHEDULE : '양산역 2번 출구 앞 매일 수시 운행';
        $upcomingServices = [];
        try {
            require_once ROOT_PATH.'/models/ServiceModel.php';
            $svc = new ServiceModel();
            $upcomingServices = $svc->getUpcoming(5);
        } catch(Exception $e) {}
        require_once ROOT_PATH.'/views/main.php';
    }
    public function about(): void {
        require_once ROOT_PATH.'/views/about.php';
    }
    public function guide(): void {
        require_once ROOT_PATH.'/views/guide.php';
    }
}