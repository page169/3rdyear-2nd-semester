<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <!-- Logo/Brand Section -->
        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="brand-text">
                <div class="brand-title">TPC</div>
                <div class="brand-subtitle">Student Management</div>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="sidebar-divider"></div>
        
        <!-- Navigation Menu -->
        <div class="nav">
            <!-- Dashboard -->
            <a class="nav-link" id="dashboard" href="<?php echo ROUTE_DASHBOARD; ?>">
                <div class="nav-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <div class="nav-text">
                    <span>Dashboard</span>
                    <small>Overview & Analytics</small>
                </div>
                <div class="nav-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
            
            <!-- Student Management -->
            <a class="nav-link" id="student" href="<?php echo ROUTE_STUDENT; ?>">
                <div class="nav-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="nav-text">
                    <span>Student Management</span>
                    <small>Manage student records</small>
                </div>
                <div class="nav-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
            
            <!-- Year Level Management -->
            <a class="nav-link" id="yearlevel" href="<?php echo ROUTE_YEARLEVEL; ?>">
                <div class="nav-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="nav-text">
                    <span>Year Level Management</span>
                    <small>Academic levels & progression</small>
                </div>
                <div class="nav-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
            
            <!-- Course Management -->
            <a class="nav-link" id="course" href="<?php echo ROUTE_COURSE; ?>">
                <div class="nav-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="nav-text">
                    <span>Course Management</span>
                    <small>Programs & curriculum</small>
                </div>
                <div class="nav-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </div>
        
        <!-- Divider -->
        <div class="sidebar-divider"></div>
        
        <!-- System Info Section -->
        <div class="system-info">
            <div class="info-item">
                <i class="fas fa-database"></i>
                <span>System Version</span>
                <strong>2.0.0</strong>
            </div>
            <div class="info-item">
                <i class="fas fa-code-branch"></i>
                <span>Build</span>
                <strong>Release 2024</strong>
            </div>
        </div>
    </div>
    
    <!-- Sidebar Footer with User Info -->
    <div class="sb-sidenav-footer">
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-details">
                <div class="user-name">
                    <?php 
                    if(isset($_SESSION["username"])) {
                        echo htmlspecialchars($_SESSION["username"]);
                    } else {
                        echo "Administrator";
                    }
                    ?>
                </div>
                <div class="user-role">
                    <i class="fas fa-shield-alt"></i> System Admin
                </div>
            </div>
        </div>
        
        <!-- Logout Button -->
        <div class="logout-section">
            <a href="#" class="logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <!-- Copyright -->
        <div class="copyright">
            <i class="far fa-copyright"></i> 2024 TPC
            <span>All rights reserved</span>
        </div>
    </div>
</nav>

