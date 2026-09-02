<?php
/**
 * 파일 역할: 세션 기반 산술 캡차
 */
declare(strict_types=1);

class Captcha {
    public static function generate(): string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $num1 = random_int(10, 99);
        $num2 = random_int(10, 99);
        $op = random_int(0, 1) === 0 ? '+' : '-';
        
        if ($op === '-' && $num1 < $num2) {
            $temp = $num1;
            $num1 = $num2;
            $num2 = $temp;
        }
        
        $answer = $op === '+' ? ($num1 + $num2) : ($num1 - $num2);
        $_SESSION['captcha_answer'] = (string)$answer;
        
        return "<div class='captcha-wrap'>
                    <label>자동입력 방지: {$num1} {$op} {$num2} = ?</label>
                    <input type='text' name='captcha' required placeholder='정답을 입력하세요'>
                </div>";
    }

    public static function verify(string $answer): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['captcha_answer'])) {
            return false;
        }
        
        $isValid = $_SESSION['captcha_answer'] === trim($answer);
        unset($_SESSION['captcha_answer']); // 한번 검증 후 삭제
        return $isValid;
    }
}
