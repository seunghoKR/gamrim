<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">📅 연중 집회 스케줄 & 구글 캘린더 공유</h2>
        <p class="text-sm text-gray-500 mt-1">2개월~6개월 앞선 정기예배 및 특별성회를 기획하고 담당자 구글 캘린더와 자동 동기화합니다.</p>
    </div>
    <button onclick="openServiceModal()" class="px-4 py-2.5 bg-navy-700 hover:bg-navy-800 text-white rounded-xl text-sm font-bold shadow transition flex items-center space-x-1.5">
        <span>+ 새 집회·예배 일정 등록</span>
    </button>
</div>

<!-- 구글 캘린더 실시간 구독 피드 안내 박스 -->
<div class="bg-gradient-to-r from-blue-900 to-indigo-900 text-white rounded-2xl p-6 shadow-md mb-8">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <span class="text-2xl">🗓️</span>
                <h3 class="text-lg font-bold text-gold">담당자 구글 캘린더 실시간 동기화 (iCal 구독 피드)</h3>
            </div>
            <p class="text-xs text-blue-200 mt-1.5 leading-relaxed">
                스마트폰이나 구글 캘린더 [설정 &gt; 캘린더 추가 &gt; URL로 추가]에 아래 주소를 넣으시면, 기도원 집회 일정이 실시간으로 폰 달력에 자동 반영됩니다.
            </p>
        </div>
        <div class="flex items-center space-x-2 w-full md:w-auto">
            <input type="text" id="icalUrl" readonly value="https://newgamrim.iwinv.net/services/ical" class="bg-black/30 border border-white/20 text-white text-xs px-3 py-2.5 rounded-xl w-full md:w-72 focus:outline-none select-all font-mono">
            <button onclick="copyIcalUrl()" class="px-3.5 py-2.5 bg-gold hover:bg-yellow-500 text-navy-950 font-bold rounded-xl text-xs flex-shrink-0 transition">
                주소 복사
            </button>
        </div>
    </div>
</div>

