<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">🎙️ 강사(설교자) 관리</h2>
        <p class="text-sm text-gray-500 mt-1">집회 인도 강사님들의 프로필, 얼굴 사진, <strong>강사 직통 연락처</strong>를 관리합니다.</p>
    </div>
    <button onclick="openSpeakerModal()" class="px-4 py-2.5 bg-navy-700 hover:bg-navy-800 text-white rounded-xl text-sm font-bold shadow transition flex items-center space-x-1.5">
        <span>+ 강사 신규 등록</span>
    </button>
</div>

<!-- 강사 카드 그리드 -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach($speakers as $s): ?>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col justify-between hover:shadow-md transition">
        <div>
            <!-- 상단: 얼굴 사진 및 이름 -->
            <div class="flex items-center space-x-4 mb-4">
                <div class="w-16 h-16 rounded-full bg-navy-50 border-2 border-gold flex items-center justify-center text-navy-900 font-bold text-xl overflow-hidden flex-shrink-0 shadow-sm">
                    <?php if(!empty($s['profile_image']) && $s['profile_image'] !== '/assets/images/speaker_default.jpg'): ?>
                        <img src="<?= htmlspecialchars($s['profile_image']) ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <span><?= mb_substr($s['name'], 0, 1, 'UTF-8') ?></span>
                    <?php endif; ?>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center space-x-2">
                        <h3 class="text-lg font-bold text-gray-900 truncate"><?= htmlspecialchars($s['name']) ?></h3>
                        <span class="text-xs px-2 py-0.5 bg-gold/10 text-yellow-800 font-semibold rounded-full flex-shrink-0"><?= htmlspecialchars($s['title']) ?></span>
                    </div>
                    <p class="text-xs text-navy-700 font-medium truncate mt-0.5"><?= htmlspecialchars($s['church']) ?></p>
                </div>
            </div>

            <!-- [중요] 강사 본인 연락처를 가장 메인으로 크게 강조! -->
            <div class="bg-amber-50/70 border border-amber-200/80 p-3 rounded-xl mb-3">
                <div class="text-[10px] text-amber-800 font-bold tracking-wide uppercase">강사 직통 연락처</div>
                <div class="text-base font-extrabold text-navy-900 font-mono mt-0.5 flex items-center space-x-1.5">
                    <span>📞</span>
                    <span><?= htmlspecialchars($s['phone'] ?: '연락처 미등록') ?></span>
                </div>
                <?php if(!empty($s['phone_sub'])): ?>
                    <div class="text-[11px] text-gray-500 mt-1">보조: <span class="font-mono"><?= htmlspecialchars($s['phone_sub']) ?></span></div>
                <?php endif; ?>
            </div>

            <!-- 일정담당자(비서/부목사) 정보는 차분한 서브 텍스트로 배치 -->
            <?php if(!empty($s['manager_name']) || !empty($s['manager_phone'])): ?>
            <div class="px-1 text-[11px] text-gray-500 mb-3 flex items-center space-x-1.5">
                <span class="text-gray-400 font-medium">일정대리인:</span>
                <span class="font-semibold text-gray-700"><?= htmlspecialchars($s['manager_name'] ?: '비서') ?></span>
                <?php if(!empty($s['manager_phone'])): ?>
                    <span class="font-mono text-gray-500">(<?= htmlspecialchars($s['manager_phone']) ?>)</span>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="bg-gray-50 p-3 rounded-xl text-xs text-gray-600 line-clamp-2 leading-relaxed">
                <?= htmlspecialchars($s['bio'] ?: '소개 정보가 없습니다.') ?>
            </div>
        </div>

        <div class="mt-5 pt-4 border-t border-gray-100 flex justify-between items-center text-xs">
            <a href="/admin/speakers/detail?id=<?= $s['id'] ?>" class="font-bold text-blue-600 hover:text-blue-800 flex items-center space-x-1">
                <span>📖 상세 & 사역이력</span>
            </a>
            <div class="flex space-x-1.5">
                <button onclick='editSpeaker(<?= json_encode($s, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>)' class="px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">수정</button>
                <form method="POST" action="/admin/speakers/delete" onsubmit="return confirm('정말 삭제하시겠습니까?');" class="inline">
                    <input type="hidden" name="id" value="<?= $s['id'] ?>">
                    <button type="submit" class="px-2.5 py-1 bg-red-50 hover:bg-red-100 text-red-600 font-medium rounded-lg transition">삭제</button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- 강사 등록/수정 모달 -->
