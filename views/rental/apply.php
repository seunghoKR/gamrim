<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ko.js"></script>

<div class="container mx-auto px-4 py-12 max-w-3xl">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-navy mb-2">시설 대관 신청</h1>
        <p class="text-gray-500">원하시는 시설과 일정을 정확히 입력해 주세요.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-10">
        <form action="/rental/submit" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
            
            <!-- 단체 및 신청자 정보 -->
            <div class="border-b pb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">신청자 정보</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">단체/교회명 *</label>
                        <input type="text" name="org_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">담당자명 *</label>
                        <input type="text" name="manager_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">연락처 (휴대폰) *</label>
                    <input type="tel" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy" placeholder="010-0000-0000">
                </div>
            </div>

            <!-- 집회 정보 -->
            <div class="border-b pb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">행사/집회 정보</h3>
                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">행사(집회)명 *</label>
                    <input type="text" name="event_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy" placeholder="예: 2026 청년부 동계 수련회">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">희망 시설 *</label>
                        <select name="facility_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-white">
                            <option value="">선택하세요</option>
                            <option value="1" <?php echo ($_GET['facility'] ?? '') == '1' ? 'selected' : ''; ?>>대성전 (1,500석)</option>
                            <option value="2" <?php echo ($_GET['facility'] ?? '') == '2' ? 'selected' : ''; ?>>벧엘성전 (300석)</option>
                            <option value="3" <?php echo ($_GET['facility'] ?? '') == '3' ? 'selected' : ''; ?>>세미나실 (80석)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">예상 참석 인원 *</label>
                        <input type="number" name="attendees" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy" placeholder="명">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">사용 기간 *</label>
                        <input type="text" id="rental-date-range" name="date_range" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-white" placeholder="날짜 선택" value="<?php echo $_GET['date'] ?? ''; ?>">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">사용 시간대 *</label>
                        <select name="time_slot" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-white">
                            <option value="all_day">종일</option>
                            <option value="morning">오전 (09:00 - 13:00)</option>
                            <option value="afternoon">오후 (14:00 - 18:00)</option>
                            <option value="evening">저녁 (19:00 - 22:00)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- 부가 옵션 -->
            <div class="pb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-4">부가 옵션 및 특이사항</h3>
                
                <div class="flex gap-6 mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="use_sound" value="1" class="w-4 h-4 text-navy border-gray-300 rounded focus:ring-navy">
                        <span class="ml-2 text-sm text-gray-700">방송/음향 장비 사용</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="use_dining" value="1" class="w-4 h-4 text-navy border-gray-300 rounded focus:ring-navy">
                        <span class="ml-2 text-sm text-gray-700">구내식당 이용 (별도 문의)</span>
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">요청 및 특이사항</label>
                    <textarea name="memo" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy resize-none" placeholder="추가적으로 필요하신 사항이나 궁금한 점을 적어주세요."></textarea>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg text-xs text-gray-600 mb-6">
                * 신청서를 제출하시면 관리자 확인 후 기재하신 연락처로 심사 결과 및 확정 절차를 안내해 드립니다.<br>
                * 대관료 및 식대는 확정 통보 시 상세히 안내해 드립니다.
            </div>

            <button type="submit" class="w-full bg-navy hover:bg-blue-900 text-white font-bold py-4 rounded-lg transition text-lg shadow-md">
                대관 신청서 제출
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#rental-date-range", {
        mode: "range",
        minDate: "today",
        locale: "ko",
        dateFormat: "Y-m-d"
    });
});
</script>
<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
