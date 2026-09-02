<?php declare(strict_types=1);

class KakaoAPI {
    private static function logKakaoMessage(string $type, string $recipient, string $message): void {
        $logDir = ROOT_PATH . '/cache';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0777, true);
        }
        $logFile = $logDir . '/kakao_notifications.log';
        $entry = "[" . date('Y-m-d H:i:s') . "] [$type] To: $recipient | Msg: " . str_replace("\n", " ", $message) . "\n";
        @file_put_contents($logFile, $entry, FILE_APPEND);
    }

    /**
     * 시설 유지보수 등록 시 담당자에게 카카오톡 알림
     */
    public static function sendMaintenanceAlert(string $roomNumber, string $buildingName, string $memo): bool {
        $msg = "[감림산기도원 시설유지보수 알림]\n";
        $msg .= "위치: {$buildingName} {$roomNumber}\n";
        $msg .= "점검내용: {$memo}\n";
        $msg .= "일시: " . date('Y-m-d H:i') . "\n";
        $msg .= "확인 후 신속한 점검 및 조치 바랍니다.";

        $managerPhone = defined('PHONE_OFFICE') ? PHONE_OFFICE : '055-374-4111';
        self::logKakaoMessage('MAINTENANCE_ALERT', $managerPhone, $msg);
        return true;
    }

    /**
     * 숙소 예약 접수 시 예약 담당자에게 카카오톡 알림
     */
    public static function sendBookingRequestAlertToManager(array $booking): bool {
        $msg = "[감림산기도원 신규 숙소예약 접수]\n";
        $msg .= "예약번호: {$booking['booking_no']}\n";
        $msg .= "예약자: {$booking['guest_name']} 성도님 ({$booking['phone']})\n";
        $msg .= "객실: {$booking['room_number']}\n";
        $msg .= "기간: {$booking['checkin_date']} ~ {$booking['checkout_date']} ({$booking['guest_count']}명)\n";
        $msg .= "상태: 승인 대기중 (관리자 포털에서 확약/반려 처리 바랍니다)";

        $managerPhone = defined('PHONE_OFFICE') ? PHONE_OFFICE : '055-374-4111';
        self::logKakaoMessage('BOOKING_NEW_TO_MANAGER', $managerPhone, $msg);
        return true;
    }

    /**
     * 예약 확약(확정) 또는 반려 시 성도에게 카카오톡 알림
     */
    public static function sendBookingStatusAlertToGuest(string $phone, string $guestName, string $roomNumber, string $checkin, string $checkout, string $status, string $reason = ''): bool {
        $msg = "[감림산기도원 숙소예약 {$status} 안내]\n";
        $msg .= "안녕하세요, {$guestName} 성도님.\n";
        
        if ($status === '예약확정') {
            $msg .= "신청하신 숙소 예약이 정상적으로 [확약(확정)] 되었습니다.\n\n";
            $msg .= "• 배정객실: {$roomNumber}\n";
            $msg .= "• 입실일시: {$checkin} 오후 2시부터\n";
            $msg .= "• 퇴실일시: {$checkout} 낮 11시까지\n";
            $msg .= "• 문의: 055-374-4111 (경남 양산시 상북면 삼감중앙길 48)\n";
            $msg .= "은혜롭고 평안한 안식의 시간 되시기를 기도합니다.";
        } else {
            $msg .= "신청하신 숙소 예약이 부득이하게 [반려/취소] 되었습니다.\n";
            if ($reason) {
                $msg .= "• 사유: {$reason}\n";
            }
            $msg .= "일정 변경이나 상세 상담은 기도원 사무실(055-374-4111)로 문의해 주시기 바랍니다.";
        }

        self::logKakaoMessage('BOOKING_STATUS_TO_GUEST', $phone, $msg);
        return true;
    }
}