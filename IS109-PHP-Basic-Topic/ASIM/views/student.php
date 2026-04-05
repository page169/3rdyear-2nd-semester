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
        cursor: pointer;
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
    
    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-active {
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    
    .status-inactive {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
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
    
    .btn-status {
        background: rgba(184, 154, 107, 0.1);
        color: #B89A6B;
    }
    
    .btn-status:hover {
        background: #B89A6B;
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
    
    .form-control-custom,
    .form-select-custom {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #E8E0D4;
        border-radius: 16px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: white;
    }
    
    .form-control-custom:focus,
    .form-select-custom:focus {
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
    
    .filter-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: white;
        border-radius: 12px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .filter-badge:hover {
        background: #198754;
        color: white;
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
            min-width: 800px;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
            text-align: center;
        }
        
        .table-controls {
            flex-direction: column;
        }
        
        .search-box {
            max-width: 100%;
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
                        <i class="fas fa-users me-2"></i>
                        Student Management
                    </h1>
                    <p class="page-subtitle">
                        Manage and monitor all student records, enrollments, and academic information
                    </p>
                </div>
                <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-2"></i>
                    Add New Student
                </button>
            </div>
        </div>
        
        <!-- Mini Stats -->
        <div class="stats-mini">
            <?php
            // Get counts for stats
            $totalCount = $conn->query("SELECT COUNT(*) as total FROM student")->fetch_assoc()['total'];
            $activeCount = $conn->query("SELECT COUNT(*) as total FROM student WHERE status = 1")->fetch_assoc()['total'];
            $maleCount = $conn->query("SELECT COUNT(*) as total FROM student WHERE gender = 1")->fetch_assoc()['total'];
            $femaleCount = $conn->query("SELECT COUNT(*) as total FROM student WHERE gender = 2")->fetch_assoc()['total'];
            ?>
            <div class="stat-mini-card" onclick="window.location.href='<?php echo ROUTE_STUDENT; ?>'">
                <div class="stat-mini-info">
                    <h4><?php echo number_format($totalCount); ?></h4>
                    <p>Total Students</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-mini-card">
                <div class="stat-mini-info">
                    <h4><?php echo number_format($activeCount); ?></h4>
                    <p>Active Students</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
            <div class="stat-mini-card">
                <div class="stat-mini-info">
                    <h4><?php echo number_format($maleCount); ?></h4>
                    <p>Male Students</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-mars"></i>
                </div>
            </div>
            <div class="stat-mini-card">
                <div class="stat-mini-info">
                    <h4><?php echo number_format($femaleCount); ?></h4>
                    <p>Female Students</p>
                </div>
                <div class="stat-mini-icon">
                    <i class="fas fa-venus"></i>
                </div>
            </div>
        </div>
        
        <!-- Table Container -->
        <div class="table-container">
            <div class="table-controls">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search students by name, course, or year level...">
                </div>
                <div class="d-flex gap-2">
                    <div class="filter-badge" id="filterAll">
                        <i class="fas fa-list"></i> All
                    </div>
                    <div class="filter-badge" id="filterActive">
                        <i class="fas fa-check-circle"></i> Active
                    </div>
                    <div class="filter-badge" id="filterInactive">
                        <i class="fas fa-times-circle"></i> Inactive
                    </div>
                </div>
            </div>
            
            <table class="custom-table" id="studentTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT *, a.id AS student_id, b.description AS course_description, c.description AS yearlevel_description  
                            FROM student AS a
                            INNER JOIN course AS b ON a.course_id = b.id
                            INNER JOIN yearlevel AS c ON a.yearlevel_id = c.id
                            ORDER BY a.id DESC";
                    $counter = 1;
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $fullName = $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'];
                            $date1 = new DateTime($row['birthdate']);
                            $date2 = new DateTime();
                            $age = $date1->diff($date2)->y;
                    ?>
                        <tr data-status="<?php echo $row['status']; ?>" data-name="<?php echo strtolower($fullName); ?>" data-course="<?php echo strtolower($row['course']); ?>">
                            <td><?php echo $counter++; ?></td>
                            <td><strong><?php echo htmlspecialchars($fullName); ?></strong></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo $age; ?></td>
                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                            <td><?php echo $row['gender'] == 1 ? '<i class="fas fa-mars text-primary"></i> Male' : '<i class="fas fa-venus text-danger"></i> Female'; ?></td>
                            <td><span class="badge" style="background: rgba(139,44,62,0.1); color: #8B2C3E;"><?php echo htmlspecialchars($row['course']); ?></span></td>
                            <td><?php echo $row['yearlevel_description']; ?> Year</td>
                            <td>
                                <span class="status-badge <?php echo $row['status'] == 1 ? 'status-active' : 'status-inactive'; ?>">
                                    <i class="fas <?php echo $row['status'] == 1 ? 'fa-circle-check' : 'fa-circle-xmark'; ?>"></i>
                                    <?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?>
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-edit" 
                                        data-object='<?php 
                                            $data = [
                                                'id' => $row['student_id'],
                                                'first_name' => $row['first_name'],
                                                'middle_name' => $row['middle_name'],
                                                'last_name' => $row['last_name'],
                                                'address' => $row['address'],
                                                'birthdate' => $row['birthdate'],
                                                'phone_number' => $row['phone_number'],
                                                'gender' => $row['gender'],
                                                'course' => $row['course_id'],
                                                'yearlevel_description' => $row['yearlevel_id'],
                                            ];
                                            echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8'); 
                                        ?>'
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn-action btn-status" 
                                        data-object='<?php 
                                            $data = [
                                                'id' => $row['student_id'],
                                                'status' => $row['status'],
                                            ];
                                            echo htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8'); 
                                        ?>'
                                        data-bs-toggle="modal" 
                                        data-bs-target="#statusModal">
                                        <i class="fas <?php echo $row['status'] == 1 ? 'fa-ban' : 'fa-check-circle'; ?>"></i>
                                        <?php echo $row['status'] == 1 ? 'Deactivate' : 'Activate'; ?>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else { 
                    ?>
                        <tr>
                            <td colspan="10" class="text-center py-5">
                                <i class="fas fa-user-graduate fa-3x mb-3" style="color: #E8E0D4;"></i>
                                <p class="text-muted">No students found. Click "Add New Student" to get started.</p>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add Modal -->
    <div class="modal fade modal-custom" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus"></i>
                        Add New Student
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_ADDSTUDENT; ?>" method="POST">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label-custom">First Name</label>
                                    <input type="text" class="form-control-custom" name="firstname" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label-custom">Middle Name</label>
                                    <input type="text" class="form-control-custom" name="middlename" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label-custom">Last Name</label>
                                    <input type="text" class="form-control-custom" name="lastname" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label-custom">Address</label>
                                    <textarea class="form-control-custom" name="address" rows="2" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label-custom">Birthdate</label>
                                    <input type="date" class="form-control-custom" name="birthdate" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label-custom">Phone Number</label>
                                    <input type="tel" class="form-control-custom" name="phone" pattern="09[0-9]{9}" maxlength="11" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label-custom">Gender</label>
                                    <select class="form-select-custom" name="gender" required>
                                        <option value="" selected disabled>Select gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label-custom">Course</label>
                                    <select class="form-select-custom" name="course" required>
                                        <option value="" selected disabled>Select course</option>
                                        <?php
                                        $courses = $conn->query("SELECT * FROM course");
                                        while($c = $courses->fetch_assoc()) {
                                            echo "<option value='{$c['id']}'>{$c['course']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label-custom">Year Level</label>
                                    <select class="form-select-custom" name="yearlevel" required>
                                        <option value="" selected disabled>Select year level</option>
                                        <?php
                                        $levels = $conn->query("SELECT * FROM yearlevel");
                                        while($l = $levels->fetch_assoc()) {
                                            echo "<option value='{$l['id']}'>{$l['yearlevel']} Year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background: #8B2C3E; color: white;">Save Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Edit Modal (similar structure - kept from original) -->
    <div class="modal fade modal-custom" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Student</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_EDITSTUDENT; ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="e_id" name="id">
                        <input type="hidden" id="e_old_firstname" name="old_firstname">
                        <input type="hidden" id="e_old_middlename" name="old_middlename">
                        <input type="hidden" id="e_old_lastname" name="old_lastname">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-group"><label class="form-label-custom">First Name</label><input type="text" class="form-control-custom" id="e_firstname" name="firstname" required></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"><label class="form-label-custom">Middle Name</label><input type="text" class="form-control-custom" id="e_middlename" name="middlename" required></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"><label class="form-label-custom">Last Name</label><input type="text" class="form-control-custom" id="e_lastname" name="lastname" required></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label class="form-label-custom">Address</label><textarea class="form-control-custom" id="e_address" name="address" rows="2" required></textarea></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label-custom">Birthdate</label><input type="date" class="form-control-custom" id="e_birthdate" name="birthdate" required></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class="form-label-custom">Phone</label><input type="tel" class="form-control-custom" id="e_phone" name="phone" pattern="09[0-9]{9}" maxlength="11" required></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"><label class="form-label-custom">Gender</label><select class="form-select-custom" id="e_gender" name="gender" required><option value="1">Male</option><option value="2">Female</option></select></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"><label class="form-label-custom">Course</label><select class="form-select-custom" id="e_course" name="course" required><?php $courses = $conn->query("SELECT * FROM course"); while($c = $courses->fetch_assoc()) echo "<option value='{$c['id']}'>{$c['course']}</option>"; ?></select></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"><label class="form-label-custom">Year Level</label><select class="form-select-custom" id="e_yearlevel" name="yearlevel" required><?php $levels = $conn->query("SELECT * FROM yearlevel"); while($l = $levels->fetch_assoc()) echo "<option value='{$l['id']}'>{$l['yearlevel']} Year</option>"; ?></select></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background: #8B2C3E; color: white;">Update Student</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Status Modal -->
    <div class="modal fade modal-custom" id="statusModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-exchange-alt"></i> Update Status</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?php echo ROUTE_DELETESTUDENT; ?>" method="post">
                    <div class="modal-body text-center py-4">
                        <input type="hidden" id="d_id" name="id">
                        <input type="hidden" id="d_status" name="status">
                        <i class="fas fa-question-circle fa-3x mb-3" style="color: #B89A6B;"></i>
                        <p class="mb-0">Are you sure you want to update the status of this student?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background: #8B2C3E; color: white;">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Active sidebar
    const sidebar = document.getElementById('student');
    if (sidebar) sidebar.classList.add('bg-primary', 'active');
    
    // Edit modal data population
    const e_id = document.getElementById('e_id');
    const e_old_firstname = document.getElementById('e_old_firstname');
    const e_old_middlename = document.getElementById('e_old_middlename');
    const e_old_lastname = document.getElementById('e_old_lastname');
    const e_firstname = document.getElementById('e_firstname');
    const e_middlename = document.getElementById('e_middlename');
    const e_lastname = document.getElementById('e_lastname');
    const e_address = document.getElementById('e_address');
    const e_birthdate = document.getElementById('e_birthdate');
    const e_phone = document.getElementById('e_phone');
    const e_gender = document.getElementById('e_gender');
    const e_course = document.getElementById('e_course');
    const e_yearlevel = document.getElementById('e_yearlevel');
    const d_id = document.getElementById('d_id');
    const d_status = document.getElementById('d_status');
    
    document.addEventListener('click', function(e) {
        const editBtn = e.target.closest('.btn-edit');
        const statusBtn = e.target.closest('.btn-status');
        
        if (editBtn) {
            const obj = JSON.parse(editBtn.dataset.object);
            e_id.value = obj.id;
            e_old_firstname.value = obj.first_name;
            e_old_middlename.value = obj.middle_name;
            e_old_lastname.value = obj.last_name;
            e_firstname.value = obj.first_name;
            e_middlename.value = obj.middle_name;
            e_lastname.value = obj.last_name;
            e_address.value = obj.address;
            e_birthdate.value = obj.birthdate;
            e_phone.value = obj.phone_number;
            e_gender.value = obj.gender;
            e_course.value = obj.course;
            e_yearlevel.value = obj.yearlevel_description;
        }
        
        if (statusBtn) {
            const obj = JSON.parse(statusBtn.dataset.object);
            d_id.value = obj.id;
            d_status.value = obj.status;
        }
    });
    
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('studentTable');
    const rows = table.querySelectorAll('tbody tr');
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
    
    // Filter functionality
    const filterAll = document.getElementById('filterAll');
    const filterActive = document.getElementById('filterActive');
    const filterInactive = document.getElementById('filterInactive');
    
    filterAll.addEventListener('click', () => {
        rows.forEach(row => row.style.display = '');
        [filterAll, filterActive, filterInactive].forEach(f => f.style.background = 'white');
        filterAll.style.background = '#8B2C3E';
        filterAll.style.color = 'white';
    });
    
    filterActive.addEventListener('click', () => {
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            row.style.display = status === '1' ? '' : 'none';
        });
        [filterAll, filterActive, filterInactive].forEach(f => f.style.background = 'white');
        filterActive.style.background = '#8B2C3E';
        filterActive.style.color = 'white';
    });
    
    filterInactive.addEventListener('click', () => {
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            row.style.display = status === '0' ? '' : 'none';
        });
        [filterAll, filterActive, filterInactive].forEach(f => f.style.background = 'white');
        filterInactive.style.background = '#8B2C3E';
        filterInactive.style.color = 'white';
    });
</script>

<?php
$content = ob_get_clean();
include 'layout/layout.php';
?>