<style>
    /* Sidebar Brand Section */
    .sidebar-brand {
        padding: 1.5rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 0.5rem;
    }
    
    .brand-logo {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #B89A6B, #9C7A4A);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: #6B1E2C;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    
    .brand-text {
        flex: 1;
    }
    
    .brand-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: white;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    
    .brand-subtitle {
        font-size: 0.65rem;
        color: rgba(255, 255, 255, 0.7);
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    
    /* Sidebar Divider */
    .sidebar-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        margin: 0.5rem 1rem;
    }
    
    /* Navigation Links */
    .sb-sidenav-dark .sb-sidenav-menu .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        margin: 0.25rem 0.75rem;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 3px;
        background: #B89A6B;
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover::before,
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active::before {
        transform: scaleY(1);
    }
    
    .nav-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        margin-right: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .nav-icon i {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover .nav-icon,
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active .nav-icon {
        background: #B89A6B;
        transform: scale(1.05);
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover .nav-icon i,
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active .nav-icon i {
        color: #6B1E2C;
    }
    
    .nav-text {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .nav-text span {
        font-size: 0.875rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        transition: color 0.3s ease;
    }
    
    .nav-text small {
        font-size: 0.65rem;
        color: rgba(255, 255, 255, 0.5);
        transition: color 0.3s ease;
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover .nav-text span,
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active .nav-text span {
        color: #B89A6B;
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover .nav-text small,
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active .nav-text small {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .nav-arrow {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }
    
    .nav-arrow i {
        font-size: 0.75rem;
        color: #B89A6B;
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover .nav-arrow,
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active .nav-arrow {
        opacity: 1;
        transform: translateX(0);
    }
    
    /* System Info Section */
    .system-info {
        padding: 1rem;
        margin-top: 0.5rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0;
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.6);
    }
    
    .info-item i {
        width: 24px;
        font-size: 0.8rem;
        color: #B89A6B;
    }
    
    .info-item span {
        flex: 1;
    }
    
    .info-item strong {
        color: white;
        font-weight: 600;
    }
    
    /* Sidebar Footer */
    .sb-sidenav-footer {
        background: rgba(0, 0, 0, 0.3);
        padding: 1rem;
        margin-top: auto;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #B89A6B, #9C7A4A);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #6B1E2C;
    }
    
    .user-details {
        flex: 1;
    }
    
    .user-name {
        font-size: 0.875rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.25rem;
    }
    
    .user-role {
        font-size: 0.65rem;
        color: rgba(255, 255, 255, 0.6);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .user-role i {
        font-size: 0.6rem;
        color: #B89A6B;
    }
    
    /* Logout Button */
    .logout-section {
        margin-bottom: 1rem;
    }
    
    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        background: rgba(220, 53, 69, 0.2);
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .logout-btn:hover {
        background: #dc3545;
        transform: translateX(5px);
    }
    
    .logout-btn i:first-child {
        font-size: 1rem;
        color: #dc3545;
        transition: color 0.3s ease;
    }
    
    .logout-btn span {
        font-size: 0.875rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        transition: color 0.3s ease;
    }
    
    .logout-btn i:last-child {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
        transition: all 0.3s ease;
    }
    
    .logout-btn:hover i:first-child,
    .logout-btn:hover span,
    .logout-btn:hover i:last-child {
        color: white;
    }
    
    .logout-btn:hover i:last-child {
        transform: translateX(5px);
    }
    
    /* Copyright */
    .copyright {
        text-align: center;
        font-size: 0.65rem;
        color: rgba(255, 255, 255, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .copyright i {
        font-size: 0.6rem;
    }
    
    .copyright span {
        color: rgba(255, 255, 255, 0.3);
    }
    
    /* Active State Styling */
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active {
        background: linear-gradient(90deg, rgba(184, 154, 107, 0.2), transparent);
    }
    
    /* Hover Animation */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link {
        animation: slideIn 0.3s ease-out forwards;
        opacity: 0;
    }
    
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:nth-child(1) { animation-delay: 0.05s; }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:nth-child(2) { animation-delay: 0.1s; }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:nth-child(3) { animation-delay: 0.15s; }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:nth-child(4) { animation-delay: 0.2s; }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .nav-text small,
        .system-info,
        .user-role,
        .copyright span {
            display: none;
        }
        
        .nav-text span {
            font-size: 0.75rem;
        }
        
        .brand-subtitle {
            display: none;
        }
        
        .brand-title {
            font-size: 1rem;
        }
        
        .sidebar-brand {
            justify-content: center;
            padding: 1rem;
        }
        
        .user-name {
            font-size: 0.75rem;
        }
        
        .logout-btn span {
            display: none;
        }
        
        .logout-btn {
            justify-content: center;
            padding: 0.75rem;
        }
        
        .logout-btn i:first-child {
            margin: 0;
        }
        
        .logout-btn i:last-child {
            display: none;
        }
    }
    
    /* Scrollbar styling for sidebar */
    .sb-sidenav-menu::-webkit-scrollbar {
        width: 4px;
    }
    
    .sb-sidenav-menu::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .sb-sidenav-menu::-webkit-scrollbar-thumb {
        background: #B89A6B;
        border-radius: 4px;
    }
    
    .sb-sidenav-menu::-webkit-scrollbar-thumb:hover {
        background: #9C7A4A;
    }
</style>

<script>
    // Add active class highlighting based on current page
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sb-sidenav-menu .nav-link');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href.replace(/^\.\.\/\.\.\//, ''))) {
                link.classList.add('active');
            }
        });
    });
</script>