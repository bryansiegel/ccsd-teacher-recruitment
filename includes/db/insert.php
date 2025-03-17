<?php
//sqlite3 db connection
$db = new SQLite3('teacherRecruitment.db');

// Create table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS teacherRecruitment (id INTEGER PRIMARY KEY, title TEXT UNIQUE, content TEXT UNIQUE, published TEXT, link TEXT UNIQUE)");

//prepare
$stmt = $db->prepare("INSERT OR IGNORE INTO teacherRecruitment (title, content, published, link) VALUES (:title, :content, :published, :link)");

//bind params
$stmt->bindParam(':title', $item->title, SQLITE3_TEXT);
$stmt->bindParam(':content', $item->content, SQLITE3_TEXT);
$stmt->bindParam(':published', $pubDate, SQLITE3_TEXT);
$stmt->bindParam(':link', $item->link['href'], SQLITE3_TEXT);

$result = $stmt->execute();

//                        if ($result) {
//                            echo "Data inserted successfully.";
//                        } else {
//                            echo "Error inserting data: " . $db->lastErrorMsg();
//                        }

//close db
$db->close();
?>