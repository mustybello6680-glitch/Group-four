-- ==========================================
-- CampusConnect Database
-- Compatible with InfinityFree
-- ==========================================

-- ==========================================
-- USERS TABLE
-- ==========================================

CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    fullname VARCHAR(100) NOT NULL,

    regno VARCHAR(30) NOT NULL UNIQUE,

    email VARCHAR(100) NOT NULL UNIQUE,

    phone VARCHAR(20) NOT NULL,

    faculty VARCHAR(100) NOT NULL,

    department VARCHAR(100) NOT NULL,

    level VARCHAR(20) NOT NULL,

    password VARCHAR(255) NOT NULL,

    profile_image VARCHAR(255) DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

-- ==========================================
-- SCHEDULE TABLE
-- ==========================================

CREATE TABLE schedules (

    id INT AUTO_INCREMENT PRIMARY KEY,

    regno VARCHAR(30) NOT NULL,

    title VARCHAR(150) NOT NULL,

    date DATE NOT NULL,

    time TIME NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_schedule_user
    FOREIGN KEY (regno)
    REFERENCES users(regno)
    ON DELETE CASCADE

);

-- ==========================================
-- LOST & FOUND TABLE
-- ==========================================

CREATE TABLE lost_found (

    id INT AUTO_INCREMENT PRIMARY KEY,

    regno VARCHAR(30) NOT NULL,

    item VARCHAR(150) NOT NULL,

    description TEXT NOT NULL,

    location VARCHAR(150) NOT NULL,

    status VARCHAR(50) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_lost_user
    FOREIGN KEY (regno)
    REFERENCES users(regno)
    ON DELETE CASCADE

);

-- ==========================================
-- EMERGENCY ALERT TABLE
-- ==========================================

CREATE TABLE emergency_alerts (

    id INT AUTO_INCREMENT PRIMARY KEY,

    regno VARCHAR(30) NOT NULL,

    type VARCHAR(100) NOT NULL,

    location VARCHAR(150) NOT NULL,

    message TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_emergency_user
    FOREIGN KEY (regno)
    REFERENCES users(regno)
    ON DELETE CASCADE

);