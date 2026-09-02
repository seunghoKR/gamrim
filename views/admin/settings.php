<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">⚙️ 사이트 기본 설정</h2>
    <p class="text-sm text-gray-500 mt-1">기도원 기본 정보, 연락처, 오늘의 말씀 및 외부 API 연동 정보를 관리합니다.</p>
</div>

<?php if(isset($_GET['saved'])): ?>
<div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-200 text-green-800 text-xs font-bold flex items-center space-x-2">
    <span>✅</span>
    <span>사이트 설정이 성공적으로 저장되었습니다! 즉시 홈페이지에 반영됩니다.</span>
</div>
<?php endif; ?>

<form method="POST" action="/admin/settings" class="space-y-6">
    <!-- 기본 정보 카드 -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="text-base font-bold text-navy-900 mb-4 pb-3 border-b border-gray-100 flex items-center space-x-2">
            <span>🏛️ 기도원 기본 정보</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
            <div>
                <label class="block font-semibold text-gray-700 mb-1">기도원 명칭</label>
                <input type="text" name="site_name" value="<?= htmlspecialchars($currentSettings['site_name'] ?? '감림산기도원') ?>" required class="w-full px-3.5 py-2.5 border rounded-xl text-sm font-bold text-navy">
            </div>
            <div>
                <label class="block font-semibold text-gray-700 mb-1">메인 슬로건</label>
                <input type="text" name="slogan" value="<?= htmlspecialchars($currentSettings['slogan'] ?? '말씀과 기도로 회복되는 은혜의 동산') ?>" class="w-full px-3.5 py-2.5 border rounded-xl text-sm">
            </div>
            <div class="md:col-span-2">
                <label class="block font-semibold text-gray-700 mb-1">소재지 주소</label>
                <input type="text" name="address" value="<?= htmlspecialchars($currentSettings['address'] ?? '경상남도 양산시 상북면 삼감중앙길 48') ?>" class="w-full px-3.5 py-2.5 border rounded-xl text-sm">
            </div>
            <div>
                <label class="block font-semibold text-gray-700 mb-1">대표 문의전화</label>
                <input type="text" name="phone_office" value="<?= htmlspecialchars($currentSettings['phone_office'] ?? '055-374-4111') ?>" class="w-full px-3.5 py-2.5 border rounded-xl text-sm font-mono">
            </div>
        </div>
    </div>

    <!-- 오늘의 말씀 카드 -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="text-base font-bold text-navy-900 mb-4 pb-3 border-b border-gray-100 flex items-center space-x-2">
            <span>📖 오늘의 성경 구절 (상단 배너 및 메인 카드)</span>
        </h3>
        <div class="text-xs">
            <textarea name="daily_verse" rows="3" class="w-full px-3.5 py-2.5 border rounded-xl text-sm leading-relaxed" placeholder="성경 구절을 입력하세요"><?= htmlspecialchars($currentSettings['daily_verse'] ?? '여호와는 나의 목자시니 내게 부족함이 없으리로다 (시편 23:1)') ?></textarea>
            <p class="text-[11px] text-gray-400 mt-1.5">※ 사이트 최상단 띠 배너와 메인 화면 [오늘의 말씀 카드]에 즉시 표시됩니다.</p>
        </div>
    </div>

    <!-- 외부 API 연동 카드 -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="text-base font-bold text-navy-900 mb-4 pb-3 border-b border-gray-100 flex items-center space-x-2">
            <span>🔗 미디어 & 플랫폼 연동 키</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
            <div>
                <label class="block font-semibold text-gray-700 mb-1">YouTube 채널 ID (감림산TV)</label>
                <input type="text" name="youtube_channel_id" value="<?= htmlspecialchars($currentSettings['youtube_channel_id'] ?? 'UC1exM7D3yO8L1Qo5JyLjHIg') ?>" class="w-full px-3.5 py-2.5 border rounded-xl text-sm font-mono">
            </div>
            <div>
                <label class="block font-semibold text-gray-700 mb-1">YouTube Data API v3 Key (선택)</label>
                <input type="password" name="youtube_api_key" value="<?= htmlspecialchars($currentSettings['youtube_api_key'] ?? '') ?>" class="w-full px-3.5 py-2.5 border rounded-xl text-sm font-mono" placeholder="실시간 라이브 감지용 키">
            </div>
            <div class="md:col-span-2">
                <label class="block font-semibold text-gray-700 mb-1">카카오 JavaScript 키 (말씀 공유/알림 연동용)</label>
                <input type="text" name="kakao_js_key" value="<?= htmlspecialchars($currentSettings['kakao_js_key'] ?? '') ?>" class="w-full px-3.5 py-2.5 border rounded-xl text-sm font-mono" placeholder="카카오 디벨로퍼스 Javascript 키">
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-3">
        <a href="/admin" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs transition">취소</a>
        <button type="submit" class="px-6 py-2.5 bg-navy-700 hover:bg-navy-800 text-white font-bold rounded-xl text-xs shadow-md transition">
            설정 저장하기
        </button>
    </div>
</form>