<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resume_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM resumes WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Edit Resume</title>
        </head>
        <body>
            <h2>Edit Resume</h2>
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>
                <label for="address">Address:</label><br>
                <textarea id="address" name="address" required><?php echo $row['address']; ?></textarea><br>
                <label for="phone">Phone:</label><br>
                <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
                <label for="linkedin">LinkedIn:</label><br>
                <input type="url" id="linkedin" name="linkedin" value="<?php echo $row['linkedin']; ?>" required><br>
                <label for="github">GitHub:</label><br>
                <input type="url" id="github" name="github" value="<?php echo $row['github']; ?>" required><br>
                <label for="objective">Objective:</label><br>
                <textarea id="objective" name="objective" required><?php echo $row['objective']; ?></textarea><br>
                <label for="institute_name1">Institute Name:</label><br>
                <input type="text" id="institute_name1" name="institute_name1" value="<?php echo $row['institute_name1']; ?>" required><br>
                <label for="average_gpa1">Average GPA / Percentage:</label><br>
                <input type="text" id="average_gpa1" name="average_gpa1" value="<?php echo $row['average_gpa1']; ?>" required><br>
                <label for="university_name">University Name:</label><br>
                <input type="text" id="university_name" name="university_name" value="<?php echo $row['university_name']; ?>" required><br>
                <label for="institute_name2">Institute Name (if any):</label><br>
                <input type="text" id="institute_name2" name="institute_name2" value="<?php echo $row['institute_name2']; ?>"><br>
                <label for="skills_abilities">Skills & Abilities:</label><br>
                <textarea id="skills_abilities" name="skills_abilities" required><?php echo $row['skills_abilities']; ?></textarea><br>
                <label for="projects">Projects:</label><br>
                <textarea id="projects" name="projects" required><?php echo $row['projects']; ?></textarea><br>
                <label for="extracurricular">Extracurricular Activities:</label><br>
                <textarea id="extracurricular" name="extracurricular" required><?php echo $row['extracurricular']; ?></textarea><br>
                <label for="training">Training:</label><br>
                <textarea id="training" name="training" required><?php echo $row['training']; ?></textarea><br>
                <label for="hobbies_interests">Hobbies & Interests:</label><br>
                <textarea id="hobbies_interests" name="hobbies_interests" required><?php echo $row['hobbies_interests']; ?></textarea><br>
                <label for="place">Place:</label><br>
                <input type="text" id="place" name="place" value="<?php echo $row['place']; ?>" required><br>
                <input type="submit" value="Update">
            </form>
        </body>
        </html>

        <?php
    } else {
        echo "No resume found!";
    }

    $conn->close();
} else {
    echo "No ID provided!";
}
?>
