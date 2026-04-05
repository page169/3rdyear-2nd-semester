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
    
    /* Table Container */
    .table-container {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        animation: fadeInUp 0.5s ease-out 0.2s backwards;
    }
    
    /* Custom Table Styles */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .custom-table thead th {
        background: linear-gradient(135deg, #198754 0%, #055160 100%);
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
    
    /* Year Level Badge */
    .year-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.875rem;
    }
    
    .year-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    .year-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
    .year-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
    .year-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: #2C2C2C; }
    .year-default { background: linear-gradient(135deg, #8B2C3E 0%, #B89A6B 100%); color: white; }
    
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
    
    /* Timeline View */
    .timeline-view {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    
    .timeline-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
    }
    
    .timeline-card:hover {
        transform: translateY(-5px);
        border-color: #B89A6B;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .timeline-year {
        font-size: 2.5rem;
        font-weight: 800;
        color: #198754;
        line-height: 1;
    }
    
    .timeline-label {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }
    
    .timeline-students {
        font-size: 0.75rem;
        color: #B89A6B;
        margin-top: 0.5rem;
        font-weight: 600;
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
        
        .table-container {
            padding: 1rem;
            overflow-x: auto;
        }
        
        .custom-table {
            min-width: 600px;
        }
        
        .timeline-view {
            grid-template-columns: repeat(2, 1fr);
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
                        <i class="fas fa-layer-group me-2"></i>
                        Year Level Management
                    </h1>
                    <p class="page-subtitle">
                        Manage academic year levels, track student distribution, and configure academic progression
                    </p>
                </div>
                <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-2"></i>
                    Add Year Level
                </button>
            </div>
        </div>
        
        <!-- Mini Stats -->
        <div class="stats-mini">
            <?php
            // Get counts for stats
            $totalLevels = $conn->query("SELECT COUNT(*) as total FROM yearlevel")->fetch_assoc()['total'];
            $totalStudents = $conn->query("SELECT COUNT(*) as total FROM student")->fetch_assoc()['total'];
            $activeStudents = $conn->query("SELECT COUNT(*) as total FROM student WHERE status = 1")->fetch_assoc()['total'];
            ?>
            <div class="stat-mini-card">
                <div class="stat-mini-info">
                    <h4><?php echo number_format($totalLevels); ?></h4>
                    <p>Year Levels</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-layer-group"></i>
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
                    <h4><?php echo $totalLevels > 0 ? round($totalStudents / $totalLevels) : 0; ?></h4>
                    <p>Avg per Level</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        
        <!-- Timeline View -->
        <div class="timeline-view">
            <?php
            $sql = "SELECT y.*, COUNT(s.id) as student_count 
                    FROM yearlevel y 
                    LEFT JOIN student s ON y.id = s.yearlevel_id 
                    GROUP BY y.id 
                    ORDER BY y.yearlevel ASC";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $yearClass = 'year-' . $row['yearlevel'];
                    if (!in_array($row['yearlevel'], [1,2,3,4])) $yearClass = 'year-default';
            ?>
                <div class="timeline-card" onclick="filterByYear(<?php echo $row['yearlevel']; ?>)">
                    <div class="timeline-year"><?php echo $row['yearlevel']; ?><?php echo $row['yearlevel'] == 1 ? 'st' : ($row['yearlevel'] == 2 ? 'nd' : ($row['yearlevel'] == 3 ? 'rd' : 'th')); ?></div>
                    <div class="timeline-label"><?php echo htmlspecialchars($row['description']); ?> Year</div>
                    <div class="timeline-students">
                        <i class="fas fa-user-graduate"></i> <?php echo number_format($row['student_count']); ?> Students
                    </div>
                </div>
            <?php 
                }
            }
            ?>
        </div>
        
        <!-- Table Container -->
        <div class="table-container">
            <div class="table-controls">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search year level or description...">
                </div>
                <div class="d-flex gap-2">
                    <div class="filter-badge" id="sortAsc" style="background: #8B2C3E; color: white; padding: 0.5rem 1rem; border-radius: 12px; cursor: pointer;">
                        <i class="fas fa-sort-numeric-up"></i> Sort Asc
                    </div>
                    <div class="filter-badge" id="sortDesc" style="background: white; padding: 0.5rem 1rem; border-radius: 12px; cursor: pointer;">
                        <i class="fas fa-sort-numeric-down"></i> Sort Desc
                    </div>
                </div>
            </div>
            
            <table class="custom-table" id="yearTable">
                <thead>
                    <tr>
                        <th style="width: 80px;">#</th>
                        <th>Year Level</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th style="width: 150px;">Students</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT y.*, COUNT(s.id) as student_count 
                            FROM yearlevel y 
                            LEFT JOIN student s ON y.id = s.yearlevel_id 
                            GROUP BY y.id 
                            ORDER BY y.yearlevel ASC";
                    $counter = 1;
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $yearClass = 'year-badge year-' . $row['yearlevel'];
                            if (!in_array($row['yearlevel'], [1,2,3,4])) $yearClass = 'year-badge year-default';
                    ?>
                        <tr data-year="<?php echo $row['yearlevel']; ?>" data-description="<?php echo strtolower($row['description']); ?>">
                            <td><strong><?php echo $counter++; ?></strong></td>
                            <td>
                                <div class="<?php echo $yearClass; ?>" style="display: inline-flex;">
                                    <i class="fas fa-star me-1"></i>
                                    <?php echo $row['yearlevel']; ?><?php echo $row['yearlevel'] == 1 ? 'st' : ($row['yearlevel'] == 2 ? 'nd' : ($row['yearlevel'] == 3 ? 'rd' : 'th')); ?> Year
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($row['description']); ?> Year</td>
                            <td>
                                <?php
                                $timestamp = strtotime($row['date_created']);
                                $newFormat = date('M d, Y', $timestamp);
                                echo '<i class="far fa-calendar-alt me-1" style="color: #B89A6B;"></i> ' . $newFormat;
                                ?>
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
                                        data-yearlevel="<?php echo $row['yearlevel']; ?>"
                                        data-description="<?php echo $row['description']; ?>"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" 
                                        data-id="<?php echo $row['id']; ?>"
                                        data-yearlevel="<?php echo $row['yearlevel']; ?>"
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
                    } else { 
                    ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-calendar-alt fa-3x mb-3" style="color: #E8E0D4;"></i>
                                <p class="text-muted">No year levels found. Click "Add Year Level" to get started.</p>
                            </td>
                        </tr>
                    <?php } ?>
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
                        Add New Year Level
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_ADDYEARLEVEL; ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label-custom">Year Level Number</label>
                            <input type="number" class="form-control-custom" name="yearlevel" placeholder="e.g., 1, 2, 3, 4" min="1" max="12" required>
                            <small class="text-muted mt-1 d-block">Enter the year level number (1-12)</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Description</label>
                            <input type="text" class="form-control-custom" name="description" placeholder="e.g., 1st, 2nd, 3rd, 4th" required>
                            <small class="text-muted mt-1 d-block">Enter the descriptive name for this year level</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background: #8B2C3E; color: white;">
                            <i class="fas fa-save me-1"></i> Add Year Level
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
                        Edit Year Level
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_EDITYEARLEVEL; ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="e_id" name="id">
                        <input type="hidden" id="e_old_yearlevel" name="old_yearlevel">
                        <div class="form-group">
                            <label class="form-label-custom">Year Level Number</label>
                            <input type="number" class="form-control-custom" id="e_yearlevel" name="yearlevel" min="1" max="12" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Description</label>
                            <input type="text" class="form-control-custom" id="e_description" name="description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background: #8B2C3E; color: white;">
                            <i class="fas fa-save me-1"></i> Update Year Level
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
                        Delete Year Level
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_DELETEYEARLEVEL; ?>" method="post">
                    <div class="modal-body text-center py-4">
                        <input type="hidden" id="d_id" name="id">
                        <i class="fas fa-exclamation-triangle fa-3x mb-3" style="color: #dc3545;"></i>
                        <p id="deleteWarning" class="mb-0"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-1"></i> Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Active sidebar
    const sidebar = document.getElementById('yearlevel');
    if (sidebar) sidebar.classList.add('bg-primary', 'active');
    
    // Edit modal data population
    const e_id = document.getElementById('e_id');
    const e_old_yearlevel = document.getElementById('e_old_yearlevel');
    const e_yearlevel = document.getElementById('e_yearlevel');
    const e_description = document.getElementById('e_description');
    const d_id = document.getElementById('d_id');
    const deleteWarning = document.getElementById('deleteWarning');
    
    document.addEventListener('click', function(e) {
        const editBtn = e.target.closest('.btn-edit');
        const deleteBtn = e.target.closest('.btn-delete');
        
        if (editBtn) {
            e_id.value = editBtn.dataset.id;
            e_old_yearlevel.value = editBtn.dataset.yearlevel;
            e_yearlevel.value = editBtn.dataset.yearlevel;
            e_description.value = editBtn.dataset.description;
        }
        
        if (deleteBtn) {
            d_id.value = deleteBtn.dataset.id;
            const studentCount = parseInt(deleteBtn.dataset.studentCount);
            const yearLevel = deleteBtn.dataset.yearlevel;
            
            if (studentCount > 0) {
                deleteWarning.innerHTML = `
                    <i class="fas fa-users me-1"></i> 
                    <strong>Warning!</strong><br>
                    This year level has ${studentCount} student(s) enrolled.<br>
                    Deleting this year level will affect these student records.<br>
                    Are you sure you want to continue?
                `;
                deleteWarning.style.color = "#dc3545";
                deleteWarning.style.fontWeight = "500";
            } else {
                deleteWarning.innerHTML = `Are you sure you want to delete ${yearLevel}${yearLevel == 1 ? 'st' : (yearLevel == 2 ? 'nd' : (yearLevel == 3 ? 'rd' : 'th'))} Year?`;
                deleteWarning.style.color = "#2C2C2C";
            }
        }
    });
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('yearTable');
    const rows = table.querySelectorAll('tbody tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        rows.forEach(row => {
            const year = row.getAttribute('data-year') || '';
            const description = row.getAttribute('data-description') || '';
            const text = year + description;
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
    
    // Sort functionality
    let currentSort = 'asc';
    const sortAsc = document.getElementById('sortAsc');
    const sortDesc = document.getElementById('sortDesc');
    
    function sortTable(order) {
        const tbody = table.querySelector('tbody');
        const rowsArray = Array.from(rows);
        
        rowsArray.sort((a, b) => {
            const yearA = parseInt(a.getAttribute('data-year') || 0);
            const yearB = parseInt(b.getAttribute('data-year') || 0);
            return order === 'asc' ? yearA - yearB : yearB - yearA;
        });
        
        rowsArray.forEach(row => tbody.appendChild(row));
        
        // Update button styles
        if (order === 'asc') {
            sortAsc.style.background = '#8B2C3E';
            sortAsc.style.color = 'white';
            sortDesc.style.background = 'white';
            sortDesc.style.color = '#2C2C2C';
        } else {
            sortDesc.style.background = '#8B2C3E';
            sortDesc.style.color = 'white';
            sortAsc.style.background = 'white';
            sortAsc.style.color = '#2C2C2C';
        }
    }
    
    sortAsc.addEventListener('click', () => sortTable('asc'));
    sortDesc.addEventListener('click', () => sortTable('desc'));
    
    // Filter by year level from timeline cards
    function filterByYear(year) {
        rows.forEach(row => {
            const rowYear = parseInt(row.getAttribute('data-year'));
            row.style.display = rowYear === year ? '' : 'none';
        });
        searchInput.value = '';
        
        // Scroll to table
        document.querySelector('.table-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    // Animation for timeline cards
    const timelineCards = document.querySelectorAll('.timeline-card');
    timelineCards.forEach((card, index) => {
        card.style.animation = `fadeInUp 0.5s ease-out ${0.3 + index * 0.1}s backwards`;
    });
</script>

<?php
$content = ob_get_clean();
include 'layout/layout.php';
?>