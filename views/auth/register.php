<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<div class="py-12 bg-cream min-h-screen">
    <div class="container mx-auto px-4 max-w-lg">
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-navy text-gold text-2xl font-bold mb-3 shadow-md">
                    ✝
                </div>
                <h2 class="text-2xl font-bold text-navy">성도 회원가입</h2>
                <p class="text-xs text-gray-500 mt-1">집회 소식과 대관·숙소 예약 안내를 가장 빠르게 받아보세요.</p>
            </div>

            <?php if(isset($_GET['error'])): ?>
            <div class="mb-5 p-3 rounded-xl bg-red-50 text-red-700 text-xs font-semibold">
                <?php if($_GET['error'] === 'duplicate'): ?>
                    이미 사용 중인 아이디입니다. 다른 아이디를 입력해 주세요.
                <?php else: ?>
                    필수 정보를 모두 입력해 주세요.
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="/register">
                <div class="space-y-4 text-xs">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">아이디 *</label>
                        <input type="text" name="username" required class="w-full px-3.5 py-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-navy focus:outline-none" placeholder="아이디를 입력하세요">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">비밀번호 *</label>
                        <input type="password" name="password" required class="w-full px-3.5 py-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-navy focus:outline-none" placeholder="비밀번호를 입력하세요">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">성명 (실명) *</label>
                        <input type="text" name="name" required class="w-full px-3.5 py-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-navy focus:outline-none" placeholder="홍길동">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">휴대전화 번호 *</label>
                        <input type="tel" name="phone" required class="w-full px-3.5 py-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-navy focus:outline-none" placeholder="010-1234-5678">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">소속 교회 / 교단</label>
                        <input type="text" name="church_name" class="w-full px-3.5 py-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-navy focus:outline-none" placeholder="예: 부산 온누리교회">
                    </div>

                    <!-- 정보 수신 동의 섹션 (핵심 요구사항) -->
                    <div class="pt-4 border-t border-gray-100">
                        <label class="block font-bold text-navy mb-2">사역 및 이용 안내 수신 동의</label>
                        
                        <div class="space-y-2 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <label class="flex items-start space-x-2.5 cursor-pointer">
                                <input type="checkbox" name="agree_notice_event" value="1" checked class="mt-0.5 rounded text-navy">
                                <span class="text-gray-700"><strong>[선택]</strong> 365일 실시간 집회 및 특별성회 소식 수신</span>
                            </label>

                            <label class="flex items-start space-x-2.5 cursor-pointer">
                                <input type="checkbox" name="agree_notice_rental" value="1" checked class="mt-0.5 rounded text-navy">
                                <span class="text-gray-700"><strong>[선택]</strong> 대성전/세미나실 대관 상담 및 이용 안내 수신</span>
                            </label>

                            <label class="flex items-start space-x-2.5 cursor-pointer">
                                <input type="checkbox" name="agree_notice_stay" value="1" checked class="mt-0.5 rounded text-navy">
                                <span class="text-gray-700"><strong>[선택]</strong> 개인 기도실/가족 숙소 잔여실 및 예약 안내 수신</span>
                            </label>

                            <label class="flex items-start space-x-2.5 cursor-pointer">
                                <input type="checkbox" name="agree_marketing" value="1" class="mt-0.5 rounded text-navy">
                                <span class="text-gray-700"><strong>[선택]</strong> 기도원 정기 기도편지 및 은혜의 소식 수신</span>
                            </label>
                        </div>
                    </div>

                    <!-- 즉시 상담 신청 체크 -->
                    <div class="p-3.5 bg-gold/10 border border-gold/30 rounded-2xl flex items-center space-x-2.5">
                        <input type="checkbox" name="need_consult" id="need_consult" value="1" class="rounded text-gold">
                        <label for="need_consult" class="text-navy font-bold cursor-pointer">
                            🙋 가입과 동시에 대관/숙소 이용 상담을 요청합니다.
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 py-3.5 bg-navy text-white rounded-xl font-bold text-sm hover:bg-navy-800 transition shadow-lg">
                    동의하고 회원가입 완료
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-100 text-center text-xs text-gray-500">
                이미 계정이 있으신가요? <a href="/login" class="text-navy font-bold hover:underline">로그인하기</a>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>