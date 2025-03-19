<?php
if (isset($_POST['id']) && isset($_POST['active'])) {
    $id = $_POST['id'];
    $active = $_POST['active'];

    // SQLite3 db connection
    $db = new SQLite3('teacherRecruitment.db');

    // Update the active column
    $stmt = $db->prepare("UPDATE teacherRecruitment SET active = :active WHERE id = :id");
    $stmt->bindParam(':active', $active, SQLITE3_INTEGER);
    $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    // Close the database connection
    $db->close();
}
//header("Location: index.php"); // Redirect back to the index page
?>

