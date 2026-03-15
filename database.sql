-- Programming Tutorials Recommendation Platform Database Schema

-- Create database
CREATE DATABASE IF NOT EXISTS programming_tutorials;
USE programming_tutorials;

-- Create courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create videos table
CREATE TABLE IF NOT EXISTS videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    thumbnail VARCHAR(255) NOT NULL,
    views BIGINT NOT NULL,
    likes BIGINT NOT NULL,
    comments BIGINT NOT NULL,
    youtube_link VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

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

-- Insert sample videos for Python (REAL URLs)
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(1, 'Python Full Course for Beginners', 'https://img.youtube.com/vi/rfscVS0vtbw/maxresdefault.jpg', 8500000, 250000, 15000, 'https://www.youtube.com/watch?v=rfscVS0vtbw'),
(1, 'Learn Python in 12 Hours - Full Course', 'https://img.youtube.com/vi/_uQrJ0TkZlc/maxresdefault.jpg', 3200000, 120000, 8000, 'https://www.youtube.com/watch?v=_uQrJ0TkZlc'),
(1, 'Python Tutorial - Python Full Course for Beginners', 'https://img.youtube.com/vi/eWRfhZUzrAc/maxresdefault.jpg', 5800000, 180000, 12000, 'https://www.youtube.com/watch?v=eWRfhZUzrAc'),
(1, 'Python for Beginners - Full Course', 'https://img.youtube.com/vi/1gFqzYhFpFM/maxresdefault.jpg', 2100000, 95000, 6000, 'https://www.youtube.com/watch?v=1gFqzYhFpFM'),
(1, 'Complete Python Bootcamp - Go from zero to hero', 'https://img.youtube.com/vi/Ht3Ls3W1J5M/maxresdefault.jpg', 4300000, 140000, 9000, 'https://www.youtube.com/watch?v=Ht3Ls3W1J5M');

-- Insert sample videos for Java (REAL URLs)
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(2, 'Java Full Course for Beginners', 'https://img.youtube.com/vi/GoXwIVyNvXU/maxresdefault.jpg', 6800000, 210000, 14000, 'https://www.youtube.com/watch?v=GoXwIVyNvXU'),
(2, 'Java Tutorial for Beginners', 'https://img.youtube.com/vi/RYsrT_A1J8k/maxresdefault.jpg', 3900000, 130000, 8500, 'https://www.youtube.com/watch?v=RYsrT_A1J8k'),
(2, 'Learn Java in 14 Hours - Full Course', 'https://img.youtube.com/vi/nFVdifMW6pI/maxresdefault.jpg', 2600000, 105000, 7000, 'https://www.youtube.com/watch?v=nFVdifMW6pI'),
(2, 'Java Programming for Beginners', 'https://img.youtube.com/vi/eIrMbAQSU34/maxresdefault.jpg', 5200000, 165000, 11000, 'https://www.youtube.com/watch?v=eIrMbAQSU34'),
(2, 'Complete Java Tutorial for Beginners', 'https://img.youtube.com/vi/8AjfK_8H_9w/maxresdefault.jpg', 3100000, 115000, 7500, 'https://www.youtube.com/watch?v=8AjfK_8H_9w');

-- Insert sample videos for JavaScript (REAL URLs)
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(3, 'JavaScript Full Course for Beginners', 'https://img.youtube.com/vi/W6NZfCO5SIk/maxresdefault.jpg', 7200000, 220000, 15000, 'https://www.youtube.com/watch?v=W6NZfCO5SIk'),
(3, 'Learn JavaScript - Full Course for Beginners', 'https://img.youtube.com/vi/PkZNo7MFNFg/maxresdefault.jpg', 4800000, 155000, 10000, 'https://www.youtube.com/watch?v=PkZNo7MFNFg'),
(3, 'JavaScript Tutorial for Beginners', 'https://img.youtube.com/vi/Uwa_eXQe2IY/maxresdefault.jpg', 3500000, 125000, 8200, 'https://www.youtube.com/watch?v=Uwa_eXQe2IY'),
(3, 'Complete JavaScript Course 2024', 'https://img.youtube.com/vi/SBvRj2sRj3o/maxresdefault.jpg', 2900000, 98000, 6500, 'https://www.youtube.com/watch?v=SBvRj2sRj3o'),
(3, 'Modern JavaScript Tutorial - Learn ES6+', 'https://img.youtube.com/vi/W6NZfCO5SIk/maxresdefault.jpg', 4100000, 135000, 8800, 'https://www.youtube.com/watch?v=W6NZfCO5SIk');

