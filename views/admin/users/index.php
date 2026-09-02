<div class="mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">👥 회원·상담 & 그룹 관리</h2>
                <span class="bg-amber-100 text-amber-800 text-xs px-2.5 py-0.5 rounded-full font-bold">개발자 전용</span>
            </div>
            <p class="text-sm text-gray-500 mt-1">개발자 대표님이 사이트 관리자 및 강사, 성도의 <strong>소속 그룹</strong>을 지정하고, 상담이 필요한 회원을 관리합니다.</p>
        </div>
    </div>
</div>

<!-- 검색 및 그룹 필터 바 -->
<div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm mb-6 flex flex-col md:flex-row gap-3 justify-between items-center">
    <form method="GET" action="/admin/users" class="flex flex-wrap gap-2 w-full md:w-auto">
        <select name="role" class="px-3 py-2 border rounded-xl text-xs bg-white font-bold">
            <option value="">-- 전체 소속 그룹 --</option>
            <option value="DEVELOPER" <?= $filterRole === 'DEVELOPER' ? 'selected' : '' ?>>개발자 그룹 (DEVELOPER)</option>
            <option value="SUPER_ADMIN" <?= $filterRole === 'SUPER_ADMIN' ? 'selected' : '' ?>>총괄 관리자 그룹 (SUPER_ADMIN)</option>
            <option value="MANAGER" <?= $filterRole === 'MANAGER' ? 'selected' : '' ?>>운영자 그룹 (MANAGER)</option>
            <option value="SPEAKER" <?= $filterRole === 'SPEAKER' ? 'selected' : '' ?>>🎙️ 강사(설교자) 그룹 (SPEAKER)</option>
            <option value="COUNSELOR" <?= $filterRole === 'COUNSELOR' ? 'selected' : '' ?>>상담관 그룹 (COUNSELOR)</option>
            <option value="VIP_MEMBER" <?= $filterRole === 'VIP_MEMBER' ? 'selected' : '' ?>>우수 성도/단체 그룹 (VIP_MEMBER)</option>
            <option value="MEMBER" <?= $filterRole === 'MEMBER' ? 'selected' : '' ?>>일반 성도 그룹 (MEMBER)</option>
            <option value="VISITOR" <?= $filterRole === 'VISITOR' ? 'selected' : '' ?>>방문자 그룹 (VISITOR)</option>
        </select>

        <select name="consult_status" class="px-3 py-2 border rounded-xl text-xs bg-white font-semibold">
            <option value="">-- 상담 필요 상태 --</option>
            <option value="대관상담필요" <?= $filterConsult === '대관상담필요' ? 'selected' : '' ?>>🏛️ 대관 상담 필요</option>
            <option value="숙소상담필요" <?= $filterConsult === '숙소상담필요' ? 'selected' : '' ?>>🛏️ 숙소 상담 필요</option>
            <option value="일반상담필요" <?= $filterConsult === '일반상담필요' ? 'selected' : '' ?>>💬 일반 상담 필요</option>
            <option value="상담완료" <?= $filterConsult === '상담완료' ? 'selected' : '' ?>>✅ 상담 완료</option>
        </select>

        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="이름/아이디/교회/전화번호" class="px-3 py-2 border rounded-xl text-xs w-48">
        <button type="submit" class="px-4 py-2 bg-navy-700 text-white rounded-xl text-xs font-bold">검색</button>
        <a href="/admin/users" class="px-3 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs">초기화</a>
    </form>
    <div class="text-xs text-gray-500">
        조회된 인원: <strong><?= count($users) ?></strong>명
    </div>
</div>

