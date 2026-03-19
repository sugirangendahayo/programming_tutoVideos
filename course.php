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

// Collect videos into array so we can count them
$videos = [];
if ($videos_result && $videos_result->num_rows > 0) {
    while ($v = $videos_result->fetch_assoc()) $videos[] = $v;
}

// Course icons & accent colors (same as index.php)
$course_icons = [
    'Python' => '🐍', 'Java' => '☕', 'JavaScript' => '🌟',
    'PHP' => '🐘', 'C++' => '⚡', 'C#' => '🔷',
    'Ruby' => '💎', 'Go' => '🐹', 'Swift' => '🦉', 'Kotlin' => '🎯'
];
$course_colors = [
    'Python'     => ['#3776AB', '#FFD43B'],
    'JavaScript' => ['#F7DF1E', '#323330'],
    'PHP'        => ['#8892be', '#4F5B93'],
    'Java'       => ['#ED8B00', '#007396'],
    'C++'        => ['#00599C', '#659ad2'],
    'C#'         => ['#239120', '#9B4F96'],
    'Ruby'       => ['#CC342D', '#F1F1F1'],
    'Go'         => ['#00ADD8', '#FFFFFF'],
    'Swift'      => ['#FA7343', '#FFFFFF'],
    'Kotlin'     => ['#7F52FF', '#C811E1'],
];

$icon   = $course_icons[$course_name] ?? '💻';
$colors = $course_colors[$course_name] ?? ['#c8f542', '#7c6cfc'];
$c1     = $colors[0]; $c2 = $colors[1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course_name); ?> Tutorials — CodeVault</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* ── COURSE-PAGE SPECIFIC VARS ────── */
        :root {
            --course-c1: <?php echo $c1; ?>;
            --course-c2: <?php echo $c2; ?>;
        }
    </style>
</head>
<body class="course-page">

<!-- ══════════ NAV ══════════ -->
<nav class="nav" id="nav">
    <div class="nav-inner">
        <a href="index.php" class="nav-logo">
            <span class="logo-mark">CV</span>
            <span class="logo-text">CodeVault</span>
        </a>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#courses">Courses</a></li>
            <li><a href="index.php#why">About</a></li>
        </ul>
        <a href="index.php#courses" class="nav-cta">All Languages →</a>
        <button class="nav-burger" id="burger" aria-label="menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- ══════════ COURSE HERO ══════════ -->
<section class="course-hero">
    <!-- Decorative background -->
    <div class="course-hero-bg">
        <div class="ch-grid"></div>
        <div class="ch-glow ch-glow-1"></div>
        <div class="ch-glow ch-glow-2"></div>
        <!-- Big ghost icon -->
        <div class="ch-ghost-icon" aria-hidden="true"><?php echo $icon; ?></div>
    </div>

    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb" aria-label="breadcrumb">
            <a href="index.php">Home</a>
            <span class="bc-sep">›</span>
            <span><?php echo htmlspecialchars($course_name); ?></span>
        </nav>

        <div class="course-hero-inner">
            <div class="ch-badge">
                <span class="ch-icon"><?php echo $icon; ?></span>
                <span class="ch-lang-tag"><?php echo htmlspecialchars($course_name); ?></span>
            </div>

            <h1 class="ch-title">
                Top <em><?php echo htmlspecialchars($course_name); ?></em><br>
                Tutorials
            </h1>
            <p class="ch-sub">
                <?php echo count($videos); ?> hand-picked videos, each with over
                <strong>1,000,000 views</strong> on YouTube — ranked by popularity.
            </p>

            <div class="ch-meta">
                <div class="ch-meta-item">
                    <span class="ch-meta-num"><?php echo count($videos); ?></span>
                    <span class="ch-meta-label">Tutorials</span>
                </div>
                <div class="ch-meta-divider"></div>
                <div class="ch-meta-item">
                    <span class="ch-meta-num">1M+</span>
                    <span class="ch-meta-label">Views Each</span>
                </div>
                <div class="ch-meta-divider"></div>
                <div class="ch-meta-item">
                    <span class="ch-meta-num">Free</span>
                    <span class="ch-meta-label">Always</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom wave divider -->
    <div class="ch-divider">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 60 C360 0 1080 60 1440 0 L1440 60 L0 60 Z" fill="var(--ink)"/>
        </svg>
    </div>
</section>

<!-- ══════════ SORT / FILTER BAR ══════════ -->
<section class="filter-bar-section">
    <div class="container">
        <div class="filter-bar">
            <p class="filter-label">
                Showing <strong><?php echo count($videos); ?></strong> viral tutorials for
                <strong><?php echo htmlspecialchars($course_name); ?></strong>
            </p>
            <div class="filter-pills">
                <span class="filter-pill filter-pill--active">Most Viewed</span>
                <span class="filter-pill">Most Liked</span>
                <span class="filter-pill">Most Discussed</span>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ VIDEOS GRID ══════════ -->
