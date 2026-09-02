<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">🛏️ 숙소·객실 정밀 관리</h2>
        <p class="text-sm text-gray-500 mt-1">4대 공식 건물별 객실 옵션 수정, 청소 상태(완료/필요/청소중), <strong>유지보수 카톡 알림</strong>을 관리합니다.</p>
    </div>
    <div class="flex space-x-2">
        <a href="/admin/rooms" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-bold transition flex items-center space-x-1">
            <span>🗓️ 룸 랙 예약현황 보기</span>
        </a>
    </div>
</div>

<!-- 4대 공식 건물별 청소 요약 뱃지 -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <?php foreach($officialBuildings as $bName): ?>
    <?php $bStat = $buildings[$bName] ?? ['total' => 0, 'clean' => 0, 'need_clean' => 0, 'cleaning' => 0]; ?>
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex justify-between items-center mb-3">
            <h3 class="font-bold text-sm text-navy-900"><?= htmlspecialchars($bName) ?></h3>
            <span class="text-xs bg-navy-50 text-navy-900 font-bold px-2 py-0.5 rounded-full"><?= $bStat['total'] ?>개실</span>
        </div>
        <div class="flex space-x-1.5 text-[11px]">
            <span class="px-2 py-0.5 bg-green-50 text-green-700 font-semibold rounded">완료 <?= $bStat['clean'] ?></span>
            <span class="px-2 py-0.5 bg-red-50 text-red-700 font-semibold rounded">필요 <?= $bStat['need_clean'] ?></span>
            <?php if($bStat['cleaning'] > 0): ?>
                <span class="px-2 py-0.5 bg-amber-50 text-amber-700 font-semibold rounded">청소중 <?= $bStat['cleaning'] ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- 객실 테이블 -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="text-base font-bold text-gray-900">전체 호실 목록 (<?= count($rooms) ?>개실)</h3>
        <span class="text-xs text-blue-600 font-semibold">💡 유지보수 메모 등록 시 담당자에게 카카오톡 알림이 발송됩니다.</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-[11px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3 px-6">건물 / 층</th>
                    <th class="py-3 px-4">호실명 / 구분</th>
                    <th class="py-3 px-4">인원 / 침대 / 욕실</th>
                    <th class="py-3 px-4">청소 상태 (원클릭 토글)</th>
                    <th class="py-3 px-6">유지보수 점검 메모 (카톡 알림)</th>
                    <th class="py-3 px-6 text-right">옵션 수정</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-xs">
                <?php foreach($rooms as $r): ?>
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="py-4 px-6 font-bold text-gray-900">
                        <div class="text-navy-900"><?= htmlspecialchars($r['building_name'] ?? '대성전 숙소') ?></div>
                        <div class="text-gray-400 font-normal text-[11px]"><?= htmlspecialchars($r['floor'] ?? '1층') ?></div>
                    </td>
                    <td class="py-4 px-4 font-bold text-navy-900">
                        <div class="text-sm font-bold"><?= htmlspecialchars($r['room_number']) ?></div>
                        <span class="text-[10px] px-2 py-0.5 bg-gray-100 rounded text-gray-600 font-semibold"><?= htmlspecialchars($r['room_type']) ?></span>
                    </td>
                    <td class="py-4 px-4 text-gray-600">
                        <div>기준 <?= $r['capacity_standard'] ?>명 (최대 <?= $r['capacity_max'] ?>명)</div>
                        <div class="text-gray-400 text-[11px]"><?= htmlspecialchars($r['bed_type']) ?> | <?= $r['has_bathroom'] ? '개별욕실' : '공동욕실' ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <form method="POST" action="/admin/rooms-manage/toggle-cleaning" class="inline">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <?php 
                                $cst = $r['cleaning_status'] ?? '청소완료';
                                $next = match($cst) {
                                    '청소완료' => '청소필요',
                                    '청소필요' => '청소중',
                                    default => '청소완료'
                                };
                                $btnStyle = match($cst) {
                                    '청소필요' => 'bg-red-50 text-red-700 border-red-200 hover:bg-red-100',
                                    '청소중' => 'bg-amber-50 text-amber-700 border-amber-200 hover:bg-amber-100',
                                    default => 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100'
                                };
                            ?>
                            <input type="hidden" name="cleaning_status" value="<?= $next ?>">
                            <button type="submit" title="클릭 시 [<?= $next ?>] 상태로 변경" class="px-3 py-1.5 rounded-lg border text-xs font-bold transition flex items-center space-x-1.5 <?= $btnStyle ?>">
                                <span><?= $cst === '청소완료' ? '✅' : ($cst === '청소필요' ? '⚠️' : '🧹') ?></span>
                                <span><?= $cst ?></span>
                            </button>
                        </form>
                    </td>
                    <td class="py-4 px-6">
                        <form method="POST" action="/admin/rooms-manage/update-memo" class="flex items-center space-x-2">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <input type="text" name="maintenance_memo" value="<?= htmlspecialchars($r['maintenance_memo'] ?? '') ?>" placeholder="예: 에어컨 수리완료, 온수 점검요망" class="w-full max-w-xs px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:ring-1 focus:ring-navy-700">
                            <button type="submit" class="px-2.5 py-1.5 bg-navy-700 hover:bg-navy-800 text-white rounded-lg text-[11px] font-bold transition flex-shrink-0">
                                알림등록
                            </button>
                        </form>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <button onclick='openEditModal(<?= json_encode($r, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>)' class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg text-xs font-bold transition">
                            옵션수정
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- 객실 옵션 수정 모달 -->
<div id="editModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto">
        <h3 class="text-lg font-bold text-gray-900 mb-4">객실 옵션 및 제원 수정</h3>
        <form method="POST" action="/admin/rooms-manage/edit-options">
            <input type="hidden" name="id" id="edit_id">
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">건물명 (4대 공식 건물) *</label>
                    <select name="building_name" id="edit_building_name" required class="w-full px-3 py-2 border rounded-xl text-sm bg-white font-bold">
                        <option value="대성전 숙소">대성전 숙소</option>
                        <option value="벧엘성전 숙소">벧엘성전 숙소</option>
                        <option value="교육관 숙소">교육관 숙소</option>
                        <option value="목양관 숙소">목양관 숙소</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">층수</label>
                    <input type="text" name="floor" id="edit_floor" required class="w-full px-3 py-2 border rounded-xl text-sm">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">호실 번호/명칭 *</label>
                    <input type="text" name="room_number" id="edit_room_number" required class="w-full px-3 py-2 border rounded-xl text-sm font-bold">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">객실 구분</label>
                    <select name="room_type" id="edit_room_type" class="w-full px-3 py-2 border rounded-xl text-sm bg-white">
                        <option value="개인실">개인실</option>
                        <option value="가족실">가족실</option>
                        <option value="목회자실">목회자실</option>
                        <option value="단체실">단체실</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">침대 형태</label>
                    <select name="bed_type" id="edit_bed_type" class="w-full px-3 py-2 border rounded-xl text-sm bg-white">
                        <option value="온돌">온돌</option>
                        <option value="침대">침대</option>
                        <option value="침대+온돌">침대+온돌</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">개별 욕실 유무</label>
                    <select name="has_bathroom" id="edit_has_bathroom" class="w-full px-3 py-2 border rounded-xl text-sm bg-white">
                        <option value="1">개별 욕실 완비</option>
                        <option value="0">공동 욕실 이용</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">기준 인원</label>
                    <input type="number" name="capacity_standard" id="edit_capacity_standard" required class="w-full px-3 py-2 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">최대 수용 인원</label>
                    <input type="number" name="capacity_max" id="edit_capacity_max" required class="w-full px-3 py-2 border rounded-xl text-sm">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 mb-1">구비 시설 및 어메니티</label>
                <input type="text" name="amenities" id="edit_amenities" class="w-full px-3 py-2 border rounded-xl text-sm">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">청소 상태</label>
                    <select name="cleaning_status" id="edit_cleaning_status" class="w-full px-3 py-2 border rounded-xl text-sm bg-white">
                        <option value="청소완료">청소완료</option>
                        <option value="청소필요">청소필요</option>
                        <option value="청소중">청소중</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">운영 상태</label>
                    <select name="status" id="edit_status" class="w-full px-3 py-2 border rounded-xl text-sm bg-white">
                        <option value="운영중">운영중</option>
                        <option value="점검중">점검중</option>
                        <option value="수리중">수리중</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium">취소</button>
                <button type="submit" class="px-5 py-2 bg-navy-700 text-white rounded-xl text-sm font-bold">수정 완료</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(r) {
    document.getElementById('edit_id').value = r.id;
    document.getElementById('edit_building_name').value = r.building_name || '대성전 숙소';
    document.getElementById('edit_floor').value = r.floor || '1층';
    document.getElementById('edit_room_number').value = r.room_number || '';
    document.getElementById('edit_room_type').value = r.room_type || '개인실';
    document.getElementById('edit_bed_type').value = r.bed_type || '온돌';
    document.getElementById('edit_has_bathroom').value = r.has_bathroom;
    document.getElementById('edit_capacity_standard').value = r.capacity_standard || 1;
    document.getElementById('edit_capacity_max').value = r.capacity_max || 2;
    document.getElementById('edit_amenities').value = r.amenities || '';
    document.getElementById('edit_cleaning_status').value = r.cleaning_status || '청소완료';
    document.getElementById('edit_status').value = r.status || '운영중';
    document.getElementById('editModal').classList.remove('hidden');
}
function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>