<!-- 회원/강사 통합 목록 테이블 -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-[11px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                    <th class="py-3 px-6">회원(강사) 정보</th>
                    <th class="py-3 px-4">소속 교회</th>
                    <th class="py-3 px-4">연락처</th>
                    <th class="py-3 px-4">안내 수신동의</th>
                    <th class="py-3 px-4">상담 요청 상태</th>
                    <th class="py-3 px-4">소속 그룹 (개발자 지정)</th>
                    <th class="py-3 px-6 text-right">그룹 변경</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-xs">
                <?php if(empty($users)): ?>
                <tr>
                    <td colspan="7" class="py-12 text-center text-gray-400">등록된 회원/강사 데이터가 없습니다.</td>
                </tr>
                <?php else: ?>
                <?php foreach($users as $u): ?>
                <tr class="hover:bg-gray-50/50 transition <?= $u['role'] === 'SPEAKER' ? 'bg-amber-50/20' : '' ?>">
                    <td class="py-4 px-6 font-bold text-gray-900">
                        <div class="text-sm font-bold flex items-center space-x-1.5">
                            <span><?= htmlspecialchars($u['name']) ?></span>
                            <?php if($u['role'] === 'DEVELOPER'): ?>
                                <span class="px-1.5 py-0.5 bg-purple-100 text-purple-800 text-[10px] rounded font-bold">DEV</span>
                            <?php elseif($u['role'] === 'SPEAKER'): ?>
                                <span class="px-1.5 py-0.5 bg-amber-100 text-amber-900 text-[10px] rounded font-bold">강사</span>
                            <?php endif; ?>
                        </div>
                        <div class="text-gray-400 text-[11px] font-mono">@<?= htmlspecialchars($u['username']) ?></div>
                    </td>
                    <td class="py-4 px-4 text-navy-800 font-medium">
                        <?= htmlspecialchars($u['church_name'] ?: '미입력') ?>
                    </td>
                    <td class="py-4 px-4 font-mono text-gray-700 font-bold">
                        <?= htmlspecialchars($u['phone']) ?>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex flex-wrap gap-1 text-[10px]">
                            <span class="px-2 py-0.5 rounded font-semibold <?= $u['agree_notice_event'] ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-400' ?>">집회</span>
                            <span class="px-2 py-0.5 rounded font-semibold <?= $u['agree_notice_rental'] ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-400' ?>">대관</span>
                            <span class="px-2 py-0.5 rounded font-semibold <?= $u['agree_notice_stay'] ? 'bg-amber-50 text-amber-700' : 'bg-gray-100 text-gray-400' ?>">숙소</span>
                        </div>
                    </td>
                    <form method="POST" action="/admin/users/update-role">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <td class="py-4 px-4">
                            <select name="consult_status" class="px-2.5 py-1.5 border rounded-lg text-xs bg-white font-semibold">
                                <option value="NONE" <?= $u['consult_status'] === 'NONE' ? 'selected' : '' ?>>상담 없음</option>
                                <option value="대관상담필요" <?= $u['consult_status'] === '대관상담필요' ? 'selected' : '' ?>>🏛️ 대관상담필요</option>
                                <option value="숙소상담필요" <?= $u['consult_status'] === '숙소상담필요' ? 'selected' : '' ?>>🛏️ 숙소상담필요</option>
                                <option value="일반상담필요" <?= $u['consult_status'] === '일반상담필요' ? 'selected' : '' ?>>💬 일반상담필요</option>
                                <option value="상담완료" <?= $u['consult_status'] === '상담완료' ? 'selected' : '' ?>>✅ 상담완료</option>
                            </select>
                        </td>
                        <td class="py-4 px-4">
                            <select name="role" class="px-2.5 py-1.5 border rounded-lg text-xs bg-white font-bold text-navy-900">
                                <option value="DEVELOPER" <?= $u['role'] === 'DEVELOPER' ? 'selected' : '' ?>>개발자 그룹 (DEVELOPER)</option>
                                <option value="SUPER_ADMIN" <?= $u['role'] === 'SUPER_ADMIN' ? 'selected' : '' ?>>총괄 관리자 그룹 (SUPER_ADMIN)</option>
                                <option value="MANAGER" <?= $u['role'] === 'MANAGER' ? 'selected' : '' ?>>운영자 그룹 (MANAGER)</option>
                                <option value="SPEAKER" <?= $u['role'] === 'SPEAKER' ? 'selected' : '' ?>>🎙️ 강사(설교자) 그룹 (SPEAKER)</option>
                                <option value="COUNSELOR" <?= $u['role'] === 'COUNSELOR' ? 'selected' : '' ?>>상담관 그룹 (COUNSELOR)</option>
                                <option value="VIP_MEMBER" <?= $u['role'] === 'VIP_MEMBER' ? 'selected' : '' ?>>우수 성도/단체 그룹 (VIP_MEMBER)</option>
                                <option value="MEMBER" <?= $u['role'] === 'MEMBER' ? 'selected' : '' ?>>일반 성도 그룹 (MEMBER)</option>
                                <option value="VISITOR" <?= $u['role'] === 'VISITOR' ? 'selected' : '' ?>>방문자 그룹 (VISITOR)</option>
                            </select>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button type="submit" class="px-3 py-1.5 bg-navy-700 hover:bg-navy-800 text-white rounded-lg text-xs font-bold transition">
                                그룹 저장
                            </button>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>