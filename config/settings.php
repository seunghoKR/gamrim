<?php
/**
 * 파일 역할: 사이트 설정 상수 캐싱
 * DB → 상수 매핑
 */
declare(strict_types=1);

require_once __DIR__ . '/database.php';

// DB 기본값 (DB 연결 전 폴백)
$defaults = [
    'site_name'          => '감림산기도원',
    'slogan'             => '말씀과 기도로 회복되는 은혜의 동산',
    'address'            => '경상남도 양산시 상북면 삼감중앙길 48',
    'phone_office'       => '055-374-4111',
    'phone_shuttle'      => '055-374-4111',
    'shuttle_schedule'   => '양산역 2번 출구 앞 / 매일 오전 9:30, 10:00, 오후 1:30, 저녁 6:30',
    'youtube_channel_id' => 'UC1exM7D3yO8L1Qo5JyLjHIg',
    'daily_verse'        => '수고하고 무거운 짐 진 자들아 다 내게로 오라 내가 너희를 쉬게 하리라 (마태복음 11:28)',
    'kakao_js_key'       => '',
    'youtube_api_key'    => '',
];

try {
    $pdo = Database::getInstance();
    $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
    $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    $settings = array_merge($defaults, $rows);
} catch (Exception $e) {
    $settings = $defaults;
}

// 상수 정의 (DB key → PHP 상수명 매핑)
$keyMap = [
    'site_name'          => 'SITE_NAME',
    'slogan'             => 'SITE_SLOGAN',
    'address'            => 'SITE_ADDRESS',
    'phone_office'       => 'PHONE_OFFICE',
    'phone_shuttle'      => 'PHONE_SHUTTLE',
    'shuttle_schedule'   => 'SHUTTLE_SCHEDULE',
    'youtube_channel_id' => 'YOUTUBE_CHANNEL_ID',
    'daily_verse'        => 'DAILY_VERSE',
    'kakao_js_key'       => 'KAKAO_JS_KEY',
    'youtube_api_key'    => 'YOUTUBE_API_KEY',
];

foreach ($keyMap as $dbKey => $constName) {
    if (!defined($constName)) {
        define($constName, $settings[$dbKey] ?? '');
    }
}
