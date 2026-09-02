<?php require_once ROOT_PATH . '/views/layouts/header.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<div class="bg-cream py-8">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-navy">대관 현황 캘린더</h1>
            
            <div class="mt-4 md:mt-0 flex items-center gap-4">
                <select id="facility-select" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-navy focus:border-navy bg-white">
                    <option value="all">전체 시설 보기</option>
                    <option value="1">대성전</option>
                    <option value="2">벧엘성전</option>
                    <option value="3">세미나실</option>
                    <option value="4">구내식당</option>
                </select>
                <a href="/rental/apply" class="bg-navy text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-900 transition">
                    신청하기
                </a>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-2xl shadow-sm border border-gray-100">
            <!-- 범례 -->
            <div class="flex flex-wrap gap-4 mb-4 text-xs font-medium px-2">
                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-blue-500 mr-1"></span>대성전</div>
                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-green-500 mr-1"></span>벧엘성전</div>
                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-purple-500 mr-1"></span>세미나실</div>
                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-orange-500 mr-1"></span>식당</div>
            </div>

            <!-- Calendar Container -->
            <div id="rental-calendar" class="fc-custom-theme min-h-[600px]"></div>
        </div>
        
        <div class="mt-4 text-sm text-gray-500 text-center">
            * 캘린더에서 빈 날짜를 클릭하면 해당 날짜로 즉시 대관 신청이 가능합니다.
        </div>
    </div>
</div>

<script src="/assets/js/rental-calendar.js"></script>
<?php require_once ROOT_PATH . '/views/layouts/footer.php'; ?>
