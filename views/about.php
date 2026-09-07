<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<!-- [A] 소개 히어로 섹션 -->
<section class="relative py-20 bg-navy text-white overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20 mix-blend-overlay">
        <img src="/assets/images/hero_bg.jpg" alt="감림산기도원 전경" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1473161962386-302377b2ddb6?auto=format&fit=crop&q=80&w=2000'">
    </div>
    <div class="relative z-10 container mx-auto px-4 text-center max-w-4xl">
        <div class="inline-flex items-center space-x-2 bg-gold/20 border border-gold/40 text-gold px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold mb-4 backdrop-blur-sm">
            <span>✝ 1968년 8월 17일 설립</span>
            <span class="text-white/60">|</span>
            <span class="text-white">58년 기도의 역사</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold mb-4 tracking-tight">감림산기도원 소개</h1>
        <p class="text-gray-300 text-sm sm:text-lg max-w-2xl mx-auto font-light leading-relaxed">
            황무지에 눈물로 세운 기도의 제단, 365일 쉬지 않는 예배와 기도로 나라와 민족, 한국 교회를 깨우는 은혜의 동산입니다.
        </p>
    </div>
</section>

<!-- [B] 40주년 기념 다큐멘터리 영상 섹션 -->
<section class="py-16 bg-cream border-b border-gray-200/70">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-8">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">History & Documentary</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-navy mt-2 mb-2">58년 기도의 눈물과 역사</h2>
            <p class="text-gray-600 text-xs sm:text-sm">감림산기도원 40주년 기념 다큐멘터리 영상을 통해 은혜의 발자취를 만나보세요.</p>
        </div>

        <div class="relative aspect-video rounded-2xl overflow-hidden shadow-2xl border-4 border-white bg-black">
            <iframe 
                class="w-full h-full"
                src="https://www.youtube-nocookie.com/embed/efgD497OF-E?rel=0" 
                title="감림산기도원 40주년 기념 영상" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
            </iframe>
        </div>
        
        <div class="mt-6 text-center text-xs text-gray-500">
            <span>영상 출처: 감림산기도원 공식 방송사역</span>
            <span class="mx-2">·</span>
            <a href="https://youtu.be/efgD497OF-E" target="_blank" rel="noopener noreferrer" class="text-gold font-semibold hover:underline">유튜브에서 직접 보기 ↗</a>
        </div>
    </div>
</section>

<!-- [C] 감림산기도원은 (설립 배경과 역사) -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-cream/60 rounded-3xl p-8 sm:p-12 border border-gold/20 shadow-sm">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-navy text-gold flex items-center justify-center font-bold text-lg shadow-sm">
                    ✝
                </div>
                <div>
                    <span class="text-gold text-xs font-bold uppercase tracking-wider">Our Heritage</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-navy">감림산기도원은</h2>
                </div>
            </div>

            <div class="space-y-4 text-gray-700 text-sm sm:text-base leading-relaxed">
                <p>
                    <strong class="text-navy font-bold">감림산기도원은 1968년 8월 17일</strong> 성령 하나님께서, 28세의 소녀 <strong class="text-navy font-bold">이옥란 원장</strong>을 감동하셔서 황무지를 개척하라고 말씀하셨고, 이옥란 원장은 성령 하나님의 말씀에 온전히 순종하여 현재의 감림산동산이 시작되었습니다.
                </p>
                <p>
                    아무것도 없던 험준한 산자락에서 오직 무릎 꿇는 기도와 눈물로 제단을 쌓았으며, 결국 하나님께서 이옥란 원장을 통해 이곳에 <strong class="text-gold font-bold">나라와 민족을 위한 뜨거운 기도가 끊이지 않는 감림산기도원</strong>을 친히 세우셨습니다.
                </p>
                <p class="text-gray-600 text-xs sm:text-sm pt-2">
                    반세기를 훌쩍 넘긴 오늘날까지도 매일 하루 4번의 예배와 화요구국철야, 금요철야기도회의 불길이 꺼지지 않고 타오르고 있습니다.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- [D] 원장 인사말씀 (이옥란 원장) -->
