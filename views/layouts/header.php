<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>감림산기도원 - 말씀과 기도로 회복되는 은혜의 동산</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#1a365d',
                        gold: '#d4a017',
                        cream: '#faf7f2',
                    },
                    fontFamily: {
                        sans: ['Noto Sans KR', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="bg-cream font-sans text-gray-800">

<!-- 상단 알림 바 -->
<div class="bg-navy text-white py-2 text-xs md:text-sm overflow-hidden whitespace-nowrap">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="truncate">
            <span class="text-gold font-bold mr-2">[오늘의 말씀]</span>
            <span><?= htmlspecialchars(defined('DAILY_VERSE') ? DAILY_VERSE : '수고하고 무거운 짐 진 자들아 다 내게로 오라 내가 너희를 쉬게 하리라 (마 11:28)') ?></span>
        </div>
        <div class="hidden md:flex items-center space-x-3 text-xs flex-shrink-0 ml-4">
            <?php if(isset($_SESSION['user_id'])): ?>
                <span><strong class="text-gold"><?= htmlspecialchars($_SESSION['user_name']) ?></strong> 성도님</span>
                <a href="/logout" class="text-gray-300 hover:text-white">로그아웃</a>
            <?php else: ?>
                <a href="/login" class="text-gray-300 hover:text-white">성도 로그인</a>
                <span class="text-gray-600">|</span>
                <a href="/register" class="text-gold font-bold hover:underline">회원가입 (안내수신 동의)</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- 로고 -->
        <a href="/" class="flex items-center text-navy font-bold text-xl md:text-2xl">
            <div class="w-8 h-8 rounded-lg bg-navy text-gold flex items-center justify-center font-bold mr-2 text-lg shadow-sm">
                ✝
            </div>
            감림산기도원
        </a>

        <!-- 데스크탑 GNB -->
        <nav class="hidden md:flex space-x-6 text-sm font-medium">
            <a href="/" class="hover:text-gold transition">홈</a>
            <a href="/about" class="hover:text-gold transition font-semibold text-navy">기도원소개</a>
            <a href="/#worship" class="hover:text-gold transition">연중예배·집회</a>
            <a href="/rental" class="hover:text-gold transition">행사대관</a>
            <a href="/stay" class="hover:text-gold transition">숙소예약</a>
            <a href="/prayer" class="hover:text-gold transition">중보기도</a>
            <a href="/#partners" class="hover:text-gold transition">동역기관</a>
            <a href="/guide" class="hover:text-gold transition">오시는 길</a>
        </nav>

        <div class="flex items-center space-x-3">
            <!-- 기도원 문의 직통전화 버튼 -->
            <a href="tel:055-374-4111" class="hidden md:inline-flex items-center space-x-1.5 bg-navy text-white px-4 py-2 rounded-full text-xs font-semibold hover:bg-navy-800 transition shadow-sm">
                <svg class="w-3.5 h-3.5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                <span>문의 055-374-4111</span>
            </a>
            
            <!-- 모바일 햄버거 메뉴 -->
            <button id="mobile-menu-btn" class="md:hidden text-navy focus:outline-none p-1 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- 모바일 메뉴 패널 -->
    <div id="mobile-menu-panel" class="hidden md:hidden bg-white border-t border-gray-100">
        <a href="/" class="block px-4 py-3 border-b text-navy font-medium">홈</a>
        <a href="/about" class="block px-4 py-3 border-b text-navy font-bold bg-cream/60">📖 기도원 소개 (58년 역사·원장·원목)</a>
        <a href="/#worship" class="block px-4 py-3 border-b text-navy font-medium">✝ 연중예배·집회 안내</a>
        <a href="/rental" class="block px-4 py-3 border-b text-navy font-medium">교회·기관 행사대관</a>
        <a href="/stay" class="block px-4 py-3 border-b text-navy font-medium">개인·가족 숙소예약</a>
        <a href="/prayer" class="block px-4 py-3 border-b text-navy font-medium">중보기도 요청</a>
        <a href="/#partners" class="block px-4 py-3 border-b text-navy font-medium">동역기관 (오병이어캠프·혜성원)</a>
        <a href="/guide" class="block px-4 py-3 border-b text-navy font-medium">오시는 길 / 이용안내</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <div class="px-4 py-3 bg-gray-50 flex justify-between items-center">
                <span class="text-sm font-bold text-navy"><?= htmlspecialchars($_SESSION['user_name']) ?> 성도님</span>
                <a href="/logout" class="text-xs text-red-600 font-semibold">로그아웃</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-2 gap-2 p-3 bg-gray-50 border-b">
                <a href="/login" class="text-center py-2 bg-white border border-gray-200 rounded-lg text-xs font-semibold text-navy">로그인</a>
                <a href="/register" class="text-center py-2 bg-gold text-white rounded-lg text-xs font-bold shadow-sm">회원가입</a>
            </div>
        <?php endif; ?>
        <a href="tel:055-374-4111" class="block px-4 py-3 text-navy font-bold">대표 문의 055-374-4111</a>
    </div>
</header>

<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">