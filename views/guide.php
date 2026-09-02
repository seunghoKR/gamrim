<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>

<div class="bg-navy py-12">
    <div class="container mx-auto px-4 text-center text-white">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">처음 오셨나요?</h1>
        <p class="text-gray-300">감림산기도원 이용에 대한 모든 궁금증을 해결해 드립니다.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12 max-w-4xl">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 mb-12">
        <h2 class="text-2xl font-bold text-navy mb-8 border-b pb-4">자주 묻는 질문 (FAQ)</h2>
        
        <div class="space-y-4">
            <!-- FAQ 1 -->
            <div class="accordion-item border border-gray-200 rounded-lg overflow-hidden">
                <button class="accordion-header w-full px-6 py-4 text-left bg-gray-50 hover:bg-gray-100 transition flex justify-between items-center focus:outline-none">
                    <span class="font-bold text-gray-800">교통 및 셔틀버스는 어떻게 이용하나요?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="accordion-content hidden px-6 py-4 bg-white text-gray-600 text-sm leading-relaxed">
                    <p class="mb-4">양산역(2번 출구)과 부산 노포역에서 정기 셔틀버스를 운행하고 있습니다.</p>
                    <div class="overflow-x-auto">
                        <div class="bg-gray-50 p-4 rounded-xl text-sm space-y-2 text-left"><p><strong>🚗 자가용:</strong> 네비게이션에 "감림산기도원" 또는 "경남 양산시 상북면 삼감중앙길 48" 검색</p><p><strong>🚌 대중교통:</strong> 양산역(2호선) 또는 노포역(1호선)에서 하차 후 상북면 방면 시내버스 탑승 또는 택시 이용 (약 15분 소요)</p><p><strong>📞 길안내 문의:</strong> 055-374-4111</p></div>
                    </div>
                    <div class="mt-4">
                        <a href="https://map.kakao.com/link/to/감림산기도원,35.437,129.053" target="_blank" class="inline-flex items-center text-navy font-semibold hover:text-gold">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg> 카카오맵 길찾기
                        </a>
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="accordion-item border border-gray-200 rounded-lg overflow-hidden">
                <button class="accordion-header w-full px-6 py-4 text-left bg-gray-50 hover:bg-gray-100 transition flex justify-between items-center focus:outline-none">
                    <span class="font-bold text-gray-800">기도원 내 복장 규정이 있나요?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="accordion-content hidden px-6 py-4 bg-white text-gray-600 text-sm leading-relaxed">
                    <p>하나님께 예배드리는 거룩한 장소이므로 단정하고 건전한 복장을 착용해 주시기 바랍니다. 노출이 심한 옷이나 슬리퍼 착용은 성전 출입 시 제한될 수 있습니다.</p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="accordion-item border border-gray-200 rounded-lg overflow-hidden">
                <button class="accordion-header w-full px-6 py-4 text-left bg-gray-50 hover:bg-gray-100 transition flex justify-between items-center focus:outline-none">
                    <span class="font-bold text-gray-800">식사는 어떻게 해결하나요?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="accordion-content hidden px-6 py-4 bg-white text-gray-600 text-sm leading-relaxed">
                    <p>구내식당에서 매끼 정성껏 준비한 식사를 제공합니다. 식권은 안내데스크 또는 식당 입구 무인 발권기에서 구매 가능합니다. (조식: 07:00~08:00, 중식: 12:00~13:00, 석식: 17:30~18:30)</p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="accordion-item border border-gray-200 rounded-lg overflow-hidden">
                <button class="accordion-header w-full px-6 py-4 text-left bg-gray-50 hover:bg-gray-100 transition flex justify-between items-center focus:outline-none">
                    <span class="font-bold text-gray-800">준비물이 필요한가요?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="accordion-content hidden px-6 py-4 bg-white text-gray-600 text-sm leading-relaxed">
                    <p>개인 성경책, 찬송가, 필기도구, 개인 세면도구(수건 포함)를 준비해 오시기 바랍니다. 산간 지역이므로 계절에 맞는 여벌 옷(겉옷)을 준비하시면 좋습니다.</p>
                </div>
            </div>
            
             <!-- FAQ 5 -->
             <div class="accordion-item border border-gray-200 rounded-lg overflow-hidden">
                <button class="accordion-header w-full px-6 py-4 text-left bg-gray-50 hover:bg-gray-100 transition flex justify-between items-center focus:outline-none">
                    <span class="font-bold text-gray-800">금식기도 안내</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="accordion-content hidden px-6 py-4 bg-white text-gray-600 text-sm leading-relaxed">
                    <p>금식기도를 원하시는 분은 체크인 시 반드시 안내데스크에 말씀해 주시고, 보호자 연락처를 남겨주셔야 합니다. 장기 금식의 경우 원장님과의 사전 상담이 필요합니다.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Accordion Logic
document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll('.accordion-header');
    headers.forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const icon = header.querySelector('svg');
            
            // Toggle current
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });
});
</script>

<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
