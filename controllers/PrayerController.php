<?php
/**
 * 파일 역할: 중보기도 컨트롤러
 */
declare(strict_types=1);

require_once __DIR__ . '/../models/PrayerModel.php';
require_once __DIR__ . '/../core/Captcha.php';

class PrayerController {
    public function index(): void {
        $captchaHtml = Captcha::generate();
        require_once __DIR__ . '/../views/prayer/index.php';
    }

    public function submit(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $captchaAnswer = $_POST['captcha'] ?? '';
            
            if (!Captcha::verify($captchaAnswer)) {
                die('자동입력 방지 문자열이 올바르지 않습니다.');
            }

            $data = [
                'name' => htmlspecialchars($_POST['name'] ?? ''),
                'title' => htmlspecialchars($_POST['title'] ?? ''),
                'content' => htmlspecialchars($_POST['content'] ?? ''),
                'status' => '대기중'
            ];

            $prayerModel = new PrayerModel();
            $prayerModel->create($data);

            header('Location: /prayer?success=1');
        }
    }
}
