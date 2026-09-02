<div class="mb-6">
    <a href="/admin/speakers" class="text-xs text-navy-700 hover:text-navy-900 font-bold flex items-center space-x-1 mb-3">
        <span>&larr; 강사 목록으로 돌아가기</span>
    </a>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <div class="flex items-center space-x-3">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight"><?= htmlspecialchars($speaker['name']) ?> <?= htmlspecialchars($speaker['title']) ?></h2>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold <?= $speaker['is_active'] ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-100 text-gray-500' ?>">
                    <?= $speaker['is_active'] ? '사역 활성' : '사역 휴지' ?>
                </span>
            </div>
            <p class="text-sm text-navy-800 font-medium mt-1">소속: <?= htmlspecialchars($speaker['church']) ?></p>
        </div>
        <a href="/admin/services" class="px-4 py-2 bg-navy-700 hover:bg-navy-800 text-white rounded-xl text-xs font-bold shadow transition flex items-center space-x-1">
            <span>📅 새 집회 일정 배정</span>
        </a>
    </div>
</div>

<!-- 상단 강사 상세 프로필 & 연락처 카드 그리드 -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- 좌측: 얼굴 이미지 및 기본정보 -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col items-center text-center">
        <div class="w-28 h-28 rounded-full border-4 border-gold/40 overflow-hidden shadow-md mb-4 bg-gray-50 flex items-center justify-center">
            <?php if(!empty($speaker['profile_image']) && $speaker['profile_image'] !== '/assets/images/speaker_default.jpg'): ?>
                <img src="<?= htmlspecialchars($speaker['profile_image']) ?>" class="w-full h-full object-cover">
            <?php else: ?>
                <span class="text-4xl text-navy-800 font-bold"><?= mb_substr($speaker['name'], 0, 1, 'UTF-8') ?></span>
            <?php endif; ?>
        </div>
        <h3 class="text-lg font-bold text-gray-900"><?= htmlspecialchars($speaker['name']) ?></h3>
        <p class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars($speaker['title']) ?> (<?= htmlspecialchars($speaker['church']) ?>)</p>

        <div class="mt-4 pt-4 border-t border-gray-100 w-full text-left text-xs space-y-2">
            <div>
                <span class="text-gray-400 font-medium">1차 연락처:</span>
                <span class="font-bold text-gray-800 ml-1"><?= htmlspecialchars($speaker['phone'] ?: '미등록') ?></span>
            </div>
            <?php if(!empty($speaker['phone_sub'])): ?>
            <div>
                <span class="text-gray-400 font-medium">2차 연락처:</span>
                <span class="font-bold text-gray-800 ml-1"><?= htmlspecialchars($speaker['phone_sub']) ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- 중앙: 일정관리 담당자 (비서/부목사) 정보 -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center space-x-2 text-navy-800 font-bold mb-4">
                <span class="text-xl">📋</span>
                <h4 class="text-base">일정 담당자 (비서/부목사)</h4>
            </div>
            <div class="bg-blue-50/50 border border-blue-100 p-4 rounded-xl space-y-3 text-xs">
                <div>
                    <label class="text-gray-500 block">담당자 성명</label>
                    <p class="text-sm font-bold text-navy-900 mt-0.5"><?= htmlspecialchars($speaker['manager_name'] ?: '등록된 일정담당자가 없습니다.') ?></p>
                </div>
                <div>
                    <label class="text-gray-500 block">담당자 직통 연락처</label>
                    <p class="text-sm font-bold text-navy-900 mt-0.5 font-mono"><?= htmlspecialchars($speaker['manager_phone'] ?: '연락처 미등록') ?></p>
                </div>
            </div>
            <p class="text-[11px] text-gray-400 mt-3 leading-relaxed">
                ※ 강사님의 스케줄 조율 및 집회 안내 공문 발송 시 본 연락처로 우선 안내됩니다.
            </p>
        </div>
        <div class="text-[11px] text-gray-400 border-t border-gray-100 pt-3">
            등록일시: <?= $speaker['created_at'] ?>
        </div>
    </div>

    <!-- 우측: 설교 주제 및 약력/소개 -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h4 class="text-base font-bold text-gray-900 mb-3 flex items-center space-x-2">
            <span>📖</span>
            <span>주요 약력 및 설교 주제</span>
        </h4>
        <div class="bg-gray-50 p-4 rounded-xl text-xs text-gray-700 leading-relaxed max-h-56 overflow-y-auto whitespace-pre-wrap">
            <?= htmlspecialchars($speaker['bio'] ?: '등록된 약력 및 소개글이 없습니다.') ?>
        </div>
    </div>
</div>

<!-- 하단: 과거 및 예정 집회 인도 내역 (히스토리) 테이블 -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4.5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="text-base font-bold text-gray-900 flex items-center space-x-2">
            <span>🏛️ 예배 및 집회 인도 히스토리</span>
            <span class="text-xs bg-navy-50 text-navy-900 font-bold px-2 py-0.5 rounded-full">총 <?= count($history) ?>회 인도</span>
        </h3>
        <span class="text-xs text-gray-400">과거 집회부터 예정 집회까지 전체 내역</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-[11px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3 px-6">집회 일시</th>
                    <th class="py-3 px-4">구분</th>
                    <th class="py-3 px-6">집회명 / 주제</th>
                    <th class="py-3 px-4">설교 영상</th>
                    <th class="py-3 px-6 text-center">진행 상태</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-xs">
                <?php if(empty($history)): ?>
                <tr>
                    <td colspan="5" class="py-12 text-center text-gray-400">등록된 집회 인도 내역이 없습니다.</td>
                </tr>
                <?php else: ?>
                <?php foreach($history as $h): ?>
                <?php 
                    $isPast = strtotime($h['event_date']) < strtotime(date('Y-m-d'));
                ?>
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="py-4 px-6 font-bold text-gray-900">
                        <div><?= $h['event_date'] ?></div>
                        <div class="text-gray-400 font-normal text-[11px]"><?= htmlspecialchars($h['event_time']) ?></div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold <?= $h['is_special'] ? 'bg-red-50 text-red-700 border border-red-200' : 'bg-blue-50 text-blue-700 border border-blue-200' ?>">
                            <?= htmlspecialchars($h['service_type'] ?? '정기예배') ?>
                        </span>
                    </td>
                    <td class="py-4 px-6">
                        <div class="text-sm font-bold text-gray-900"><?= htmlspecialchars($h['title']) ?></div>
                        <?php if(!empty($h['description'])): ?>
                            <div class="text-gray-500 text-[11px] mt-0.5"><?= htmlspecialchars($h['description']) ?></div>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-4">
                        <?php if(!empty($h['youtube_url'])): ?>
                            <a href="<?= htmlspecialchars($h['youtube_url']) ?>" target="_blank" class="inline-flex items-center space-x-1 text-red-600 hover:text-red-800 font-semibold bg-red-50 px-2.5 py-1 rounded-lg border border-red-200">
                                <span>▶ 유튜브 설교</span>
                            </a>
                        <?php else: ?>
                            <span class="text-gray-300">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold <?= $isPast ? 'bg-gray-100 text-gray-600' : 'bg-green-50 text-green-700 border border-green-200' ?>">
                            <?= $isPast ? '인도 완료' : '예정 집회' ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>