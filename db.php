<?php
// Database connection configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'programming_tutorials';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

// Function to format numbers (views, likes, comments)
function formatNumber($num) {
    if ($num >= 1000000) {
        return round($num / 1000000, 1) . 'M';
    } elseif ($num >= 1000) {
        return round($num / 1000, 1) . 'K';
    }
    return $num;
}

// Function to get YouTube video ID from URL
function getYouTubeVideoId($url) {
    $video_id = '';
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
        $video_id = $matches[1];
    } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
        $video_id = $matches[1];
    }
    return $video_id;
}

// Function to build YouTube URL from video ID
function buildYouTubeUrl($video_id) {
    return "https://www.youtube.com/watch?v=" . $video_id;
}

// Function to build YouTube thumbnail URL from video ID
function buildThumbnailUrl($video_id) {
    return "https://img.youtube.com/vi/" . $video_id . "/maxresdefault.jpg";
}
?>
