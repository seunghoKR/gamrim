<h1 class="text-2xl font-semibold text-gray-800 mb-6">룸 랙 (Room Rack)</h1>

<div class="flex justify-between items-center mb-4">
    <div class="space-x-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded text-sm font-medium">14일 조회</button>
        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded text-sm font-medium hover:bg-gray-300">30일 조회</button>
    </div>
    <div class="flex space-x-4 text-sm text-gray-600">
        <span class="flex items-center"><span class="w-4 h-4 bg-yellow-200 inline-block mr-1"></span>예약대기</span>
        <span class="flex items-center"><span class="w-4 h-4 bg-green-300 inline-block mr-1"></span>예약확정</span>
        <span class="flex items-center"><span class="w-4 h-4 bg-blue-300 inline-block mr-1"></span>입실완료</span>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto relative">
    <table class="min-w-max w-full table-fixed border-collapse">
        <thead>
            <tr>
                <th class="w-24 p-3 border text-left bg-gray-50 sticky left-0 z-10">객실</th>
                <?php for($i=0; $i<14; $i++): $date = date('m/d', strtotime("+$i days")); ?>
                <th class="w-16 p-3 border text-center bg-gray-50 text-sm"><?= $date ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            $rooms = ['101', '102', '201', '202', '301'];
            foreach($rooms as $room): 
            ?>
            <tr>
                <td class="p-3 border font-medium bg-white sticky left-0 z-10"><?= $room ?>호</td>
                <?php 
                for($i=0; $i<14; $i++): 
                    $currentDate = date('Y-m-d', strtotime("+$i days"));
                    $status = $roomRackData[$room][$currentDate]['status'] ?? null;
                    
                    $bgClass = '';
                    if($status === '예약대기') $bgClass = 'bg-yellow-200 cursor-pointer';
                    elseif($status === '예약확정') $bgClass = 'bg-green-300 cursor-pointer';
                    elseif($status === '입실완료') $bgClass = 'bg-blue-300 cursor-pointer';
                ?>
                <td class="p-1 border text-center <?= $bgClass ?>" 
                    onclick="<?= $status ? "openPanel('{$room}', '{$currentDate}')" : "" ?>">
                </td>
                <?php endfor; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- 우측 슬라이드 패널 -->
<div id="sidePanel" class="fixed inset-y-0 right-0 w-80 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50 flex flex-col">
    <div class="p-4 border-b flex justify-between items-center bg-gray-50">
        <h2 class="text-lg font-semibold" id="panelTitle">예약 정보</h2>
        <button onclick="closePanel()" class="text-gray-500 hover:text-gray-800 text-xl">&times;</button>
    </div>
    <div class="p-4 flex-1 overflow-y-auto">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">예약자명</label>
            <p class="mt-1 text-sm text-gray-900" id="panelBooker">홍길동</p>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">연락처</label>
            <p class="mt-1 text-sm text-gray-900" id="panelContact">010-0000-0000</p>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">상태 변경</label>
            <select id="statusSelect" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                <option value="예약대기">예약대기</option>
                <option value="예약확정">예약확정</option>
                <option value="입실완료">입실완료</option>
                <option value="취소">취소</option>
            </select>
        </div>
        <button onclick="saveStatus()" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">저장</button>
    </div>
</div>

<script>
    let currentBookingId = null;

    function openPanel(room, date) {
        // 실제로는 AJAX로 예약 정보를 불러와야 함
        document.getElementById('panelTitle').innerText = `${room}호 (${date})`;
        document.getElementById('sidePanel').classList.remove('translate-x-full');
    }

    function closePanel() {
        document.getElementById('sidePanel').classList.add('translate-x-full');
    }

    function saveStatus() {
        const status = document.getElementById('statusSelect').value;
        // AJAX 통신 후 완료 시 닫기
        alert('저장되었습니다.');
        closePanel();
    }
</script>
