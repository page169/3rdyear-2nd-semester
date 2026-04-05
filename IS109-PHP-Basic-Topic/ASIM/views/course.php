<?php
session_start();
require_once "../lib/database.php";
require_once "../lib/route.php";
ob_start();
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #198754 0%, #055160 100%);
        border-radius: 24px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        animation: slideDown 0.5s ease-out;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(184,154,107,0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .page-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: white;
        margin: 0;
        letter-spacing: -0.5px;
        position: relative;
        z-index: 1;
    }
    
    .page-subtitle {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.8);
        margin-top: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .add-btn {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .add-btn:hover {
        background: white;
        color: #8B2C3E;
        border-color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    /* Stats Cards */
    .stats-mini {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
        animation: fadeInUp 0.5s ease-out 0.1s backwards;
    }
    
    .stat-mini-card {
        background: white;
        border-radius: 20px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        cursor: pointer;
    }
    
    .stat-mini-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .stat-mini-info h4 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #198754;
        margin: 0;
    }
    
    .stat-mini-info p {
        font-size: 0.75rem;
        color: #6c757d;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-mini-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, rgba(139,44,62,0.1), rgba(184,154,107,0.1));
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: #198754;
    }
    
    /* Course Cards Grid View */
    .view-toggle {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        justify-content: flex-end;
    }
    
    .view-btn {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        background: white;
        border: 2px solid #E8E0D4;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .view-btn.active {
        background: #8B2C3E;
        border-color: #8B2C3E;
        color: white;
    }
    
    .view-btn:hover:not(.active) {
        border-color: #B89A6B;
        background: #F5F0E8;
    }
    
    /* Grid View */
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        animation: fadeInUp 0.5s ease-out 0.2s backwards;
    }
    
    .course-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        position: relative;
    }
    
    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .course-card-header {
        background: linear-gradient(135deg, #198754 0%, #055160 100%);
        padding: 1.25rem;
        position: relative;
        overflow: hidden;
    }
    
    .course-card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(184,154,107,0.2) 0%, transparent 70%);
        animation: rotate 15s linear infinite;
    }
    
    .course-icon {
        font-size: 2rem;
        color: white;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }
    
    .course-code {
        font-size: 1.25rem;
        font-weight: 800;
        color: white;
        margin: 0;
        position: relative;
        z-index: 1;
    }
    
    .course-card-body {
        padding: 1.25rem;
    }
    
    .course-description {
        color: #6c757d;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        min-height: 60px;
    }
    
    .course-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #E8E0D4;
        margin-bottom: 1rem;
    }
    
    .student-count {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #198754;
        font-weight: 600;
    }
    
    .created-date {
        font-size: 0.75rem;
        color: #adb5bd;
    }
    
    .course-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    /* Table View */
    .table-container {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        display: none;
    }
    
    .table-container.active-view {
        display: block;
        animation: fadeInUp 0.5s ease-out;
    }
    
    .courses-grid.active-view {
        display: grid;
    }
    
    /* Custom Table Styles */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .custom-table thead th {
        background: linear-gradient(135deg, #8B2C3E 0%, #6B1E2C 100%);
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 1rem;
        white-space: nowrap;
    }
    
    .custom-table thead th:first-child {
        border-radius: 16px 0 0 0;
    }
    
    .custom-table thead th:last-child {
        border-radius: 0 16px 0 0;
    }
    
    .custom-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #E8E0D4;
    }
    
    .custom-table tbody tr:hover {
        background: #F5F0E8;
        transform: scale(1.01);
    }
    
    .custom-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        font-size: 0.875rem;
        color: #2C2C2C;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }
    
    .btn-action {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-edit {
        background: rgba(139, 44, 62, 0.1);
        color: #8B2C3E;
    }
    
    .btn-edit:hover {
        background: #8B2C3E;
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-delete {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .btn-delete:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Modal Styles */
    .modal-custom .modal-content {
        border-radius: 24px;
        border: none;
        overflow: hidden;
    }
    
    .modal-custom .modal-header {
        background: linear-gradient(135deg, #198754 0%, #055160 100%);
        padding: 1.25rem 1.5rem;
        border: none;
    }
    
    .modal-custom .modal-title {
        color: white;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .modal-custom .modal-body {
        padding: 1.5rem;
        background: #F5F0E8;
    }
    
    .modal-custom .modal-footer {
        background: white;
        border-top: 1px solid #E8E0D4;
        padding: 1rem 1.5rem;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 1rem;
    }
    
    .form-label-custom {
        font-weight: 600;
        font-size: 0.875rem;
        color: #2C2C2C;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control-custom {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #E8E0D4;
        border-radius: 16px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: white;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: #B89A6B;
        box-shadow: 0 0 0 3px rgba(184, 154, 107, 0.1);
    }
    
    /* Search & Filter */
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .search-box {
        position: relative;
        flex: 1;
        max-width: 300px;
    }
    
    .search-box i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #B89A6B;
    }
    
    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 2px solid #E8E0D4;
        border-radius: 16px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #B89A6B;
        box-shadow: 0 0 0 3px rgba(184, 154, 107, 0.1);
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.25rem;
        }
        
        .stats-mini {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .courses-grid {
            grid-template-columns: 1fr;
        }
        
        .table-controls {
            flex-direction: column;
        }
        
        .search-box {
            max-width: 100%;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
            text-align: center;
        }
        
        .custom-table {
            min-width: 500px;
        }
        
        .view-toggle {
            justify-content: center;
        }
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<main>
    <div class="container-fluid p-3">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-book-open me-2"></i>
                        Course Management
                    </h1>
                    <p class="page-subtitle">
                        Manage academic programs, track student enrollment, and configure course offerings
                    </p>
                </div>
                <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-2"></i>
                    Add Course
                </button>
            </div>
        </div>
        
        <!-- Mini Stats -->
        <div class="stats-mini">
            <?php
            // Get counts for stats
            $totalCourses = $conn->query("SELECT COUNT(*) as total FROM course")->fetch_assoc()['total'];
            $totalStudents = $conn->query("SELECT COUNT(*) as total FROM student")->fetch_assoc()['total'];
            $activeStudents = $conn->query("SELECT COUNT(*) as total FROM student WHERE status = 1")->fetch_assoc()['total'];
            $mostEnrolled = $conn->query("SELECT c.course, COUNT(s.id) as student_count 
                                          FROM course c 
                                          LEFT JOIN student s ON c.id = s.course_id 
                                          GROUP BY c.id 
                                          ORDER BY student_count DESC 
                                          LIMIT 1")->fetch_assoc();
            ?>
            <div class="stat-mini-card" onclick="window.location.href='<?php echo ROUTE_COURSE; ?>'">
                <div class="stat-mini-info">
                    <h4><?php echo number_format($totalCourses); ?></h4>
                    <p>Total Courses</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-book"></i>
                </div>
            </div>
            <div class="stat-mini-card">
                <div class="stat-mini-info">
                    <h4><?php echo number_format($totalStudents); ?></h4>
                    <p>Total Students</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-mini-card">
                <div class="stat-mini-info">
                    <h4><?php echo number_format($activeStudents); ?></h4>
                    <p>Active Students</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-mini-card">
                <div class="stat-mini-info">
                    <h4><?php echo $mostEnrolled ? htmlspecialchars($mostEnrolled['course']) : 'N/A'; ?></h4>
                    <p>Most Enrolled</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-trophy"></i>
                </div>
            </div>
        </div>
        
        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="view-btn active" id="gridViewBtn">
                <i class="fas fa-th-large"></i> Grid View
            </button>
            <button class="view-btn" id="tableViewBtn">
                <i class="fas fa-table"></i> Table View
            </button>
        </div>
        
        <!-- Grid View -->
        <div class="courses-grid active-view" id="gridView">
            <?php
            $sql = "SELECT c.*, COUNT(s.id) as student_count 
                    FROM course c 
                    LEFT JOIN student s ON c.id = s.course_id 
                    GROUP BY c.id 
                    ORDER BY c.id DESC";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                <div class="course-card" data-course="<?php echo strtolower($row['course']); ?>" data-description="<?php echo strtolower($row['description']); ?>">
                    <div class="course-card-header">
                        <div class="course-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="course-code"><?php echo htmlspecialchars($row['course']); ?></h3>
                    </div>
                    <div class="course-card-body">
                        <div class="course-description">
                            <?php echo htmlspecialchars($row['description']); ?>
                        </div>
                        <div class="course-stats">
                            <div class="student-count">
                                <i class="fas fa-user-graduate"></i>
                                <?php echo number_format($row['student_count']); ?> Students
                            </div>
                            <div class="created-date">
                                <i class="far fa-calendar-alt"></i>
                                <?php echo date('M d, Y', strtotime($row['date_created'])); ?>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="btn-action btn-edit" 
                                data-id="<?php echo $row['id']; ?>"
                                data-course="<?php echo htmlspecialchars($row['course']); ?>"
                                data-description="<?php echo htmlspecialchars($row['description']); ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal"
                                style="flex: 1;">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn-action btn-delete" 
                                data-id="<?php echo $row['id']; ?>"
                                data-course="<?php echo htmlspecialchars($row['course']); ?>"
                                data-student-count="<?php echo $row['student_count']; ?>"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal"
                                style="flex: 1;">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } else { 
            ?>
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <p>No courses found. Click "Add Course" to get started.</p>
                </div>
            <?php } ?>
        </div>
        
        <!-- Table View -->
        <div class="table-container" id="tableView">
            <div class="table-controls">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search course code or description...">
                </div>
                <div class="d-flex gap-2">
                    <div class="filter-badge" id="sortByStudents" style="background: white; padding: 0.5rem 1rem; border-radius: 12px; cursor: pointer;">
                        <i class="fas fa-sort-amount-down"></i> Sort by Students
                    </div>
                </div>
            </div>
            
            <table class="custom-table" id="courseTable">
                <thead>
                    <tr>
                        <th style="width: 80px;">#</th>
                        <th>Course Code</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th>Students</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT c.*, COUNT(s.id) as student_count 
                            FROM course c 
                            LEFT JOIN student s ON c.id = s.course_id 
                            GROUP BY c.id 
                            ORDER BY c.id DESC";
                    $counter = 1;
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr data-course="<?php echo strtolower($row['course']); ?>" data-description="<?php echo strtolower($row['description']); ?>" data-students="<?php echo $row['student_count']; ?>">
                            <td><strong><?php echo $counter++; ?></strong></td>
                            <td>
                                <span style="background: linear-gradient(135deg, #8B2C3E, #6B1E2C); color: white; padding: 0.35rem 0.75rem; border-radius: 8px; font-weight: 600;">
                                    <?php echo htmlspecialchars($row['course']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
                                <i class="far fa-calendar-alt me-1" style="color: #B89A6B;"></i>
                                <?php echo date('M d, Y', strtotime($row['date_created'])); ?>
                            </td>
                            <td>
                                <a href="<?php echo ROUTE_STUDENT; ?>" class="text-decoration-none">
                                    <span class="badge" style="background: rgba(139,44,62,0.1); color: #8B2C3E; padding: 0.5rem 1rem;">
                                        <i class="fas fa-users me-1"></i> <?php echo number_format($row['student_count']); ?> Students
                                    </span>
                                </a>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-edit" 
                                        data-id="<?php echo $row['id']; ?>"
                                        data-course="<?php echo htmlspecialchars($row['course']); ?>"
                                        data-description="<?php echo htmlspecialchars($row['description']); ?>"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" 
                                        data-id="<?php echo $row['id']; ?>"
                                        data-course="<?php echo htmlspecialchars($row['course']); ?>"
                                        data-student-count="<?php echo $row['student_count']; ?>"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php 
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add Modal -->
    <div class="modal fade modal-custom" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle"></i>
                        Add New Course
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_ADDCOURSE; ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label-custom">Course Code</label>
                            <input type="text" class="form-control-custom" name="course" placeholder="e.g., BSIS, BSBA, BSCS" required>
                            <small class="text-muted mt-1 d-block">Enter the course code/acronym</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Course Description</label>
                            <textarea class="form-control-custom" name="description" rows="3" placeholder="e.g., Bachelor of Science in Information Systems" required></textarea>
                            <small class="text-muted mt-1 d-block">Enter the full course name</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background: #8B2C3E; color: white;">
                            <i class="fas fa-save me-1"></i> Add Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Edit Modal -->
    <div class="modal fade modal-custom" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit"></i>
                        Edit Course
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_EDITCOURSE; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="e_id" name="id">
                        <input type="hidden" id="e_old_course" name="old_course">
                        <div class="form-group">
                            <label class="form-label-custom">Course Code</label>
                            <input type="text" class="form-control-custom" id="e_course" name="course" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Course Description</label>
                            <textarea class="form-control-custom" id="e_description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background: #8B2C3E; color: white;">
                            <i class="fas fa-save me-1"></i> Update Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Delete Modal -->
    <div class="modal fade modal-custom" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-trash-alt"></i>
                        Delete Course
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_DELETECOURSE; ?>" method="post">
                    <div class="modal-body text-center py-4">
                        <input type="hidden" id="d_id" name="id">
                        <i class="fas fa-exclamation-triangle fa-3x mb-3" style="color: #dc3545;"></i>
                        <p id="deleteWarning" class="mb-0"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-1"></i> Delete Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Active sidebar
    const sidebar = document.getElementById('course');
    if (sidebar) sidebar.classList.add('bg-primary', 'active');
    
    // View Toggle
    const gridView = document.getElementById('gridView');
    const tableView = document.getElementById('tableView');
    const gridViewBtn = document.getElementById('gridViewBtn');
    const tableViewBtn = document.getElementById('tableViewBtn');
    
    gridViewBtn.addEventListener('click', () => {
        gridView.classList.add('active-view');
        tableView.classList.remove('active-view');
        gridViewBtn.classList.add('active');
        tableViewBtn.classList.remove('active');
    });
    
    tableViewBtn.addEventListener('click', () => {
        tableView.classList.add('active-view');
        gridView.classList.remove('active-view');
        tableViewBtn.classList.add('active');
        gridViewBtn.classList.remove('active');
    });
    
    // Edit modal data population
    const e_id = document.getElementById('e_id');
    const e_old_course = document.getElementById('e_old_course');
    const e_course = document.getElementById('e_course');
    const e_description = document.getElementById('e_description');
    const d_id = document.getElementById('d_id');
    const deleteWarning = document.getElementById('deleteWarning');
    
    document.addEventListener('click', function(e) {
        const editBtn = e.target.closest('.btn-edit');
        const deleteBtn = e.target.closest('.btn-delete');
        
        if (editBtn) {
            e_id.value = editBtn.dataset.id;
            e_old_course.value = editBtn.dataset.course;
            e_course.value = editBtn.dataset.course;
            e_description.value = editBtn.dataset.description;
        }
        
        if (deleteBtn) {
            d_id.value = deleteBtn.dataset.id;
            const studentCount = parseInt(deleteBtn.dataset.studentCount);
            const courseCode = deleteBtn.dataset.course;
            
            if (studentCount > 0) {
                deleteWarning.innerHTML = `
                    <i class="fas fa-users me-1"></i> 
                    <strong>Warning!</strong><br>
                    This course has ${studentCount} student(s) enrolled.<br>
                    Deleting this course will affect these student records.<br>
                    Are you sure you want to continue?
                `;
                deleteWarning.style.color = "#dc3545";
                deleteWarning.style.fontWeight = "500";
            } else {
                deleteWarning.innerHTML = `Are you sure you want to delete ${courseCode}?`;
                deleteWarning.style.color = "#2C2C2C";
            }
        }
    });
    
    // Search functionality for table view
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('courseTable');
    const tableRows = table ? table.querySelectorAll('tbody tr') : [];
    
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            tableRows.forEach(row => {
                const course = row.getAttribute('data-course') || '';
                const description = row.getAttribute('data-description') || '';
                const text = course + description;
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }
    
    // Search for grid view
    const gridSearch = document.createElement('div');
    gridSearch.className = 'search-box';
    gridSearch.innerHTML = `
        <i class="fas fa-search"></i>
        <input type="text" id="gridSearchInput" class="search-input" placeholder="Search courses...">
    `;
    const tableControls = document.querySelector('.table-controls');
    if (tableControls && !document.getElementById('gridSearchInput')) {
        const gridSearchClone = gridSearch.cloneNode(true);
        gridSearchClone.id = 'gridSearchClone';
        tableControls.parentNode.insertBefore(gridSearchClone, tableControls);
        
        const gridSearchInput = document.getElementById('gridSearchInput');
        if (gridSearchInput) {
            const courseCards = document.querySelectorAll('.course-card');
            gridSearchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                courseCards.forEach(card => {
                    const course = card.getAttribute('data-course') || '';
                    const description = card.getAttribute('data-description') || '';
                    const text = course + description;
                    card.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    }
    
    // Sort by students in table view
    const sortByStudents = document.getElementById('sortByStudents');
    let sortDirection = 'desc';
    
    if (sortByStudents) {
        sortByStudents.addEventListener('click', function() {
            const tbody = table.querySelector('tbody');
            const rowsArray = Array.from(tableRows);
            
            rowsArray.sort((a, b) => {
                const studentsA = parseInt(a.getAttribute('data-students') || 0);
                const studentsB = parseInt(b.getAttribute('data-students') || 0);
                return sortDirection === 'desc' ? studentsB - studentsA : studentsA - studentsB;
            });
            
            rowsArray.forEach(row => tbody.appendChild(row));
            
            sortDirection = sortDirection === 'desc' ? 'asc' : 'desc';
            sortByStudents.innerHTML = sortDirection === 'desc' ? 
                '<i class="fas fa-sort-amount-down"></i> Sort by Students' : 
                '<i class="fas fa-sort-amount-up"></i> Sort by Students';
        });
    }
</script>

<?php
$content = ob_get_clean();
include 'layout/layout.php';
?>