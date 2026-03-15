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
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Custom sorting function
usort($courses, function($a, $b) use ($preferred_order) {
    $a_name = $a['course_name'];
    $b_name = $b['course_name'];
    
    $a_index = array_search($a_name, $preferred_order);
    $b_index = array_search($b_name, $preferred_order);
    
    // If both are in preferred order, sort by their position
    if ($a_index !== false && $b_index !== false) {
        return $a_index - $b_index;
    }
    
    // If only one is in preferred order, it comes first
    if ($a_index !== false) {
        return -1;
    }
    if ($b_index !== false) {
        return 1;
    }
    
    // If neither is in preferred order, sort alphabetically
    return strcmp($a_name, $b_name);
});

// Course icons mapping
$course_icons = [
    'Python' => '🐍',
    'Java' => '☕',
    'JavaScript' => '🌟',
    'PHP' => '🐘',
    'C++' => '⚡',
    'C#' => '🔷',
    'Ruby' => '💎',
    'Go' => '🐹',
    'Swift' => '🦉',
    'Kotlin' => '🎯'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming Tutorials - Best YouTube Courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📚 Programming Tutorials Platform</h1>
            <p>Discover the best YouTube programming tutorials with 1M+ views</p>
        </header>

        <main>
            <section class="courses-section">
                <h2 style="color: white; text-align: center; margin-bottom: 20px;">Choose a Programming Language</h2>
                
                <?php if (!empty($courses)): ?>
                    <div class="courses-grid">
                        <?php foreach ($courses as $row): ?>
                            <a href="course.php?id=<?php echo $row['id']; ?>" class="course-card-link">
                                <div class="course-card">
                                    <div class="course-icon">
                                        <?php echo isset($course_icons[$row['course_name']]) ? $course_icons[$row['course_name']] : '💻'; ?>
                                    </div>
                                    <h3 class="course-name"><?php echo htmlspecialchars($row['course_name']); ?></h3>
                                    <p class="course-count"><?php echo $row['video_count']; ?> tutorials available</p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="error">
                        No courses found in the database. Please import the database schema first.
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <style>
        .course-card-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</body>
</html>

<?php
$conn->close();
?>
