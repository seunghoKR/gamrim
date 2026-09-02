<h1 class="text-2xl font-semibold text-gray-800 mb-6">중보기도 요청 관리</h1>

<div class="mb-6 border-b border-gray-200">
    <nav class="-mb-px flex space-x-8">
        <a href="#" class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">전체</a>
        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">접수</a>
        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">기도중</a>
        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">응답완료</a>
    </nav>
</div>

<div class="space-y-4">
    <?php foreach($prayerList ?? [] as $prayer): ?>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900"><?= htmlspecialchars($prayer['title']) ?></h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500"><?= htmlspecialchars($prayer['requester_name']) ?> | <?= htmlspecialchars($prayer['contact']) ?> | <?= $prayer['created_at'] ?></p>
            </div>
            <div>
                <?php if($prayer['status'] === '접수'): ?>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">접수</span>
                <?php elseif($prayer['status'] === '기도중'): ?>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">기도중</span>
                <?php else: ?>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">응답완료</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
            <p class="text-gray-700 whitespace-pre-wrap mb-4"><?= htmlspecialchars($prayer['content']) ?></p>
            
            <div class="mt-4 flex space-x-2">
                <?php if($prayer['status'] === '접수'): ?>
                <button onclick="updateStatus(<?= $prayer['request_id'] ?>, '기도중')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                    기도 시작
                </button>
                <?php endif; ?>
                
                <?php if($prayer['status'] !== '응답완료'): ?>
                <button onclick="toggleReplyForm(<?= $prayer['request_id'] ?>)" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                    답변 작성
                </button>
                <?php endif; ?>
            </div>

            <div id="replyForm_<?= $prayer['request_id'] ?>" class="hidden mt-4 bg-gray-50 p-4 rounded-md">
                <textarea id="replyContent_<?= $prayer['request_id'] ?>" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="응답 내용을 입력하세요..."><?= htmlspecialchars($prayer['reply'] ?? '') ?></textarea>
                <div class="mt-3 flex justify-end">
                    <button onclick="submitReply(<?= $prayer['request_id'] ?>)" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none">
                        응답완료 처리
                    </button>
                </div>
            </div>
            
            <?php if($prayer['status'] === '응답완료' && !empty($prayer['reply'])): ?>
            <div class="mt-4 bg-blue-50 p-4 rounded-md">
                <h4 class="text-sm font-medium text-blue-900 mb-1">응답 내용:</h4>
                <p class="text-sm text-blue-800 whitespace-pre-wrap"><?= htmlspecialchars($prayer['reply']) ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
    function updateStatus(id, status) {
        if(confirm(`상태를 [${status}]로 변경하시겠습니까?`)) {
            // AJAX 통신
            alert('변경되었습니다.');
            location.reload();
        }
    }

    function toggleReplyForm(id) {
        const form = document.getElementById(`replyForm_${id}`);
        form.classList.toggle('hidden');
    }

    function submitReply(id) {
        const content = document.getElementById(`replyContent_${id}`).value;
        if(!content) {
            alert('답변 내용을 입력해주세요.');
            return;
        }
        if(confirm('응답을 저장하고 완료 처리하시겠습니까?')) {
            // AJAX POST → /admin/prayer/reply
            alert('처리되었습니다.');
            location.reload();
        }
    }
</script>
