<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<div class="mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">🏛️ 대관 시설 및 갤러리 관리</h2>
            <p class="text-sm text-gray-500 mt-1">대성전, 벧엘성전, 세미나실, 식당의 제원 수정 및 <strong>사진 드래그앤드롭 업로드·순서 변경</strong>을 관리합니다.</p>
        </div>
    </div>
</div>

<div class="space-y-8">
    <?php foreach($facilities as $f): ?>
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <!-- 시설 기본 정보 헤더 -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/70 flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center space-x-3">
                <span class="text-xs font-mono font-bold px-2.5 py-1 rounded-lg bg-navy text-white"><?= htmlspecialchars($f['code']) ?></span>
                <h3 class="text-lg font-bold text-gray-900"><?= htmlspecialchars($f['name']) ?></h3>
                <span class="text-xs text-gray-500">수용인원: <strong><?= number_format($f['capacity']) ?>석</strong></span>
            </div>
            <div>
                <span class="text-xs px-2.5 py-1 rounded-full font-semibold <?= $f['is_active'] ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-100 text-gray-500' ?>">
                    <?= $f['is_active'] ? '대관 가능' : '점검중' ?>
                </span>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- 좌측: 시설 스펙 및 안내 수정 폼 (5열) -->
            <form method="POST" action="/admin/facilities/update" class="lg:col-span-5 space-y-4 text-xs">
                <input type="hidden" name="facility_id" value="<?= $f['facility_id'] ?>">
                <input type="hidden" name="code" value="<?= htmlspecialchars($f['code']) ?>">
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">시설명</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($f['name']) ?>" required class="w-full px-3 py-2 border rounded-xl text-xs">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">수용 인원 (석)</label>
                        <input type="number" name="capacity" value="<?= $f['capacity'] ?>" required class="w-full px-3 py-2 border rounded-xl text-xs">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-gray-600 mb-1">시설 장비 및 스펙 (LED, 음향 등)</label>
                    <textarea name="specs" rows="3" class="w-full px-3 py-2 border rounded-xl text-xs"><?= htmlspecialchars($f['specs']) ?></textarea>
                </div>

                <div>
                    <label class="block font-semibold text-gray-600 mb-1">대관 이용 안내 수칙</label>
                    <textarea name="usage_guide" rows="2" class="w-full px-3 py-2 border rounded-xl text-xs"><?= htmlspecialchars($f['usage_guide'] ?? '') ?></textarea>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="is_active" id="act_<?= $f['facility_id'] ?>" value="1" <?= $f['is_active'] ? 'checked' : '' ?> class="rounded text-navy-700">
                        <label for="act_<?= $f['facility_id'] ?>" class="text-xs font-semibold text-gray-600">대관 운영 활성화</label>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-navy-700 hover:bg-navy-800 text-white font-bold rounded-xl text-xs transition">
                        기본정보 저장
                    </button>
                </div>
            </form>

            <!-- 우측: 드래그앤드롭 다중 이미지 업로드 & 순서 변경 갤러리 (7열) -->
            <div class="lg:col-span-7 bg-gray-50/50 p-5 rounded-2xl border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-base">📸</span>
                            <h4 class="text-sm font-bold text-gray-900">시설 갤러리 (마우스 드래그로 순서 변경)</h4>
                        </div>
                        <span class="text-[11px] text-gray-400">총 <?= count($f['images'] ?? []) ?>장</span>
                    </div>

                    <!-- 드래그 정렬 갤러리 그리드 -->
                    <div id="gallery_<?= $f['facility_id'] ?>" class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4 min-h-[100px] p-2 bg-white rounded-xl border border-dashed border-gray-200">
                        <?php if(empty($f['images'])): ?>
                            <div class="col-span-full py-8 text-center text-gray-400 text-xs empty-msg">
                                등록된 사진이 없습니다. 아래에서 사진을 추가하세요.
                            </div>
                        <?php else: ?>
                            <?php foreach($f['images'] as $img): ?>
                            <div class="relative group rounded-xl overflow-hidden shadow-sm border border-gray-200 cursor-move bg-gray-100 aspect-video" data-id="<?= $img['id'] ?>">
                                <img src="<?= htmlspecialchars($img['image_url']) ?>" class="w-full h-full object-cover select-none">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center space-x-2">
                                    <span class="text-white text-xs font-bold bg-black/60 px-2 py-0.5 rounded">드래그이동</span>
                                    <button onclick="deleteImage(<?= $img['id'] ?>)" type="button" class="p-1 bg-red-600 text-white rounded-full hover:bg-red-700 transition" title="삭제">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 파일 드래그 앤 드롭 업로드 폼 -->
                <form action="/admin/facilities/upload-image" method="POST" enctype="multipart/form-data" class="pt-3 border-t border-gray-200/60 flex items-center space-x-2">
                    <input type="hidden" name="facility_id" value="<?= $f['facility_id'] ?>">
                    <input type="file" name="images[]" multiple accept="image/*" required class="flex-1 text-xs file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-navy-700 file:text-white file:font-semibold hover:file:bg-navy-800 cursor-pointer">
                    <button type="submit" class="px-3.5 py-1.5 bg-gold hover:bg-yellow-500 text-navy-950 font-bold rounded-lg text-xs transition flex-shrink-0">
                        사진 업로드
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
// Sortable.js 순서 변경 초기화
document.addEventListener('DOMContentLoaded', function() {
    <?php foreach($facilities as $f): ?>
    const el_<?= $f['facility_id'] ?> = document.getElementById('gallery_<?= $f['facility_id'] ?>');
    if (el_<?= $f['facility_id'] ?>) {
        new Sortable(el_<?= $f['facility_id'] ?>, {
            animation: 150,
            ghostClass: 'opacity-40',
            onEnd: function(evt) {
                const items = el_<?= $f['facility_id'] ?>.querySelectorAll('[data-id]');
                const order = Array.from(items).map(item => item.getAttribute('data-id'));
                
                fetch('/admin/facilities/reorder-images', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: JSON.stringify({ order: order })
                }).then(res => res.json()).then(data => {
                    if(data.success) {
                        console.log('순서 저장 완료:', order);
                    }
                });
            }
        });
    }
    <?php endforeach; ?>
});

function deleteImage(id) {
    if(!confirm('이 이미지를 삭제하시겠습니까?')) return;
    const form = new FormData();
    form.append('image_id', id);
    fetch('/admin/facilities/delete-image', {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        body: form
    }).then(() => location.reload());
}
</script>