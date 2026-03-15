<?php
require_once 'db.php';

// Get course ID from URL
$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($course_id === 0) {
    header('Location: index.php');
    exit;
}

// Get course details
$course_query = "SELECT course_name FROM courses WHERE id = ?";
$stmt = $conn->prepare($course_query);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$course_result = $stmt->get_result();

if ($course_result->num_rows === 0) {
    header('Location: index.php');
    exit;
}

$course = $course_result->fetch_assoc();
$course_name = $course['course_name'];

// Get videos for this course with 1M+ views
$videos_query = "SELECT id, title, youtube_id, views, likes, comments 
                 FROM videos 
                 WHERE course_id = ? AND views >= 1000000 
                 ORDER BY views DESC";

$stmt = $conn->prepare($videos_query);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$videos_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course_name); ?> Tutorials - Programming Tutorials Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📚 <?php echo htmlspecialchars($course_name); ?> Tutorials</h1>
            <p>Top YouTube tutorials with 1M+ views</p>
        </header>

        <main>
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>›</span>
                <span><?php echo htmlspecialchars($course_name); ?></span>
            </div>

            <a href="index.php" class="back-btn">
                ← Back to Courses
            </a>

            <section class="videos-section">
                <?php if ($videos_result && $videos_result->num_rows > 0): ?>
                    <div class="videos-grid">
                        <?php while ($video = $videos_result->fetch_assoc()): ?>
                            <a href="<?php echo buildYouTubeUrl($video['youtube_id']); ?>" 
                               target="_blank" 
                               class="video-card-link">
                                <div class="video-card">
                                    <img src="<?php echo buildThumbnailUrl($video['youtube_id']); ?>" 
                                         alt="<?php echo htmlspecialchars($video['title']); ?>" 
                                         class="video-thumbnail"
                                         onerror="this.src='https://img.youtube.com/vi/default.jpg'">
                                    <div class="video-info">
                                        <h3 class="video-title"><?php echo htmlspecialchars($video['title']); ?></h3>
                                        <div class="video-stats">
                                            <div class="stat-item">
                                                <span class="stat-icon">👁️</span>
                                                <span><?php echo formatNumber($video['views']); ?></span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-icon">👍</span>
                                                <span><?php echo formatNumber($video['likes']); ?></span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-icon">💬</span>
                                                <span><?php echo formatNumber($video['comments']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="error">
                        No tutorials found for <?php echo htmlspecialchars($course_name); ?> with 1M+ views.
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <style>
        .video-card-link {
            text-decoration: none;
            color: inherit;
        }
    </style>

    <script>
        // Add smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add click tracking (optional)
        document.querySelectorAll('.video-card').forEach(card => {
            card.addEventListener('click', function() {
                const title = this.querySelector('.video-title').textContent;
                console.log('Video clicked:', title);
            });
        });
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
