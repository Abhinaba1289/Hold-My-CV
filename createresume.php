<?php
$title = "Create Resume | Hold My CV";
require './assets/includes/header.php';
// require './assets/includes/navbar.php';
require './assets/includes/conndb.php';

$fn->AuthPage();
session_start();
$user = $fn->Auth();


// Get user ID from database
$detailsQuery = 'SELECT id FROM details WHERE id =' . $user['id'];
$result = $db->query($detailsQuery);
if ($result) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
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

.create-resume-page {
    padding: 2rem 1rem;
    background: var(--bg);
    min-height: calc(100vh - 120px);
    transition: all 0.3s ease;
}

.resume-container {
    max-width: 1000px;
    margin: 0 auto;
    width: 100%;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0;
}

.page-title i {
    color: var(--primary);
}

.back-btn {
    background: var(--gradient);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
}

.back-btn:hover {
    background: var(--gradient-hover);
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(67, 97, 238, 0.3);
}

.resume-form {
    background: var(--glass);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 2rem;
    border: 1px solid var(--glass-border);
    box-shadow: var(--shadow);
}

.form-section {
    margin-bottom: 2rem;
}

.form-section h2 {
    color: var(--primary);
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-light);
}

.input-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.input-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.input-group label i {
    width: 20px;
    color: var(--primary);
}

.input-group input,
.input-group textarea,
.input-group select {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    border: 1px solid var(--border);
    background: var(--input-bg);
    color: var(--text);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.input-group input:focus,
.input-group textarea:focus,
.input-group select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
}

.input-group textarea {
    min-height: 100px;
    resize: vertical;
}

.dynamic-section {
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    background: var(--card-bg);
    border-radius: 12px;
    border: 1px solid var(--border);
    position: relative;
}

.add-btn {
    background: var(--gradient);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    margin-bottom: 2rem;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
}

.add-btn:hover {
    background: var(--gradient-hover);
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(67, 97, 238, 0.3);
}

.remove-btn {
    background: var(--danger);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
    margin-top: 1rem;
}

.remove-btn:hover {
    background: #d3165e;
    transform: translateY(-1px);
}

