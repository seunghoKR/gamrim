<?php
if(session_status()===PHP_SESSION_NONE){session_start();}
$_SESSION["csrf_token"] = isset($_SESSION["csrf_token"]) ? $_SESSION["csrf_token"] : bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>관리자 로그인 - 감림산기도원</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
<style>body{font-family:"Noto Sans KR",sans-serif}</style>
</head>
<body class="bg-blue-900 min-h-screen flex items-center justify-center p-4">
<div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
<div class="text-center mb-8">
<div class="inline-flex items-center justify-center w-16 h-16 bg-blue-900 rounded-full mb-4">
<span class="text-yellow-400 text-3xl font-bold">✝</span>
</div>
<h1 class="text-2xl font-bold text-blue-900">감림산기도원</h1>
<p class="text-gray-500 text-sm mt-1">관리자 시스템</p>
</div>
<?php if(isset($_GET["error"])): ?>
<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm text-center">
⚠️ 아이디 또는 비밀번호를 확인해주세요.
</div>
<?php endif; ?>
<?php if(isset($_GET["logout"])): ?>
<div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm text-center">
✅ 로그아웃 되었습니다.
</div>
<?php endif; ?>
<form method="POST" action="/admin/login">
<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
<div class="mb-4">
<label class="block text-sm font-medium text-gray-700 mb-2">아이디</label>
<input type="text" name="username" required autofocus
  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 text-sm"
  placeholder="관리자 아이디">
</div>
<div class="mb-6">
<label class="block text-sm font-medium text-gray-700 mb-2">비밀번호</label>
<input type="password" name="password" required
  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 text-sm"
  placeholder="비밀번호">
</div>
<button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors duration-200">
로그인
</button>
</form>
<div class="text-center mt-6">
<a href="/" class="text-sm text-gray-400 hover:text-blue-900 transition-colors">← 메인 사이트로 돌아가기</a>
</div>
</div>
</body>
</html>