<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<div class="py-16 bg-cream min-h-screen">
    <div class="container mx-auto px-4 max-w-md">
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-navy text-gold text-2xl font-bold mb-3 shadow-md">
                    ✝
                </div>
                <h2 class="text-2xl font-bold text-navy">성도 로그인</h2>
                <p class="text-xs text-gray-500 mt-1">감림산기도원 온라인 플랫폼에 오신 것을 환영합니다.</p>
            </div>

            <?php if(isset($_GET['error'])): ?>
            <div class="mb-5 p-3 rounded-xl bg-red-50 text-red-700 text-xs font-semibold text-center">
                아이디 또는 비밀번호를 다시 확인해 주세요.
            </div>
            <?php endif; ?>

            <form method="POST" action="/login">
                <div class="space-y-4 text-xs">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">아이디</label>
                        <input type="text" name="username" required autofocus class="w-full px-3.5 py-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-navy focus:outline-none" placeholder="아이디">
                    </div>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">비밀번호</label>
                        <input type="password" name="password" required class="w-full px-3.5 py-2.5 border rounded-xl text-sm focus:ring-2 focus:ring-navy focus:outline-none" placeholder="비밀번호">
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 py-3.5 bg-navy text-white rounded-xl font-bold text-sm hover:bg-navy-800 transition shadow-lg">
                    로그인
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-100 text-center text-xs text-gray-500">
                아직 회원이 아니신가요? <a href="/register" class="text-gold font-bold hover:underline">회원가입하기</a>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>