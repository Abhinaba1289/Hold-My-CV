<?php
// Include database connection file
include './assets/includes/conndb.php'; // Adjust this to your actual connection file

if (isset($_GET['id'])) {
    $resume_id = $_GET['id'];

    // Begin transaction to ensure all deletions are completed successfully
    $db->begin_transaction();

    try {
        // Delete from the experience table
        $stmt = $db->prepare("DELETE FROM experience WHERE resume_id = ?");
        $stmt->bind_param("i", $resume_id);
        $stmt->execute();

        // Delete from the skills table
        $stmt = $db->prepare("DELETE FROM skills WHERE resume_id = ?");
        $stmt->bind_param("i", $resume_id);
        $stmt->execute();

        // Delete from the educations table
        $stmt = $db->prepare("DELETE FROM educations WHERE resume_id = ?");
        $stmt->bind_param("i", $resume_id);
        $stmt->execute();

        // Delete from the resumedata table
        $stmt = $db->prepare("DELETE FROM resumedata WHERE id = ?");
        $stmt->bind_param("i", $resume_id);
        $stmt->execute();

        // Commit the transaction
        $db->commit();

        // Redirect back to the dashboard or wherever you want after deletion
        header("Location: myresumes.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        $db->rollback();
        echo "Error deleting record: " . $db->error;
    }
}
?>
