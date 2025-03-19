<?php
// SQLite3 db connection
$db = new SQLite3('teacherRecruitment.db');

// Delete all records where active = 0
$db->exec("DELETE FROM teacherRecruitment WHERE active = 0");

// Close the database connection
$db->close();
?>