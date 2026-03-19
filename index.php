<?php
require_once 'db.php';

// Get all courses with video count
$query = "SELECT c.id, c.course_name, COUNT(v.id) as video_count 
          FROM courses c 
          LEFT JOIN videos v ON c.id = v.course_id 
          WHERE v.views >= 1000000 
          GROUP BY c.id, c.course_name";

$result = $conn->query($query);

// Define custom sort order
$preferred_order = ['Python', 'JavaScript', 'PHP'];

// Convert result to array for custom sorting
$courses = [];
if ($result && $result->rowCount() > 0) {
    $courses = $result->fetchAll();
}

// Custom sorting function
usort($courses, function($a, $b) use ($preferred_order) {
    $a_name = $a['course_name'];
    $b_name = $b['course_name'];
    $a_index = array_search($a_name, $preferred_order);
    $b_index = array_search($b_name, $preferred_order);
    if ($a_index !== false && $b_index !== false) return $a_index - $b_index;
    if ($a_index !== false) return -1;
    if ($b_index !== false) return 1;
    return strcmp($a_name, $b_name);
});

// Course icons mapping
$course_icons = [
    'Python'     => '🐍',
    'Java'       => '☕',
    'JavaScript' => '🌟',
    'PHP'        => '🐘',
    'C++'        => '⚡',
    'C#'         => '🔷',
    'Ruby'       => '💎',
    'Go'         => '🐹',
    'Swift'      => '🦉',
    'Kotlin'     => '🎯'
];

// Course accent colors for cards
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

