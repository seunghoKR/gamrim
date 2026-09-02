# ✝ 감림산기도원 통합 사역 ERP & 스마트 웹앱 (Gamrim Portal)

> **"말씀과 기도로 회복되는 은혜의 동산"**  
> 1968년 설립 이래 58년간 영남을 대표해 온 감림산기도원의 온·오프라인 통합 사역 관리 시스템입니다.

[![PHP Version](https://img.shields.io/badge/PHP-8.4-777BB4?logo=php&logoColor=white)](https://php.net)
[![MariaDB](https://img.shields.io/badge/MariaDB-10.x-003545?logo=mariadb&logoColor=white)](https://mariadb.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![SSL Always](https://img.shields.io/badge/SSL-Always_Active-green?logo=letsencrypt&logoColor=white)](https://newgamrim.iwinv.net)

---

## 🌐 실서버 배포 환경

- **임시 도메인**: [https://newgamrim.iwinv.net/](https://newgamrim.iwinv.net/)
- **서버 IP**: `115.68.168.243` (iWinV Apache/PHP 8.4 공유호스팅)
- **문자셋 / 언어**: UTF-8 / PHP 8.4 Strict Types
- **데이터베이스**: MariaDB 10.x (`newgamrim`)
- **최고 관리자(개발자)**: `admin` / `gamrim2026!`

---

## 🚀 핵심 사역 관리 모듈 (ERP)

### 1. 🎙️ 강사(설교자) 프로필 및 사역 히스토리
- **강사 상세 프로필**: 성명, 직분, 소속 교회/기관, 주요 약력, 얼굴 사진 업로드
- **연락처 다중화**: 강사 본인 직통 연락처(1차/2차) 최우선 강조 + 일정대리인(비서/부목사) 서브 정보 관리
- **사역 히스토리 추적**: 과거부터 미래까지 해당 강사의 기도원 예배 및 특별성회 인도 내역 일람

### 2. 📅 연중 집회 스케줄러 & 구글 캘린더 실시간 공유
- **다월 선등록**: 2개월~6개월 앞선 365일 정기예배, 화요구국철야, 금요은혜철야, 산상부흥성회 선등록
- **구글 캘린더 원클릭 담기**: 집회별 `📅 담기` 링크 지원
- **실시간 iCal (.ics) 구독 피드**: `https://newgamrim.iwinv.net/services/ical` URL을 구글 캘린더에 등록하면 담당자 스마트폰 달력과 실시간 자동 동기화

### 3. 🏛️ 대관 시설 관리 & Sortable.js 드래그 갤러리
- **마스터 제원 관리**: 대성전(1,500석), 벧엘성전(300석), 세미나실(80석), 식당(400석) 스펙 및 수칙 관리
- **드래그 앤 드롭 갤러리**: 마우스 드래그로 사진 순서를 자유롭게 재배치하면 비동기 AJAX로 즉시 DB에 정렬 순서 저장

### 4. 🛏️ 객실 4대 건물 정밀관리 & 유지보수 카톡 알림
- **4대 공식 건물 체계화**: `대성전 숙소`, `벧엘성전 숙소`, `교육관 숙소`, `목양관 숙소`
- **호실별 옵션 수정**: 침대 형태(온돌/침대), 욕실 유무, 정원, 어메니티 상세 수정 모달 지원
- **원클릭 청소 토글**: `청소완료(초록)` ➔ `청소필요(빨강)` ➔ `청소중(노랑)`
- **유지보수 카카오 알림톡**: 시설 이상 및 수리 메모 등록 시 유지보수 담당자에게 카톡 알림 자동 발송

### 5. 🛎️ 숙소 예약 & 카카오톡 2-Way 알림 시스템
- **예약 접수 시**: 숙소 예약 담당자 카카오톡으로 신규 예약 상세 알림 자동 발송
- **확약/반려 시**: 관리자가 [예약확정(확약)] 또는 [취소/반려] 클릭 시 예약자 성도 카카오톡으로 입실안내문 자동 발송

### 6. 👥 회원·상담 & 그룹 관리 (개발자 전용)
- **개발자 최고 권한 체계**:
  * 👑 `DEVELOPER` (최고 개발자)
  * 🏛️ `SUPER_ADMIN` (총괄 관리자)
  * 💼 `MANAGER` (운영자)
  * 🎙️ `SPEAKER` (강사 그룹 - 강사 등록 시 자동 연동)
  * 🕊️ `COUNSELOR` (상담관)
  * 🌟 `VIP_MEMBER` (우수 교회/단체)
  * 🌿 `MEMBER` (일반 성도)
  * 🚶 `VISITOR` (방문자)
- **상담 상태 태깅**: `대관상담필요`, `숙소상담필요`, `일반상담필요`, `상담완료`

### 7. 🚫 셔틀버스 완전 삭제 (최신 운영 현황 반영)
- 자체 셔틀버스 미운행 현황에 맞추어 헤더, 푸터, 설정, 이용안내에서 셔틀 문구 100% 완전 삭제
- 자가용 네비게이션 및 대중교통(양산역/노포역 하차 후 버스/택시) 길찾기 안내로 정돈

---

## 📁 프로젝트 디렉토리 구조

```
├── config/              # DB 접속 (database.php), 사이트 상수 설정 (settings.php)
├── core/                # 라우터 (Router.php), 캡차, 카카오 API, 유튜브 동기화
├── models/              # Facility, Rental, Room, Booking, Prayer, Service, Speaker, User
├── controllers/         # Home, Rental, Stay, Prayer, Admin, Speaker, ServiceSchedule, FacilityManage, RoomManage, UserManage, Auth
├── views/
│   ├── layouts/         # header.php, footer.php, admin_layout.php (통합 사이드바)
│   ├── admin/           # dashboard, settings, rental_calendar, room_rack, prayer_list
│   │   ├── speakers/    # index.php (목록/모달), detail.php (상세/사역이력)
│   │   ├── services/    # index.php (연중 집회 & iCal 구독)
│   │   ├── facilities/  # index.php (Sortable 드래그 갤러리)
│   │   ├── rooms/       # manage.php (4대 건물별 청소/옵션/유지보수)
│   │   └── users/       # index.php (그룹 및 상담 관리)
│   ├── auth/            # register.php (수신동의 4종), login.php
│   ├── rental/          # index.php, calendar.php, apply.php
│   ├── stay/            # index.php, search.php, lookup.php
│   ├── main.php         # 메인 홈페이지
│   ├── guide.php        # 처음오셨나요 (오시는 길/FAQ)
│   └── prayer.php       # 비공개 중보기도 신청
├── public/              # 웹 루트 (index.php, .htaccess, sw.js, manifest.json)
└── assets/              # css (app.css), js (app.js, rental-calendar.js), images
```

---

## 🛠️ 설치 및 로컬 실행

1. **저장소 클론**:
   ```bash
   git clone https://github.com/seunghoKR/gamrim.git
   ```
2. **웹 서버 구성 (Apache + PHP 8.4)**:
   - 웹 서버의 DocumentRoot를 프로젝트 루트(또는 `public/`)로 지정
   - `mod_rewrite` 활성화
3. **데이터베이스 구성**:
   - MariaDB에 `public/gamrim_db_schema.sql` 임포트
   - `config/database.php`에 DB 계정 정보 입력

---

## 📜 라이선스 및 크레딧

- **소유 및 운영**: 감림산기도원 (경상남도 양산시 상북면 삼감중앙길 48)
- **개발 총괄**: seunghoKR (최고 개발자 대표님)
- **디자인/기획 총괄**: AI 디자인실장 영자 (Youngja @ Connect AI LAB)