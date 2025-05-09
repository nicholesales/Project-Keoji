<!-- app/Views/posts/index.php -->
<?php 
// Debug data
echo '<!-- Debug: recentPosts count: ' . (isset($recentPosts) ? count($recentPosts) : 'not set') . ' -->';
echo '<!-- Debug: featuredPosts count: ' . (isset($featuredPosts) ? count($featuredPosts) : 'not set') . ' -->';
?>
<?= $this->extend('layout/posts') ?>

<?= $this->section('content') ?>

<!-- Add CSS for Project Keoji design -->
<style>
    :root {
         /* Light theme variables (default) */
    --bg: #f5f7fa;
    --bg-secondary: #ffffff;
    --bg-tertiary: #f0f2f5;
    --border: #e5e7eb;
    --text: #333333;
    --text-muted: #666666;
    --shadow-sm: 0 5px 15px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 15px 35px rgba(0, 0, 0, 0.15);
    
    /* Dark theme variables (will be applied with .dark-mode class) */
    --dark-bg: #1a1c25;
    --dark-bg-secondary: #282c34;
    --dark-bg-tertiary: #2d3748;
    --dark-border: #3a3f4b;
    --dark-text: #e0e0e0;
    --dark-text-muted: #a0a0a0;
    --dark-shadow-sm: 0 5px 15px rgba(0, 0, 0, 0.2);
    --dark-shadow-md: 0 10px 30px rgba(0, 0, 0, 0.25);
    --dark-shadow-lg: 0 15px 35px rgba(0, 0, 0, 0.3)
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: var(--bg-light);
    }
    
    /* Main container */
    .keoji-container {
        display: flex;
        min-height: 100vh;
    }
    
    /* Sidebar styles */
    .sidebar {
        width: 250px;
        background-color: white;
        border-right: 1px solid #e9ecef;
        position: fixed;
        height: 100vh;
        left: 0;
        top: 0;
        z-index: 1000;
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }
    
    .sidebar.collapsed {
        width: 60px;
    }

    .sidebar.collapsed .logo-container span,
    .sidebar.collapsed .workspace-info,
    .sidebar.collapsed .workspace-dropdown,
    .sidebar.collapsed .sidebar-menu .menu-item span,
    .sidebar.collapsed .sidebar-menu .badge {
        display: none;
    }
    .sidebar.collapsed .logo-container {
    justify-content: center;
    padding: 10px 0;
    }

    .sidebar.collapsed .user-workspace {
        justify-content: center;
    }

    .sidebar.collapsed .workspace-avatar {
        margin-right: 0;
    }

    .sidebar.collapsed .menu-item {
        justify-content: center;
        padding: 10px 0;
    }
    
    .logo-container {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }
    
    .logo {
        width: 32px;
        height: 32px;
        margin-right: 10px;
        object-fit: contain;
    }
    
    .sidebar-toggle {
        position: absolute;
        top: 15px;
        right: 10px;
    }
    
    .sidebar-toggle button {
        background: transparent;
        border: none;
        font-size: 16px;
        cursor: pointer;
        color: #777;
    }
    
    .user-workspace {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }
    
    .workspace-avatar img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin-right: 10px;
    }
    
    .workspace-info {
        flex: 1;
    }
    
    .workspace-name {
        margin: 0;
        font-weight: 500;
        font-size: 14px;
    }
    
    .workspace-id {
        margin: 0;
        font-size: 12px;
        color: var(--text-light);
    }
    
    .sidebar-menu {
        padding: 15px 0;
    }
    
    .menu-item {
        padding: 10px 20px;
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 14px;
        position: relative;
    }
    
    .menu-item:hover {
        background-color: #f8f9fa;
    }
    
    .menu-item.active {
        font-weight: 500;
        background-color: #f0f0f0;
    }
    
    .menu-item i {
        margin-right: 10px;
        font-size: 18px;
    }
    
    .menu-item .badge {
        margin-left: auto;
        font-size: 11px;
    }
    
    /* Main content styles */
    .main-content {
        flex: 1;
        margin-left: 250px;
    transition: all 0.3s ease;
    }
    
    .main-content.expanded {
        margin-left: 60px;
    }
    
    /* Header styles */
    .keoji-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 60px;
        padding: 0 20px;
        background-color: white;
        border-bottom: 1px solid #eee;
    }
    
    .header-left h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    
    .header-right {
        display: flex;
        align-items: center;
    }
    
    .theme-toggle {
        background: none;
        border: none;
        color: #555;
        font-size: 18px;
        margin-right: 15px;
        cursor: pointer;
    }
    
    .user-profile img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    /* Content area styles */
    .content-area {
        padding: 20px;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .section-header h1 {
        margin: 0;
        font-size: 24px;
        font-weight: 500;
    }
    
    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .section-title h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 500;
    }
    
    .post-filters {
        display: flex;
        align-items: center;
    }
    
    .filter {
        margin-left: 15px;
        font-size: 14px;
        color: var(--text-light);
        cursor: pointer;
    }
    
    .filter.active {
        color: var(--primary-color);
        font-weight: 500;
    }
    
    .filter i {
        margin-right: 5px;
    }
    
    /* Post items */
    .post-section {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .post-list {
        display: flex;
        flex-direction: column;
    }
    
    .post-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }
    
    .post-item:last-child {
        border-bottom: none;
    }
    
    .post-icon {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 18px;
        color: var(--primary-color);
    }
    
    .post-content {
        flex: 1;
    }
    
    .post-title {
        font-weight: 500;
        margin-bottom: 5px;
    }
    
    .post-date {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .post-actions {
        display: flex;
    }
    
    .action-btn {
        background: none;
        border: none;
        color: #777;
        font-size: 16px;
        margin-left: 10px;
        cursor: pointer;
        padding: 5px;
    }
    
    .action-btn:hover {
        color: var(--primary-color);
    }
    
    /* Featured post styles */
    .featured-post-container {
    display: flex;
    overflow-x: auto;
    gap: 20px;
    padding: 10px 0;
    scrollbar-width: thin;
    scrollbar-color: rgba(0,0,0,0.2) transparent;
    }

    .featured-post-container::-webkit-scrollbar {
        height: 6px;
    }

    .featured-post-container::-webkit-scrollbar-track {
        background: transparent;
    }

    .featured-post-container::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.2);
        border-radius: 6px;
    }

    /* Card design improvements */
    .featured-post-card {
        min-width: 320px;
        max-width: 380px;
        border-radius: 12px;
        overflow: hidden;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 10px;
    }

    .featured-post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }

    /* Image container more square-like */
    .featured-image {
        position: relative;
        height: 280px;
        width: 100%;
        overflow: hidden;
    }

    .featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .featured-post-card:hover .featured-image img {
        transform: scale(1.05);
    }

    /* Improved overlay with better text contrast and readability */
    .featured-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 25px 20px;
        background: linear-gradient(transparent, rgba(0,0,0,0.7) 40%, rgba(0,0,0,0.9));
        color: white;
        transition: padding 0.3s ease;
    }

    .featured-post-card:hover .featured-overlay {
        padding-bottom: 30px;
    }

    .featured-overlay p:first-child {
        margin-bottom: 8px;
        font-size: 12px;
        opacity: 0.9;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .featured-overlay h3 {
        margin: 8px 0;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.3;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
    }

    .featured-overlay p:last-child {
        margin-top: 8px;
        font-size: 14px;
        line-height: 1.5;
        opacity: 0.95;
    }

    /* Improved stats section */
    .featured-stats {
        display: flex;
        padding: 15px;
        font-size: 14px;
        color: var(--text-light);
        justify-content: space-around;
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    .featured-stats span {
        display: flex;
        align-items: center;
        margin: 0;
    }

    .featured-stats i {
        margin-right: 5px;
        font-size: 16px;
        color: #666;
    }
    
    /* Button styles */
    .btn-danger {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-outline-danger {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    /* Modal styles */
    .modal-content {
        border-radius: 10px;
    }
    
    .modal-header {
        border-bottom: 1px solid #eee;
    }
    
    .modal-footer {
        border-top: 1px solid #eee;
    }
    

/* Optional: Add navigation buttons for the scrollable container */
.featured-post-section {
    position: relative;
}

.scroll-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    cursor: pointer;
    z-index: 2;
}

.scroll-prev {
    left: 10px;
}

.scroll-next {
    right: 10px;
}

body, .sidebar, .main-content, .keoji-header, .post-section, .post-item, 
.featured-post-card, .post-list, .featured-post-container, 
.section-title, .post-title, .post-date, .post-content, .featured-overlay,
.featured-stats, .post-actions, .menu-item, .filter,
input, textarea, button, .modal-content {
    transition: all 0.3s ease-in-out;
}

/* Dark mode styles using CSS variables */
body.dark-mode {
    background-color: var(--dark-bg);
    color: var(--dark-text);
}

/* Sidebar in dark mode */
body.dark-mode .sidebar {
    background-color: var(--dark-bg-secondary);
    border-color: var(--dark-border);
}

body.dark-mode .sidebar-menu .menu-item {
    color: var(--dark-text-muted);
}

body.dark-mode .sidebar-menu .menu-item.active,
body.dark-mode .sidebar-menu .menu-item:hover {
    background-color: var(--dark-bg-tertiary);
    color: var(--dark-text);
}

body.dark-mode .user-workspace {
    border-color: var(--dark-border);
}

/* Header in dark mode */
body.dark-mode .keoji-header {
    background-color: var(--dark-bg-secondary);
    border-color: var(--dark-border);
}

/* Main content in dark mode */
body.dark-mode .main-content {
    background-color: var(--dark-bg);
}

/* Post sections in dark mode */
body.dark-mode .post-section,
body.dark-mode .section-title,
body.dark-mode .featured-post-container {
    background-color: var(--dark-bg-secondary);
    box-shadow: var(--dark-shadow-sm);
}

/* Post items in dark mode */
body.dark-mode .post-item {
    background-color: var(--dark-bg-tertiary);
    border-color: var(--dark-border);
}

body.dark-mode .post-title {
    color: var(--dark-text);
}

body.dark-mode .post-date {
    color: var(--dark-text-muted);
}

/* Featured posts in dark mode */
body.dark-mode .featured-post-card {
    background-color: var(--dark-bg-tertiary);
    box-shadow: var(--dark-shadow-md);
}

body.dark-mode .featured-stats {
    color: var(--dark-text-muted);
    border-color: var(--dark-border);
}

body.dark-mode .featured-overlay {
    /* Darker gradient for better contrast on featured images */
    background: linear-gradient(transparent, rgba(0,0,0,0.8) 50%, rgba(0,0,0,0.95));
}

/* Filters in dark mode */
body.dark-mode .filter {
    background-color: var(--dark-bg-tertiary);
    color: var(--dark-text-muted);
}

body.dark-mode .filter.active {
    background-color: var(--dark-bg);
    color: var(--dark-text);
}

/* Form elements in dark mode */
body.dark-mode input,
body.dark-mode textarea,
body.dark-mode select {
    background-color: var(--dark-bg-tertiary);
    border-color: var(--dark-border);
    color: var(--dark-text);
}

body.dark-mode .modal-content {
    background-color: var(--dark-bg-secondary);
    border-color: var(--dark-border);
}

/* Buttons in dark mode */
body.dark-mode .btn-primary {
    background-color: #4a5568;
    border-color: #2d3748;
}

body.dark-mode .btn-secondary {
    background-color: #718096;
    border-color: #4a5568;
}

/* Theme toggle button animation */
.theme-toggle {
    position: relative;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background-color: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    overflow: hidden;
    transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
}

.theme-toggle:hover {
    transform: rotate(15deg);
}

.theme-toggle i {
    font-size: 1.3rem;
    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
}

body:not(.dark-mode) .theme-toggle i.bi-moon-fill {
    transform: rotate(0deg) scale(1);
}

body.dark-mode .theme-toggle i.bi-sun-fill {
    transform: rotate(360deg) scale(1);
    color: #f6e05e; /* Yellow sun color */
}

/* Animation for the toggle button */
.theme-toggle::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
    transform: scale(0);
    transition: transform 0.6s;
    border-radius: 50%;
}

.theme-toggle:active::before {
    transform: scale(3);
}

/* Animation for the entire page when toggling */
/* Responsive */
@media (max-width: 992px) {
        .sidebar {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar.expanded {
            width: var(--sidebar-width);
        }
        
        .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        .main-content.sidebar-expanded {
            margin-left: var(--sidebar-width);
        }
    }

    @media (max-width: 768px) {
        .featured-post-card {
            min-width: 270px;
        }
        
        .featured-image {
            height: 240px;
        }
        
        .featured-overlay h3 {
            font-size: 18px;
        }
    }

    @media (max-width: 480px) {
        .featured-post-card {
            min-width: 240px;
        }
        
        .featured-image {
            height: 220px;
        }
    }
    
@keyframes fadeTransition {
    0% {
        opacity: 0.8;
    }
    100% {
        opacity: 1;
    }
}

body.transitioning {
    animation: fadeTransition 0.5s forwards;
}
</style>

<div class="keoji-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="logo">
            <span>Logo</span>
        </div>
        
        <div class="sidebar-toggle">
            <button id="sidebarToggleBtn"><i class="bi bi-chevron-left"></i></button>
        </div>
        
        <div class="user-workspace">
            <div class="workspace-avatar">
                <img src="<?= base_url('assets/images/profile.jfif') ?>" alt="User Avatar">
            </div>
            <div class="workspace-info">
                <p class="workspace-name">Rome's workspace</p>
                <p class="workspace-id">to POST</p>
            </div>
            <div class="workspace-dropdown">
                <i class="bi bi-chevron-down"></i>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-item">
                <i class="bi bi-rss"></i>
                <span>Feed</span>
                <span class="badge rounded-pill bg-danger">3</span>
            </div>
            <div class="menu-item active">
                <i class="bi bi-file-post"></i>
                <span>Post</span>
            </div>
            <div class="menu-item">
                <i class="bi bi-chat"></i>
                <span>Comments</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="keoji-header">
            <div class="header-left">
                <h2>POST</h2>
            </div>
            <div class="header-right">
                <button class="theme-toggle">
                    <i class="bi bi-moon-fill"></i>
                </button>
                <div class="user-profile">
                    <img src="<?= base_url('assets/images/profile.jfif') ?>" alt="Profile">
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Blog Posts Header -->
            <div class="section-header">
                <h1>Blog Posts</h1>
                <button type="button" class="btn btn-danger" id="newPostBtn">
                    + New Post
                </button>
            </div>

            <!-- Recent Posts Section -->
            <div class="post-section">
                <div class="section-title">
                    <h3>Recent Post</h3>
                    <div class="post-filters">
                        <span class="filter active"><i class="bi bi-grid-3x3-gap-fill"></i> All</span>
                        <span class="filter"><i class="bi bi-check-circle"></i> Published</span>
                        <span class="filter"><i class="bi bi-file-earmark"></i> Drafts</span>
                    </div>
                </div>
                
                <div class="post-list">
                    <?php if(empty($recentPosts)): ?>
                        <p>No posts yet. Create your first post!</p>
                    <?php else: ?>
                        <?php foreach($recentPosts as $post): ?>
                            <div class="post-item">
                                <div class="post-icon">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="post-content">
                                    <div class="post-title">
                                        <?= esc($post['title']) ?>
                                        <span class="badge <?= $post['status'] === 'draft' ? 'bg-secondary' : 'bg-danger' ?>">
                                            <?= $post['status'] === 'draft' ? 'Draft' : 'Published' ?>
                                        </span>
                                    </div>
                                    <div class="post-date">
                                        <i class="bi bi-calendar"></i> <?= date('M d, Y', strtotime($post['date_created'])) ?>
                                    </div>
                                </div>
                                <div class="post-actions">
                                    <button class="btn action-btn edit-post" data-id="<?= $post['post_id'] ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn action-btn delete-post" data-id="<?= $post['post_id'] ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Featured Posts Section -->
            <!-- Updated HTML structure with navigation buttons -->
            <div class="post-section featured-post-section">
                <div class="section-title">
                    <h3>Featured Post</h3>
                </div>
                
                <!-- Optional scroll navigation buttons -->
                <div class="scroll-prev scroll-nav"><i class="bi bi-chevron-left"></i></div>
                <div class="scroll-next scroll-nav"><i class="bi bi-chevron-right"></i></div>
                
                <div class="featured-post-container">
                    <?php if(empty($featuredPosts)): ?>
                        <p>No featured posts yet. Mark a post as featured to see it here!</p>
                    <?php else: ?>
                        <?php foreach($featuredPosts as $post): ?>
                            <div class="featured-post-card">
                                <div class="featured-image">
                                    <img src="<?= base_url('uploads/posts/' . $post['image']) ?>" alt="<?= esc($post['title']) ?>">
                                    <div class="featured-overlay">
                                        <p>Featured</p>
                                        <h3><?= esc($post['title']) ?></h3>
                                        <p><?= substr(esc($post['description']), 0, 100) ?>...</p>
                                    </div>
                                </div>
                                <div class="featured-stats">
                                    <span><i class="bi bi-hand-thumbs-up"></i> 6999</span>
                                    <span><i class="bi bi-chat"></i> 999</span>
                                    <span><i class="bi bi-eye"></i> 100k</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Post Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Create New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="postForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="post_id" name="post_id">
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Input text" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Dropdown</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category ?>"><?= $category ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="5" placeholder="Input text" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept=".jpg,.jpeg,.png" required>
                        <div id="imagePreviewContainer" class="mt-2 d-none">
                            <img id="imagePreview" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="featured" name="featured">
                        <label class="form-check-label" for="featured">
                            Mark as featured post
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-outline-danger" id="saveDraftBtn">Save as Draft</button>
                    <button type="submit" class="btn btn-danger" id="publishBtn">Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Sidebar toggle functionality
    $('#sidebarToggleBtn').click(function() {
        $('.sidebar').toggleClass('collapsed');
        $('.main-content').toggleClass('expanded');
        
        // Change toggle icon
        if ($('.sidebar').hasClass('collapsed')) {
            $(this).html('<i class="bi bi-chevron-right"></i>');
        } else {
            $(this).html('<i class="bi bi-chevron-left"></i>');
        }
    });
    
    // Theme toggle (light/dark)
    $('.theme-toggle').click(function() {
        $('body').toggleClass('dark-mode');
        
        // Change icon
        if ($('body').hasClass('dark-mode')) {
            $(this).html('<i class="bi bi-sun-fill"></i>');
        } else {
            $(this).html('<i class="bi bi-moon-fill"></i>');
        }
    });
    
    // Filter posts
    $('.post-filters').on('click', '.filter', function() {
    $('.filter').removeClass('active');
    $(this).addClass('active');
    
    var filterType = $(this).text().trim();
    
    if (filterType.includes('All')) {
        $('.post-item').show();
    } 
    else if (filterType.includes('Published')) {
        $('.post-item').hide();
        $('.post-item').each(function() {
            if ($(this).find('.badge').text().trim() === 'Published') {
                $(this).show();
            }
        });
    } 
    else if (filterType.includes('Drafts')) {
        $('.post-item').hide();
        $('.post-item').each(function() {
            if ($(this).find('.badge').text().trim() === 'Draft') {
                $(this).show();
            }
        });
    }
});
    
    // Clear any existing handlers to prevent duplicates
    $('#postForm').off('submit');
    $('#saveDraftBtn').off('click');
    $('#publishBtn').off('click');
    
    // Open modal for new post
    $('#newPostBtn').click(function() {
        $('#postModalLabel').text('Create New Post');
        $('#postForm')[0].reset();
        $('#post_id').val('');
        $('#imagePreviewContainer').addClass('d-none');
        $('#image').attr('required', true);
        $('#postModal').modal('show');
    });
    
    // Preview image
    $('#image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreviewContainer').removeClass('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Form submission handler
    $('#postForm').on('submit', function(e) {
        console.log('Form submit event triggered');
        e.preventDefault();
        e.stopPropagation();
        const status = $(this).data('submit-type') || 'published';
        console.log('Submitting with status: ' + status);
        submitPost(status);
    });
    
    // Handle save as draft
    $('#saveDraftBtn').on('click', function(e) {
        console.log('Save Draft button clicked');
        e.preventDefault();
        e.stopPropagation();
        $('#postForm').data('submit-type', 'draft');
        $('#postForm').submit();
    });
    
    // Handle publish
    $('#publishBtn').on('click', function(e) {
        console.log('Publish button clicked');
        e.preventDefault();
        e.stopPropagation();
        $('#postForm').data('submit-type', 'published');
        $('#postForm').submit();
    });
    
    // Add isSubmitting flag to prevent multiple submissions
    let isSubmitting = false;
    
    // Submit post function
    function submitPost(status) {
        // Prevent multiple submissions
        if (isSubmitting) {
            console.log('Form is already being submitted');
            return;
        }
        
        // Validate form
        if (!$('#postForm')[0].checkValidity()) {
            $('#postForm')[0].reportValidity();
            return;
        }
        
        // Set flag to prevent multiple submissions
        isSubmitting = true;
        
        // Disable buttons during submission
        $('#saveDraftBtn, #publishBtn').prop('disabled', true);
        
        // Create form data
        const formData = new FormData($('#postForm')[0]);
        formData.append('status', status);
        
        // Get post ID
        const postId = $('#post_id').val();
        
        // Debug - log form data
        console.log('Form data:', Object.fromEntries(formData));
        
        // Determine URL based on whether this is an edit or create
        const url = postId ? '<?= base_url('posts/update') ?>/' + postId : '<?= base_url('posts/create') ?>';
        console.log('Submitting to URL:', url);
        
        // Submit form
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Success response:', response);
                isSubmitting = false;
                $('#saveDraftBtn, #publishBtn').prop('disabled', false);
                
                if (response.success) {
                    // Close modal and refresh page
                    $('#postModal').modal('hide');
                    location.reload();
                } else {
                    // Display errors
                    console.error('Error response:', response);
                    alert('Error: ' + JSON.stringify(response.errors || response.message));
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', xhr.responseText);
                alert('An error occurred. Please check console for details.');
                isSubmitting = false;
                $('#saveDraftBtn, #publishBtn').prop('disabled', false);
            }
        });
    }
    
    // Edit post
    $(document).on('click', '.edit-post', function() {
        const postId = $(this).data('id');
        
        // Fetch post data
        $.ajax({
            url: '<?= base_url('posts/edit') ?>/' + postId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const post = response.post;
                    
                    // Fill form
                    $('#postModalLabel').text('Edit Post');
                    $('#post_id').val(post.post_id);
                    $('#title').val(post.title);
                    $('#category').val(post.category);
                    $('#content').val(post.description);
                    $('#featured').prop('checked', post.featured == 1);
                    
                    // Show image preview
                    $('#imagePreview').attr('src', '<?= base_url('uploads/posts') ?>/' + post.image);
                    $('#imagePreviewContainer').removeClass('d-none');
                    
                    // Image not required when editing
                    $('#image').removeAttr('required');
                    
                    // Show modal
                    $('#postModal').modal('show');
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });
    
    // Delete post (show confirmation)
    $(document).on('click', '.delete-post', function() {
        const postId = $(this).data('id');
        $('#confirmDelete').data('id', postId);
        $('#deleteModal').modal('show');
    });
    
    // Confirm delete
    $('#confirmDelete').click(function() {
        const postId = $(this).data('id');
        
        $.ajax({
            url: '<?= base_url('posts/delete') ?>/' + postId,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });
});

$(document).ready(function() {
    // Smooth scroll navigation for featured posts
    $('.scroll-next').click(function() {
        const container = $('.featured-post-container');
        const scrollAmount = container.width() / 2;
        container.animate({
            scrollLeft: container.scrollLeft() + scrollAmount
        }, 300);
    });
    
    $('.scroll-prev').click(function() {
        const container = $('.featured-post-container');
        const scrollAmount = container.width() / 2;
        container.animate({
            scrollLeft: container.scrollLeft() - scrollAmount
        }, 300);
    });
    
    // Hide/show navigation buttons based on scroll position
    function updateScrollButtons() {
        const container = $('.featured-post-container');
        const maxScrollLeft = container[0].scrollWidth - container[0].clientWidth;
        
        // Only show navigation if there's content to scroll
        if (maxScrollLeft > 0) {
            $('.scroll-nav').show();
            
            // Hide prev button if at start
            if (container.scrollLeft() <= 0) {
                $('.scroll-prev').fadeOut(200);
            } else {
                $('.scroll-prev').fadeIn(200);
            }
            
            // Hide next button if at end
            if (container.scrollLeft() >= maxScrollLeft - 10) {
                $('.scroll-next').fadeOut(200);
            } else {
                $('.scroll-next').fadeIn(200);
            }
        } else {
            // Hide both if no scrolling needed
            $('.scroll-nav').hide();
        }
    }
    
    // Initial check
    updateScrollButtons();
    
    // Listen for scroll events
    $('.featured-post-container').scroll(function() {
        updateScrollButtons();
    });
    
    // Update on window resize
    $(window).resize(function() {
        updateScrollButtons();
    });
});
</script>

<?= $this->endSection() ?>