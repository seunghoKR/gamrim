<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<div class="bg-navy py-12 text-center text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">중보기도 신청</h1>
        <p class="text-gray-300">"너희는 내게 부르짖으라 내가 네게 응답하겠고" (렘 33:3)</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12 max-w-2xl">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-10">
        <div class="bg-blue-50 border border-blue-100 text-blue-800 px-4 py-3 rounded-lg mb-8 text-sm">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p>작성해주신 기도제목은 비공개로 접수되며, 원장단과 중보기도팀만 확인하여 집중적으로 기도해 드립니다.</p>
            </div>
        </div>

        <form action="/prayer/submit" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">이름 (직분)</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy" placeholder="예: 홍길동 (집사)">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">연락처</label>
                    <input type="tel" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy" placeholder="010-0000-0000">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">기도 제목 요약</label>
                <input type="text" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy" placeholder="기도제목의 핵심을 적어주세요">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">상세 기도 내용</label>
                <textarea name="content" required rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy resize-none" placeholder="하나님께 아뢸 상세한 기도 내용을 자유롭게 적어주세요."></textarea>
            </div>

            <!-- Captcha Area -->
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex flex-col md:flex-row items-center gap-4">
                <div class="flex-shrink-0">
                    <?php echo $captchaHtml ?? '<img src="/captcha/image" alt="CAPTCHA" class="border rounded bg-white w-32 h-10">'; ?>
                </div>
                <div class="w-full">
                    <input type="text" name="captcha" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy" placeholder="왼쪽의 문자를 입력하세요">
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input type="checkbox" name="agree" required id="agree" class="w-4 h-4 text-navy border-gray-300 rounded focus:ring-navy">
                </div>
                <div class="ml-3 text-sm">
                    <label for="agree" class="font-medium text-gray-700">개인정보 수집 및 이용에 동의합니다.</label>
                    <p class="text-gray-500 text-xs mt-1">수집된 정보는 중보기도 사역 외의 목적으로 사용되지 않으며, 일정 기간 후 파기됩니다.</p>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                <a href="/prayer/lookup" class="text-sm text-gray-500 hover:text-navy underline">나의 기도 응답 조회</a>
                <button type="submit" class="bg-navy hover:bg-blue-900 text-white font-bold py-3 px-8 rounded-lg transition shadow-md">
                    기도 요청하기
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
