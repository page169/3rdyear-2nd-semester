<?php
session_start();
require_once "../lib/route.php";
require_once "../backend/dashboard.php";
ob_start();
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

      /* Background Image with TPC Logo */
    .dashboard-wrapper {
        padding: 1.5rem;
        background: linear-gradient(135deg, #F5F0E8 0%, #E8E0D4 100%);
        min-height: 100vh;
        position: relative;
    }
    
    /* TPC Logo as Background Watermark */
    .dashboard-wrapper::before {
        content: '';
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        background-image: url('../tpclogo.png');
        background-size: 55% auto;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.10;
        pointer-events: none;
        z-index: 0;
    }
    
    /* Dashboard Specific Styles */
    .dashboard-wrapper {
        padding: 1.5rem;
        background: linear-gradient(135deg, #F5F0E8 0%, #E8E0D4 100%);
        min-height: 100vh;
    }
    
    /* Welcome Section */
    .welcome-section {
        margin-bottom: 2rem;
        animation: slideDown 0.5s ease-out;
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
    
    .welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(139, 44, 62, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        margin-bottom: 1rem;
    }
    
    .welcome-badge i {
        color: #8B2C3E;
        font-size: 0.875rem;
    }
    
    .welcome-badge span {
        color: #6B1E2C;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .welcome-title {
        font-size: 2rem;
        font-weight: 800;
        color: #2C2C2C;
        margin: 0;
        letter-spacing: -0.5px;
    }
    
    .welcome-title span {
        color: #198754;
        position: relative;
        display: inline-block;
    }
    
    .welcome-title span::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #B89A6B, transparent);
        border-radius: 3px;
    }
    
    .welcome-subtitle {
        color: #6c757d;
        margin-top: 0.5rem;
        font-size: 0.95rem;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    /* Modern Stat Cards */
    .stat-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        animation: fadeInUp 0.5s ease-out;
        animation-fill-mode: both;
    }
    
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    
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
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.15);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #8B2C3E, #B89A6B);
    }
    
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, rgba(139, 44, 62, 0.1), rgba(184, 154, 107, 0.1));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #198;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.05);
        background: linear-gradient(135deg, rgba(139, 44, 62, 0.2), rgba(184, 154, 107, 0.2));
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #2C2C2C;
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 1rem;
    }
    
    .stat-footer {
        border-top: 1px solid #E8E0D4;
        padding-top: 1rem;
        margin-top: 0.5rem;
    }
    
    .stat-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #8B2C3E;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .stat-link i {
        transition: transform 0.3s ease;
    }
    
    .stat-link:hover {
        color: #B89A6B;
        gap: 0.75rem;
    }
    
    .stat-link:hover i {
        transform: translateX(5px);
    }
    
    /* Quick Actions Section */
    .quick-actions-section {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.5s ease-out 0.5s backwards;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2C2C2C;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .section-title i {
        color: #8B2C3E;
        font-size: 1.25rem;
    }
    
    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .action-card {
        background: #F5F0E8;
        border-radius: 16px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }
    
    .action-card:hover {
        background: linear-gradient(135deg, #198754, #055160);
        opacity: 0.20
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(139, 44, 62, 0.2);
    }
    
    .action-icon {
        font-size: 2rem;
        color: #198754;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .action-card:hover .action-icon {
        color: white;
        transform: scale(1.1);
    }
    
    .action-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #2C2C2C;
        transition: all 0.3s ease;
    }
    
    .action-card:hover .action-title {
        color: white;
    }
    
    .action-desc {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 0.25rem;
        transition: all 0.3s ease;
    }
    
    .action-card:hover .action-desc {
        color: rgba(255, 255, 255, 0.8);
    }
    
    /* Recent Activity Section */
    .recent-section {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        animation: fadeInUp 0.5s ease-out 0.6s backwards;
    }
    
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .activity-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .activity-item:hover {
        background: #F5F0E8;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        background: rgba(139, 44, 62, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #198754;
        font-size: 1rem;
    }
    
    .activity-content {
        flex: 1;
    }
    
    .activity-text {
        font-size: 0.875rem;
        font-weight: 500;
        color: #2C2C2C;
        margin-bottom: 0.25rem;
    }
    
    .activity-time {
        font-size: 0.75rem;
        color: #6c757d;
    }
    
    .empty-state {
        text-align: center;
        padding: 2rem;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-wrapper {
            padding: 1rem;
        }
        
        .welcome-title {
            font-size: 1.5rem;
        }
        
        .stat-value {
            font-size: 2rem;
        }
        
        .stats-grid {
            gap: 1rem;
        }
        
        .stat-card {
            padding: 1rem;
        }
        
        .actions-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .quick-actions-section,
        .recent-section {
            padding: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .actions-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
        }
    }
</style>

<main>
    <div class="dashboard-wrapper">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="welcome-badge">
                <i class="fas fa-calendar-alt"></i>
                <span><?php echo date('l, F j, Y'); ?></span>
            </div>
            <h1 class="welcome-title">
                Welcome back, <span>Administrator</span>
            </h1>
            <p class="welcome-subtitle">
                Here's what's happening with your student management system today.
            </p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <!-- Active Students Card -->
            <div class="stat-card" onclick="window.location.href='<?php echo ROUTE_STUDENT; ?>'">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($active_student); ?></div>
                <div class="stat-label">Active Students</div>
                <div class="stat-footer">
                    <a href="<?php echo ROUTE_STUDENT; ?>" class="stat-link">
                        View Details
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Inactive Students Card -->
            <div class="stat-card" onclick="window.location.href='<?php echo ROUTE_STUDENT; ?>'">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($inactive_student); ?></div>
                <div class="stat-label">Inactive Students</div>
                <div class="stat-footer">
                    <a href="<?php echo ROUTE_STUDENT; ?>" class="stat-link">
                        View Details
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Students Card -->
            <div class="stat-card" onclick="window.location.href='<?php echo ROUTE_STUDENT; ?>'">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($total_student); ?></div>
                <div class="stat-label">Total Enrollment</div>
                <div class="stat-footer">
                    <a href="<?php echo ROUTE_STUDENT; ?>" class="stat-link">
                        View Details
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Total Courses Card -->
            <div class="stat-card" onclick="window.location.href='<?php echo ROUTE_COURSE; ?>'">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                </div>
                <div class="stat-value"><?php echo number_format($total_course); ?></div>
                <div class="stat-label">Active Courses</div>
                <div class="stat-footer">
                    <a href="<?php echo ROUTE_COURSE; ?>" class="stat-link">
                        View Details
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="quick-actions-section">
            <div class="section-title">
                <i class="fas fa-bolt"></i>
                Quick Actions
            </div>
            <div class="actions-grid">
                <a href="<?php echo ROUTE_STUDENT; ?>" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="action-title">Add New Student</div>
                    <div class="action-desc">Register a new student record</div>
                </a>
                <a href="<?php echo ROUTE_COURSE; ?>" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="action-title">Add Course</div>
                    <div class="action-desc">Create new course offering</div>
                </a>
                <a href="<?php echo ROUTE_YEARLEVEL; ?>" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="action-title">Manage Year Levels</div>
                    <div class="action-desc">Configure academic levels</div>
                </a>
                <a href="#" class="action-card" data-bs-toggle="modal" data-bs-target="#quickReportModal">
                    <div class="action-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="action-title">Generate Report</div>
                    <div class="action-desc">View system analytics</div>
                </a>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="recent-section">
            <div class="section-title">
                <i class="fas fa-history"></i>
                Recent Activity
            </div>
            <div class="activity-list">
                <?php
                // Get recent student additions (last 5)
                $sql = "SELECT first_name, middle_name, last_name, date_created FROM student ORDER BY date_created DESC LIMIT 5";
                $result = $conn->query($sql);
                
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $fullName = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                        $dateCreated = new DateTime($row['date_created']);
                        $now = new DateTime();
                        $interval = $dateCreated->diff($now);
                        
                        if ($interval->days == 0) {
                            $timeAgo = 'Today';
                        } elseif ($interval->days == 1) {
                            $timeAgo = 'Yesterday';
                        } else {
                            $timeAgo = $interval->days . ' days ago';
                        }
                ?>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">New student enrolled: <strong><?php echo htmlspecialchars($fullName); ?></strong></div>
                            <div class="activity-time"><i class="far fa-clock"></i> <?php echo $timeAgo; ?></div>
                        </div>
                    </div>
                <?php 
                    }
                } else { 
                ?>
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>No recent activity to display</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Quick Report Modal -->
    <div class="modal fade" id="quickReportModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-chart-line me-2"></i>
                        System Analytics
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Enrollment Rate</span>
                                    <span class="fw-bold text-success">+12.5%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" style="width: 75%; background: linear-gradient(90deg, #8B2C3E, #B89A6B);"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Course Completion</span>
                                    <span class="fw-bold text-success">68%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" style="width: 68%; background: linear-gradient(90deg, #8B2C3E, #B89A6B);"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Student Retention</span>
                                    <span class="fw-bold text-success">92%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" style="width: 92%; background: linear-gradient(90deg, #8B2C3E, #B89A6B);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="alert('Full report feature coming soon!')">
                        <i class="fas fa-download me-1"></i> Download Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Active sidebar highlighting
    const sidebar = document.getElementById('dashboard');
    if (sidebar) {
        sidebar.classList.add('bg-primary', 'active');
    }
    
    // Add hover effect to stat cards
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('click', function(e) {
            // Don't trigger if clicking on the link inside
            if (e.target.closest('.stat-link')) {
                return;
            }
            const link = this.querySelector('.stat-link');
            if (link) {
                window.location.href = link.getAttribute('href');
            }
        });
    });
    
    // Animate numbers on load
    document.addEventListener('DOMContentLoaded', function() {
        const statValues = document.querySelectorAll('.stat-value');
        statValues.forEach(stat => {
            const finalValue = parseInt(stat.innerText);
            if (!isNaN(finalValue)) {
                let currentValue = 0;
                const duration = 1000;
                const increment = finalValue / (duration / 16);
                
                const counter = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        stat.innerText = finalValue.toLocaleString();
                        clearInterval(counter);
                    } else {
                        stat.innerText = Math.floor(currentValue).toLocaleString();
                    }
                }, 16);
            }
        });
    });
</script>

<?php
$content = ob_get_clean();
include 'layout/layout.php';
?>