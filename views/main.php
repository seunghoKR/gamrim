<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<!-- ========================================================
     [Tier 1 / ★★★★] Hero 섹션: 기도하는 동산, 연중 쉬지 않는 예배
======================================================== -->
<section class="relative h-[85vh] min-h-[620px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-navy/70 mix-blend-multiply"></div>
        <img src="/assets/images/hero_bg.jpg" alt="감림산기도원 전경" class="w-full h-full object-cover object-center" onerror="this.src='https://images.unsplash.com/photo-1473161962386-302377b2ddb6?auto=format&fit=crop&q=80&w=2000'">
    </div>
    
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto text-white">
        <!-- 헤리티지 뱃지 -->
        <div class="inline-flex items-center space-x-2 bg-gold/20 border border-gold/40 text-gold px-4 py-1.5 rounded-full text-xs md:text-sm font-semibold mb-6 backdrop-blur-sm shadow-sm">
            <span>✝ 1968년 설립 — 58년 기도의 역사</span>
            <span class="text-white/60">|</span>
            <span class="text-white">연중 쉬지 않는 예배</span>
        </div>
        
        <!-- 메인 헤드라인 -->
        <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold mb-5 leading-tight tracking-tight drop-shadow-md">
            기도하는 동산,<br class="sm:hidden"> <span class="text-gold">감림산기도원</span>
        </h1>
        
        <p class="text-base sm:text-xl text-gray-200 mb-8 max-w-2xl mx-auto font-light leading-relaxed">
            365일 기도의 불이 꺼지지 않는 곳,<br class="hidden sm:inline">
            말씀과 기도로 지친 영혼이 회복되고 새 힘을 얻는 은혜의 처소입니다.
        </p>

        <!-- CTA 버튼 (영성 & 예배 중심) -->
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3.5 mb-6">
            <a href="#worship" class="w-full sm:w-auto inline-flex items-center justify-center bg-gold hover:bg-yellow-600 text-white px-8 py-3.5 rounded-full font-bold text-base transition shadow-xl hover:shadow-2xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                연중 예배·집회 안내
            </a>
            <a href="/prayer" class="w-full sm:w-auto inline-flex items-center justify-center bg-white/15 hover:bg-white/25 text-white border border-white/40 px-8 py-3.5 rounded-full font-bold text-base transition backdrop-blur-sm shadow-md">
                <svg class="w-5 h-5 mr-2 text-pink-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                중보기도 요청하기
            </a>
        </div>

        <!-- 서브 링크: 대관 및 숙소 사역 바로가기 -->
        <div class="text-xs sm:text-sm text-gray-300 flex items-center justify-center space-x-4">
            <span>교회·기관 행사 대관 및 개인·가족 쉼터 숙소 예약</span>
            <a href="#ministry-spaces" class="text-gold font-semibold underline hover:text-yellow-300 transition">자세히 보기 ↓</a>
        </div>
    </div>

    <!-- PWA Install Banner -->
    <div id="pwa-install-banner" class="hidden absolute top-4 right-4 bg-white text-navy p-4 rounded-lg shadow-xl z-20 max-w-xs">
        <p class="font-bold mb-2 text-sm">홈 화면에 추가하여 편리하게 이용하세요!</p>
        <button id="pwa-install-btn" class="w-full bg-navy text-white py-2 rounded text-sm font-semibold">설치하기</button>
        <button id="pwa-close-btn" class="absolute top-1 right-2 text-gray-400 hover:text-gray-600">×</button>
    </div>
</section>

<!-- 실시간 라이브 배너 -->
<?php if(isset($isLive) && $isLive): ?>
<div class="bg-red-600 text-white py-3 px-4 cursor-pointer hover:bg-red-700 transition" onclick="openYouTubeModal()">
    <div class="container mx-auto flex items-center justify-center">
        <div class="w-3 h-3 bg-white rounded-full live-pulse mr-3"></div>
        <span class="font-bold text-sm sm:text-base">지금 감림산TV 실시간 예배 생방송 중입니다</span>
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
</div>
<?php endif; ?>

