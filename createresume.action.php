<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="create.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div  class="content">


        <!-- <div class="first">
            <?php
                
                include('db_connect.php'); // Include database connection
               
                
                

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $resume_id = isset($_POST['resume_id']) ? $_POST['resume_id'] : null;



                $user_id = $_POST['user_id'];
                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $dob = $_POST['dob'];
                $linkedin = $_POST['linkedin'];
                $languages = $_POST['language'];
                $hobbies = $_POST['hobbies'];
                $objective = $_POST['objective'];
            
                if ($resume_id) {
                    // Update existing resume
                    $stmt = $conn->prepare("UPDATE resumedata SET user_id = ?, full_name = ?, email = ?, phone = ?, address = ?, dob = ?, linkedin = ?, languages = ?, hobbies = ?, objective = ?, updated_at = NOW() WHERE id = ?");
                    $stmt->bind_param("issssssssi", $user_id, $full_name, $email, $phone, $address, $dob, $linkedin, $languages, $hobbies, $objective, $resume_id);
                } else {
                    // Insert new resume
                    $stmt = $conn->prepare("INSERT INTO resumedata (user_id, full_name, email, phone, address, dob, linkedin, languages, hobbies, objective, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                    $stmt->bind_param("isssssssss", $user_id, $full_name, $email, $phone, $address, $dob, $linkedin, $languages, $hobbies, $objective);
                }

                if ($stmt->execute()) {
                    if (!$resume_id) {
                        $resume_id = $stmt->insert_id; // Get the inserted resume ID
                    }

                    // Handle experience section
                    if (isset($_POST['position'])) {
                        $positions = $_POST['position'];
                        $companies = $_POST['company'];
                        $descriptions = $_POST['description'];
                        $started_dates = $_POST['started'];
                        $ended_dates = $_POST['ended'];

                        // Delete existing experiences if updating
                        if ($resume_id) {
                            $stmt_delete_exp = $conn->prepare("DELETE FROM experience WHERE resume_id = ?");
                            $stmt_delete_exp->bind_param("i", $resume_id);
                            $stmt_delete_exp->execute();
                            $stmt_delete_exp->close();
                        }

                        $stmt_exp = $conn->prepare("INSERT INTO experience (resume_id, position, company, description, started, ended) VALUES (?, ?, ?, ?, ?, ?)");
                        foreach ($positions as $index => $position) {
                            $company = $companies[$index];
                            $description = $descriptions[$index];
                            $started = $started_dates[$index];
                            $ended = $ended_dates[$index];
                            $stmt_exp->bind_param("isssss", $resume_id, $position, $company, $description, $started, $ended);
                            $stmt_exp->execute();
                        }
                        $stmt_exp->close();
                    }

                    // Handle education section
                    if (isset($_POST['institute'])) {
                        $institutes = $_POST['institute'];
                        $completed_on_dates = $_POST['completed_on'];
                        $courses = $_POST['course'];

                        // Delete existing educations if updating
                        if ($resume_id) {
                            $stmt_delete_edu = $conn->prepare("DELETE FROM educations WHERE resume_id = ?");
                            $stmt_delete_edu->bind_param("i", $resume_id);
                            $stmt_delete_edu->execute();
                            $stmt_delete_edu->close();
                        }

                        $stmt_edu = $conn->prepare("INSERT INTO educations (resume_id, institute, completed_on, course) VALUES (?, ?, ?, ?)");
                        foreach ($institutes as $index => $institute) {
                            $completed_on = $completed_on_dates[$index];
                            $course = $courses[$index];
                            $stmt_edu->bind_param("isss", $resume_id, $institute, $completed_on, $course);
                            $stmt_edu->execute();
                        }
                        $stmt_edu->close();
                    }

                    // Handle skills section
                    if (isset($_POST['skill'])) {
                        $skills = $_POST['skill'];

                        // Delete existing skills if updating
                        if ($resume_id) {
                            $stmt_delete_skill = $conn->prepare("DELETE FROM skills WHERE resume_id = ?");
                            $stmt_delete_skill->bind_param("i", $resume_id);
                            $stmt_delete_skill->execute();
                            $stmt_delete_skill->close();
                        }

                        $stmt_skill = $conn->prepare("INSERT INTO skills (resume_id, skill) VALUES (?, ?)");
                        foreach ($skills as $skill) {
                            $stmt_skill->bind_param("is", $resume_id, $skill);
                            $stmt_skill->execute();
                        }
                        $stmt_skill->close();
                    }

                    // Redirect to the resume template page with the updated ID
                    header("Location: createresume.action.php?user_id=" . $resume_id);
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            } elseif (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];

                $stmt = $conn->prepare("SELECT * FROM resumedata WHERE id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $resume = $result->fetch_assoc();

                if ($resume) {
                    echo "<!DOCTYPE html>";
                    echo "<html lang='en'>";
                    echo "<head>";
                    echo "<meta charset='UTF-8'>";
                    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
                    echo "<title>Edit Resume</title>";
                    echo "</head>";
                    echo "<body>";
                    echo "<div class='head'>";
                    echo "<h1 style='font-size:20px'>📃Edit Resume</h1>";
                    echo "<a href='myresumes.php' class='dash'><i class='fa-solid fa-arrow-left'></i>Dashboard</a>";
                    echo "</div>";
                    echo "<form action='createresume.action.php' method='post' class='full-form'>";
                    echo "<input type='text' name='resume_id' value='" . htmlspecialchars($resume['id']) . "'>";
                    echo "<div class='name inputs-dg'>";
                    echo "<label for='user_id'><i class='fa-solid fa-marker'></i>Enter Your Name</label>";
                    echo "<input type='text' name='user_id' id='user_id' value='" . htmlspecialchars($resume['user_id']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='name inputs-dg'>";
                    echo "<label for='full_name'><i class='fa-solid fa-marker'></i>Enter Your Name</label>";
                    echo "<input type='text' name='full_name' id='full_name' value='" . htmlspecialchars($resume['full_name']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='email inputs-dg'>";
                    echo "<label for='email'><i class='fa-solid fa-envelope'></i>Enter Your Email:</label>";
                    echo "<input type='email' name='email' id='email' value='" . htmlspecialchars($resume['email']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='phone inputs-dg'>";
                    echo "<label for='phone'><i class='fa-solid fa-phone'></i>Enter Phone Number:</label>";
                    echo "<input type='number' name='phone' id='phone' value='" . htmlspecialchars($resume['phone']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='address inputs-dg'>";
                    echo "<label for='address'><i class='fa-solid fa-map-location-dot'></i>Enter Your Address:</label>";
                    echo "<input type='text' name='address' id='address' value='" . htmlspecialchars($resume['address']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='dob inputs-dg'>";
                    echo "<label for='dob'><i class='fa-solid fa-calendar-days'></i>Enter Your Date of Birth:</label>";
                    echo "<input type='date' name='dob' id='dob' value='" . htmlspecialchars($resume['dob']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='linkedin inputs-dg'>";
                    echo "<label for='linkedin'><i class='fa-brands fa-linkedin'></i>Paste Your Linkedin URL:</label>";
                    echo "<input type='url' name='linkedin' id='linkedin' value='" . htmlspecialchars($resume['linkedin']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='language inputs-dg'>";
                    echo "<label for='language'><i class='fa-solid fa-language'></i>Languages You Know:</label>";
                    echo "<input type='text' name='language' id='language' value='" . htmlspecialchars($resume['languages']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='hobbies inputs-dg'>";
                    echo "<label for='hobbies'><i class='fa-solid fa-futbol'></i>Enter Your Hobbies:</label>";
                    echo "<input type='text' name='hobbies' id='hobbies' value='" . htmlspecialchars($resume['hobbies']) . "' required><br>";
                    echo "</div>";
                    echo "<div class='objective inputs-dg'>";
                    echo "<label for='objective'><i class='fa-solid fa-bullseye'></i>Enter Your Objective:</label>";
                    echo "<textarea name='objective' id='objective' required>" . htmlspecialchars($resume['objective']) . "</textarea><br>";
                    echo "</div>";

                    // Display existing experiences
                    echo "<h2>Experience</h2>";
                    echo "<div id='experience-section'>";
                    $stmt_exp = $conn->prepare("SELECT * FROM experience WHERE resume_id = ?");
                    $stmt_exp->bind_param("i", $user_id);
                    $stmt_exp->execute();
                    $exp_result = $stmt_exp->get_result();
                    while ($exp = $exp_result->fetch_assoc()) {
                        echo "<div class='experience-item second2'>";
                        echo "<label for='position'>Position:</label>";
                        echo "<input type='text' name='position[]' value='" . htmlspecialchars($exp['position']) . "' required><br>";
                        echo "<label for='company'>Company:</label>";
                        echo "<input type='text' name='company[]' value='" . htmlspecialchars($exp['company']) . "' required><br>";
                        echo "<label for='description'>Description:</label>";
                        echo "<textarea name='description[]' required>" . htmlspecialchars($exp['description']) . "</textarea><br>";
                        echo "<label for='started'>Started:</label>";
                        echo "<input type='date' name='started[]' value='" . htmlspecialchars($exp['started']) . "' required><br>";
                        echo "<label for='ended'>Ended:</label>";
                        echo "<input type='date' name='ended[]' value='" . htmlspecialchars($exp['ended']) . "' required><br>";
                        echo "<button type='button' class='remove-experience remove'>Remove</button>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "<button type='button' id='add-experience' class='add-btn'>Add Experience</button><br>";

                    // Display existing educations
                    echo "<h2>Education</h2>";
                    echo "<div id='education-section'>";
                    $stmt_edu = $conn->prepare("SELECT * FROM educations WHERE resume_id = ?");
                    $stmt_edu->bind_param("i", $user_id);
                    $stmt_edu->execute();
                    $edu_result = $stmt_edu->get_result();
                    while ($edu = $edu_result->fetch_assoc()) {
                        echo "<div class='education-item second2'>";
                        echo "<label for='institute'>Institute:</label>";
                        echo "<input type='text' name='institute[]' value='" . htmlspecialchars($edu['institute']) . "' required><br>";
                        echo "<label for='completed_on'>Completed On:</label>";
                        echo "<input type='date' name='completed_on[]' value='" . htmlspecialchars($edu['completed_on']) . "' required><br>";
                        echo "<label for='course'>Course:</label>";
                        echo "<input type='text' name='course[]' value='" . htmlspecialchars($edu['course']) . "' required><br>";
                        echo "<button type='button' class='remove-education remove'>Remove</button>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "<button type='button' id='add-education' class='add-btn'>Add Education</button><br>";

                    // Display existing skills
                    echo "<h2>Skills</h2>";
                    echo "<div id='skills-section'>";
                    $stmt_skill = $conn->prepare("SELECT * FROM skills WHERE resume_id = ?");
                    $stmt_skill->bind_param("i", $user_id);
                    $stmt_skill->execute();
                    $skill_result = $stmt_skill->get_result();
                    while ($skill = $skill_result->fetch_assoc()) {
                        echo "<div class='skill-item second2'>";
                        echo "<label for='skill'>Skill:</label>";
                        echo "<input type='text' name='skill[]' value='" . htmlspecialchars($skill['skill']) . "' required><br>";
                        echo "<button type='button' class='remove-skill remove'>Remove</button>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "<button type='button' id='add-skill' class='add-btn'>Add Skill</button><br>";

                    echo "<input id='submit-btn' type='submit' value='Update Resume'>";
                    echo "</form>";
                    echo "</body>";
                    echo "</html>";
                } else {
                    echo "Resume not found.";
                }

                $stmt->close();
            }
            ?>

            <script>
            // JavaScript for adding and removing experience, education, and skill items
            document.getElementById('add-experience').addEventListener('click', function() {
                var experienceSection = document.getElementById('experience-section');
                var newExperience = document.createElement('div');
                newExperience.classList.add('experience-item');
                newExperience.classList.add('second2');
                newExperience.innerHTML = `
                    <label for='position'>Position:</label>
                    <input type='text' name='position[]' placeholder='Enter your position' required><br>
                    <label for='company'>Company:</label>
                    <input type='text' name='company[]' placeholder='Enter company name' required><br>
                    <label for='description'>Description:</label>
                    <textarea name='description[]' placeholder='Enter your job description' required></textarea><br>
                    <label for='started'>Started:</label>
                    <input type='date' name='started[]' required><br>
                    <label for='ended'>Ended:</label>
                    <input type='date' name='ended[]' required><br>
                    <button type='button' class='remove-experience remove'>Remove</button>
                `;
                experienceSection.appendChild(newExperience);

                newExperience.querySelector('.remove-experience').addEventListener('click', function() {
                    experienceSection.removeChild(newExperience);
                });
            });

            document.getElementById('add-education').addEventListener('click', function() {
                var educationSection = document.getElementById('education-section');
                var newEducation = document.createElement('div');
                newEducation.classList.add('education-item');
                newEducation.classList.add('second2');
                newEducation.innerHTML = `
                    <label for='institute'>Institute:</label>
                    <input type='text' name='institute[]' placeholder='Enter institute name' required><br>
                    <label for='completed_on'>Completed On:</label>
                    <input type='date' name='completed_on[]' required><br>
                    <label for='course'>Course:</label>
                    <input type='text' name='course[]' placeholder='Enter your course' required><br>
                    <button type='button' class='remove-education remove'>Remove</button>
                `;
                educationSection.appendChild(newEducation);

                newEducation.querySelector('.remove-education').addEventListener('click', function() {
                    educationSection.removeChild(newEducation);
                });
            });

            document.getElementById('add-skill').addEventListener('click', function() {
                var skillsSection = document.getElementById('skills-section');
                var newSkill = document.createElement('div');
                newSkill.classList.add('skill-item');
                newSkill.classList.add('second2');
                newSkill.innerHTML = `
                    <label for='skill'>Skill:</label>
                    <input type='text' name='skill[]' placeholder='Enter a skill' required><br>
                    <button type='button' class='remove-skill remove'>Remove</button>
                `;
                skillsSection.appendChild(newSkill);

                newSkill.querySelector('.remove-skill').addEventListener('click', function() {
                    skillsSection.removeChild(newSkill);
                });
            });

            var removeExperienceButtons = document.querySelectorAll('.remove-experience');
            removeExperienceButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    button.parentElement.parentElement.removeChild(button.parentElement);
                });
            });

            var removeEducationButtons = document.querySelectorAll('.remove-education');
            removeEducationButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    button.parentElement.parentElement.removeChild(button.parentElement);
                });
            });

            var removeSkillButtons = document.querySelectorAll('.remove-skill');
            removeSkillButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    button.parentElement.parentElement.removeChild(button.parentElement);
                });
            });
            </script>

        </div> -->



        <div class="second">
        <?php
            include('db_connect.php'); // Include database connection

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get the data from the form
                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $dob = $_POST['dob'];
                $linkedin = $_POST['linkedin'];
                $languages = $_POST['language'];
                $hobbies = $_POST['hobbies'];
                $objective = $_POST['objective'];

                // Prepare the SQL statement for resumedata table
                $stmt = $conn->prepare("INSERT INTO resumedata (full_name, email, phone, address, dob, linkedin, languages, hobbies, objective, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt->bind_param("sssssssss", $full_name, $email, $phone, $address, $dob, $linkedin, $languages, $hobbies, $objective);

                if ($stmt->execute()) {
                    $resume_id = $stmt->insert_id; // Get the inserted resume ID

                    // Handle experience section
                    if (isset($_POST['position'])) {
                        $positions = $_POST['position'];
                        $companies = $_POST['company'];
                        $descriptions = $_POST['description'];
                        $started_dates = $_POST['started'];
                        $ended_dates = $_POST['ended'];

                        $stmt_exp = $conn->prepare("INSERT INTO experience (resume_id, position, company, description, started, ended) VALUES (?, ?, ?, ?, ?, ?)");

                        foreach ($positions as $index => $position) {
                            $company = $companies[$index];
                            $description = $descriptions[$index];
                            $started = $started_dates[$index];
                            $ended = $ended_dates[$index];

                            $stmt_exp->bind_param("isssss", $resume_id, $position, $company, $description, $started, $ended);
                            $stmt_exp->execute();
                        }
                        $stmt_exp->close();
                    }

                    // Handle education section
                    if (isset($_POST['institute'])) {
                        $institutes = $_POST['institute'];
                        $completed_on_dates = $_POST['completed_on'];
                        $courses = $_POST['course'];

                        $stmt_edu = $conn->prepare("INSERT INTO educations (resume_id, institute, completed_on, course) VALUES (?, ?, ?, ?)");

                        foreach ($institutes as $index => $institute) {
                            $completed_on = $completed_on_dates[$index];
                            $course = $courses[$index];

                            $stmt_edu->bind_param("isss", $resume_id, $institute, $completed_on, $course);
                            $stmt_edu->execute();
                        }
                        $stmt_edu->close();
                    }

                    // Handle skills section
                    if (isset($_POST['skill'])) {
                        $skills = $_POST['skill'];

                        $stmt_skill = $conn->prepare("INSERT INTO skills (resume_id, skill) VALUES (?, ?)");

                        foreach ($skills as $skill) {
                            $stmt_skill->bind_param("is", $resume_id, $skill);
                            $stmt_skill->execute();
                        }
                        $stmt_skill->close();
                    }

                    // Redirect to the resume template page with the inserted ID
                    header("Location: createresume.action.php?user_id=" . $resume_id);
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            } elseif (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];

                $stmt = $conn->prepare("SELECT * FROM resumedata WHERE id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $resume = $result->fetch_assoc();

                if ($resume) {
                    echo "<!DOCTYPE html>";
                    echo "<html lang='en'>";
                    echo "<head>";
                    echo "<meta charset='UTF-8'>";
                    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
                    echo "<title>Resume for " . htmlspecialchars($resume['full_name']) . "</title>";
                    echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>";
                    echo "<style>
                            body {
                                font-family: Arial, sans-serif;
                                margin: 0;
                                padding: 20px;
                                background-color: #f4f4f4;
                            }
                            .resume-container {
                                background-color: #fff;
                                padding: 20px;
                                border-radius: 8px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                width: 800px;
                                transform:scale(1);
                            }
                            .header, .section {
                                margin-bottom: 20px;
                            }
                            .header {
                                text-align: center;
                                border-bottom: 2px solid #333;
                                padding-bottom: 10px;
                            }
                            .header h1 {
                                margin: 0;
                            }
                            .section-title {
                                font-size: 20px;
                                margin-bottom: 10px;
                                color: #333;
                                border-bottom: 1px solid #ccc;
                                padding-bottom: 5px;
                            }
                            .info {
                                display: flex;
                                justify-content: space-between;
                            }
                            .info p {
                                margin: 0;
                            }
                            .experience, .education, .skills {
                                margin-bottom: 15px;
                            }
                         

                            .headers{
                                font-size:13px;
                                padding:5px;
                            }
                            .font{
                            font-size:14px;
                            }
                        </style>";
                    echo "</head>";
                    echo "<body>";
                    echo "<div class='head'>";
                    echo "<h1 style='font-size:20px'>Check Your Resume</h1>";
                    echo "<a href='myresumes.php' class='dash'><i class='fa-solid fa-arrow-left'></i>Dashboard</a>";
                    echo "</div>";
                    echo "<div class='resume-container' id='resume'>";
                    echo "<div class='header'>";
                    echo "<h1>" . htmlspecialchars($resume['full_name']) . "</h1>";
                    echo "<span class='headers'>" 
                    . htmlspecialchars($resume['email']) . " | " 
                    . htmlspecialchars($resume['phone']) . " | " 
                    . htmlspecialchars($resume['address']) . " | Date of Birth: " 
                    . htmlspecialchars($resume['dob']) . " | <a href='" 
                    . htmlspecialchars($resume['linkedin']) . "' target='_blank'><i class='fab fa-linkedin'></i> LinkedIn</a></span>";
                
                    echo "</div>";

                    echo "<div class='section font'>";
                    echo "<h2 class='section-title'>Objective</h2>";
                    echo "<p>" . htmlspecialchars($resume['objective']) . "</p>";
                    echo "</div>";

                    echo "<div class='section'>";
                    echo "<h2 class='section-title'>Languages</h2>";
                    echo "<p>" . htmlspecialchars($resume['languages']) . "</p>";
                    echo "</div>";

                    echo "<div class='section font'>";
                    echo "<h2 class='section-title'>Hobbies</h2>";
                    echo "<p>" . htmlspecialchars($resume['hobbies']) . "</p>";
                    echo "</div>";

                    // Fetch and display experience
                    $stmt_exp = $conn->prepare("SELECT * FROM experience WHERE resume_id = ?");
                    $stmt_exp->bind_param("i", $user_id);
                    $stmt_exp->execute();
                    $exp_result = $stmt_exp->get_result();
                    if ($exp_result->num_rows > 0) {
                        echo "<div class='section font'>";
                        echo "<h2 class='section-title'>Experience</h2>";
                        while ($exp = $exp_result->fetch_assoc()) {
                            echo "<div class='experience'>";
                            echo "<p><strong><i style='font-size:6px; padding:4px; position:relative; bottom:3px;' class='fa-solid fa-circle'></i>Position:</strong> " . htmlspecialchars($exp['position']) . "</p>";
                            echo "<p><strong>Company:</strong> " . htmlspecialchars($exp['company']) . "</p>";
                            echo "<p><strong>Description:</strong> " . htmlspecialchars($exp['description']) . "</p>";
                            echo "<p><strong>Started:</strong> " . htmlspecialchars($exp['started']) . "</p>";
                            echo "<p><strong>Ended:</strong> " . htmlspecialchars($exp['ended']) . "</p>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    $stmt_exp->close();

                    // Fetch and display education
                    $stmt_edu = $conn->prepare("SELECT * FROM educations WHERE resume_id = ?");
                    $stmt_edu->bind_param("i", $user_id);
                    $stmt_edu->execute();
                    $edu_result = $stmt_edu->get_result();
                    if ($edu_result->num_rows > 0) {
                        echo "<div class='section font'>";
                        echo "<h2 class='section-title'>Education</h2>";
                        while ($edu = $edu_result->fetch_assoc()) {
                            echo "<div class='education'>";
                            echo "<p><strong><i style='font-size:6px; padding:4px; position:relative; bottom:3px;' class='fa-solid fa-circle'></i>Institute:</strong> " . htmlspecialchars($edu['institute']) . "</p>";
                            echo "<p><strong>Completed On:</strong> " . htmlspecialchars($edu['completed_on']) . "</p>";
                            echo "<p><strong>Course:</strong> " . htmlspecialchars($edu['course']) . "</p>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    $stmt_edu->close();

                    // Fetch and display skills
                    $stmt_skill = $conn->prepare("SELECT * FROM skills WHERE resume_id = ?");
                    $stmt_skill->bind_param("i", $user_id);
                    $stmt_skill->execute();
                    $skill_result = $stmt_skill->get_result();
                    if ($skill_result->num_rows > 0) {
                        echo "<div class='section font'>";
                        echo "<h2 class='section-title'>Skills</h2>";
                        while ($skill = $skill_result->fetch_assoc()) {
                            echo "<div class='skills'>";
                            echo "<p><i style='font-size:6px; padding:4px; position:relative; bottom:3px;' class='fa-solid fa-circle'></i>" . htmlspecialchars($skill['skill']) . "</p>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    $stmt_skill->close();

                    echo "<div class='section font'>";
                    echo "<h2 class='section-title'>Declearation</h2>";
                    echo "<p> I hereby declare that the information mentioned above are true and correct to the best of my knowledge and belief </p>";
                    echo "<h5>" . htmlspecialchars($resume['full_name']) . "</h5>";
                    echo "</div>";

                    echo "</div>";
                    echo "<button class='download-btn' onclick='downloadResume()'><i class='fas fa-download'></i> Download Resume as PDF</button>";
                    echo "</html>";
                } else {
                    echo "Resume not found.";
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "No user ID provided.";
            }
            ?>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
            <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
            <script>
                function downloadResume() {
                    var { jsPDF } = window.jspdf;
                    var doc = new jsPDF('p', 'mm', 'a4');

                    var resumeElement = document.getElementById('resume');

                    // Capture the resume section as an image
                    html2canvas(resumeElement, { scale: 2 }).then(canvas => {
                        var imgData = canvas.toDataURL('image/png');

                        // Adjust image width and height for A4 paper size
                        var imgWidth = 210; // A4 size in mm
                        var imgHeight = (canvas.height * imgWidth) / canvas.width;

                        // Add the image of the resume to the PDF
                        doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

                    

                        // Save the PDF with the clickable link
                        doc.save('resume.pdf');
                    });
                }
            </script>




        </div>



    </div>
</body>
</html>



























