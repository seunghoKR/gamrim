<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? '감림산기도원 관리자') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            50: '#f0f4f8',
                            100: '#d9e2ec',
                            700: '#1e3a5f',
                            800: '#152b47',
                            900: '#0f1f33',
                            950: '#0a1524',
                        },
                        gold: '#d4a017',
                    }
                }
            }
        }
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Noto Sans KR', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden text-gray-800">

    <!-- 사이드바 -->
    <aside id="sidebar" class="bg-navy-900 text-white w-64 flex-shrink-0 flex flex-col justify-between py-5 px-3 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out z-30 shadow-xl overflow-y-auto">
        <div>
            <!-- 로고 영역 -->
            <div class="flex items-center space-x-3 px-3 pb-5 mb-5 border-b border-navy-700">
                <div class="w-10 h-10 rounded-xl bg-gold flex items-center justify-center text-navy-950 font-bold text-xl shadow-md flex-shrink-0">
                    ✝
                </div>
                <div>
                    <h1 class="text-base font-bold tracking-tight text-white leading-tight">감림산기도원</h1>
                    <p class="text-[11px] text-gold font-medium">통합 사역 포털</p>
                </div>
            </div>

            <!-- 네비게이션 메뉴 -->
            <nav class="space-y-1 text-xs sm:text-sm">
                <?php $curr = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>
                
                <a href="/admin" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= ($curr === '/admin' || $curr === '/admin/dashboard') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>📊</span>
                    <span>통합 현황판</span>
                </a>

                <div class="pt-2 pb-1 px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">사역 & 일정</div>

                <a href="/admin/speakers" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= str_starts_with($curr, '/admin/speakers') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>🎙️</span>
                    <span>강사(설교자) 관리</span>
                </a>

                <a href="/admin/services" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= str_starts_with($curr, '/admin/services') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>📅</span>
                    <span>연중 집회 & 구글캘린더</span>
                </a>

                <a href="/admin/prayer" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= str_starts_with($curr, '/admin/prayer') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>🙏</span>
                    <span>중보기도 핫라인</span>
                </a>

                <div class="pt-2 pb-1 px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">시설 & 자산 관리</div>

                <a href="/admin/facilities" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= str_starts_with($curr, '/admin/facilities') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>🏛️</span>
                    <span>대관 시설 정보</span>
                </a>

                <a href="/admin/rental" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= ($curr === '/admin/rental') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>📑</span>
                    <span>대관 신청 현황</span>
                </a>

                <a href="/admin/rooms-manage" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= str_starts_with($curr, '/admin/rooms-manage') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>🛏️</span>
                    <span>객실·청소·유지보수</span>
                </a>

                <a href="/admin/rooms" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= ($curr === '/admin/rooms') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>🗓️</span>
                    <span>숙소 예약 (룸 랙)</span>
                </a>

                <div class="pt-2 pb-1 px-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">회원 & 그룹 (개발자)</div>

                <a href="/admin/users" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= str_starts_with($curr, '/admin/users') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>👥</span>
                    <span>회원·상담 & 그룹 관리</span>
                </a>

                <a href="/admin/settings" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition <?= str_starts_with($curr, '/admin/settings') ? 'bg-gold text-navy-950 font-bold shadow' : 'text-gray-300 hover:bg-navy-800 hover:text-white' ?>">
                    <span>⚙️</span>
                    <span>사이트 기본 설정</span>
                </a>
            </nav>
        </div>

        <!-- 하단 바로가기 -->
        <div class="pt-3 border-t border-navy-700 space-y-1">
            <a href="/" target="_blank" class="flex items-center space-x-2 text-xs text-gray-300 hover:text-gold transition px-2 py-1">
                <span>🌐</span>
                <span>사용자 홈 바로가기</span>
            </a>
            <div class="text-[10px] text-gray-400 px-2 flex justify-between">
                <span>감림산 사역 ERP</span>
                <span class="text-gold font-bold">개발자 모드</span>
            </div>
        </div>
    </aside>

    <!-- 메인 본문 -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- 상단 헤더 -->
        <header class="bg-white border-b border-gray-200 flex justify-between items-center py-3.5 px-6 z-10 shadow-sm">
            <div class="flex items-center space-x-3">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none p-1 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="text-xs text-gray-500 hidden sm:block">
                    <span class="text-navy-700 font-semibold">감림산기도원 관리자</span> &gt; <?= htmlspecialchars($pageTitle ?? '현황') ?>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <span class="px-2.5 py-1 bg-amber-50 text-amber-800 border border-amber-200 rounded-full text-xs font-bold">
                    개발자 대표님 모드
                </span>
                <a href="/admin/logout" class="text-xs text-red-600 hover:text-white hover:bg-red-600 border border-red-200 px-3 py-1.5 rounded-lg font-medium transition">로그아웃</a>
            </div>
        </header>

        <!-- 스크롤 가능한 본문 -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 md:p-8">
            <div class="max-w-7xl mx-auto">
                <?= $content ?? '' ?>
            </div>
        </main>
    </div>

</body>
</html>