<!-- ========================================================
     [Tier 1 / ★★★★] 오늘의 말씀 카드 & 영성 퀵 네비게이션
======================================================== -->
<section class="py-12 bg-cream">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 -mt-24 relative z-20">
            <!-- 오늘의 말씀 카드 -->
            <div class="lg:col-span-2 bg-gradient-to-br from-gold to-yellow-600 rounded-2xl shadow-xl p-8 text-white verse-card flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-semibold opacity-90 text-xs tracking-widest bg-black/20 px-3 py-1 rounded-full">DAILY SCRIPTURE</span>
                        <span class="text-xs opacity-80">감림산 오늘의 말씀</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold leading-relaxed mb-4 font-serif">"여호와는 나의 목자시니<br>내게 부족함이 없으리로다"</h2>
                    <p class="text-right text-base opacity-90 font-medium mb-6">- 시편 23:1 -</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button id="kakao-share-verse" class="bg-yellow-400 text-yellow-950 px-4 py-2 rounded-full text-xs sm:text-sm font-bold hover:bg-yellow-300 transition flex items-center shadow">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3c-4.97 0-9 3.185-9 7.115 0 2.557 1.708 4.8 4.27 6.054l-.865 3.18c-.078.286.195.534.453.411l3.755-1.782c.45.064.914.102 1.387.102 4.97 0 9-3.185 9-7.115S16.97 3 12 3z"/></svg>
                        말씀 카카오톡 공유
                    </button>
                    <button onclick="addToGoogleCalendar('오늘의 말씀 묵상', '감림산기도원')" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-full text-xs sm:text-sm font-bold transition flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        캘린더 묵상 추가
                    </button>
                </div>
            </div>

            <!-- 은혜의 동산 바로가기 독 -->
            <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col justify-between border border-gray-100">
                <div>
                    <h3 class="text-navy font-bold text-lg border-b pb-2.5 mb-3 flex items-center">
                        <span class="text-gold mr-1.5">✝</span> 은혜의 동산 둘러보기
                    </h3>
                    
                    <div class="space-y-2.5">
                        <a href="#about" class="flex items-center justify-between p-3 bg-cream/60 rounded-xl hover:bg-cream transition group">
                            <div class="flex items-center">
                                <div class="w-9 h-9 bg-navy/10 rounded-lg flex items-center justify-center text-navy font-bold mr-3 group-hover:scale-105 transition">
                                    소개
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-800">기도원 소개 & 40주년 영상</div>
                                    <div class="text-[11px] text-gray-500">58년 기도의 역사 · 원장 인사말씀 · 원목 소개</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gold transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>

                        <a href="#worship" class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition group border border-gray-100">
                            <div class="flex items-center">
                                <div class="w-9 h-9 bg-gold/15 rounded-lg flex items-center justify-center text-gold font-bold mr-3 group-hover:scale-105 transition">
                                    예배
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-800">연중 무휴 4부 예배</div>
                                    <div class="text-[11px] text-gray-500">새벽 5:00 / 오전 10:30 / 오후 3:00 / 저녁 7:30</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gold transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>

                        <a href="/prayer" class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition group border border-gray-100">
                            <div class="flex items-center">
                                <div class="w-9 h-9 bg-pink-100 rounded-lg flex items-center justify-center text-pink-600 font-bold mr-3 group-hover:scale-105 transition">
                                    기도
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-800">중보기도 신청함</div>
                                    <div class="text-[11px] text-gray-500">간절한 기도 제목을 원장님과 함께 기도합니다</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gold transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>

                        <a href="#ministry-spaces" class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition group border border-gray-100">
                            <div class="flex items-center">
                                <div class="w-9 h-9 bg-navy/10 rounded-lg flex items-center justify-center text-navy font-bold mr-3 group-hover:scale-105 transition">
                                    사역
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-800">교회 대관 & 숙소 예약</div>
                                    <div class="text-[11px] text-gray-500">교회 행사 지원 및 개인·가족 쉼터</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gold transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     [Tier 1 / ★★★★] 감림산기도원 소개 & 40주년 기념 다큐 영상 & 원장/원목
