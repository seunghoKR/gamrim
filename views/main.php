<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<!-- [A] Hero 섹션 -->
<section class="relative h-[80vh] min-h-[600px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-navy bg-opacity-60 mix-blend-multiply"></div>
        <img src="/assets/images/hero_bg.jpg" alt="감림산기도원 전경" class="w-full h-full object-cover object-center" onerror="this.src='https://images.unsplash.com/photo-1473161962386-302377b2ddb6?auto=format&fit=crop&q=80&w=2000'">
    </div>
    
    <div class="relative z-10 text-center px-4 text-white">
        <p class="text-gold font-semibold mb-4 text-lg md:text-xl">1968년 설립 — 58년 기도의 역사</p>
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">말씀과 기도로 회복되는<br>은혜의 동산</h1>
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
            <a href="/rental" class="bg-gold hover:bg-yellow-600 text-white px-8 py-3 rounded-full font-bold text-lg transition shadow-lg">대관 신청하기</a>
            <a href="/stay" class="bg-white hover:bg-gray-100 text-navy px-8 py-3 rounded-full font-bold text-lg transition shadow-lg">객실 예약하기</a>
        </div>
    </div>

    <!-- PWA Install Banner -->
    <div id="pwa-install-banner" class="hidden absolute top-4 right-4 bg-white text-navy p-4 rounded-lg shadow-xl z-20 max-w-xs">
        <p class="font-bold mb-2 text-sm">홈 화면에 추가하여 편리하게 이용하세요!</p>
        <button id="pwa-install-btn" class="w-full bg-navy text-white py-2 rounded text-sm font-semibold">설치하기</button>
        <button id="pwa-close-btn" class="absolute top-1 right-2 text-gray-400 hover:text-gray-600">×</button>
    </div>
</section>

<!-- [B] 실시간 라이브 배너 -->
<?php if(isset($isLive) && $isLive): ?>
<div class="bg-red-600 text-white py-3 px-4 cursor-pointer hover:bg-red-700 transition" onclick="openYouTubeModal()">
    <div class="container mx-auto flex items-center justify-center">
        <div class="w-3 h-3 bg-white rounded-full live-pulse mr-3"></div>
        <span class="font-bold">지금 감림산TV 실시간 예배 생방송 중</span>
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
</div>
<?php endif; ?>

<!-- [C] 오늘의 말씀 카드 & [D] 빠른예약 독 -->
<section class="py-12 bg-cream">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 -mt-24 relative z-20">
            <!-- 말씀 카드 -->
            <div class="lg:col-span-2 bg-gradient-to-br from-gold to-yellow-600 rounded-2xl shadow-xl p-8 text-white verse-card flex flex-col justify-center">
                <div class="mb-4 font-semibold opacity-80 text-sm tracking-widest">DAILY VERSE</div>
                <h2 class="text-2xl md:text-3xl font-bold leading-relaxed mb-6 font-serif">"여호와는 나의 목자시니<br>내게 부족함이 없으리로다"</h2>
                <p class="text-right text-lg opacity-90 mb-6">- 시편 23:1 -</p>
                <div class="flex gap-3">
                    <button id="kakao-share-verse" class="bg-yellow-400 text-yellow-900 px-4 py-2 rounded-full text-sm font-bold hover:bg-yellow-300 transition flex items-center">
                        카카오톡 공유
                    </button>
                    <button onclick="addToGoogleCalendar('오늘의 말씀 묵상', '감림산기도원')" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-full text-sm font-bold transition flex items-center">
                        구글 캘린더 추가
                    </button>
                </div>
            </div>

            <!-- 빠른 예약 독 -->
            <div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col gap-4">
                <h3 class="text-navy font-bold text-lg border-b pb-2">빠른 예약</h3>
                
                <a href="/rental" class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-navy bg-opacity-10 rounded-full flex items-center justify-center text-navy mr-4 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <div class="font-bold text-gray-800">시설대관 신청</div>
                            <div class="text-xs text-gray-500">대성전, 세미나실 등</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gold transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                <a href="/stay" class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group border border-gray-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gold bg-opacity-10 rounded-full flex items-center justify-center text-gold mr-4 group-hover:scale-110 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        </div>
                        <div>
                            <div class="font-bold text-gray-800">객실 예약하기</div>
                            <div class="text-xs text-gray-500">개인, 가족, 단체 숙소</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gold transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- [G] 매일 예배 시간 안내 -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-navy mb-12">예배 안내</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
            <div class="text-center p-6 bg-cream rounded-xl">
                <div class="text-gold font-bold text-xl mb-2">새벽 예배</div>
                <div class="text-gray-600 font-medium">매일 오전 5:00</div>
            </div>
            <div class="text-center p-6 bg-cream rounded-xl">
                <div class="text-gold font-bold text-xl mb-2">오전 집회</div>
                <div class="text-gray-600 font-medium">매일 오전 10:30</div>
            </div>
            <div class="text-center p-6 bg-cream rounded-xl">
                <div class="text-gold font-bold text-xl mb-2">오후 집회</div>
                <div class="text-gray-600 font-medium">매일 오후 3:00</div>
            </div>
            <div class="text-center p-6 bg-cream rounded-xl">
                <div class="text-gold font-bold text-xl mb-2">저녁 집회</div>
                <div class="text-gray-600 font-medium">매일 저녁 7:30</div>
            </div>
        </div>
        <div class="text-center mt-8 text-gray-500 text-sm">
            <span class="inline-block bg-navy text-white px-3 py-1 rounded-full text-xs mr-2">특별집회</span> 화요구국철야 / 금요철야
        </div>
    </div>
</section>

