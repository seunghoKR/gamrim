<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-16 max-w-md">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-navy mb-2">비회원 예약 조회</h1>
        <p class="text-sm text-gray-500">예약 시 입력하신 정보를 입력해 주세요.</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <form action="/stay/lookup" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">예약자 이름</label>
                <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-gray-50">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">연락처</label>
                <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-gray-50" placeholder="010-0000-0000">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">간편 비밀번호 (4자리)</label>
                <input type="password" name="password" required maxlength="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-gray-50 text-center tracking-[1em] text-lg font-mono">
            </div>

            <button type="submit" class="w-full bg-navy hover:bg-blue-900 text-white font-bold py-3 rounded-lg transition shadow-md">
                조회하기
            </button>
        </form>
    </div>
    
    <?php if(isset($isResult) && $isResult): ?>
    <!-- 조회 결과 데모 영역 (POST 요청 시 표시) -->
    <div class="mt-8 bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
        <div class="flex justify-between items-center mb-4 pb-4 border-b">
            <h3 class="font-bold text-lg text-gray-800">예약 내역</h3>
            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">예약확정</span>
        </div>
        
        <div class="space-y-3 text-sm mb-6">
            <div class="flex justify-between"><span class="text-gray-500">예약번호</span> <span class="font-bold">R260901-0012</span></div>
            <div class="flex justify-between"><span class="text-gray-500">객실명</span> <span class="font-bold">가족실 (201호)</span></div>
            <div class="flex justify-between"><span class="text-gray-500">체크인</span> <span class="font-medium">2026.09.15 14:00</span></div>
            <div class="flex justify-between"><span class="text-gray-500">체크아웃</span> <span class="font-medium">2026.09.16 11:00</span></div>
        </div>
        
        <div class="bg-gray-50 p-3 rounded-lg text-xs text-gray-600 mb-6">
            안내데스크에 방문하여 예약번호 또는 성함을 말씀해 주시면 키를 수령하실 수 있습니다.
        </div>
        
        <button type="button" class="w-full bg-white border border-red-200 text-red-500 hover:bg-red-50 font-bold py-2 rounded-lg transition text-sm">
            예약 취소 요청
        </button>
    </div>
    <?php endif; ?>
</div>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