======================================================== -->
<section id="about" class="py-16 bg-white scroll-mt-20 border-b border-gray-100">
    <div class="container mx-auto px-4 max-w-5xl">
        <!-- 섹션 헤더 -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">58 Years of Prayer Heritage</span>
            <h2 class="text-3xl font-extrabold text-navy mt-3 mb-3">감림산기도원 소개</h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                1968년 8월 17일, 성령 하나님의 감동으로 28세의 소녀 이옥란 원장이 황무지를 눈물로 개척하며 시작된 58년 기도의 역사입니다.
            </p>
        </div>

        <!-- 40주년 기념 다큐 영상 임베드 -->
        <div class="mb-14">
            <div class="bg-navy rounded-3xl p-4 sm:p-6 shadow-xl border border-gold/30">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 text-white">
                    <div class="flex items-center space-x-2 mb-2 sm:mb-0">
                        <span class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
                        <span class="font-bold text-sm sm:text-base">감림산기도원 40주년 기념 다큐멘터리 영상</span>
                    </div>
                    <a href="https://youtu.be/efgD497OF-E" target="_blank" rel="noopener noreferrer" class="text-gold text-xs hover:underline flex items-center">
                        유튜브에서 크게 보기 ↗
                    </a>
                </div>
                <div class="relative aspect-video rounded-2xl overflow-hidden bg-black shadow-inner">
                    <iframe 
                        class="w-full h-full"
                        src="https://www.youtube-nocookie.com/embed/efgD497OF-E?rel=0" 
                        title="감림산기도원 40주년 기념 다큐멘터리" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
                <p class="text-gray-300 text-xs text-center mt-3 font-light">
                    “부족한 저를 부르셔서 이 산을 제단으로 삼아주신 하나님의 크신 은혜를 증거합니다.”
                </p>
            </div>
        </div>

        <!-- 이옥란 원장 & 이은호 원목 소개 2단 카드 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- 1. 원장 인사말씀 카드 -->
            <div class="bg-cream/50 rounded-3xl p-6 sm:p-8 border border-gold/30 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-4 mb-5">
                        <div class="w-20 h-24 sm:w-24 sm:h-28 rounded-2xl overflow-hidden shadow-md border-2 border-gold/50 flex-shrink-0 bg-white">
                            <img src="/assets/images/about/director_okran.png" alt="이옥란 원장" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="text-gold text-xs font-bold uppercase tracking-wider">Director Message</span>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-navy">이옥란 원장</h3>
                            <p class="text-xs text-gray-500 mt-0.5">감림산기도원 설립자 / 원장</p>
                        </div>
                    </div>

                    <blockquote class="text-gray-700 text-xs sm:text-sm leading-relaxed mb-5 font-light space-y-2">
                        <p class="font-medium text-navy">“부족한 저를 부르셔서 이 산을 제단으로 삼아주신 것이 벌써 반세기가 넘어갑니다.”</p>
                        <p>시대가 혼탁해질수록 기도의 일꾼들을 깨우고, 지역 교회와 함께 시대의 사명을 감당하는 겸손한 동역자가 되고 싶습니다.</p>
                    </blockquote>

                    <!-- 3대 사명 구호 -->
                    <div class="bg-white rounded-2xl p-4 border border-gold/30 mb-4 shadow-xs">
                        <div class="text-[11px] font-bold text-gold uppercase tracking-wider text-center mb-2">3대 사명적 구호</div>
                        <div class="flex justify-around text-center text-xs font-extrabold text-navy">
                            <span class="bg-cream px-2 py-1 rounded-lg">“세상을 새롭게”</span>
                            <span class="bg-cream px-2 py-1 rounded-lg">“교회를 부흥케”</span>
                            <span class="bg-cream px-2 py-1 rounded-lg">“가정을 복되게”</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-2 border-t border-gold/20">
                    <span class="text-xs text-gray-400 italic">감림산 골방에서...</span>
                    <a href="/about" class="text-xs font-bold text-navy hover:text-gold transition flex items-center">
                        원장 인사말씀 전문 보기 →
                    </a>
                </div>
            </div>

            <!-- 2. 원목 소개 카드 -->
            <div class="bg-cream/50 rounded-3xl p-6 sm:p-8 border border-navy/20 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-4 mb-5">
                        <div class="w-20 h-24 sm:w-24 sm:h-28 rounded-2xl overflow-hidden shadow-md border-2 border-navy/30 flex-shrink-0 bg-white">
                            <img src="/assets/images/about/pastor_eunho.png" alt="이은호 목사" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="text-navy text-xs font-bold uppercase tracking-wider">Pastor Leadership</span>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-navy">이은호 목사</h3>
                            <p class="text-xs text-gold font-semibold mt-0.5">감림산기도원 원목 · 오병이어 캠프 대표</p>
                        </div>
                    </div>

                    <div class="space-y-2.5 text-xs sm:text-sm text-gray-700 mb-5">
                        <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-xs">
                            <span class="text-gold font-bold mr-1">사역</span>
                            <span class="font-medium">현 감림산기도원 원목 / 현 오병이어 캠프 사역원 대표 / 현 감림산교회 담임목사</span>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-xs">
                            <span class="text-navy font-bold mr-1">학력</span>
                            <span class="text-gray-600">총신 신대원(M.Div), 칼빈 신대원(M.Div), 美 리버티 대학교 목회학박사(D.Min)</span>
                        </div>
                        <p class="text-gray-500 text-xs leading-relaxed pt-1">
                            복음주의 정통 신학과 뜨거운 영성으로 한국 교회의 미래인 다음세대를 세우고 있습니다.
                        </p>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-2 border-t border-navy/10">
                    <span class="text-xs text-gray-400">다음세대 영성 훈련</span>
                    <a href="/about" class="text-xs font-bold text-navy hover:text-gold transition flex items-center">
                        원목 약력 자세히 보기 →
                    </a>
                </div>
            </div>
        </div>

        <!-- 3대 핵심 사역 요약 배너 -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
            <div class="p-4 bg-cream/70 rounded-2xl border border-gold/20">
                <div class="text-gold font-bold text-xs mb-1">✝ 365일 쉬지 않는 예배</div>
                <div class="text-navy font-bold text-sm">화요구국철야 & 금요철야</div>
            </div>
            <div class="p-4 bg-cream/70 rounded-2xl border border-gold/20">
                <div class="text-gold font-bold text-xs mb-1">🌍 선교 & 다음세대 부흥</div>
                <div class="text-navy font-bold text-sm">하얀사랑선교회 & 오병이어캠프</div>
            </div>
            <div class="p-4 bg-cream/70 rounded-2xl border border-gold/20">
                <div class="text-gold font-bold text-xs mb-1">🌿 하나님과의 깊은 교제</div>
                <div class="text-navy font-bold text-sm">자연 속 기도와 치유의 쉼터</div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     [Tier 1 / ★★★★] 연중 쉬지 않는 예배 안내 & 이번 주 집회 일정