<section class="py-16 bg-cream border-t border-b border-gray-200/60">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">Director's Message</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-navy mt-2">원장 인사말씀</h2>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-gray-100 flex flex-col md:flex-row gap-8 items-start">
            <!-- 원장님 사진 & 캡션 -->
            <div class="w-full md:w-56 flex-shrink-0 flex flex-col items-center text-center">
                <div class="w-44 h-56 sm:w-48 sm:h-60 rounded-2xl overflow-hidden shadow-lg border-2 border-gold/40 mb-3 bg-cream">
                    <img src="/assets/images/about/director_okran.png" alt="이옥란 원장" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-bold text-navy">이옥란 원장</h3>
                <p class="text-xs text-gold font-semibold">감림산기도원 설립자 / 원장</p>
            </div>

            <!-- 인사말 본문 -->
            <div class="flex-grow space-y-4 text-gray-700 text-sm sm:text-base leading-relaxed">
                <p class="font-bold text-navy text-lg">
                    “이옥란 원장입니다.”
                </p>
                <p>
                    부족한 저를 부르셔서 이 산을 제단으로 삼아주신 것이 벌써 반세기가 넘어갑니다.
                </p>
                <p>
                    그동안 얼마나 많은 성도님들과 목회자분들께서 이 동산에 올라오셔서 기도의 제단들을 쌓으셨는지 이루 헤아릴 수가 없습니다.
                </p>
                <p>
                    시대가 혼탁해 질수록 기도의 일꾼들을 깨우는 도구가 되고 싶습니다.<br>
                    지역 교회와 함께 시대의 사명을 감당하는 동역자가 되고 싶습니다.<br>
                    또한, 주님이 이 복음 들고 가라고 하시는 그 어느 곳이든 최선을 다해 뛰어가고 싶습니다.
                </p>

                <!-- 3대 사명적 구호 하이라이트 박스 -->
                <div class="my-6 p-6 bg-gradient-to-r from-cream via-amber-50 to-cream rounded-2xl border border-gold/40 text-center shadow-sm">
                    <div class="text-xs font-bold text-gold uppercase tracking-widest mb-2">감림산기도원 3대 사명적 구호</div>
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-3 sm:gap-6 text-navy font-extrabold text-base sm:text-lg">
                        <span class="px-3 py-1.5 bg-white rounded-xl shadow-xs border border-gold/30">“세상을 새롭게”</span>
                        <span class="hidden sm:inline text-gold">·</span>
                        <span class="px-3 py-1.5 bg-white rounded-xl shadow-xs border border-gold/30">“교회를 부흥케”</span>
                        <span class="hidden sm:inline text-gold">·</span>
                        <span class="px-3 py-1.5 bg-white rounded-xl shadow-xs border border-gold/30">“가정을 복되게”</span>
                    </div>
                </div>

                <p>
                    세 개의 사명적 구호를 가지고 주님 오시는 날까지 기도의 동산으로, 선교의 동산으로 끝까지 쓰임 받기를 소원하는 마음 간절합니다.
                </p>
                <div class="pt-4 text-right">
                    <p class="italic text-gray-500 text-sm">그분 오실 그날을 기다리면서</p>
                    <p class="font-bold text-navy text-base mt-1">감림산 골방에서... <span class="text-gold">원장 이옥란</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- [E] 원목 소개 (이은호 목사) -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-12">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">Pastor Leadership</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-navy mt-2">원목 소개</h2>
            <p class="text-gray-600 text-xs sm:text-sm mt-1">복음주의 정통 신학과 깊은 영성으로 다음세대와 교회를 깨우는 사역 리더십입니다.</p>
        </div>

        <div class="bg-cream/50 rounded-3xl p-8 sm:p-12 shadow-lg border border-gray-100 flex flex-col md:flex-row gap-8 items-start">
            <!-- 원목님 사진 & 캡션 -->
            <div class="w-full md:w-56 flex-shrink-0 flex flex-col items-center text-center">
                <div class="w-44 h-56 sm:w-48 sm:h-60 rounded-2xl overflow-hidden shadow-lg border-2 border-navy/20 mb-3 bg-white">
                    <img src="/assets/images/about/pastor_eunho.png" alt="이은호 목사" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-bold text-navy">이은호 목사</h3>
                <p class="text-xs text-gold font-semibold">감림산기도원 원목</p>
                <span class="mt-2 inline-block bg-navy text-white text-[11px] font-bold px-3 py-1 rounded-full">
                    오병이어 캠프 사역원 대표
                </span>
            </div>

            <!-- 경력 및 학력 안내 -->
            <div class="flex-grow space-y-6">
                <!-- 주요 경력 -->
                <div>
                    <div class="inline-flex items-center space-x-2 bg-navy text-white px-3.5 py-1.5 rounded-lg text-xs font-bold mb-3 shadow-xs">
                        <span>경력</span>
                    </div>
                    <ul class="space-y-2 text-xs sm:text-sm text-gray-700 pl-1">
                        <li class="flex items-start">
                            <span class="text-gold font-bold mr-2">✔</span>
                            <span><strong>현, 감림산기도원 원목</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-gold font-bold mr-2">✔</span>
                            <span><strong>현, 오병이어 캠프 사역원 대표</strong></span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-gold font-bold mr-2">✔</span>
                            <span><strong>현, 감림산교회 담임목사</strong></span>
                        </li>
                        <li class="flex items-start text-gray-500">
                            <span class="text-gray-400 mr-2">•</span>
                            <span>남서울비전교회 부목</span>
                        </li>
                        <li class="flex items-start text-gray-500">
                            <span class="text-gray-400 mr-2">•</span>
                            <span>워싱턴 은혜장로교회 부목</span>
                        </li>
                    </ul>
                </div>

                <!-- 주요 학력 -->
                <div class="border-t border-gray-200/70 pt-5">
                    <div class="inline-flex items-center space-x-2 bg-navy text-white px-3.5 py-1.5 rounded-lg text-xs font-bold mb-3 shadow-xs">
                        <span>학력</span>
                    </div>
                    <ul class="space-y-2 text-xs sm:text-sm text-gray-700 pl-1">
                        <li class="flex items-start">
                            <span class="text-navy font-bold mr-2">•</span>
                            <span>대전침례신학대학교 신학과</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-navy font-bold mr-2">•</span>
                            <span>칼빈 신대원 (M.Div)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-navy font-bold mr-2">•</span>
                            <span>총신 신대원 (M.Div)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-navy font-bold mr-2">•</span>
                            <span>미국, 리버티 대학교 교육학 (M.R.E.)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-navy font-bold mr-2">•</span>
                            <span>미국, 리버티 대학교 대학원 크리스천 리더십 (M.A.R. in Christian Leadership)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-gold font-bold mr-2">★</span>
                            <span><strong>미국, 리버티 대학교 대학원 목회학박사 (D.Min) 졸업</strong></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- [F] 감림산의 3대 핵심 사역 -->