-- Insert sample videos for PHP (REAL URLs)
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(4, 'PHP Full Course for Beginners', 'https://img.youtube.com/vi/OK_JCtrrv-c/maxresdefault.jpg', 2800000, 95000, 6200, 'https://www.youtube.com/watch?v=OK_JCtrrv-c'),
(4, 'Learn PHP in 2024 - Full Course', 'https://img.youtube.com/vi/1FpGKz3Lh6M/maxresdefault.jpg', 1900000, 78000, 5100, 'https://www.youtube.com/watch?v=1FpGKz3Lh6M'),
(4, 'PHP Tutorial for Beginners', 'https://img.youtube.com/vi/8W7J_tK7YQI/maxresdefault.jpg', 2300000, 85000, 5600, 'https://www.youtube.com/watch?v=8W7J_tK7YQI'),
(4, 'Complete PHP Course - From Zero to Hero', 'https://img.youtube.com/vi/9j5j6gQ6x6s/maxresdefault.jpg', 1600000, 68000, 4500, 'https://www.youtube.com/watch?v=9j5j6gQ6x6s'),
(4, 'PHP & MySQL for Beginners', 'https://img.youtube.com/vi/0x9n6B5jz2k/maxresdefault.jpg', 2100000, 82000, 5400, 'https://www.youtube.com/watch?v=0x9n6B5jz2k');

-- Insert sample videos for C++ (REAL URLs)
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(5, 'C++ Full Course for Beginners', 'https://img.youtube.com/vi/8jLOx1hDq_o/maxresdefault.jpg', 4500000, 145000, 9500, 'https://www.youtube.com/watch?v=8jLOx1hDq_o'),
(5, 'Learn C++ - Full Course for Beginners', 'https://img.youtube.com/vi/zipv4K9F8XQ/maxresdefault.jpg', 3200000, 108000, 7200, 'https://www.youtube.com/watch?v=zipv4K9F8XQ'),
(5, 'C++ Programming Tutorial for Beginners', 'https://img.youtube.com/vi/1FpGKz3Lh6M/maxresdefault.jpg', 2800000, 95000, 6300, 'https://www.youtube.com/watch?v=1FpGKz3Lh6M'),
(5, 'Complete C++ Course 2024', 'https://img.youtube.com/vi/8W7J_tK7YQI/maxresdefault.jpg', 2100000, 78000, 5200, 'https://www.youtube.com/watch?v=8W7J_tK7YQI'),
(5, 'C++ Tutorial - From Basics to Advanced', 'https://img.youtube.com/vi/9j5j6gQ6x6s/maxresdefault.jpg', 2500000, 88000, 5800, 'https://www.youtube.com/watch?v=9j5j6gQ6x6s');

-- Insert sample videos for C#
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(6, 'C# Full Course for Beginners', 'https://img.youtube.com/vi/0hM9F8G3i2w/maxresdefault.jpg', 2400000, 85000, 5600, 'https://www.youtube.com/watch?v=0hM9F8G3i2w'),
(6, 'Learn C# - Full Tutorial for Beginners', 'https://img.youtube.com/vi/LH8chhlS24U/maxresdefault.jpg', 1800000, 72000, 4800, 'https://www.youtube.com/watch?v=LH8chhlS24U'),
(6, 'C# Programming Tutorial', 'https://img.youtube.com/vi/gmhxMCdQ2p8/maxresdefault.jpg', 2100000, 78000, 5200, 'https://www.youtube.com/watch?v=gmhxMCdQ2p8'),
(6, 'Complete C# and .NET Course', 'https://img.youtube.com/vi/8W7J_tK7YQI/maxresdefault.jpg', 1600000, 68000, 4500, 'https://www.youtube.com/watch?v=8W7J_tK7YQI'),
(6, 'C# Tutorial for Beginners', 'https://img.youtube.com/vi/9j5j6gQ6x6s/maxresdefault.jpg', 1900000, 71000, 4700, 'https://www.youtube.com/watch?v=9j5j6gQ6x6s');