======================================================== -->
<section id="worship" class="py-16 bg-white scroll-mt-20">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">Continuous Prayer & Worship</span>
            <h2 class="text-3xl font-extrabold text-navy mt-3 mb-3">연중 쉬지 않는 예배</h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                감림산기도원은 365일 하루도 쉬지 않고 매일 4번의 예배를 드립니다.<br>
                언제든 찾아오셔서 마음껏 찬양하고 부르짖어 기도하십시오.
            </p>
        </div>

        <!-- 4대 정기 예배 카드 그리드 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
            <div class="p-6 bg-cream rounded-2xl border border-gold/20 shadow-sm hover:shadow-md transition text-center group">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-navy/5 text-navy flex items-center justify-center font-bold text-lg group-hover:bg-gold group-hover:text-white transition">
                    1부
                </div>
                <div class="text-gold font-bold text-lg mb-1">새벽 예배</div>
                <div class="text-navy font-extrabold text-xl mb-2">오전 5:00</div>
                <p class="text-gray-500 text-xs leading-relaxed">하루의 첫 시간을 온전히 하나님께 드리는 첫 열매의 기도</p>
            </div>

            <div class="p-6 bg-cream rounded-2xl border border-gold/20 shadow-sm hover:shadow-md transition text-center group">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-navy/5 text-navy flex items-center justify-center font-bold text-lg group-hover:bg-gold group-hover:text-white transition">
                    2부
                </div>
                <div class="text-gold font-bold text-lg mb-1">오전 집회</div>
                <div class="text-navy font-extrabold text-xl mb-2">오전 10:30</div>
                <p class="text-gray-500 text-xs leading-relaxed">성령의 기름 부으심과 깊은 말씀의 깨달음이 있는 은혜의 시간</p>
            </div>

            <div class="p-6 bg-cream rounded-2xl border border-gold/20 shadow-sm hover:shadow-md transition text-center group">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-navy/5 text-navy flex items-center justify-center font-bold text-lg group-hover:bg-gold group-hover:text-white transition">
                    3부
                </div>
                <div class="text-gold font-bold text-lg mb-1">오후 집회</div>
                <div class="text-navy font-extrabold text-xl mb-2">오후 3:00</div>
                <p class="text-gray-500 text-xs leading-relaxed">말씀 묵상과 치유, 성도들의 영적 회복을 위한 간절한 기도</p>
            </div>

            <div class="p-6 bg-cream rounded-2xl border border-gold/20 shadow-sm hover:shadow-md transition text-center group">
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-navy/5 text-navy flex items-center justify-center font-bold text-lg group-hover:bg-gold group-hover:text-white transition">
                    4부
                </div>
                <div class="text-gold font-bold text-lg mb-1">저녁 집회</div>
                <div class="text-navy font-extrabold text-xl mb-2">저녁 7:30</div>
                <p class="text-gray-500 text-xs leading-relaxed">가슴을 찢는 회개와 부르짖음, 밤을 지새우는 뜨거운 성령의 불길</p>
            </div>
        </div>

        <!-- 특별 집회 안내 띠배너 -->
        <div class="bg-navy text-white p-4 rounded-xl flex flex-col sm:flex-row items-center justify-between shadow-md mb-12">
            <div class="flex items-center space-x-3 mb-3 sm:mb-0">
                <span class="bg-gold text-navy text-xs font-black px-2.5 py-1 rounded">정기 특별집회</span>
                <span class="font-bold text-sm">화요구국철야기도회 & 매주 금요철야예배</span>
            </div>
            <div class="text-xs text-gray-300">
                나라와 민족, 한국 교회의 부흥을 위해 함께 깨어 기도합니다.
            </div>
        </div>

        <!-- 이번 주 집회 스케줄 -->
        <div class="bg-gray-50 rounded-2xl p-6 sm:p-8 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-navy">이번 주 강사 및 집회 일정</h3>
                    <p class="text-xs text-gray-500 mt-1">성령 충만한 강사님들의 말씀 집회가 준비되어 있습니다.</p>
                </div>
            </div>

            <div class="space-y-3">
                <?php 
                $upcomingServices = [
                    ['date' => '09.05 (목)', 'time' => '10:30', 'speaker' => '김목사', 'title' => '은혜와 진리로 충만한 삶'],
                    ['date' => '09.06 (금)', 'time' => '19:30', 'speaker' => '이전도사', 'title' => '부르짖어 기도하라 (금요철야예배)'],
                    ['date' => '09.07 (토)', 'time' => '10:30', 'speaker' => '박원장', 'title' => '기도의 능력과 영적 돌파'],
                ];
                foreach($upcomingServices as $service): 
                ?>
                <div class="bg-white p-5 rounded-xl shadow-sm flex flex-col sm:flex-row justify-between items-center border border-gray-100 hover:border-gold/50 transition">
                    <div class="flex items-center gap-5 mb-3 sm:mb-0 w-full sm:w-auto">
                        <div class="text-center w-20 bg-cream/70 py-2 rounded-lg flex-shrink-0">
                            <div class="text-navy font-bold text-sm"><?php echo $service['date']; ?></div>
                            <div class="text-gold text-xs font-semibold"><?php echo $service['time']; ?></div>
                        </div>
                        <div>
                            <div class="text-base font-bold text-gray-800"><?php echo $service['title']; ?></div>
                            <div class="text-xs text-gray-500 font-medium mt-0.5">강사: <span class="text-navy font-semibold"><?php echo $service['speaker']; ?></span></div>
                        </div>
                    </div>
                    <button onclick="addToGoogleCalendar('<?php echo $service['title']; ?>', '감림산기도원')" class="text-xs bg-gray-100 hover:bg-gold hover:text-white text-gray-700 px-4 py-2 rounded-lg transition font-medium w-full sm:w-auto text-center">
                        캘린더 알림 등록
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     [Tier 1 / ★★★★] 감림산TV 최신 설교 영상
======================================================== -->
<section class="py-16 bg-navy text-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-10">
            <div>
                <span class="text-gold font-bold text-xs uppercase tracking-widest">Video Ministry</span>
                <h2 class="text-2xl sm:text-3xl font-bold flex items-center mt-1">
                    <svg class="w-7 h-7 text-red-500 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    감림산TV 최신 설교 & 예배 실황
                </h2>
            </div>
            <a href="https://www.youtube.com/@gamrimsan" target="_blank" class="mt-3 sm:mt-0 text-gold text-xs hover:underline flex items-center font-medium">
                감림산TV 채널 바로가기 →
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php 
            $latestVideos = [
                ['id' => 'dummy1', 'title' => '믿음의 주요 온전케 하시는 이', 'date' => '2026.09.01', 'desc' => '히브리서 12:2 강해'],
                ['id' => 'dummy2', 'title' => '기도 응답의 비결과 영적 돌파', 'date' => '2026.08.31', 'desc' => '마가복음 9:29 말씀'],
                ['id' => 'dummy3', 'title' => '성령의 열매를 맺는 삶', 'date' => '2026.08.30', 'desc' => '갈라디아서 5:22-23'],
            ];
            foreach($latestVideos as $vid): 
            ?>
            <a href="https://youtube.com/watch?v=<?php echo $vid['id']; ?>" target="_blank" class="block group bg-navy-800 rounded-xl overflow-hidden border border-gray-700/60 hover:border-gold transition">
                <div class="relative aspect-video bg-gray-800">
                    <img src="https://images.unsplash.com/photo-1438283173091-5dbf5c5a3206?w=500&q=80" alt="Video thumbnail" class="w-full h-full object-cover group-hover:scale-105 transition duration-300 opacity-80 group-hover:opacity-100">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-11 h-11 bg-red-600 rounded-full flex items-center justify-center bg-opacity-80 group-hover:bg-opacity-100 transition shadow-lg">
                            <svg class="w-4 h-4 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h4 class="font-bold text-sm mb-1 group-hover:text-gold transition truncate"><?php echo $vid['title']; ?></h4>
                    <p class="text-xs text-gray-400 mb-1"><?php echo $vid['desc']; ?></p>
                    <span class="text-[11px] text-gray-500"><?php echo $vid['date']; ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========================================================
     [Tier 2 / ★★★] 핵심 사역: 교회·기관 대관 및 개인·가족 숙소 섬김
