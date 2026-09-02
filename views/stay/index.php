<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- 상단 검색 영역 -->
<div class="bg-navy py-12 relative">
    <div class="container mx-auto px-4 max-w-5xl">
        <h1 class="text-3xl font-bold text-white mb-8 text-center">숙소 예약</h1>
        
        <div class="bg-white p-4 md:p-6 rounded-2xl shadow-xl border border-gray-100">
            <form action="/stay/search" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase tracking-wider">체크인 - 체크아웃</label>
                    <div class="relative">
                        <input type="text" id="stay-date-range" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-gray-50 font-medium" placeholder="날짜를 선택하세요">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <input type="hidden" name="checkin" id="checkin_val">
                    <input type="hidden" name="checkout" id="checkout_val">
                </div>
                
                <div class="w-full md:w-1/4">
                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase tracking-wider">인원</label>
                    <div class="relative">
                        <select name="guests" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-gray-50 font-medium appearance-none">
                            <option value="1">1명</option>
                            <option value="2" selected>2명</option>
                            <option value="3">3명</option>
                            <option value="4">4명</option>
                            <option value="5">5명 이상 (단체)</option>
                        </select>
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                </div>
                
                <div class="w-full md:w-1/4">
                    <button type="submit" class="w-full bg-gold hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-lg transition shadow-md h-[50px]">
                        객실 검색
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 객실 안내 -->
<div class="container mx-auto px-4 py-16 max-w-6xl">
    <h2 class="text-2xl font-bold text-navy mb-8">전체 객실 안내</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php 
        $rooms = [
            ['name' => '개인 기도실 (1인실)', 'type' => '침대/온돌', 'cap' => '1명', 'bath' => '공용', 'features' => '냉난방기, 책상'],
            ['name' => '가족실 (2~4인실)', 'type' => '온돌', 'cap' => '2~4명', 'bath' => '개별', 'features' => '냉난방기, 개별 화장실'],
            ['name' => '단체 숙소 A (소그룹)', 'type' => '온돌', 'cap' => '5~10명', 'bath' => '개별', 'features' => '냉난방기, 넓은 거실'],
        ];
        foreach($rooms as $room):
        ?>
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="h-48 bg-gray-200 relative">
                <img src="https://images.unsplash.com/photo-1590490359683-658d3d23f972?w=500&q=80" alt="객실 사진" class="w-full h-full object-cover">
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4"><?php echo $room['name']; ?></h3>
                <ul class="text-sm text-gray-600 space-y-2 mb-6">
                    <li class="flex items-center"><svg class="w-4 h-4 mr-2 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> 타입: <?php echo $room['type']; ?></li>
                    <li class="flex items-center"><svg class="w-4 h-4 mr-2 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> 수용인원: <?php echo $room['cap']; ?></li>
                    <li class="flex items-center"><svg class="w-4 h-4 mr-2 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> 욕실: <?php echo $room['bath']; ?></li>
                    <li class="flex items-center"><svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> <?php echo $room['features']; ?></li>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- 예약 조회 플로팅 버튼 -->
<a href="/stay/lookup" class="fixed bottom-20 md:bottom-10 right-4 md:right-10 bg-navy text-white p-4 rounded-full shadow-2xl hover:bg-blue-900 transition flex items-center justify-center z-40 group">
    <svg class="w-6 h-6 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    <span class="hidden md:inline font-bold">예약 조회</span>
</a>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ko.js"></script>
<script src="/assets/js/stay-datepicker.js"></script>
<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
