<?php
if (isset($_POST['id']) && isset($_POST['saved'])) {
    $id = $_POST['id'];
    $saved = $_POST['saved'];

    // SQLite3 db connection
    $db = new SQLite3('teacherRecruitment.db');

    // Update the saved column
    $stmt = $db->prepare("UPDATE teacherRecruitment SET saved = :saved WHERE id = :id");
    $stmt->bindParam(':saved', $saved, SQLITE3_INTEGER);
    $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    // Close the database connection
    $db->close();
}
?>