======================================================== -->
<section id="ministry-spaces" class="py-16 bg-cream scroll-mt-20">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">Ministry Spaces</span>
            <h2 class="text-3xl font-extrabold text-navy mt-3 mb-3">거룩한 모임과 참된 안식을 위한 은혜의 공간</h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                단순한 대여나 숙박을 넘어, 한국 교회와 성도님들의 영적 회복과 거룩한 성회를 정성껏 지원하고 섬깁니다.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- 1. 교회 및 기관 행사 대관 카드 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 flex flex-col justify-between group">
                <div>
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1540397106260-e24a507a088c?w=800&q=80" alt="대성전 전경" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-6">
                            <span class="text-gold text-xs font-bold uppercase tracking-wider mb-1">Church & Organization Rental</span>
                            <h3 class="text-white text-xl font-bold">교회와 기관들의 소중한 행사를 지원하는 대관 예약</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-4">
                            한국 교회의 연합성회, 청소년·청년 수련회, 직분자 세미나 등 소중한 은혜의 집회가 차질 없이 진행될 수 있도록 최적의 시설과 음향, 기도로 함께 섬깁니다.
                        </p>
                        <div class="grid grid-cols-2 gap-2 text-xs text-navy font-semibold mb-6">
                            <div class="p-2.5 bg-cream rounded-lg">🏛️ 대성전 (1,500석)</div>
                            <div class="p-2.5 bg-cream rounded-lg">🕊️ 벧엘성전 (300석)</div>
                            <div class="p-2.5 bg-cream rounded-lg">📖 세미나실 (80석)</div>
                            <div class="p-2.5 bg-cream rounded-lg">🍚 구내식당 (400석)</div>
                        </div>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <a href="/rental" class="w-full inline-flex items-center justify-center bg-navy hover:bg-navy-800 text-white py-3 rounded-xl font-bold text-sm transition shadow">
                        대관 시설 안내 및 예약 신청하기 →
                    </a>
                </div>
            </div>

            <!-- 2. 개인 및 가족 숙소 예약 카드 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 flex flex-col justify-between group">
                <div>
                    <div class="h-56 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80" alt="숙소 전경" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-6">
                            <span class="text-gold text-xs font-bold uppercase tracking-wider mb-1">Rest & Prayer Stay</span>
                            <h3 class="text-white text-xl font-bold">개인과 가족의 행복을 위한 숙소 예약</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-4">
                            세상의 분주함에서 벗어나 오롯이 말씀과 기도에 전념할 수 있는 안식처입니다. 목회자, 성도, 가정이 영육 간의 쉼과 참된 회복을 누릴 수 있습니다.
                        </p>
                        <div class="grid grid-cols-2 gap-2 text-xs text-navy font-semibold mb-6">
                            <div class="p-2.5 bg-cream rounded-lg">🛌 쾌적한 침대실</div>
                            <div class="p-2.5 bg-cream rounded-lg">🪵 따뜻한 온돌실</div>
                            <div class="p-2.5 bg-cream rounded-lg">👨‍👩‍👧‍👦 화목한 가족실</div>
                            <div class="p-2.5 bg-cream rounded-lg">🌿 조용한 개인 묵상실</div>
                        </div>
                    </div>
                </div>
                <div class="px-6 pb-6">
                    <a href="/stay" class="w-full inline-flex items-center justify-center bg-gold hover:bg-yellow-600 text-white py-3 rounded-xl font-bold text-sm transition shadow">
                        숙소 객실 둘러보기 및 예약 신청하기 →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     [Tier 3 / ★★] 동역 및 관련기관 네트워크 (오병이어 캠프 & 혜성원)
