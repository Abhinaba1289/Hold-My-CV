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
            <title>Resume Display</title>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
            <script>
                function downloadResume() {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    const name = "<?php echo $row['name']; ?>";
                    const address = "<?php echo $row['address']; ?>";
                    const phone = "<?php echo $row['phone']; ?>";
                    const email = "<?php echo $row['email']; ?>";
                    const linkedin = "<?php echo $row['linkedin']; ?>";
                    const github = "<?php echo $row['github']; ?>";
                    const objective = "<?php echo nl2br($row['objective']); ?>";
                    const institute_name1 = "<?php echo $row['institute_name1']; ?>";
                    const average_gpa1 = "<?php echo $row['average_gpa1']; ?>";
                    const university_name = "<?php echo $row['university_name']; ?>";
                    const institute_name2 = "<?php echo $row['institute_name2']; ?>";
                    const skills_abilities = "<?php echo nl2br($row['skills_abilities']); ?>";
                    const projects = "<?php echo nl2br($row['projects']); ?>";
                    const extracurricular = "<?php echo nl2br($row['extracurricular']); ?>";
                    const training = "<?php echo nl2br($row['training']); ?>";
                    const hobbies_interests = "<?php echo nl2br($row['hobbies_interests']); ?>";
                    const place = "<?php echo $row['place']; ?>";

                    doc.text(`Name: ${name}`, 10, 10);
                    doc.text(`Address: ${address}`, 10, 20);
                    doc.text(`Phone: ${phone}`, 10, 30);
                    doc.text(`Email: ${email}`, 10, 40);
                    doc.text(`LinkedIn: ${linkedin}`, 10, 50);
                    doc.text(`GitHub: ${github}`, 10, 60);
                    doc.text(`Objective: ${objective}`, 10, 70);
                    doc.text(`Institute Name: ${institute_name1}`, 10, 80);
                    doc.text(`Average GPA / Percentage: ${average_gpa1}`, 10, 90);
                    doc.text(`University Name: ${university_name}`, 10, 100);
                    doc.text(`Institute Name (if any): ${institute_name2}`, 10, 110);
                    doc.text(`Skills & Abilities: ${skills_abilities}`, 10, 120);
                    doc.text(`Projects: ${projects}`, 10, 130);
                    doc.text(`Extracurricular Activities: ${extracurricular}`, 10, 140);
                    doc.text(`Training: ${training}`, 10, 150);
                    doc.text(`Hobbies & Interests: ${hobbies_interests}`, 10, 160);
                    doc.text(`Place: ${place}`, 10, 170);

                    doc.save("resume.pdf");
                }
            </script>
        </head>
        <body>
            <h2>Resume Details</h2>
            <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
            <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
            <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>LinkedIn:</strong> <?php echo $row['linkedin']; ?></p>
            <p><strong>GitHub:</strong> <?php echo $row['github']; ?></p>
            <p><strong>Objective:</strong> <?php echo nl2br($row['objective']); ?></p>
            <p><strong>Institute Name:</strong> <?php echo $row['institute_name1']; ?></p>
            <p><strong>Average GPA / Percentage:</strong> <?php echo $row['average_gpa1']; ?></p>
            <p><strong>University Name:</strong> <?php echo $row['university_name']; ?></p>
            <p><strong>Institute Name (if any):</strong> <?php echo $row['institute_name2']; ?></p>
            <p><strong>Skills & Abilities:</strong> <?php echo nl2br($row['skills_abilities']); ?></p>
            <p><strong>Projects:</strong> <?php echo nl2br($row['projects']); ?></p>
            <p><strong>Extracurricular Activities:</strong> <?php echo nl2br($row['extracurricular']); ?></p>
            <p><strong>Training:</strong> <?php echo nl2br($row['training']); ?></p>
            <p><strong>Hobbies & Interests:</strong> <?php echo nl2br($row['hobbies_interests']); ?></p>
            <p><strong>Place:</strong> <?php echo $row['place']; ?></p>

            <button onclick="downloadResume()">Download Resume</button>
            <form method="get" action="edit.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" value="Edit Resume">
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
