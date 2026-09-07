<?php declare(strict_types=1);
define("ROOT_PATH", __DIR__);
ini_set("display_errors", "1");
error_reporting(E_ALL);
if(session_status() === PHP_SESSION_NONE){ session_start(); }

require_once ROOT_PATH . "/config/database.php";
require_once ROOT_PATH . "/config/settings.php";
require_once ROOT_PATH . "/core/Router.php";
require_once ROOT_PATH . "/core/Captcha.php";
require_once ROOT_PATH . "/core/KakaoAPI.php";
require_once ROOT_PATH . "/core/YouTubeSync.php";

require_once ROOT_PATH . "/models/FacilityModel.php";
require_once ROOT_PATH . "/models/RentalModel.php";
require_once ROOT_PATH . "/models/RoomModel.php";
require_once ROOT_PATH . "/models/BookingModel.php";
require_once ROOT_PATH . "/models/PrayerModel.php";
require_once ROOT_PATH . "/models/ServiceModel.php";
require_once ROOT_PATH . "/models/SpeakerModel.php";
require_once ROOT_PATH . "/models/UserModel.php";

require_once ROOT_PATH . "/controllers/HomeController.php";
require_once ROOT_PATH . "/controllers/RentalController.php";
require_once ROOT_PATH . "/controllers/StayController.php";
require_once ROOT_PATH . "/controllers/PrayerController.php";
require_once ROOT_PATH . "/controllers/AdminController.php";
require_once ROOT_PATH . "/controllers/SpeakerController.php";
require_once ROOT_PATH . "/controllers/ServiceScheduleController.php";
require_once ROOT_PATH . "/controllers/FacilityManageController.php";
require_once ROOT_PATH . "/controllers/RoomManageController.php";
require_once ROOT_PATH . "/controllers/UserManageController.php";
require_once ROOT_PATH . "/controllers/AuthController.php";

$router = new Router();

// 메인 & 소개 & 이용안내
$router->get("/", "HomeController::index");
$router->get("/about", "HomeController::about");
$router->get("/guide", "HomeController::guide");

// 회원 가입 & 로그인 & 로그아웃
$router->get("/register", "AuthController::registerForm");
$router->post("/register", "AuthController::registerSubmit");
$router->get("/login", "AuthController::loginForm");
$router->post("/login", "AuthController::loginSubmit");
$router->get("/logout", "AuthController::logout");

// 구글 캘린더 실시간 iCal 피드
$router->get("/services/ical", "ServiceScheduleController::icalFeed");

// 시설 대관 (사용자단)
$router->get("/rental", "RentalController::index");
$router->get("/rental/calendar", "RentalController::calendar");
$router->get("/rental/events-api", "RentalController::eventsApi");
$router->get("/rental/apply", "RentalController::applyForm");
$router->post("/rental/apply", "RentalController::applySubmit");

// 숙소 예약 (사용자단)
$router->get("/stay", "StayController::index");
$router->get("/stay/search", "StayController::search");
$router->post("/stay/book", "StayController::book");
$router->post("/stay/lookup", "StayController::lookup");

// 비공개 중보기도
$router->get("/prayer", "PrayerController::index");
$router->post("/prayer/submit", "PrayerController::submit");

// 관리자 포털 대시보드 및 인증
$router->get("/admin", "AdminController::dashboard");
$router->get("/admin/login", "AdminController::loginForm");
$router->post("/admin/login", "AdminController::loginSubmit");
$router->get("/admin/logout", "AdminController::logout");

// 관리자: 강사 관리 & 상세페이지
$router->get("/admin/speakers", "SpeakerController::index");
$router->get("/admin/speakers/detail", "SpeakerController::detail");
$router->post("/admin/speakers/create", "SpeakerController::create");
$router->post("/admin/speakers/update", "SpeakerController::update");
$router->post("/admin/speakers/delete", "SpeakerController::delete");

// 관리자: 연중 집회 스케줄 & 구글 캘린더
$router->get("/admin/services", "ServiceScheduleController::index");
$router->post("/admin/services/create", "ServiceScheduleController::create");
$router->post("/admin/services/delete", "ServiceScheduleController::delete");

// 관리자: 대관 시설 관리 & 다중 이미지 업로드 / 정렬
$router->get("/admin/facilities", "FacilityManageController::index");
$router->post("/admin/facilities/update", "FacilityManageController::update");
$router->post("/admin/facilities/upload-image", "FacilityManageController::uploadImage");
$router->post("/admin/facilities/reorder-images", "FacilityManageController::reorderImages");
$router->post("/admin/facilities/delete-image", "FacilityManageController::deleteImage");
$router->get("/admin/rental", "AdminController::rentalCalendar");
$router->post("/admin/rental/status", "AdminController::updateRentalStatus");

// 관리자: 숙소 정밀관리 & 룸 랙
$router->get("/admin/rooms-manage", "RoomManageController::index");
$router->post("/admin/rooms-manage/toggle-cleaning", "RoomManageController::toggleCleaning");
$router->post("/admin/rooms-manage/update-memo", "RoomManageController::updateMemo");
$router->post("/admin/rooms-manage/edit-options", "RoomManageController::editOptions");
$router->get("/admin/rooms", "AdminController::roomRack");
$router->post("/admin/booking/status", "AdminController::updateBookingStatus");

// 관리자: 회원 & 개발자 전용 권한/상담 관리
$router->get("/admin/users", "UserManageController::index");
$router->post("/admin/users/update-role", "UserManageController::updateRole");

// 관리자: 중보기도 & 사이트 설정
$router->get("/admin/prayer", "AdminController::prayerList");
$router->post("/admin/prayer/reply", "AdminController::prayerReply");
$router->get("/admin/settings", "AdminController::settings");
$router->post("/admin/settings", "AdminController::saveSettings");

$router->dispatch();