======================================================== -->
<section id="partners" class="py-16 bg-white scroll-mt-20 border-t border-gray-100">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">Partner Network</span>
            <h2 class="text-3xl font-extrabold text-navy mt-3 mb-3">동역 및 관련기관</h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                감림산기도원의 영성은 다음 세대의 부흥과 이웃을 향한 그리스도의 사랑 실천으로 이어집니다.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- 1. 오병이어 캠프 -->
            <div class="p-6 sm:p-8 bg-cream/60 rounded-2xl border border-gold/30 flex flex-col justify-between hover:shadow-lg transition">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-gold text-white text-xs font-bold px-3 py-1 rounded-full">다음세대 영성 수련</span>
                        <span class="text-xs text-gray-400 font-mono">5025camp.kr</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-navy mb-2">오병이어 캠프</h3>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-6">
                        한국 교회의 미래인 어린이, 청소년, 청년들을 말씀과 뜨거운 찬양, 기도로 깨우는 전국 초교파 영성수련 캠프입니다. 믿음의 다음세대를 강한 군사로 세워갑니다.
                    </p>
                </div>
                <div>
                    <a href="https://5025camp.kr/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-full bg-white hover:bg-gold hover:text-white text-navy border border-gold/40 py-3 rounded-xl font-bold text-xs sm:text-sm transition shadow-sm">
                        <span>오병이어 캠프 공식 홈페이지 바로가기</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>

            <!-- 2. 사회복지법인 혜성원 (로뎀요양원) -->
            <div class="p-6 sm:p-8 bg-cream/60 rounded-2xl border border-gold/30 flex flex-col justify-between hover:shadow-lg transition">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-navy text-white text-xs font-bold px-3 py-1 rounded-full">그리스도의 사랑과 섬김</span>
                        <span class="text-xs text-gray-400 font-mono">로뎀요양i.com</span>
                    </div>
                    <h3 class="text-2xl font-extrabold text-navy mb-2">사회복지법인 혜성원</h3>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-6">
                        연로하신 어르신들을 그리스도의 긍휼과 사랑으로 정성껏 모시는 전문 노인 복지 사역(로뎀요양원)입니다. 믿음 안에서 평안하고 은혜로운 노후를 누리시도록 섬깁니다.
                    </p>
                </div>
                <div>
                    <a href="http://로뎀요양i.com/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-full bg-white hover:bg-navy hover:text-white text-navy border border-navy/30 py-3 rounded-xl font-bold text-xs sm:text-sm transition shadow-sm">
                        <span>사회복지법인 혜성원 (로뎀요양원) 바로가기</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     [Tier 4 / ★] 길안내 & 시설 소개