<div id="speakerModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 max-h-[90vh] overflow-y-auto">
        <h3 id="modalTitle" class="text-lg font-bold text-gray-900 mb-4">강사 등록</h3>
        <form id="speakerForm" method="POST" action="/admin/speakers/create" enctype="multipart/form-data">
            <input type="hidden" name="id" id="speaker_id">
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">강사 성명 *</label>
                    <input type="text" name="name" id="speaker_name" required class="w-full px-3 py-2 border rounded-xl text-sm font-bold text-navy">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">직분 (원장, 목사, 선교사 등)</label>
                    <input type="text" name="title" id="speaker_title" value="목사" class="w-full px-3 py-2 border rounded-xl text-sm">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 mb-1">소속 교회 / 기관 *</label>
                <input type="text" name="church" id="speaker_church" required class="w-full px-3 py-2 border rounded-xl text-sm" placeholder="예: 부산 온누리교회">
            </div>

            <!-- 얼굴 사진 업로드 -->
            <div class="mb-5">
                <label class="block text-xs font-semibold text-gray-600 mb-1">강사 얼굴 사진 업로드</label>
                <input type="file" name="image_file" accept="image/*" class="w-full px-3 py-1.5 border rounded-xl text-xs bg-gray-50 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-navy file:text-white file:text-xs">
                <input type="hidden" name="profile_image" id="speaker_image">
            </div>

            <!-- [메인 강조] 강사 직통 연락처 입력 영역 -->
            <div class="bg-amber-50/40 p-4 rounded-2xl border border-amber-200 mb-4">
                <label class="block text-xs font-bold text-amber-900 mb-2">📞 강사 본인 직통 연락처 (메인)</label>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">휴대전화 번호 (1차) *</label>
                        <input type="tel" name="phone" id="speaker_phone" required class="w-full px-3 py-2 border border-amber-300 rounded-xl text-sm font-bold font-mono focus:ring-2 focus:ring-gold bg-white" placeholder="010-0000-0000">
                    </div>
                    <div>
                        <label class="block text-[11px] font-medium text-gray-600 mb-1">보조 연락처 (2차)</label>
                        <input type="tel" name="phone_sub" id="speaker_phone_sub" class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm font-mono bg-white" placeholder="사무실/자택">
                    </div>
                </div>
            </div>

            <!-- [서브] 일정담당자 (비서 / 부목사) 입력 영역 (단정하고 부차적인 스타일) -->
            <div class="p-3 bg-gray-50 rounded-xl border border-gray-200 mb-4 text-xs">
                <p class="font-bold text-gray-600 mb-2 text-[11px]">📋 대리 일정관리자 정보 (선택 입력: 비서/부목사 등)</p>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] text-gray-500 mb-1">담당자 성명</label>
                        <input type="text" name="manager_name" id="speaker_manager_name" class="w-full px-2.5 py-1.5 border rounded-lg text-xs bg-white" placeholder="예: 김비서">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-500 mb-1">담당자 연락처</label>
                        <input type="tel" name="manager_phone" id="speaker_manager_phone" class="w-full px-2.5 py-1.5 border rounded-lg text-xs bg-white" placeholder="010-0000-0000">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-600 mb-1">주요 약력 / 설교 주제 소개</label>
                <textarea name="bio" id="speaker_bio" rows="3" class="w-full px-3 py-2 border rounded-xl text-sm"></textarea>
            </div>

            <div class="mb-5 flex items-center space-x-2">
                <input type="checkbox" name="is_active" id="speaker_active" value="1" checked class="rounded text-navy-700">
                <label for="speaker_active" class="text-xs font-semibold text-gray-700">사역 활성화</label>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeSpeakerModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium">취소</button>
                <button type="submit" class="px-5 py-2 bg-navy-700 text-white rounded-xl text-sm font-bold">저장하기</button>
            </div>
        </form>
    </div>
</div>

<script>
function openSpeakerModal() {
    document.getElementById('modalTitle').innerText = '강사 신규 등록';
    document.getElementById('speakerForm').action = '/admin/speakers/create';
    document.getElementById('speaker_id').value = '';
    document.getElementById('speaker_name').value = '';
    document.getElementById('speaker_title').value = '목사';
    document.getElementById('speaker_church').value = '';
    document.getElementById('speaker_phone').value = '';
    document.getElementById('speaker_phone_sub').value = '';
    document.getElementById('speaker_manager_name').value = '';
    document.getElementById('speaker_manager_phone').value = '';
    document.getElementById('speaker_bio').value = '';
    document.getElementById('speaker_image').value = '/assets/images/speaker_default.jpg';
    document.getElementById('speaker_active').checked = true;
    document.getElementById('speakerModal').classList.remove('hidden');
}
function editSpeaker(s) {
    document.getElementById('modalTitle').innerText = '강사 정보 수정';
    document.getElementById('speakerForm').action = '/admin/speakers/update';
    document.getElementById('speaker_id').value = s.id;
    document.getElementById('speaker_name').value = s.name;
    document.getElementById('speaker_title').value = s.title;
    document.getElementById('speaker_church').value = s.church;
    document.getElementById('speaker_phone').value = s.phone;
    document.getElementById('speaker_phone_sub').value = s.phone_sub || '';
    document.getElementById('speaker_manager_name').value = s.manager_name || '';
    document.getElementById('speaker_manager_phone').value = s.manager_phone || '';
    document.getElementById('speaker_bio').value = s.bio || '';
    document.getElementById('speaker_image').value = s.profile_image || '';
    document.getElementById('speaker_active').checked = s.is_active == 1;
    document.getElementById('speakerModal').classList.remove('hidden');
}
function closeSpeakerModal() {
    document.getElementById('speakerModal').classList.add('hidden');
}
</script>