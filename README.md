# Programming Tutorials Recommendation Platform

A modern web platform that recommends the best YouTube programming tutorials with over 1 million views.

## Features

- **Homepage**: Browse programming languages (Python, Java, JavaScript, PHP, C++, etc.)
- **Course Pages**: View top-rated YouTube tutorials for each language
- **Video Cards**: Display thumbnails, views, likes, and comments
- **Modern UI**: Responsive design with smooth animations
- **Database**: MySQL backend with sample data

## Technologies Used

- **HTML5**: Semantic markup
- **CSS3**: Modern styling with animations
- **PHP**: Backend logic and database interactions
- **MySQL**: Data storage and management

## Project Structure

```
prog_tuto/
├── index.php          # Homepage with course listing
├── course.php         # Course page with video listings
├── db.php            # Database connection and utilities
├── style.css         # Modern CSS styling
├── database.sql      # Database schema and sample data
└── README.md         # This file
```

## Setup Instructions

### 1. Database Setup

1. Create a MySQL database:
   ```sql
   CREATE DATABASE programming_tutorials;
   ```

2. Import the database schema and sample data:
   ```bash
   mysql -u root -p programming_tutorials < database.sql
   ```

### 2. Web Server Setup

1. Place all files in your web server's document root (e.g., `htdocs/`, `www/`)

2. Ensure PHP and MySQL are properly configured

3. Update database credentials in `db.php` if needed:
   ```php
   $host = 'localhost';
   $username = 'root';
   $password = ''; // Your MySQL password
   $database = 'programming_tutorials';
   ```

### 3. Access the Application

Open your web browser and navigate to:
```
http://localhost/prog_tuto/
```

## Database Schema

### Courses Table
- `id`: Primary key
- `course_name`: Programming language name
- `created_at`: Timestamp

### Videos Table
- `id`: Primary key
- `course_id`: Foreign key to courses table
- `title`: Video title
- `thumbnail`: YouTube thumbnail URL
- `views`: Number of views (filtered > 1M)
- `likes`: Number of likes
- `comments`: Number of comments
- `youtube_link`: Direct YouTube URL
- `created_at`: Timestamp

## Features Overview

### Homepage (index.php)
- Grid layout of programming languages
- Shows available tutorial count for each language
- Clickable cards with hover effects
- Responsive design for mobile devices

### Course Page (course.php)
- Displays 5+ YouTube tutorials per language
- Video cards with thumbnails and statistics
- Click to open videos in new tabs
- Breadcrumb navigation
- Back button to return to homepage

### Video Cards
- Thumbnail preview
- Video title (truncated if too long)
- Views, likes, and comments with formatted numbers (1M, 250K, etc.)
- Hover effects and smooth transitions
- Direct YouTube links

## Sample Data

The database includes sample data for 10 programming languages:
- Python, Java, JavaScript, PHP, C++, C#, Ruby, Go, Swift, Kotlin

Each language has 5 popular YouTube tutorials with:
- Real video titles
- YouTube thumbnails
- View counts (all > 1M)
- Like and comment counts
- Working YouTube links

## Customization

### Adding New Courses
1. Insert into `courses` table:
   ```sql
   INSERT INTO courses (course_name) VALUES ('YourLanguage');
   ```

2. Add videos for the course:
   ```sql
   INSERT INTO videos (course_id, title, thumbnail, views, likes, comments, youtube_link) 
   VALUES (course_id, 'Title', 'thumbnail_url', 1500000, 50000, 3000, 'youtube_url');
   ```

### Styling
- Edit `style.css` to customize colors, fonts, and layouts
- CSS uses modern features like Grid and Flexbox
- Responsive breakpoints at 768px and 480px

### Database Configuration
- Modify `db.php` for different database credentials
- Add utility functions for formatting data
- Implement additional database queries as needed

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## Security Notes

- Uses prepared statements to prevent SQL injection
- HTML output is properly escaped
- Database credentials should be secured in production
- Consider implementing rate limiting for API calls

## Future Enhancements

- User authentication and favorites
- Search functionality
- Video rating system
- Category filtering
- API integration for real-time data
- Admin panel for content management

## Troubleshooting

### Database Connection Issues
- Check MySQL server is running
- Verify database credentials in `db.php`
- Ensure database exists and is imported

### Missing Thumbnails
- YouTube thumbnails may fail to load
- Fallback image is provided
- Check internet connectivity

### PHP Errors
- Ensure PHP 7.4+ is installed
- Check error logs for specific issues
- Verify all required extensions are enabled

## License

This project is open source and available under the MIT License.
