<?php
$title = "My Resumes | Hold My CV";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
require './assets/includes/conndb.php'; 

class Databasee {
    private $host = 'localhost';
    private $username = 'root';
    private $database = 'resume';
    private $password = '';
    private $dbb = null;

    function __construct() {
        $this->dbb = new mysqli($this->host, $this->username, $this->password, $this->database);
    }

    public function connect() {
        return $this->dbb;
    }
}

$dbb = new Databasee();
$dbb = $dbb->connect();
$fn->AuthPage(); 
session_start();
$user = $fn->Auth();
$resumes = $db->query('SELECT * FROM resumedata WHERE user_id=' . $user['id']);
$resumes = $resumes->fetch_all(1); 

$detailsQuery = 'SELECT id FROM details WHERE id =' . $user['id'];
$result = $dbb->query($detailsQuery);
if ($result) {
    $row = $result->fetch_assoc();
    $abhinaba = $row['id'];
    $updateQuery = 'UPDATE resumedata SET user_id=' . $abhinaba . ' WHERE user_id=' . $user['id'];
} else {
    echo "Error fetching details: " . $db->error;
}
?>

<style>
:root {
    /* Modern Color Scheme */
    --primary: #4361ee;
    --primary-light: rgba(67, 97, 238, 0.1);
    --primary-dark: #3a56d5;
    --secondary: #3f37c9;
    --accent: #4895ef;
    --success: #4cc9f0;
    --light: #f8f9fa;
    --lighter: #ffffff;
    --light-gray: #e9ecef;
    --gray: #adb5bd;
    --dark-gray: #495057;
    --dark: #212529;
    --darker: #1a1a1a;
    --danger: #f72585;
    --warning: #f8961e;
    
    /* Gradients */
    --gradient: linear-gradient(135deg, var(--primary), var(--accent));
    --gradient-hover: linear-gradient(135deg, var(--primary-dark), var(--secondary));
    
    /* Current Theme Defaults */
    --bg: var(--light);
    --text: var(--dark);
    --card-bg: var(--lighter);
    --border: rgba(0, 0, 0, 0.08);
    --input-bg: var(--light-gray);
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    --hover-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    --glass: rgba(255, 255, 255, 0.7);
    --glass-border: rgba(255, 255, 255, 0.2);
}

body.dark-mode {
    --bg: var(--darker);
    --text: var(--light);
    --card-bg: rgba(255, 255, 255, 0.05);
    --border: rgba(255, 255, 255, 0.1);
    --input-bg: rgba(255, 255, 255, 0.1);
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    --hover-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    --glass: rgba(0, 0, 0, 0.3);
    --glass-border: rgba(0, 0, 0, 0.2);
}

.resume-dashboard {
    padding: 2rem 1rem;
    /* min-height: calc(100vh - 120px); */
    background: transparent;
    transition: all 0.3s ease;
}

.dashboard-container {
    max-width: 1300px;
    margin: 0 auto;
    width: 100%;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    background: var(--glass);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    box-shadow: var(--shadow);
    margin-bottom: 2rem;
    border: 1px solid var(--glass-border);
    position: relative;
    /* overflow: hidden; */
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--gradient);
}

.dashboard-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

.dashboard-title i {
    color: var(--primary);
}

.user-id-badge {
    background: var(--gradient);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 24px;
    font-size: 0.9rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(67, 97, 238, 0.3);
}

.add-new-btn {
    background: var(--gradient);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
}

.add-new-btn:hover {
    background: var(--gradient-hover);
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(67, 97, 238, 0.3);
}

.add-new-btn i {
    font-size: 1.1rem;
}

.resume-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.resume-card {
    background: var(--glass);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 1.5rem;
    border: 1px solid var(--glass-border);
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.resume-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--hover-shadow);
    border-color: var(--primary);
}

.resume-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--gradient);
}

.resume-name {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.resume-name i {
    color: var(--primary);
    font-size: 1.1rem;
}

.resume-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    color: var(--gray);
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.resume-meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.resume-meta i {
    font-size: 1rem;
    width: 20px;
    text-align: center;
}

.resume-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: auto;
    padding-top: 1.5rem;
}

.action-btn {
    padding: 0.6rem 1rem;
    border-radius: 8px;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    transition: all 0.2s ease;
    font-weight: 500;
    flex: 1;
    justify-content: center;
}

.action-primary {
    background: var(--gradient);
    color: white;
    box-shadow: 0 2px 6px rgba(67, 97, 238, 0.2);
}

