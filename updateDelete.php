<?php
// TODO: GET DELETE TO WORK
// SQLite3 db connection
$db = new SQLite3('teacherRecruitment.db');

// Get the ID and active status from the POST request
$id = $_POST['id'];
$active = $_POST['active'];

// If active is 0, delete the record
//if ($active == 0) {
    $stmt = $db->prepare('DELETE FROM teacherRecruitment WHERE id = :id');
    $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
//}

// Close the database connection
$db->close();
?>