// Short descriptions per language
$course_desc = [
    'Python'     => 'Data science, AI, automation & web backends',
    'JavaScript' => 'Web interactivity, Node.js & modern frameworks',
    'PHP'        => 'Server-side scripting & dynamic web pages',
    'Java'       => 'Enterprise apps, Android & cross-platform',
    'C++'        => 'Systems programming, games & performance',
    'C#'         => '.NET ecosystem, Unity & Windows apps',
    'Ruby'       => 'Elegant syntax, Rails & rapid prototyping',
    'Go'         => 'Concurrent systems & cloud-native services',
    'Swift'      => 'iOS, macOS & Apple ecosystem development',
    'Kotlin'     => 'Modern Android & multiplatform development',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeVault — Premium Programming Tutorials</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ═══════════════════════════════ NAV ═══════════════════════════════ -->
<nav class="nav" id="nav">
    <div class="nav-inner">
        <a href="index.php" class="nav-logo">
            <span class="logo-mark">CV</span>
            <span class="logo-text">CodeVault</span>
        </a>
        <ul class="nav-links">
            <li><a href="#courses">Courses</a></li>
            <li><a href="#why">Why Us</a></li>
            <li><a href="#stats">Stats</a></li>
            <li><a href="#languages">Languages</a></li>
        </ul>
        <a href="#courses" class="nav-cta">Start Learning →</a>
        <button class="nav-burger" id="burger" aria-label="menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- ═══════════════════════════════ HERO ═══════════════════════════════ -->
<section class="hero">
    <div class="hero-bg">
        <div class="hero-grid"></div>
        <div class="hero-glow glow-1"></div>
        <div class="hero-glow glow-2"></div>
        <div class="hero-glow glow-3"></div>
    </div>
    <div class="hero-inner">
        <div class="hero-badge">
            <span class="badge-dot"></span>
            <span>1M+ Views Per Tutorial</span>
        </div>
        <h1 class="hero-title">
            Master Code.<br>
            <em>Shape the Future.</em>
        </h1>
        <p class="hero-sub">
            Hand-curated programming tutorials from YouTube's top educators —
            filtered to only the very best, most-watched content.
        </p>
        <div class="hero-actions">
            <a href="#courses" class="btn btn-primary">Explore Courses</a>
            <a href="#why" class="btn btn-ghost">How it Works</a>
        </div>
        <div class="hero-marquee" aria-hidden="true">
            <div class="marquee-track">
                <?php
                $langs = ['Python', 'JavaScript', 'PHP', 'Java', 'C++', 'C#', 'Ruby', 'Go', 'Swift', 'Kotlin', 'Rust', 'TypeScript'];
                for ($i = 0; $i < 3; $i++) {
                    foreach ($langs as $l) {
                        echo "<span class=\"marquee-item\">$l</span><span class=\"marquee-sep\">·</span>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="hero-scroll-hint">
        <span>scroll</span>
        <div class="scroll-line"></div>
    </div>
</section>

<!-- ═══════════════════════════════ STATS ═══════════════════════════════ -->
<section class="stats-section" id="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-delay="0">
                <span class="stat-num" data-target="<?php echo count($courses); ?>"><?php echo count($courses); ?></span>
                <span class="stat-label">Languages</span>
                <span class="stat-icon">🌐</span>
            </div>
            <div class="stat-card" data-delay="100">
                <span class="stat-num" data-target="<?php
                    $total = 0;
                    foreach ($courses as $c) $total += $c['video_count'];
                    echo $total;
                ?>"><?php echo $total; ?></span>
                <span class="stat-label">Viral Tutorials</span>
                <span class="stat-icon">🎬</span>
            </div>
            <div class="stat-card" data-delay="200">
                <span class="stat-num">1M+</span>
                <span class="stat-label">Views Per Video</span>
                <span class="stat-icon">👁</span>
            </div>
            <div class="stat-card" data-delay="300">
                <span class="stat-num">100%</span>
                <span class="stat-label">Free Content</span>
                <span class="stat-icon">✨</span>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ WHY ═══════════════════════════════ -->
<section class="why-section" id="why">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Why CodeVault</span>
            <h2 class="section-title">Not just another<br><em>tutorial site.</em></h2>
            <p class="section-sub">We do the hard work — hunting through thousands of YouTube videos to surface only the most battle-tested, highly-watched programming content.</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon">⚡</div>
                <h3>Only Viral Content</h3>
                <p>Every tutorial on this platform has crossed the 1,000,000 view threshold. If it's here, the community already loved it.</p>
            </div>
            <div class="why-card why-card--featured">
                <div class="why-icon">🎯</div>
                <h3>Curated by Language</h3>
                <p>Structured browsing. Jump straight to the language you need, see every top video in one clean grid — no noise.</p>
                <div class="why-card-glow"></div>
            </div>
            <div class="why-card">
                <div class="why-icon">🔓</div>
                <h3>Completely Free</h3>
                <p>No paywalls. No sign-ups. Just open the site, pick a language, and start watching the internet's best coding content.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">📱</div>
                <h3>Watch Anywhere</h3>
                <p>Optimized for desktop, tablet, and mobile. Code on your laptop, review concepts on the go.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">🔄</div>
                <h3>Always Fresh</h3>
                <p>Powered by live database queries — the content you see reflects the real, current viral tutorial landscape.</p>
            </div>
            <div class="why-card">
                <div class="why-icon">🏆</div>
                <h3>Community Proven</h3>
                <p>View counts don't lie. These are the tutorials that millions of developers have trusted to level up their skills.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ COURSES ═══════════════════════════════ -->
<section class="courses-section" id="courses">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">All Languages</span>
            <h2 class="section-title">Choose Your<br><em>Language.</em></h2>
            <p class="section-sub">Every card below leads to a curated collection of the highest-viewed tutorials for that language.</p>
        </div>

        <?php if (!empty($courses)): ?>
        <div class="courses-grid">
            <?php foreach ($courses as $i => $row):
                $name   = htmlspecialchars($row['course_name']);
                $icon   = $course_icons[$row['course_name']] ?? '💻';
                $colors = $course_colors[$row['course_name']] ?? ['#666', '#999'];
                $desc   = $course_desc[$row['course_name']] ?? 'Explore top tutorials for this language';
                $delay  = $i * 60;
            ?>
            <a href="course.php?id=<?php echo $row['id']; ?>" class="course-card" style="--c1:<?php echo $colors[0]; ?>;--c2:<?php echo $colors[1]; ?>;--delay:<?php echo $delay; ?>ms">
                <div class="card-accent"></div>
                <div class="card-body">
                    <div class="card-top">
                        <span class="card-icon"><?php echo $icon; ?></span>
                        <span class="card-count"><?php echo $row['video_count']; ?> tutorials</span>
                    </div>
                    <h3 class="card-title"><?php echo $name; ?></h3>
                    <p class="card-desc"><?php echo $desc; ?></p>
                    <div class="card-footer">
                        <span class="card-tag">1M+ views</span>
                        <span class="card-arrow">→</span>
                    </div>
                </div>
                <div class="card-hover-bg"></div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <span class="empty-icon">🗄️</span>
            <h3>No courses found</h3>
            <p>Please import the database schema first.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ═══════════════════════════════ LANGUAGES SHOWCASE ═══════════════════════════════ -->
<section class="showcase-section" id="languages">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Top Picks</span>
            <h2 class="section-title">Where to<br><em>Start?</em></h2>
            <p class="section-sub">If you're new here, these three languages have the most viral tutorials and the warmest community.</p>
        </div>
        <div class="showcase-grid">
            <?php
            $top3 = array_filter($courses, fn($c) => in_array($c['course_name'], ['Python','JavaScript','PHP']));
            foreach ($top3 as $row):
                $name   = htmlspecialchars($row['course_name']);
                $icon   = $course_icons[$row['course_name']] ?? '💻';
                $colors = $course_colors[$row['course_name']] ?? ['#666','#999'];
                $desc   = $course_desc[$row['course_name']] ?? '';
            ?>
            <a href="course.php?id=<?php echo $row['id']; ?>" class="showcase-card" style="--c1:<?php echo $colors[0]; ?>;--c2:<?php echo $colors[1]; ?>">
                <div class="showcase-icon"><?php echo $icon; ?></div>
                <div class="showcase-content">
                    <h3><?php echo $name; ?></h3>
                    <p><?php echo $desc; ?></p>
                    <span class="showcase-count"><?php echo $row['video_count']; ?> top tutorials</span>
                </div>
                <div class="showcase-arrow">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 10h12M12 6l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ CTA BANNER ═══════════════════════════════ -->
<section class="cta-section">
    <div class="cta-bg">
        <div class="cta-glow"></div>
    </div>
    <div class="container">
        <div class="cta-inner">
            <h2 class="cta-title">Ready to write<br><em>better code?</em></h2>
            <p class="cta-sub">Join thousands of developers who start every learning session with CodeVault.</p>
            <a href="#courses" class="btn btn-primary btn-large">Browse All Courses →</a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ FOOTER ═══════════════════════════════ -->
<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">
                    <span class="logo-mark">CV</span>
                    <span class="logo-text">CodeVault</span>
                </div>
                <p>The internet's best programming tutorials, curated and organized for developers who don't have time to waste.</p>
            </div>
            <div class="footer-links">
                <div class="footer-col">
                    <h4>Languages</h4>
                    <?php foreach (array_slice($courses, 0, 5) as $c): ?>
                    <a href="course.php?id=<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['course_name']); ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="footer-col">
                    <h4>More</h4>
                    <?php foreach (array_slice($courses, 5) as $c): ?>
                    <a href="course.php?id=<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['course_name']); ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="footer-col">
                    <h4>Platform</h4>
                    <a href="#courses">Browse Courses</a>
                    <a href="#why">About</a>
                    <a href="#stats">Statistics</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?php echo date('Y'); ?> CodeVault · All content sourced from YouTube · Curated with ❤️</p>
            <p class="footer-note">Tutorials shown have 1,000,000+ views</p>
        </div>
    </div>
</footer>

<script>
// Nav scroll effect
const nav = document.getElementById('nav');
window.addEventListener('scroll', () => {
    nav.classList.toggle('nav--scrolled', window.scrollY > 60);
});

// Mobile burger
document.getElementById('burger').addEventListener('click', function() {
    document.querySelector('.nav-links').classList.toggle('open');
    this.classList.toggle('active');
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    });
});

// Intersection observer for card animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(el => {
        if (el.isIntersecting) {
            el.target.classList.add('visible');
            observer.unobserve(el.target);
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.course-card, .why-card, .stat-card, .showcase-card').forEach(el => observer.observe(el));
</script>
</body>
</html>
<?php $conn->close(); ?>