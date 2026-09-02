<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<h1 class="text-2xl font-semibold text-gray-800 mb-6">대관 관리 캘린더</h1>

<div class="bg-white rounded-lg shadow p-6 mb-8">
    <div id='calendar'></div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">대관 신청 목록</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">접수번호</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">신청단체</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">시설</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">기간</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">상태</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">관리</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach($rentalList ?? [] as $rental): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($rental['rental_no']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($rental['applicant_name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($rental['facility_name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $rental['start_date'] ?> ~ <?= $rental['end_date'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php 
                        $badgeColors = [
                            '접수대기' => 'bg-yellow-100 text-yellow-800',
                            '심사승인' => 'bg-blue-100 text-blue-800',
                            '확정완료' => 'bg-green-100 text-green-800',
                            '반려' => 'bg-red-100 text-red-800',
                            '취소' => 'bg-gray-100 text-gray-800'
                        ];
                        $colorClass = $badgeColors[$rental['status']] ?? 'bg-gray-100 text-gray-800';
                        ?>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $colorClass ?>"><?= $rental['status'] ?></span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <button onclick="updateStatus('<?= $rental['rental_id'] ?>', '심사승인')" class="text-blue-600 hover:text-blue-900">승인</button>
                        <button onclick="updateStatus('<?= $rental['rental_id'] ?>', '확정완료')" class="text-green-600 hover:text-green-900">확정</button>
                        <button onclick="updateStatus('<?= $rental['rental_id'] ?>', '반려')" class="text-red-600 hover:text-red-900">반려</button>
                        <button onclick="updateStatus('<?= $rental['rental_id'] ?>', '취소')" class="text-gray-600 hover:text-gray-900">취소</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/admin/rental/events', // JSON endpoint
            locale: 'ko'
        });
        calendar.render();
    });

    function updateStatus(id, status) {
        if(confirm(`해당 신청을 [${status}] 상태로 변경하시겠습니까?`)) {
            fetch('/admin/rental/status', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}&status=${status}`
            }).then(res => res.json()).then(data => {
                if(data.success) location.reload();
                else alert('오류가 발생했습니다.');
            });
        }
    }
</script>
