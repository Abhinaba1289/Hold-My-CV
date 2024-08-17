<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hold My CV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="styleinp.css"> -->
    <link rel="stylesheet" href="styleinp.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="head">
            <h1 class = "header">📃CV informations</h1>
            <a href="myresumes.php"><i class="fa-solid fa-arrow-left"></i>Dashboard</a>
    </div>
    <form action="createresume.action.php" method = "post" class="full-form">
       
        <div class="name inputs-dg">
            <label for="user_id"><i class="fa-solid fa-marker"></i>Enter id : </label>
            <input type="number" name="user_id" id="user_id" placeholder="find id at dashboard top" required>
        </div>
        <div class="name inputs-dg">
            <label for="full_name"><i class="fa-solid fa-marker"></i>Enter Your Name</label>
            <input type="text" name="full_name" id="full_name" placeholder="Rabi Roy" required>
        </div>

        <div class="email inputs-dg">
            <label for="email"><i class="fa-solid fa-envelope"></i>Enter Your Email: </label>
            <input type="email" name="email" id="email" placeholder="rabi123@gmail.com" required>
        </div>

        <div class="phone inputs-dg">
            <label for="phone"><i class="fa-solid fa-phone"></i>Enter Phone Number: </label>
            <input type="number" name="phone" id="phone" placeholder="9898769769" required>
        </div>

        <div class="address inputs-dg">
            <label for="address"><i class="fa-solid fa-map-location-dot"></i>Enter Your Address: </Address></label>
            <input type="text" name="address" id="address" placeholder="kolkata, West Bengal - 732322" required>
        </div>

        <div class="dob inputs-dg">
            <label for="dob"><i class="fa-solid fa-calendar-days"></i>Enter Your Date of Birth: </Address></label>
            <input type="date" name="dob" id="dob" placeholder="select Date" required>
        </div>

        <div class="language inputs-dg">
            <label for="language"><i class="fa-solid fa-language"></i>Languages You Know: </Address></label>
            <input type="text" name="language" id="language" placeholder="English, Bengali, Hindi .." required>
        </div>

        <div class="linkedin inputs-dg">
            <label for="linkedin"><i class="fa-brands fa-linkedin"></i>Paste Your Linkedin URL: </Address></label>
            <input type="url" name="linkedin" id="linkedin" placeholder="paste link here" required>
        </div>

        <div class="hobbies inputs-dg">
            <label for="hobbies"><i class="fa-solid fa-laptop-code"><i class="fa-solid fa-futbol"></i></i>Your Hobbies : </Address></label>
            <input type="text" name="hobbies" id="hobbies" placeholder="playing cricket, meditation..." required>
        </div>

        <div class="objective inputs-dg">
            <label for="hobbies"><i class="fa-solid fa-bullseye"></i>Objective: </Address></label>
            <textarea name="objective" id="objective" placeholder="enter objective here" required></textarea>
        </div>

          <!-- Experience Section -->
        <h2>Experience</h2>
        <div id="experience-section">
            <!-- Experience items will be added here dynamically -->
        </div>
        <button  class="add-btn" type="button" onclick="addExperience()"><i class="fa-solid fa-plus"></i>Add New Experience</button>




         <!-- Education Section -->
         <h2>Education</h2>
        <div id="education-section">
            <!-- Education items will be added here dynamically -->
        </div>
        <button class="add-btn" type="button" onclick="addEducation()"><i class="fa-solid fa-plus"></i>Add New Education</button>


        <!-- Skills Section -->
        <h2>Skills</h2>
        <div id="skills-section">
            <!-- Skill items will be added here dynamically -->
        </div>
        <button class="add-btn" type="button" onclick="addSkill()"><i class="fa-solid fa-plus"></i>Add New Skill</button>

        
        <input id="submit-btn" type="submit" value="✨Launch Your Resume 🚀" name="submit" id="submit">
                
    </form>
<script>
            function addExperience() {
                // Create a new div to hold the experience item
                const experienceDiv = document.createElement('div');
                experienceDiv.classList.add('experience-item');

                // Add the fields for position, company, description, started, ended
                experienceDiv.innerHTML = `
                <div class="second">
                    <label for="position"><i class="fa-solid fa-briefcase"></i>Position:</label>
                    <input type="text" name="position[]" placeholder="Enter position" required>

                    <label for="company"><i class="fa-solid fa-building"></i>Company:</label>
                    <input type="text" name="company[]" placeholder="Enter company name" required>

                    <label for="description">Description:</label>
                    <textarea name="description[]" placeholder="Describe your role" required></textarea>

                    <label for="started"><i class="fa-solid fa-calendar-day"></i>Started:</label>
                    <input type="date" name="started[]" required>

                    <label for="ended"><i class="fa-solid fa-calendar-check"></i>Ended:</label>
                    <input type="date" name="ended[]" required>

                    <button class="remove" type="button" onclick="removeExperience(this)"><i class="fa-solid fa-minus"></i>Remove Experience</button>

                </div>
                `;
                
                // Append the new experience item to the experience section
                document.getElementById('experience-section').appendChild(experienceDiv);
            }

            function removeExperience(button) {
                // Remove the parent div of the clicked remove button
                button.parentElement.remove();
            }




            // for education section

            function addEducation() {
                // Create a new div to hold the education item
                const educationDiv = document.createElement('div');
                educationDiv.classList.add('education-item');

                // Add the fields for institute, completed_on, course
                educationDiv.innerHTML = `
                 <div class="second">
                    <label for="institute"><i class="fa-solid fa-school-circle-check"></i>Institute:</label>
                    <input type="text" name="institute[]" placeholder="Enter institute name" required>

                    <label for="completed_on"><i class="fa-solid fa-calendar-check"></i>Completed On:</label>
                    <input type="date" name="completed_on[]" required>

                    <label for="course"><i class="fa-solid fa-book"></i>Course:</label>
                    <input type="text" name="course[]" placeholder="Enter course name" required>

                    <button class="remove" type="button" onclick="removeEducation(this)"><i class="fa-solid fa-minus"></i>Remove Education</button>
                </div>
                `;

                // Append the new education item to the education section
                document.getElementById('education-section').appendChild(educationDiv);
            }

            function removeEducation(button) {
                // Remove the parent div of the clicked remove button
                button.parentElement.remove();
            }


            //skills 
            function addSkill() {
                // Create a new div to hold the skill item
                const skillDiv = document.createElement('div');
                skillDiv.classList.add('skill-item');

                // Add the field for skill
                skillDiv.innerHTML = `
                 <div class="second">
                    <label for="skill"><i class="fa-solid fa-compass-drafting"></i>Skill:</label>
                    <input type="text" name="skill[]" placeholder="Enter skill" required>

                    <button class="remove" type="button" onclick="removeSkill(this)"><i class="fa-solid fa-minus"></i>Remove Skill</button>
                </div>
                `;

                // Append the new skill item to the skills section
                document.getElementById('skills-section').appendChild(skillDiv);
            }

            function removeSkill(button) {
                // Remove the parent div of the clicked remove button
                button.parentElement.remove();
            }
        </script>
   
</body>
</html>