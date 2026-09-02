<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<div class="bg-navy py-12 text-center text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">시설 대관 안내</h1>
        <p class="text-gray-300">각종 집회, 수련회, 세미나를 위한 영성의 공간을 제공합니다.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <!-- 대관 절차 타임라인 -->
    <div class="max-w-4xl mx-auto mb-16">
        <h2 class="text-xl font-bold text-center text-navy mb-8">대관 절차</h2>
        <div class="flex flex-col md:flex-row justify-between items-center relative">
            <div class="hidden md:block absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -z-10 transform -translate-y-1/2"></div>
            
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 w-full md:w-48 text-center mb-4 md:mb-0 relative z-10">
                <div class="w-10 h-10 bg-navy text-white rounded-full flex items-center justify-center mx-auto mb-2 font-bold">1</div>
                <div class="font-bold text-gray-800">신청 접수</div>
                <div class="text-xs text-gray-500">온라인 폼 작성</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 w-full md:w-48 text-center mb-4 md:mb-0 relative z-10">
                <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mx-auto mb-2 font-bold">2</div>
                <div class="font-bold text-gray-800">일정 심사</div>
                <div class="text-xs text-gray-500">중복 및 목적 확인</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 w-full md:w-48 text-center mb-4 md:mb-0 relative z-10">
                <div class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center mx-auto mb-2 font-bold">3</div>
                <div class="font-bold text-gray-800">승인 통보</div>
                <div class="text-xs text-gray-500">개별 연락(문자/전화)</div>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 w-full md:w-48 text-center relative z-10">
                <div class="w-10 h-10 bg-gold text-white rounded-full flex items-center justify-center mx-auto mb-2 font-bold">4</div>
                <div class="font-bold text-gray-800">예약 확정</div>
                <div class="text-xs text-gray-500">계약금 입금 완료</div>
            </div>
        </div>
    </div>

    <!-- 시설 목록 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <?php 
        $facilities = [
            ['id' => 1, 'name' => '대성전', 'cap' => '1,500석', 'features' => '음향/조명 시스템, 대형 스크린, 자모실'],
            ['id' => 2, 'name' => '벧엘성전', 'cap' => '300석', 'features' => '음향 시스템, 프로젝터, 피아노'],
            ['id' => 3, 'name' => '세미나실', 'cap' => '80석', 'features' => '화이트보드, 프로젝터, 책걸상'],
            ['id' => 4, 'name' => '구내식당', 'cap' => '400석', 'features' => '대형 배식대, 취사장비 (별도 협의)'],
        ];
        foreach($facilities as $fac):
        ?>
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden flex flex-col">
            <div class="h-56 bg-gray-200 relative">
                <img src="https://images.unsplash.com/photo-1540397106260-e24a507a088c?w=600&q=80" class="w-full h-full object-cover">
                <div class="absolute top-4 right-4 bg-navy text-white text-xs font-bold px-3 py-1 rounded-full">
                    수용인원: <?php echo $fac['cap']; ?>
                </div>
            </div>
            <div class="p-6 flex flex-col flex-grow">
                <h3 class="text-2xl font-bold text-navy mb-2"><?php echo $fac['name']; ?></h3>
                <p class="text-sm text-gray-600 mb-6 flex-grow">
                    <span class="font-bold text-gray-700">주요 시설:</span> <?php echo $fac['features']; ?>
                </p>
                <div class="flex gap-2 mt-auto">
                    <a href="/rental/calendar?facility=<?php echo $fac['id']; ?>" class="w-1/2 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 rounded-lg font-bold transition">일정 확인</a>
                    <a href="/rental/apply?facility=<?php echo $fac['id']; ?>" class="w-1/2 text-center bg-gold hover:bg-yellow-600 text-white py-3 rounded-lg font-bold transition">대관 신청</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- 이용 안내 사항 -->
    <div class="max-w-5xl mx-auto mt-16 bg-gray-50 p-8 rounded-2xl border border-gray-200">
        <h3 class="font-bold text-lg text-gray-800 mb-4">대관 이용 시 유의사항</h3>
        <ul class="list-disc list-inside text-sm text-gray-600 space-y-2">
            <li>건전한 복음주의 개신교 단체 및 교회만 대관이 가능하며, 이단 및 사이비 단체의 대관은 엄격히 금지합니다.</li>
            <li>대관 신청은 사용일 기준 최소 2주 전까지 완료되어야 합니다.</li>
            <li>기본 음향/조명 장비 외의 추가 장비 반입 시 사전 협의가 필요합니다.</li>
            <li>시설물 훼손 시 원상복구 또는 배상의 책임이 있습니다.</li>
            <li>쓰레기는 반드시 분리수거하여 지정된 장소에 배출해 주시기 바랍니다.</li>
        </ul>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