.submit-btn {
    background: var(--gradient);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    cursor: pointer;
    margin: 2rem auto 0;
    width: 100%;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.submit-btn:hover {
    background: var(--gradient-hover);
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .resume-form {
        padding: 1.5rem;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .back-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .resume-form {
        padding: 1rem;
    }
    
    .dynamic-section {
        padding: 1rem;
    }
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.resume-form {
    animation: fadeIn 0.4s ease forwards;
}
</style>

<div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
</div>

<div class="create-resume-page">
    <div class="resume-container">
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-file-earmark-plus-fill"></i> Create New Resume
            </h1>
            <a href="myresumes.php" class="back-btn">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <form action="createresume.action.php" method="POST" class="resume-form">
            <div class="form-section">
                <h2><i class="bi bi-person-badge"></i> Personal Information</h2>
                
              
                
                <div class="input-group">
                    <label for="full_name"><i class="bi bi-person-fill"></i> Full Name</label>
                    <input type="text" name="full_name" id="full_name" placeholder="John Doe" required>
                </div>

                <div class="input-group">
                    <label for="email"><i class="bi bi-envelope-fill"></i> Email</label>
                    <input type="email" name="email" id="email" placeholder="john.doe@example.com" required>
                </div>

                <div class="input-group">
                    <label for="phone"><i class="bi bi-telephone-fill"></i> Phone Number</label>
                    <input type="tel" name="phone" id="phone" placeholder="+1 234 567 8900" required>
                </div>

                <div class="input-group">
                    <label for="address"><i class="bi bi-geo-alt-fill"></i> Address</label>
                    <input type="text" name="address" id="address" placeholder="123 Main St, City, Country" required>
                </div>

                <div class="input-group">
                    <label for="dob"><i class="bi bi-calendar-heart-fill"></i> Date of Birth</label>
                    <input type="date" name="dob" id="dob" required>
                </div>

                <div class="input-group">
                    <label for="language"><i class="bi bi-translate"></i> Languages</label>
                    <input type="text" name="language" id="language" placeholder="English, Spanish, French" required>
                </div>

                <div class="input-group">
                    <label for="linkedin"><i class="bi bi-linkedin"></i> LinkedIn URL</label>
                    <input type="url" name="linkedin" id="linkedin" placeholder="https://linkedin.com/in/yourprofile">
                </div>

                <div class="input-group">
                    <label for="hobbies"><i class="bi bi-joystick"></i> Hobbies</label>
                    <input type="text" name="hobbies" id="hobbies" placeholder="Reading, Hiking, Photography">
                </div>

                <div class="input-group">
                    <label for="objective"><i class="bi bi-bullseye"></i> Career Objective</label>
                    <textarea name="objective" id="objective" placeholder="Summarize your career goals and aspirations..." required></textarea>
                </div>
            </div>

            <!-- Experience Section -->
            <div class="form-section">
                <h2><i class="bi bi-briefcase-fill"></i> Work Experience</h2>
                <div id="experience-section">
                    <!-- Experience items will be added here dynamically -->
                </div>
                <button type="button" class="add-btn" onclick="addExperience()">
                    <i class="bi bi-plus-circle"></i> Add Experience
                </button>
            </div>

            <!-- Education Section -->
            <div class="form-section">
                <h2><i class="bi bi-mortarboard-fill"></i> Education</h2>
                <div id="education-section">
                    <!-- Education items will be added here dynamically -->
                </div>
                <button type="button" class="add-btn" onclick="addEducation()">
                    <i class="bi bi-plus-circle"></i> Add Education
                </button>
            </div>

            <!-- Skills Section -->
            <div class="form-section">
                <h2><i class="bi bi-tools"></i> Skills</h2>
                <div id="skills-section">
                    <!-- Skill items will be added here dynamically -->
                </div>
                <button type="button" class="add-btn" onclick="addSkill()">
                    <i class="bi bi-plus-circle"></i> Add Skill
                </button>
            </div>

            <button type="submit" class="submit-btn">
                <i class="bi bi-rocket-takeoff-fill"></i> Generate My Resume
            </button>
        </form>
    </div>
</div>

<script>
// Automatically set the user ID
document.addEventListener("DOMContentLoaded", function() {
    // User ID is already set via PHP, this is just for demonstration
    console.log("User ID automatically set to: <?= $user_id ?>");
});

function addExperience() {
    const experienceDiv = document.createElement('div');
    experienceDiv.className = 'dynamic-section';
    experienceDiv.innerHTML = `
        <div class="input-group">
            <label for="position"><i class="bi bi-briefcase"></i> Position</label>
            <input type="text" name="position[]" placeholder="Software Developer" required>
        </div>
        
        <div class="input-group">
            <label for="company"><i class="bi bi-building"></i> Company</label>
            <input type="text" name="company[]" placeholder="Tech Corp Inc." required>
        </div>
        
        <div class="input-group">
            <label for="description"><i class="bi bi-card-text"></i> Description</label>
            <textarea name="description[]" placeholder="Describe your responsibilities and achievements" required></textarea>
        </div>
        
        <div class="input-row" style="display: flex; gap: 1rem;">
            <div class="input-group" style="flex: 1;">
                <label for="started"><i class="bi bi-calendar-plus"></i> Start Date</label>
                <input type="date" name="started[]" required>
            </div>
            
            <div class="input-group" style="flex: 1;">
                <label for="ended"><i class="bi bi-calendar-check"></i> End Date</label>
                <input type="date" name="ended[]">
            </div>
        </div>
        
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">
            <i class="bi bi-trash-fill"></i> Remove Experience
        </button>
    `;
    document.getElementById('experience-section').appendChild(experienceDiv);
}

function addEducation() {
    const educationDiv = document.createElement('div');
    educationDiv.className = 'dynamic-section';
    educationDiv.innerHTML = `
        <div class="input-group">
            <label for="institute"><i class="bi bi-building"></i> Institute</label>
            <input type="text" name="institute[]" placeholder="University of Technology" required>
        </div>
        
        <div class="input-group">
            <label for="course"><i class="bi bi-book"></i> Course/Degree</label>
            <input type="text" name="course[]" placeholder="Bachelor of Computer Science" required>
        </div>
        
        <div class="input-group">
            <label for="completed_on"><i class="bi bi-calendar-event"></i> Completion Date</label>
            <input type="date" name="completed_on[]" required>
        </div>
        
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">
            <i class="bi bi-trash-fill"></i> Remove Education
        </button>
    `;
    document.getElementById('education-section').appendChild(educationDiv);
}

function addSkill() {
    const skillDiv = document.createElement('div');
    skillDiv.className = 'dynamic-section';
    skillDiv.innerHTML = `
        <div class="input-group">
            <label for="skill"><i class="bi bi-code-slash"></i> Skill</label>
            <input type="text" name="skill[]" placeholder="JavaScript, Python, etc." required>
        </div>
        
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">
            <i class="bi bi-trash-fill"></i> Remove Skill
        </button>
    `;
    document.getElementById('skills-section').appendChild(skillDiv);
}

// Add one empty section of each type by default
document.addEventListener("DOMContentLoaded", function() {
    addExperience();
    addEducation();
    addSkill();
});
</script>

<?php require './assets/includes/footer.php'; ?>