======================================================== -->
<section class="py-16 bg-cream">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">Location & Guide</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-navy mt-2">은혜의 동산 오시는 길</h2>
            <p class="text-gray-600 text-xs sm:text-sm mt-1">평안한 발걸음이 되시도록 친절하게 안내해 드립니다.</p>
        </div>

        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-md border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-left">
                <div class="inline-block bg-gold/20 text-navy font-bold text-xs px-2.5 py-1 rounded mb-2">대중교통 & 셔틀</div>
                <div class="font-bold text-lg text-gray-800 mb-1">양산역 2번 출구 / 노포역 출발</div>
                <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-2">
                    주요 집회 시간에 맞추어 셔틀버스를 운행하오니 방문 전 확인해 주시기 바랍니다.
                </p>
                <div class="text-xs text-navy font-bold flex items-center">
                    <svg class="w-4 h-4 text-gold mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    기도원 직통 문의: <a href="tel:055-374-4111" class="ml-1 underline hover:text-gold">055-374-4111</a>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <a href="/guide" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-xl font-semibold transition text-xs sm:text-sm text-center">
                    상세 길안내 보기
                </a>
                <a href="https://map.kakao.com/link/to/감림산기도원,35.437,129.053" target="_blank" class="px-5 py-2.5 bg-yellow-400 hover:bg-yellow-500 text-yellow-950 rounded-xl font-bold transition text-xs sm:text-sm text-center flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3c-4.97 0-9 3.185-9 7.115 0 2.557 1.708 4.8 4.27 6.054l-.865 3.18c-.078.286.195.534.453.411l3.755-1.782c.45.064.914.102 1.387.102 4.97 0 9-3.185 9-7.115S16.97 3 12 3z"/></svg>
                    카카오맵 길찾기
                </a>
            </div>
        </div>
    </div>
</section>

<!-- YouTube 라이브 팝업 모달 -->
<div id="youtube-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black bg-opacity-80 backdrop-blur-sm" onclick="closeYouTubeModal()"></div>
    <div class="relative bg-black w-full max-w-5xl aspect-video rounded-xl overflow-hidden shadow-2xl z-10 border border-gray-700">
        <button onclick="closeYouTubeModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300 font-bold text-xl">&times; 닫기</button>
        <div id="youtube-player" class="w-full h-full"></div>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