<!-- 집회 일정 목록 테이블 -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="text-base font-bold text-gray-900">향후 6개월 집회 일정 (<?= count($services) ?>건)</h3>
        <span class="text-xs text-gray-500 font-medium">정기예배 / 부흥회 / 철야성회</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-[11px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3 px-6">집회 일시</th>
                    <th class="py-3 px-4">구분</th>
                    <th class="py-3 px-4">집회명 / 주제</th>
                    <th class="py-3 px-4">설교자 (강사)</th>
                    <th class="py-3 px-4">구글 캘린더</th>
                    <th class="py-3 px-6 text-right">관리</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-xs">
                <?php if(empty($services)): ?>
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-400">등록된 향후 집회 일정이 없습니다.</td>
                </tr>
                <?php else: ?>
                <?php foreach($services as $s): ?>
                <tr class="hover:bg-blue-50/30 transition">
                    <td class="py-4 px-6 font-bold text-gray-900">
                        <div><?= $s['event_date'] ?></div>
                        <div class="text-gray-400 font-normal text-[11px]"><?= htmlspecialchars($s['event_time']) ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold <?= $s['is_special'] ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-blue-50 text-blue-700 border border-blue-200' ?>">
                            <?= htmlspecialchars($s['service_type'] ?? '정기예배') ?>
                        </span>
                    </td>
                    <td class="py-4 px-4 font-medium text-gray-900">
                        <div class="text-sm font-bold"><?= htmlspecialchars($s['title']) ?></div>
                        <?php if(!empty($s['description'])): ?>
                            <div class="text-gray-400 text-[11px] line-clamp-1 mt-0.5"><?= htmlspecialchars($s['description']) ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-4">
                        <div class="font-bold text-navy-800"><?= htmlspecialchars($s['speaker_name'] ?: $s['preacher']) ?></div>
                        <?php if(!empty($s['speaker_church'])): ?>
                            <div class="text-gray-400 text-[11px]"><?= htmlspecialchars($s['speaker_church']) ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-4">
                        <a href="<?= htmlspecialchars($s['google_calendar_url']) ?>" target="_blank" class="inline-flex items-center space-x-1 text-xs text-blue-600 hover:text-blue-800 font-semibold bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-200">
                            <span>📅 담기</span>
                        </a>
                    </td>
                    <td class="py-4 px-6 text-right space-x-1">
                        <form method="POST" action="/admin/services/delete" onsubmit="return confirm('이 일정을 삭제하시겠습니까?');" class="inline">
                            <input type="hidden" name="id" value="<?= $s['id'] ?>">
                            <button type="submit" class="px-2.5 py-1 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-lg transition">삭제</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- 집회 등록 모달 -->
<div id="serviceModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">새 집회 일정 등록 (연중 2~6개월 선등록)</h3>
        <form method="POST" action="/admin/services/create">
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 mb-1">집회 제목 *</label>
                <input type="text" name="title" required class="w-full px-3 py-2 border rounded-xl text-sm" placeholder="예: 화요구국철야 성회, 산상축복성회">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">집회 구분</label>
                    <select name="service_type" class="w-full px-3 py-2 border rounded-xl text-sm bg-white">
                        <option value="정기예배">정기예배 (매일 4부)</option>
                        <option value="화요철야">화요구국철야 (화 밤10:00)</option>
                        <option value="금요철야">금요은혜철야 (금 밤10:00)</option>
                        <option value="특별성회">특별 산상성회</option>
                        <option value="부흥회">심령부흥대성회</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">초청 강사(설교자) 선택</label>
                    <select name="speaker_id" id="speaker_select" onchange="onSpeakerSelect(this)" class="w-full px-3 py-2 border rounded-xl text-sm bg-white">
                        <option value="">-- 등록된 강사 선택 --</option>
                        <?php foreach($speakers as $sp): ?>
                            <option value="<?= $sp['id'] ?>" data-name="<?= htmlspecialchars($sp['name'] . ' ' . $sp['title']) ?>"><?= htmlspecialchars($sp['name']) ?> (<?= htmlspecialchars($sp['church']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 mb-1">설교자 직접 입력 (외부 강사 등)</label>
                <input type="text" name="preacher" id="preacher_input" required class="w-full px-3 py-2 border rounded-xl text-sm" placeholder="예: 이은호 목사">
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">집회 날짜 (수개월 뒤 가능) *</label>
                    <input type="date" name="event_date" required value="<?= date('Y-m-d') ?>" class="w-full px-3 py-2 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">집회 시간대 *</label>
                    <input type="text" name="event_time" required value="오전 10:30" class="w-full px-3 py-2 border rounded-xl text-sm" placeholder="예: 오전 10:30, 저녁 7:30, 밤 10:00">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 mb-1">집회 주제 및 안내 메모</label>
                <textarea name="description" rows="2" class="w-full px-3 py-2 border rounded-xl text-sm" placeholder="성회 주제, 찬양팀 안내 등"></textarea>
            </div>
            <div class="mb-5 flex items-center space-x-2">
                <input type="checkbox" name="is_special" id="is_special" value="1" class="rounded text-navy-700">
                <label for="is_special" class="text-xs font-semibold text-gray-700">특별 성회 (메인 화면 강조 노출)</label>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeServiceModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium">취소</button>
                <button type="submit" class="px-5 py-2 bg-navy-700 text-white rounded-xl text-sm font-bold">일정 등록 및 캘린더 생성</button>
            </div>
        </form>
    </div>
</div>

<script>
function openServiceModal() {
    document.getElementById('serviceModal').classList.remove('hidden');
}
function closeServiceModal() {
    document.getElementById('serviceModal').classList.add('hidden');
}
function onSpeakerSelect(sel) {
    const opt = sel.options[sel.selectedIndex];
    if (opt.value) {
        document.getElementById('preacher_input').value = opt.getAttribute('data-name');
    }
}
function copyIcalUrl() {
    const input = document.getElementById('icalUrl');
    input.select();
    navigator.clipboard.writeText(input.value);
    alert('구글 캘린더 구독용 iCal 주소가 복사되었습니다!\n\n구글 캘린더 [설정 > 캘린더 추가 > URL로 추가]에 붙여넣으세요.');
}
</script>