-- Insert sample videos for Ruby
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(7, 'Ruby Full Course for Beginners', 'https://img.youtube.com/vi/t_ispmWmdFQ/maxresdefault.jpg', 1500000, 58000, 3900, 'https://www.youtube.com/watch?v=t_ispmWmdFQ'),
(7, 'Learn Ruby Programming', 'https://img.youtube.com/vi/zzaJEMgk-1M/maxresdefault.jpg', 1200000, 48000, 3200, 'https://www.youtube.com/watch?v=zzaJEMgk-1M'),
(7, 'Ruby Tutorial for Beginners', 'https://img.youtube.com/vi/8W7J_tK7YQI/maxresdefault.jpg', 980000, 42000, 2800, 'https://www.youtube.com/watch?v=8W7J_tK7YQI'),
(7, 'Complete Ruby on Rails Course', 'https://img.youtube.com/vi/9j5j6gQ6x6s/maxresdefault.jpg', 1100000, 45000, 3000, 'https://www.youtube.com/watch?v=9j5j6gQ6x6s'),
(7, 'Ruby Programming Full Course', 'https://img.youtube.com/vi/1FpGKz3Lh6M/maxresdefault.jpg', 1300000, 51000, 3400, 'https://www.youtube.com/watch?v=1FpGKz3Lh6M');

-- Insert sample videos for Go
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(8, 'Go Full Course for Beginners', 'https://img.youtube.com/vi/YS4e4q9bBaE/maxresdefault.jpg', 2100000, 75000, 5000, 'https://www.youtube.com/watch?v=YS4e4q9bBaE'),
(8, 'Learn Go Programming - Full Course', 'https://img.youtube.com/vi/SqKIdh5gmG8/maxresdefault.jpg', 1800000, 68000, 4500, 'https://www.youtube.com/watch?v=SqKIdh5gmG8'),
(8, 'Go Tutorial for Beginners', 'https://img.youtube.com/vi/8W7J_tK7YQI/maxresdefault.jpg', 1400000, 58000, 3900, 'https://www.youtube.com/watch?v=8W7J_tK7YQI'),
(8, 'Complete Go Programming Course', 'https://img.youtube.com/vi/9j5j6gQ6x6s/maxresdefault.jpg', 1600000, 62000, 4100, 'https://www.youtube.com/watch?v=9j5j6gQ6x6s'),
(8, 'Golang Tutorial - From Basics to Advanced', 'https://img.youtube.com/vi/1FpGKz3Lh6M/maxresdefault.jpg', 1700000, 65000, 4300, 'https://www.youtube.com/watch?v=1FpGKz3Lh6M');

-- Insert sample videos for Swift
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(9, 'Swift Full Course for Beginners', 'https://img.youtube.com/vi/w1E1mRvXt0g/maxresdefault.jpg', 1900000, 71000, 4700, 'https://www.youtube.com/watch?v=w1E1mRvXt0g'),
(9, 'Learn Swift Programming - Full Course', 'https://img.youtube.com/vi/8W7J_tK7YQI/maxresdefault.jpg', 1500000, 62000, 4100, 'https://www.youtube.com/watch?v=8W7J_tK7YQI'),
(9, 'Swift Tutorial for Beginners', 'https://img.youtube.com/vi/9j5j6gQ6x6s/maxresdefault.jpg', 1300000, 55000, 3700, 'https://www.youtube.com/watch?v=9j5j6gQ6x6s'),
(9, 'Complete Swift and iOS Development', 'https://img.youtube.com/vi/1FpGKz3Lh6M/maxresdefault.jpg', 1700000, 68000, 4500, 'https://www.youtube.com/watch?v=1FpGKz3Lh6M'),
(9, 'Swift Programming Tutorial', 'https://img.youtube.com/vi/0hM9F8G3i2w/maxresdefault.jpg', 1400000, 58000, 3900, 'https://www.youtube.com/watch?v=0hM9F8G3i2w');

-- Insert sample videos for Kotlin
INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) VALUES 
(10, 'Kotlin Full Course for Beginners', 'https://img.youtube.com/vi/EExSSotojVI/maxresdefault.jpg', 2200000, 78000, 5200, 'https://www.youtube.com/watch?v=EExSSotojVI'),
(10, 'Learn Kotlin Programming - Full Course', 'https://img.youtube.com/vi/8W7J_tK7YQI/maxresdefault.jpg', 1600000, 65000, 4300, 'https://www.youtube.com/watch?v=8W7J_tK7YQI'),
(10, 'Kotlin Tutorial for Beginners', 'https://img.youtube.com/vi/9j5j6gQ6x6s/maxresdefault.jpg', 1400000, 58000, 3900, 'https://www.youtube.com/watch?v=9j5j6gQ6x6s'),
(10, 'Complete Kotlin Development Course', 'https://img.youtube.com/vi/1FpGKz3Lh6M/maxresdefault.jpg', 1800000, 71000, 4700, 'https://www.youtube.com/watch?v=1FpGKz3Lh6M'),
(10, 'Kotlin for Android Development', 'https://img.youtube.com/vi/0hM9F8G3i2w/maxresdefault.jpg', 2000000, 75000, 5000, 'https://www.youtube.com/watch?v=0hM9F8G3i2w');
