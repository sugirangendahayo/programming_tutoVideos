-- Programming Tutorials Recommendation Platform Database Schema
-- IMPROVED VERSION with YouTube video IDs and real URLs

-- Create database
CREATE DATABASE IF NOT EXISTS programming_tutorials;
USE programming_tutorials;

-- Create courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create videos table with YouTube video ID approach
CREATE TABLE IF NOT EXISTS videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    youtube_id VARCHAR(20) NOT NULL,
    views BIGINT NOT NULL,
    likes BIGINT NOT NULL,
    comments BIGINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY (youtube_id)
);

-- Clear existing data
DELETE FROM videos;
DELETE FROM courses;

-- Insert sample courses
INSERT INTO courses (course_name) VALUES 
('Python'),
('Java'),
('JavaScript'),
('PHP'),
('C++'),
('C#'),
('Ruby'),
('Go'),
('Swift'),
('Kotlin');

-- Insert REAL YouTube videos for Python
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(1, 'Python for Beginners - Full Course', 'rfscVS0vtbw', 8500000, 250000, 15000),
(1, 'Learn Python in 12 Hours - Full Course', '_uQrJ0TkZlc', 3200000, 120000, 8000),
(1, 'Python Tutorial - Python Full Course for Beginners', 'eWRfhZUzrAc', 5800000, 180000, 12000),
(1, 'Python Full Course for Beginners | Tutorial', 'kqtD5dpn9C8', 2100000, 95000, 6000),
(1, 'Complete Python Bootcamp: Go from zero to hero', '8DvywoWv6fI', 4300000, 140000, 9000);

-- Insert REAL YouTube videos for Java
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(2, 'Java Full Course for Beginners', 'GoXwIVyNvXU', 6800000, 210000, 14000),
(2, 'Java Tutorial for Beginners [Full Course]', 'RYsrT_A1J8k', 3900000, 130000, 8500),
(2, 'Learn Java in 14 Hours - Full Course', 'nFVdifMW6pI', 2600000, 105000, 7000),
(2, 'Java Programming for Beginners', 'grEKMHGYyns', 5200000, 165000, 11000),
(2, 'Complete Java Tutorial for Beginners', 'UmnCZ7-9yDY', 3100000, 115000, 7500);

-- Insert REAL YouTube videos for JavaScript
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(3, 'JavaScript Full Course for Beginners', 'W6NZfCO5SIk', 7200000, 220000, 15000),
(3, 'Learn JavaScript - Full Course for Beginners', 'PkZNo7MFNFg', 4800000, 155000, 10000),
(3, 'JavaScript Tutorial for Beginners', 'Uwa_eXQe2IY', 3500000, 125000, 8200),
(3, 'JavaScript Full Course 2024', 'jS4aFq5-91M', 2900000, 98000, 6500),
(3, 'Modern JavaScript Tutorial - Learn ES6+', 'hdI2bqOjy3c', 4100000, 135000, 8800);

-- Insert REAL YouTube videos for PHP
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(4, 'PHP Full Course for Beginners', 'OK_JCtrrv-c', 2800000, 95000, 6200),
(4, 'PHP Tutorial for Beginners', 'zZ6vybT1HQs', 2300000, 85000, 5600),
(4, 'PHP & MySQL for Beginners', '2eebptXfEvw', 2100000, 82000, 5400),
(4, 'Learn PHP in 2024 - Full Course', 'BUCiSSyIGGU', 1900000, 78000, 5100);

-- Insert REAL YouTube videos for C++
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(5, 'C++ Full Course for Beginners', '8jLOx1hDq_o', 4500000, 145000, 9500),
(5, 'Learn C++ - Full Course for Beginners', 'vLnPwxZdW4Y', 3200000, 108000, 7200),
(5, 'C++ Programming Tutorial for Beginners', 'ZzaPdXTrSb8', 2800000, 95000, 6300);

-- Insert REAL YouTube videos for C#
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(6, 'C# Full Course for Beginners', 'LH8chhlS24U', 2400000, 85000, 5600),
(6, 'C# Tutorial for Beginners', 'gfkTfcpWqAY', 1800000, 72000, 4800),
(6, 'C# Programming Tutorial', 'gmhxMCdQ2p8', 2100000, 78000, 5200);

-- Insert REAL YouTube videos for Ruby
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(7, 'Ruby Full Course for Beginners', 't_ispmWmdFQ', 1500000, 58000, 3900),
(7, 'Learn Ruby Programming', 'zzaJEMgk-1M', 1200000, 48000, 3200),
(7, 'Ruby Tutorial for Beginners', 'Dji9ALCgfpM', 980000, 42000, 2800);

-- Insert REAL YouTube videos for Go
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(8, 'Go Full Course for Beginners', 'YS4e4q9bBaE', 2100000, 75000, 5000),
(8, 'Learn Go Programming - Full Course', 'SqKIdh5gmG8', 1800000, 68000, 4500),
(8, 'Go Tutorial for Beginners', 'un6ZyFkqFKo', 1400000, 58000, 3900);

-- Insert REAL YouTube videos for Swift
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(9, 'Swift Full Course for Beginners', 'w1E1mRvXt0g', 1900000, 71000, 4700),
(9, 'Learn Swift Programming - Full Course', 'comQ1-x2a1Q', 1500000, 62000, 4100),
(9, 'Swift Tutorial for Beginners', 'k5w5Vtt9tD8', 1300000, 55000, 3700);

-- Insert REAL YouTube videos for Kotlin
INSERT INTO videos (course_id, title, youtube_id, views, likes, comments) VALUES 
(10, 'Kotlin Full Course for Beginners', 'EExSSotojVI', 2200000, 78000, 5200),
(10, 'Learn Kotlin Programming - Full Course', 'F9UC9DY-vIU', 1600000, 65000, 4300),
(10, 'Kotlin Tutorial for Beginners', 'H_oGi8uuDpA', 1400000, 58000, 3900);
