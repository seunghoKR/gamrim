<div class="mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">통합 사역 현황판</h2>
            <p class="text-sm text-gray-500 mt-1">대관, 숙소 예약, 강사 사역, 중보기도, 상담 요청을 종합 모니터링합니다.</p>
        </div>
        <div class="flex space-x-2">
            <a href="/admin/services" class="px-3.5 py-2 bg-navy-700 hover:bg-navy-800 text-white rounded-xl text-xs font-bold shadow transition flex items-center space-x-1.5">
                <span>📅 집회 일정 등록</span>
            </a>
            <a href="/admin/rooms-manage" class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold shadow transition flex items-center space-x-1.5">
                <span>🛏️ 객실 청소/점검</span>
            </a>
        </div>
    </div>
</div>

<!-- 4대 핵심 사역 지표 카드 -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <!-- 오늘 대관 접수 -->
    <a href="/admin/rental" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center justify-between hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">오늘 대관 신청</p>
            <p class="text-3xl font-extrabold text-navy-900 mt-2"><?= number_format((int)($stats['rentals'] ?? 0)) ?><span class="text-sm font-normal text-gray-400 ml-1">건</span></p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
            🏛️
        </div>
    </a>

    <!-- 오늘 객실 예약 -->
    <a href="/admin/rooms" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center justify-between hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">오늘 숙소 예약</p>
            <p class="text-3xl font-extrabold text-navy-900 mt-2"><?= number_format((int)($stats['bookings'] ?? 0)) ?><span class="text-sm font-normal text-gray-400 ml-1">건</span></p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-xl">
            🛏️
        </div>
    </a>

    <!-- 미답변 중보기도 -->
    <a href="/admin/prayer" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center justify-between hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">미처리 중보기도</p>
            <p class="text-3xl font-extrabold text-red-600 mt-2"><?= number_format((int)($stats['prayers'] ?? 0)) ?><span class="text-sm font-normal text-gray-400 ml-1">건</span></p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center text-xl">
            🙏
        </div>
    </a>

    <!-- 상담 필요 회원 -->
    <a href="/admin/users?consult_status=대관상담필요" class="bg-white rounded-2xl border border-amber-200 bg-amber-50/20 shadow-sm p-6 flex items-center justify-between hover:shadow-md transition">
        <div>
            <p class="text-xs font-semibold text-amber-700 uppercase tracking-wider">대관/숙소 상담 요청</p>
            <p class="text-3xl font-extrabold text-amber-600 mt-2"><?= number_format((int)($stats['consults'] ?? 0)) ?><span class="text-sm font-normal text-gray-400 ml-1">명</span></p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-xl font-bold">
            👥
        </div>
    </a>
</div>

<!-- 상세 목록 2열 그리드 -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- 최근 대관 신청 현황 -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-base font-bold text-gray-900 flex items-center space-x-2">
                <span>🏛️ 최근 대관 신청 현황</span>
            </h3>
            <a href="/admin/rental" class="text-xs text-blue-600 hover:text-blue-800 font-semibold">대관 일정표 &rarr;</a>
        </div>
        <div class="p-6 flex-1 divide-y divide-gray-100">
            <?php if(empty($recentRentals)): ?>
                <div class="text-center py-8 text-gray-400 text-sm">접수된 대관 신청이 없습니다.</div>
            <?php else: ?>
                <?php foreach($recentRentals as $r): ?>
                <div class="py-3 first:pt-0 last:pb-0 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-900"><?= htmlspecialchars($r['org_name'] ?: $r['applicant_name']) ?></p>
                        <p class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars($r['facility_name'] ?? '시설') ?> | <?= $r['start_date'] ?> ~ <?= $r['end_date'] ?></p>
                    </div>
                    <div>
                        <?php
                            $st = $r['status'];
                            $badge = match($st) {
                                '심사승인' => 'bg-blue-50 text-blue-700 border-blue-200',
                                '확정완료' => 'bg-green-50 text-green-700 border-green-200',
                                '반려' => 'bg-red-50 text-red-700 border-red-200',
                                '취소' => 'bg-gray-50 text-gray-700 border-gray-200',
                                default => 'bg-amber-50 text-amber-700 border-amber-200',
                            };
                        ?>
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full border <?= $badge ?>"><?= $st ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- 최근 숙소 예약 현황 -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-base font-bold text-gray-900 flex items-center space-x-2">
                <span>🛏️ 최근 숙소 예약 현황</span>
            </h3>
            <a href="/admin/rooms" class="text-xs text-blue-600 hover:text-blue-800 font-semibold">룸 랙 보기 &rarr;</a>
        </div>
        <div class="p-6 flex-1 divide-y divide-gray-100">
            <?php if(empty($recentBookings)): ?>
                <div class="text-center py-8 text-gray-400 text-sm">접수된 객실 예약이 없습니다.</div>
            <?php else: ?>
                <?php foreach($recentBookings as $b): ?>
                <div class="py-3 first:pt-0 last:pb-0 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-900"><?= htmlspecialchars($b['guest_name']) ?> <span class="text-xs text-gray-400 font-normal">(<?= htmlspecialchars($b['church_name'] ?? '성도') ?>)</span></p>
                        <p class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars($b['room_number'] ?? '객실') ?> | <?= $b['checkin_date'] ?> 입실</p>
                    </div>
                    <div>
                        <?php
                            $bst = $b['status'];
                            $bBadge = match($bst) {
                                '예약확정' => 'bg-green-50 text-green-700 border-green-200',
                                '입실완료' => 'bg-blue-50 text-blue-700 border-blue-200',
                                '퇴실완료' => 'bg-gray-50 text-gray-700 border-gray-200',
                                '취소' => 'bg-red-50 text-red-700 border-red-200',
                                default => 'bg-amber-50 text-amber-700 border-amber-200',
                            };
                        ?>
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full border <?= $bBadge ?>"><?= $bst ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- 하단: 미답변 중보기도 및 바로가기 -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h3 class="text-base font-bold text-gray-900 flex items-center space-x-2">
            <span>🙏 성도 미답변 중보기도 요청</span>
        </h3>
        <a href="/admin/prayer" class="text-xs text-blue-600 hover:text-blue-800 font-semibold">기도 우체통 전체보기 &rarr;</a>
    </div>
    <div class="p-6 divide-y divide-gray-100">
        <?php if(empty($pendingPrayers)): ?>
            <div class="text-center py-8 text-gray-400 text-sm">미처리된 중보기도 요청이 없습니다. 🙏</div>
        <?php else: ?>
            <?php foreach($pendingPrayers as $p): ?>
            <div class="py-3 first:pt-0 last:pb-0 flex items-center justify-between">
                <div class="pr-4">
                    <p class="text-sm font-bold text-gray-900"><?= htmlspecialchars($p['title']) ?></p>
                    <p class="text-xs text-gray-500 mt-1 line-clamp-1"><?= htmlspecialchars(mb_substr($p['content'], 0, 80)) ?>...</p>
                    <p class="text-[11px] text-gray-400 mt-1"><?= htmlspecialchars($p['author_name']) ?> 성도님 | 접수일: <?= $p['created_at'] ?></p>
                </div>
                <a href="/admin/prayer" class="flex-shrink-0 px-3 py-1.5 bg-navy-700 text-white rounded-lg text-xs font-medium hover:bg-navy-800 transition">기도 답변 작성</a>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>