<!-- [E] 이번 주 집회 일정 -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-navy mb-12">이번 주 집회 일정</h2>
        <div class="max-w-3xl mx-auto space-y-4">
            <?php 
            // Dummy data for example
            $upcomingServices = [
                ['date' => '09.05 (목)', 'time' => '10:30', 'speaker' => '김목사', 'title' => '은혜와 진리'],
                ['date' => '09.06 (금)', 'time' => '19:30', 'speaker' => '이전도사', 'title' => '금요철야예배'],
            ];
            foreach($upcomingServices as $service): 
            ?>
            <div class="bg-white p-6 rounded-xl shadow-sm flex flex-col sm:flex-row justify-between items-center border border-gray-100">
                <div class="flex items-center gap-6 mb-4 sm:mb-0">
                    <div class="text-center w-24">
                        <div class="text-navy font-bold"><?php echo $service['date']; ?></div>
                        <div class="text-gray-500 text-sm"><?php echo $service['time']; ?></div>
                    </div>
                    <div class="h-10 w-px bg-gray-200 hidden sm:block"></div>
                    <div>
                        <div class="text-xl font-bold text-gray-800"><?php echo $service['title']; ?></div>
                        <div class="text-gold text-sm font-medium">강사: <?php echo $service['speaker']; ?></div>
                    </div>
                </div>
                <button onclick="addToGoogleCalendar('<?php echo $service['title']; ?>', '감림산기도원')" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition font-medium">
                    캘린더 등록
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- [H] 시설 소개 갤러리 -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-end mb-10">
            <h2 class="text-3xl font-bold text-navy">시설 안내</h2>
            <a href="/rental" class="text-gold font-medium hover:underline text-sm">대관 안내 보기 →</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Facility Cards -->
            <?php 
            $facilities = [
                ['name' => '대성전', 'cap' => '1,500석', 'desc' => '대규모 연합 집회 및 수련회'],
                ['name' => '벧엘성전', 'cap' => '300석', 'desc' => '중소규모 세미나 및 집회'],
                ['name' => '세미나실', 'cap' => '80석', 'desc' => '소그룹 모임 및 회의'],
                ['name' => '구내식당', 'cap' => '400석', 'desc' => '깨끗하고 정갈한 식사 제공'],
            ];
            foreach($facilities as $index => $fac): 
            ?>
            <div class="group rounded-xl overflow-hidden shadow-md bg-gray-50">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1540397106260-e24a507a088c?w=500&q=80" alt="<?php echo $fac['name']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <span class="text-white text-xs font-bold bg-gold px-2 py-1 rounded"><?php echo $fac['cap']; ?></span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-navy mb-2"><?php echo $fac['name']; ?></h3>
                    <p class="text-sm text-gray-600 mb-4 h-10"><?php echo $fac['desc']; ?></p>
                    <a href="/rental" class="text-sm text-navy font-semibold hover:text-gold transition">대관 신청하기 →</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- [F] 감림산TV 최신 설교 -->
<section class="py-16 bg-navy text-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-10 flex items-center justify-center">
            <svg class="w-8 h-8 text-red-500 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
            감림산TV 최신 설교
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php 
            $latestVideos = [
                ['id' => 'dummy1', 'title' => '믿음의 주요 온전케 하시는 이', 'date' => '2026.09.01'],
                ['id' => 'dummy2', 'title' => '기도 응답의 비결', 'date' => '2026.08.31'],
                ['id' => 'dummy3', 'title' => '성령의 열매를 맺으라', 'date' => '2026.08.30'],
            ];
            foreach($latestVideos as $vid): 
            ?>
            <a href="https://youtube.com/watch?v=<?php echo $vid['id']; ?>" target="_blank" class="block group">
                <div class="relative rounded-lg overflow-hidden mb-3 aspect-video bg-gray-800">
                    <img src="https://images.unsplash.com/photo-1438283173091-5dbf5c5a3206?w=500&q=80" alt="Video thumbnail" class="w-full h-full object-cover group-hover:scale-105 transition duration-300 opacity-80 group-hover:opacity-100">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center bg-opacity-80 group-hover:bg-opacity-100 transition shadow-lg">
                            <svg class="w-5 h-5 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <h4 class="font-medium text-lg mb-1 group-hover:text-gold transition truncate"><?php echo $vid['title']; ?></h4>
                <p class="text-sm text-gray-400"><?php echo $vid['date']; ?></p>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- [I] 셔틀버스 안내 -->
<section class="py-16 bg-cream">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h2 class="text-2xl font-bold text-navy mb-6">오시는 길 / 셔틀버스 안내</h2>
        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 mb-6 flex flex-col md:flex-row items-center justify-between">
            <div class="text-left mb-6 md:mb-0">
                <div class="font-bold text-lg mb-2">양산역 2번 출구 / 노포역 출발</div>
                <p class="text-gray-600 text-sm">집회 시간에 맞추어 셔틀버스를 운행합니다. (직통: 055-374-4111)</p>
            </div>
            <div class="flex gap-4">
                <a href="/guide" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg font-medium transition text-sm">시간표 보기</a>
                <a href="https://map.kakao.com/link/to/감림산기도원,35.437,129.053" target="_blank" class="px-6 py-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-900 rounded-lg font-bold transition text-sm">카카오맵 길찾기</a>
            </div>
        </div>
    </div>
</section>

<!-- [J] YouTube 라이브 팝업 모달 -->
<div id="youtube-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black bg-opacity-80 backdrop-blur-sm" onclick="closeYouTubeModal()"></div>
    <div class="relative bg-black w-full max-w-5xl aspect-video rounded-xl overflow-hidden shadow-2xl z-10 border border-gray-700">
        <button onclick="closeYouTubeModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300 font-bold text-xl">&times; 닫기</button>
        <div id="youtube-player" class="w-full h-full"></div>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