<section class="py-16 bg-cream">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-12">
            <span class="text-gold font-bold text-xs uppercase tracking-widest bg-gold/10 px-3 py-1 rounded-full">Three Pillars of Ministry</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-navy mt-2 mb-2">기도와 선교, 치유의 사역</h2>
            <p class="text-gray-600 text-xs sm:text-sm">감림산기도원이 쉬지 않고 달려가는 세 가지 핵심 사역 방향입니다.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- 1. 기도와 예배 -->
            <div class="bg-white p-7 rounded-2xl shadow-md border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-navy/10 text-navy flex items-center justify-center font-bold text-xl mb-4">
                        ✝
                    </div>
                    <div class="text-gold text-xs font-bold mb-1">화요구국철야 | 금요철야 | 연중 365일</div>
                    <h3 class="text-xl font-bold text-navy mb-3">기도와 예배</h3>
                    <p class="text-gray-600 text-xs leading-relaxed mb-4">
                        매주 화요일 나라와 민족을 살리는 구국철야기도회, 매주 금요일 지역 교회와 함께하는 금요철야기도회, 그리고 1년 52주 365일 쉬지 않는 예배가 매일 이어집니다.
                    </p>
                </div>
                <a href="/#worship" class="text-xs font-bold text-navy hover:text-gold transition flex items-center">
                    예배 시간표 확인하기 →
                </a>
            </div>

            <!-- 2. 국내/해외/다음세대선교 -->
            <div class="bg-white p-7 rounded-2xl shadow-md border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-gold/15 text-gold flex items-center justify-center font-bold text-xl mb-4">
                        🌍
                    </div>
                    <div class="text-gold text-xs font-bold mb-1">사랑의불꽃 | 하얀사랑 | 오병이어</div>
                    <h3 class="text-xl font-bold text-navy mb-3">국내·해외·다음세대 선교</h3>
                    <p class="text-gray-600 text-xs leading-relaxed mb-4">
                        하얀사랑선교회와 사랑의 불꽃 잔치 선교회를 통해 뜨거운 영성 훈련을 진행하며, 오병이어 캠프 사역원을 통해 다음세대(어린이, 청소년, 청년)의 건강한 신앙을 세워갑니다.
                    </p>
                </div>
                <a href="https://5025camp.kr/" target="_blank" class="text-xs font-bold text-navy hover:text-gold transition flex items-center">
                    오병이어 캠프 바로가기 ↗
                </a>
            </div>

            <!-- 3. 언제든 오세요 -->
            <div class="bg-white p-7 rounded-2xl shadow-md border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-green-50 text-green-700 flex items-center justify-center font-bold text-xl mb-4">
                        🌿
                    </div>
                    <div class="text-gold text-xs font-bold mb-1">하나님과의 깊은 교제</div>
                    <h3 class="text-xl font-bold text-navy mb-3">언제든 오세요</h3>
                    <p class="text-gray-600 text-xs leading-relaxed mb-4">
                        사시사철 아름답고 신선한 자연과 함께 조용한 산중턱에 자리 잡고 있습니다. 언제든지 오셔서 영적 재충전을 누리시고 응답, 회복, 그리고 치유함을 받으시기 바랍니다.
                    </p>
                </div>
                <a href="/guide" class="text-xs font-bold text-navy hover:text-gold transition flex items-center">
                    오시는 길 안내 보기 →
                </a>
            </div>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
