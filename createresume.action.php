<?php
$title = "Resume Action | Hold My CV";
require './assets/includes/header.php';
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
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get all form data
    $full_name = $db->real_escape_string($_POST['full_name'] ?? '');
    $email = $db->real_escape_string($_POST['email'] ?? '');
    $phone = $db->real_escape_string($_POST['phone'] ?? '');
    $address = $db->real_escape_string($_POST['address'] ?? '');
    $dob = $db->real_escape_string($_POST['dob'] ?? '');
    $languages = $db->real_escape_string($_POST['language'] ?? '');
    $linkedin = $db->real_escape_string($_POST['linkedin'] ?? '');
    $hobbies = $db->real_escape_string($_POST['hobbies'] ?? '');
    $objective = $db->real_escape_string($_POST['objective'] ?? '');
    $updated_at = date('Y-m-d H:i:s');

    // Always insert new resume (removed the check for existing resumes)
    $slug = uniqid();
    $insertQuery = "INSERT INTO resumedata 
                   (user_id, full_name, email, phone, address, dob, languages, linkedin, hobbies, objective, updated_at) 
                   VALUES ($user_id, '$full_name', '$email', '$phone', '$address', '$dob', '$languages', '$linkedin', '$hobbies', '$objective', '$updated_at')";
    
    if ($db->query($insertQuery)) {
        $resume_id = $db->insert_id;
        
        // Insert experiences
        if (isset($_POST['position'])) {
            for ($i = 0; $i < count($_POST['position']); $i++) {
                $position = $db->real_escape_string($_POST['position'][$i]);
                $company = $db->real_escape_string($_POST['company'][$i]);
                $description = $db->real_escape_string($_POST['description'][$i]);
                $started = $db->real_escape_string($_POST['started'][$i]);
                $ended = isset($_POST['ended'][$i]) ? $db->real_escape_string($_POST['ended'][$i]) : null;
                
                $db->query("INSERT INTO experience 
                            (resume_id, position, company, description, started, ended) 
                            VALUES ($resume_id, '$position', '$company', '$description', '$started', " . ($ended ? "'$ended'" : "NULL") . ")");
            }
        }
        
        // Insert educations
        if (isset($_POST['institute'])) {
            for ($i = 0; $i < count($_POST['institute']); $i++) {
                $institute = $db->real_escape_string($_POST['institute'][$i]);
                $course = $db->real_escape_string($_POST['course'][$i]);
                $completed_on = $db->real_escape_string($_POST['completed_on'][$i]);
                
                $db->query("INSERT INTO educations 
                            (resume_id, institute, course, completed_on) 
                            VALUES ($resume_id, '$institute', '$course', '$completed_on')");
            }
        }
        
        // Insert skills
        if (isset($_POST['skill'])) {
            foreach ($_POST['skill'] as $skill) {
                $skill = $db->real_escape_string($skill);
                $db->query("INSERT INTO skills (resume_id, skill) VALUES ($resume_id, '$skill')");
            }
        }
        
        // Redirect to view the new resume
        header("Location: createresume.action.php?id=$resume_id");
        exit();
    } else {
        $_SESSION['error'] = "Error creating resume: " . $db->error;
        header("Location: createresume.php");
        exit();
    }
}

// Display resume if ID is provided
if (isset($_GET['id'])) {
    $resume_id = $_GET['id'];
    
    // Fetch resume data
    $resumeResult = $db->query("SELECT * FROM resumedata WHERE id = $resume_id");
    if ($resumeResult->num_rows === 0) {
        echo "Resume not found.";
        exit();
    }
    $resume = $resumeResult->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume for <?= htmlspecialchars($resume['full_name']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 1050px;
            margin: 20px auto;
            padding: 20px;
        }
        
        .dashboard-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #4361ee;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .dashboard-btn:hover {
            background-color: #3a56d5;
        }
        
        .dashboard-btn i {
            margin-right: 8px;
        }
        
        .resume {
            background-color: white;
            padding: 40px 50px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .resume-header {
            margin-bottom: 30px;
            text-align: center;
        }
        
        .resume-header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2b2d42;
        }
        
        .contact-info {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
        }
        
        .contact-item i {
            margin-right: 8px;
            color: #4361ee;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2b2d42;
            border-bottom: 2px solid #4361ee;
            padding-bottom: 5px;
        }
        
        .objective {
            line-height: 1.7;
        }
        
        .skills-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .skills-list li {
            /* background-color: #e0e6ff; */
            /* padding: 8px 15px; */
            border-radius: 20px;
            font-size: 0.9rem;
        }
        
        .experience-item {
            margin-bottom: 20px;
        }
        
        .experience-item h3 {
            margin: 0 0 5px 0;
            font-size: 1.1rem;
        }
        
        .experience-item .company {
            font-weight: 600;
            color: #4361ee;
        }
        
        .experience-item .date {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 8px;
            font-style: italic;
        }
        
        .experience-item .description {
            margin-top: 8px;
        }
        
        .hobbies {
            line-height: 1.7;
        }
        
        .download-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 25px;
            background-color: #4361ee;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        
        .download-btn:hover {
            background-color: #3a56d5;
        }
        
        .download-btn i {
            margin-right: 8px;
        }


        .desktop-notice {  
            display: none;  
        }  

        @media (max-width: 1024px) {  
            .desktop-notice {  
                display: block;  
                font-style: italic;  
                color: #666; /* Optional: subtle gray text */  
                margin: 10px 0; /* Optional: spacing */  
            }  
        }  
        
    </style>
</head>
<body>
    <div class="container">
        <a href="myresumes.php" class="dashboard-btn">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
        <div class="desktop-notice">  
  <em>For the best experience, please view this resume in desktop mode or on a larger screen (1024px or wider).</em>  
</div>  
        <div class="resume" id="resume">
            
            <div class="resume-header">
                <h1><?= htmlspecialchars($resume['full_name']) ?></h1>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <?= htmlspecialchars($resume['email']) ?>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <?= htmlspecialchars($resume['phone']) ?>
                    </div>
                    <?php if (!empty($resume['address'])): ?>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <?= htmlspecialchars($resume['address']) ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($resume['linkedin'])): ?>
                        <div class="contact-item">
                            <i class="fab fa-linkedin"></i>
                            <a href="<?= htmlspecialchars($resume['linkedin']) ?>" target="_blank">LinkedIn</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="section">
                <h2 class="section-title">Objective</h2>
                <div class="objective">
                    <?= htmlspecialchars($resume['objective']) ?>
                </div>
            </div>
            
            <div class="section">
                <h2 class="section-title">Skills</h2>
                <?php
                $stmt_skill = $db->prepare("SELECT * FROM skills WHERE resume_id = ?");
                $stmt_skill->bind_param("i", $resume_id);
                $stmt_skill->execute();
                $skill_result = $stmt_skill->get_result();
                if ($skill_result->num_rows > 0): ?>
                    <ul class="skills-list">
                        <?php while ($skill = $skill_result->fetch_assoc()): ?>
                            <li><?= htmlspecialchars($skill['skill']) ?></li>
                        <?php endwhile; ?>
                    </ul>
                <?php 
                endif;
                $stmt_skill->close();
                ?>
            </div>
            
            <div class="section">
                <h2 class="section-title">Experience</h2>
                <?php
                $stmt_exp = $db->prepare("SELECT * FROM experience WHERE resume_id = ?");
                $stmt_exp->bind_param("i", $resume_id);
                $stmt_exp->execute();
                $exp_result = $stmt_exp->get_result();
                if ($exp_result->num_rows > 0):
                    while ($exp = $exp_result->fetch_assoc()): ?>
                        <div class="experience-item">
                            <h3><?= htmlspecialchars($exp['position']) ?></h3>
                            <div class="company"><?= htmlspecialchars($exp['company']) ?></div>
                            <div class="date">
                                <?= htmlspecialchars($exp['started']) ?> - <?= $exp['ended'] ? htmlspecialchars($exp['ended']) : 'Present' ?>
                            </div>
                            <div class="description">
                                <?= nl2br(htmlspecialchars($exp['description'])) ?>
                            </div>
                        </div>
                    <?php endwhile;
                else: ?>
                    <p>No experience listed</p>
                <?php 
                endif;
                $stmt_exp->close();
                ?>
            </div>
            
            <div class="section">
                <h2 class="section-title">Hobbies</h2>
                <div class="hobbies">
                    <?= htmlspecialchars($resume['hobbies']) ?>
                </div>
            </div>
        </div>
        
        <button class="download-btn" onclick="downloadResume()">
            <i class="fas fa-download"></i> Download Resume as PDF
        </button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    
    <script>
        function downloadResume() {
    var { jsPDF } = window.jspdf;
    var doc = new jsPDF('p', 'mm', 'a4');
    
    var resumeElement = document.getElementById('resume');
    
    // Options for html2canvas to better preserve text and links
    html2canvas(resumeElement, {
        scale: 2, // Balanced resolution
        logging: false,
        useCORS: true,
        allowTaint: true,
        backgroundColor: '#FFFFFF',
        onclone: function(clonedDoc) {
            // Make links more visible for html2canvas
            clonedDoc.querySelectorAll('a').forEach(link => {
                link.style.color = '#0000EE'; // Standard link blue
                link.style.textDecoration = 'underline';
            });
        }
    }).then(canvas => {
        // Get all links from the original element
        const links = resumeElement.querySelectorAll('a');
        const linkData = [];
        
        // Collect link positions and URLs
        links.forEach(link => {
            const rect = link.getBoundingClientRect();
            const offset = resumeElement.getBoundingClientRect();
            
            linkData.push({
                x: rect.left - offset.left,
                y: rect.top - offset.top,
                width: rect.width,
                height: rect.height,
                url: link.href
            });
        });
        
        // Add the canvas as an image (optional, can remove if you want pure text)
        var imgWidth = 210; // A4 width in mm
        var imgHeight = canvas.height * imgWidth / canvas.width;
        doc.addImage(canvas, 'JPEG', 0, 0, imgWidth, imgHeight);
        
        // Add clickable links
        linkData.forEach(link => {
            // Convert pixel positions to mm (1px ≈ 0.264583mm at 96dpi)
            const x = link.x * 0.264583;
            const y = link.y * 0.264583;
            const width = link.width * 0.264583;
            const height = link.height * 0.264583;
            
            // Add link annotation
            doc.link(x, y, width, height, { url: link.url });
        });
        
        // Save the PDF
        doc.save('resume.pdf');
    });
}
    </script>
</body>
</html>
<?php
} else {
    // No ID provided, redirect to create page
    header("Location: createresume.php");
    exit();
}
?>