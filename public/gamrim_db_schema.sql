CREATE DATABASE IF NOT EXISTS gamrim_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gamrim_db;

CREATE TABLE IF NOT EXISTS site_settings (
    setting_key VARCHAR(50) PRIMARY KEY,
    setting_value TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    role ENUM('SUPER', 'MANAGER', 'STAFF') DEFAULT 'MANAGER',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS facilities (
    facility_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    capacity INT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS facility_rentals (
    rental_id INT AUTO_INCREMENT PRIMARY KEY,
    rental_no VARCHAR(50) UNIQUE NOT NULL,
    facility_id INT NOT NULL,
    applicant_name VARCHAR(100) NOT NULL,
    contact VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('접수대기', '심사승인', '확정완료', '반려', '취소') DEFAULT '접수대기',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (facility_id) REFERENCES facilities(facility_id)
);

CREATE TABLE IF NOT EXISTS rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(20) UNIQUE NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    capacity INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS room_bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_no VARCHAR(50) UNIQUE NOT NULL,
    room_id INT NOT NULL,
    booker_name VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    contact VARCHAR(50) NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    status ENUM('예약대기', '예약확정', '입실완료', '취소') DEFAULT '예약대기',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);

CREATE TABLE IF NOT EXISTS prayer_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    requester_name VARCHAR(100) NOT NULL,
    contact VARCHAR(50),
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    status ENUM('접수', '기도중', '응답완료') DEFAULT '접수',
    reply TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    service_date DATE NOT NULL,
    speaker VARCHAR(100),
    video_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 초기 데이터
INSERT IGNORE INTO site_settings (setting_key, setting_value) VALUES
('site_name', '감림산기도원'),
('main_slogan', '말씀과 기도로 회복되는 은혜의 동산'),
('address', '경상남도 양산시 하북면 감림산길 123'),
('main_phone', '055-374-4111'),
('shuttle_driver_phone', '010-0000-0000'),
('shuttle_schedule', '매일 오전 9시, 오후 2시 출발'),
('youtube_channel_id', 'UC_your_channel_id'),
('today_bible_verse', '항상 기뻐하라 쉬지 말고 기도하라 범사에 감사하라 (살전 5:16-18)');

INSERT IGNORE INTO facilities (name, capacity) VALUES 
('대성전', 1000), 
('벧엘성전', 300), 
('세미나실', 100), 
('구내식당', 200);

INSERT IGNORE INTO rooms (room_number, room_type) VALUES 
('101', '개인기도실'), 
('102', '개인기도실'), 
('201', '가족쉼터'), 
('202', '가족쉼터'), 
('301', '교육관 단체실');

-- password: gamrim2026! 로 변경 필요
INSERT IGNORE INTO admins (username, password_hash, name, role) 
VALUES ('admin', '$2y$12$PLACEHOLDER_HASH_HERE', '관리자', 'SUPER');