<section class="videos-section">
    <div class="container">
        <?php if (!empty($videos)): ?>
        <div class="videos-grid">
            <?php foreach ($videos as $i => $video):
                $delay = $i * 70;
                $rank  = $i + 1;
            ?>
            <a href="<?php echo buildYouTubeUrl($video['youtube_id']); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="vcard"
               style="--delay:<?php echo $delay; ?>ms"
               aria-label="Watch <?php echo htmlspecialchars($video['title']); ?> on YouTube">

                <!-- Rank badge -->
                <div class="vcard-rank"><?php echo $rank; ?></div>

                <!-- Thumbnail -->
                <div class="vcard-thumb-wrap">
                    <img src="<?php echo buildThumbnailUrl($video['youtube_id']); ?>"
                         alt="<?php echo htmlspecialchars($video['title']); ?>"
                         class="vcard-thumb"
                         loading="lazy"
                         onerror="this.src='https://img.youtube.com/vi/default.jpg'">
                    <div class="vcard-play">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8 5.14v14l11-7-11-7z"/>
                        </svg>
                    </div>
                    <div class="vcard-yt-badge">
                        <svg width="14" height="10" viewBox="0 0 28 20" fill="none">
                            <rect width="28" height="20" rx="4" fill="#FF0000"/>
                            <path d="M11 6l8 4-8 4V6z" fill="white"/>
                        </svg>
                        YouTube
                    </div>
                    <?php if ($rank === 1): ?>
                    <div class="vcard-top-badge">#1 Most Viewed</div>
                    <?php endif; ?>
                </div>

                <!-- Info -->
                <div class="vcard-body">
                    <h3 class="vcard-title"><?php echo htmlspecialchars($video['title']); ?></h3>

                    <div class="vcard-stats">
                        <div class="vcard-stat" title="Views">
                            <span class="vcard-stat-icon">👁</span>
                            <span class="vcard-stat-val"><?php echo formatNumber($video['views']); ?></span>
                            <span class="vcard-stat-label">views</span>
                        </div>
                        <div class="vcard-stat" title="Likes">
                            <span class="vcard-stat-icon">👍</span>
                            <span class="vcard-stat-val"><?php echo formatNumber($video['likes']); ?></span>
                            <span class="vcard-stat-label">likes</span>
                        </div>
                        <div class="vcard-stat" title="Comments">
                            <span class="vcard-stat-icon">💬</span>
                            <span class="vcard-stat-val"><?php echo formatNumber($video['comments']); ?></span>
                            <span class="vcard-stat-label">comments</span>
                        </div>
                    </div>

                    <div class="vcard-footer">
                        <span class="vcard-cta">Watch on YouTube →</span>
                        <span class="vcard-views-bar" title="Popularity">
                            <span class="vcard-views-fill"
                                  style="width:<?php
                                      $maxV = max(array_column($videos, 'views'));
                                      echo round(($video['views'] / $maxV) * 100);
                                  ?>%"></span>
                        </span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <?php else: ?>
        <div class="empty-state">
            <span class="empty-icon">🎬</span>
            <h3>No tutorials found</h3>
            <p>No <?php echo htmlspecialchars($course_name); ?> tutorials with 1M+ views in the database yet.</p>
            <a href="index.php" class="btn btn-primary" style="margin-top:24px">← Back to Courses</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ══════════ BACK / MORE COURSES ══════════ -->
<section class="more-section">
    <div class="container">
        <div class="more-inner">
            <div>
                <h2 class="more-title">Explore more<br><em>languages.</em></h2>
                <p class="more-sub">Every language on CodeVault has its own curated collection of million-view tutorials.</p>
            </div>
            <a href="index.php#courses" class="btn btn-primary btn-large">All Courses →</a>
        </div>
    </div>
</section>

<!-- ══════════ FOOTER ══════════ -->
<footer class="footer">
    <div class="container">
        <div class="footer-bottom" style="border-top:1px solid var(--line);padding-top:28px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px">
            <div style="display:flex;align-items:center;gap:10px">
                <span class="logo-mark">CV</span>
                <span style="color:var(--white-40);font-size:.88rem;">CodeVault · <?php echo date('Y'); ?></span>
            </div>
            <p style="color:var(--white-40);font-size:.82rem;">All tutorials sourced from YouTube · 1M+ views only</p>
            <a href="index.php" style="color:var(--accent);font-size:.88rem;text-decoration:none;">← Back to Home</a>
        </div>
    </div>
</footer>

<script>
// Nav scroll
const nav = document.getElementById('nav');
window.addEventListener('scroll', () => {
    nav.classList.toggle('nav--scrolled', window.scrollY > 60);
});

// Mobile burger
document.getElementById('burger').addEventListener('click', function() {
    document.querySelector('.nav-links').classList.toggle('open');
    this.classList.toggle('active');
});

// Scroll reveal
const observer = new IntersectionObserver((entries) => {
    entries.forEach(el => {
        if (el.isIntersecting) { el.target.classList.add('visible'); observer.unobserve(el.target); }
    });
}, { threshold: 0.08 });
document.querySelectorAll('.vcard').forEach(el => observer.observe(el));

// Filter pills (visual only — actual sorting would need AJAX)
document.querySelectorAll('.filter-pill').forEach(pill => {
    pill.addEventListener('click', function() {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('filter-pill--active'));
        this.classList.add('filter-pill--active');
    });
});
</script>
</body>
</html>
<?php $stmt->close(); $conn->close(); ?>