.action-primary:hover {
    background: var(--gradient-hover);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.action-secondary {
    background: transparent;
    color: var(--gray);
    border: 1px solid var(--border);
}

.action-secondary:hover {
    background: var(--input-bg);
    color: var(--danger);
    border-color: var(--danger);
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    background: var(--glass);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    border: 2px dashed var(--border);
    margin-top: 2rem;
    transition: all 0.3s ease;
}

.empty-state:hover {
    border-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: var(--hover-shadow);
}

.empty-icon {
    font-size: 3rem;
    color: var(--primary);
    margin-bottom: 1.25rem;
    opacity: 0.8;
}

.empty-text {
    color: var(--gray);
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
}

/* Floating background elements */
.floating-shapes {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
    pointer-events: none;
}

.shape {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    opacity: 0.1;
}

.shape-1 {
    width: 300px;
    height: 300px;
    background: var(--primary);
    top: -100px;
    left: -100px;
}

.shape-2 {
    width: 400px;
    height: 400px;
    background: var(--accent);
    bottom: -150px;
    right: -100px;
}

/* Theme toggle */
.theme-toggle {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 100;
}

.toggle-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--gradient);
    border: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.toggle-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
}

/* Tooltips */
[data-tooltip] {
    position: relative;
}

[data-tooltip]::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: var(--dark);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.8rem;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.2s ease;
    pointer-events: none;
    margin-bottom: 10px;
}

[data-tooltip]:hover::after {
    opacity: 1;
    visibility: visible;
    margin-bottom: 5px;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1.25rem;
    }
    
    .resume-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
}

@media (max-width: 768px) {
    .resume-grid {
        grid-template-columns: 1fr;
    }
    
    .resume-actions {
        flex-direction: column;
    }
    
    .action-btn {
        width: 100%;
    }
    
    .dashboard-title {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .dashboard-header {
        padding: 1.25rem;
    }
    
    .add-new-btn {
        width: 100%;
        justify-content: center;
    }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.resume-card {
    animation: fadeIn 0.4s ease forwards;
}

.resume-card:nth-child(1) { animation-delay: 0.1s; }
.resume-card:nth-child(2) { animation-delay: 0.2s; }
.resume-card:nth-child(3) { animation-delay: 0.3s; }
.resume-card:nth-child(4) { animation-delay: 0.4s; }

/* Scrollbar styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--light-gray);
}

::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}
</style>

<div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
</div>

<div class="resume-dashboard">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <h1 class="dashboard-title">
                    <i class="bi bi-file-earmark-text-fill"></i> My Resumes
                </h1>
                <!-- <span class="user-id-badge">
                    <i class="bi bi-person-badge-fill"></i> ID: <?= $abhinaba ?>
                </span> -->
            </div>
            <a href="createresume.php" class="add-new-btn" data-tooltip="Create a new resume">
                <i class="bi bi-plus-lg"></i> Create New
            </a>
        </div>

       <?php if($resumes): ?>
            <div class="resume-grid">
                <?php foreach ($resumes as $resume): ?>
                    <div class="resume-card">
                        <h3 class="resume-name">
                            <i class="bi bi-person-vcard-fill"></i> 
                            <?= htmlspecialchars($resume['full_name']) ?>
                        </h3>
                        <div class="resume-meta">
                            <div class="resume-meta-item">
                                <i class="bi bi-clock-history"></i>
                                <span>Updated <?= date('M j, Y', strtotime($resume['updated_at'])) ?></span>
                            </div>
                        </div>
                        <div class="resume-actions">
                            <a href="createresume.action.php?id=<?= $resume['id'] ?>" 
                            class="action-btn action-primary" data-tooltip="View this resume">
                                <i class="bi bi-eye-fill"></i> View 
                            </a>
                            <a href="deleteresume.action.php?id=<?= $resume['id'] ?>" 
                            class="action-btn action-secondary" data-tooltip="Delete this resume">
                                <i class="bi bi-trash3-fill"></i> Delete
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                </div>
                <h4 class="empty-text">You haven't created any resumes yet</h4>
                <p class="text-muted mb-4">Get started by creating your first professional resume</p>
                <a href="createresume.php" class="add-new-btn">
                    <i class="bi bi-plus-lg"></i> Create Your First Resume
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="theme-toggle">
    <button class="toggle-btn" id="themeToggle">
        <i class="bi bi-moon-fill"></i>
    </button>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const themeToggle = document.getElementById('themeToggle');
    const savedTheme = localStorage.getItem("theme") || "light";
    const icon = themeToggle.querySelector('i');
    
    // Set initial theme
    document.body.classList.toggle("dark-mode", savedTheme === "dark");
    icon.className = savedTheme === "dark" ? "bi bi-sun-fill" : "bi bi-moon-fill";
    
    // Toggle theme
    themeToggle.addEventListener('click', () => {
        const isDark = document.body.classList.toggle("dark-mode");
        localStorage.setItem("theme", isDark ? "dark" : "light");
        icon.className = isDark ? "bi bi-sun-fill" : "bi bi-moon-fill";
    });
    
    // Add animation to empty state
    const emptyState = document.querySelector('.empty-state');
    if (emptyState) {
        emptyState.style.opacity = '0';
        setTimeout(() => {
            emptyState.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            emptyState.style.opacity = '1';
        }, 100);
    }
    
    // Card hover effects
    const cards = document.querySelectorAll('.resume-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
});
</script>

<?php require './assets/includes/footer.php'; ?>