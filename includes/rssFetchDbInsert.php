<?php
// SQLite3 db connection
$db = new SQLite3('teacherRecruitment.db');

// Create table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS teacherRecruitment (id INTEGER PRIMARY KEY, title TEXT UNIQUE, content TEXT UNIQUE, published TEXT, link TEXT UNIQUE)");

$rss_feeds = [
    "https://www.google.com/alerts/feeds/09799090004667660386/14564746603821698168",
    "https://www.google.com/alerts/feeds/09799090004667660386/16541197399518915531"
];

foreach ($rss_feeds as $rss_feed) {
    // Load the RSS feed
    $rss = simplexml_load_file($rss_feed);
    if ($rss === false) {
        die("Error loading RSS feed: " . htmlspecialchars($rss_feed));
    }

    // Iterate over each item in the RSS feed
    foreach ($rss->entry as $item) {
        if (!empty($item->published)) {
            $pubDate = date("F j, Y, g:i a", strtotime($item->published));

            // Prepare the insert statement
            $stmt = $db->prepare("INSERT OR IGNORE INTO teacherRecruitment (title, content, published, link) VALUES (:title, :content, :published, :link)");

            // Bind parameters
            $stmt->bindParam(':title', $item->title, SQLITE3_TEXT);
            $stmt->bindParam(':content', $item->content, SQLITE3_TEXT);
            $stmt->bindParam(':published', $pubDate, SQLITE3_TEXT);
            $stmt->bindParam(':link', $item->link['href'], SQLITE3_TEXT);

            // Execute the statement
            $stmt->execute();
        }
    }
}
?>
