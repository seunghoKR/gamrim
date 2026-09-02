<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<div class="bg-gray-50 py-8 border-b border-gray-200">
    <div class="container mx-auto px-4 max-w-5xl flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-navy mb-1">검색 결과</h1>
            <p class="text-sm text-gray-500">
                일정: <span class="font-bold text-gray-700"><?php echo htmlspecialchars($_GET['checkin'] ?? ''); ?> ~ <?php echo htmlspecialchars($_GET['checkout'] ?? ''); ?></span> 
                | 인원: <span class="font-bold text-gray-700"><?php echo htmlspecialchars($_GET['guests'] ?? '2'); ?>명</span>
            </p>
        </div>
        <a href="/stay" class="text-sm bg-white border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition">다시 검색</a>
    </div>
</div>

<div class="container mx-auto px-4 py-12 max-w-5xl min-h-[50vh]">
    <?php 
    // Mock condition
    $hasAvailableRooms = true; 
    
    if($hasAvailableRooms): 
    ?>
        <div class="space-y-6">
            <!-- 가용 객실 아이템 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col md:flex-row">
                <div class="w-full md:w-1/3 h-48 md:h-auto bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=500&q=80" alt="객실 사진" class="w-full h-full object-cover">
                </div>
                <div class="w-full md:w-2/3 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">가족실 (2~4인실)</h3>
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">예약 가능</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">냉난방기, 개별 화장실 구비. 조용하게 쉴 수 있는 온돌방입니다.</p>
                        
                        <div class="flex gap-4 text-sm text-gray-500 mb-6">
                            <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> 최대 4인</span>
                            <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> 온돌/개별욕실</span>
                        </div>
                    </div>
                    
                    <div class="text-right border-t pt-4">
                        <button class="bg-navy hover:bg-blue-900 text-white font-bold py-2 px-8 rounded-lg transition shadow-sm">
                            예약하기
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    <?php else: ?>
        <div class="text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <h3 class="text-xl font-bold text-gray-800 mb-2">가용 객실이 없습니다.</h3>
            <p class="text-gray-500 mb-6">선택하신 날짜에 예약 가능한 객실이 모두 마감되었습니다.<br>다른 일정으로 검색해 보세요.</p>
            <a href="/stay" class="inline-block bg-navy text-white px-6 py-2 rounded-lg font-bold">다시 검색하기</a>
        </div>
    <?php endif; ?>
</div>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
