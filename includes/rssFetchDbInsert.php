<?php

// SQLite3 db connection
$db = new SQLite3('teacherRecruitment.db');

$redirect_url = 'http://localhost/ccsd-teacher-recruitment/';

// Create table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS teacherRecruitment (
    id INTEGER PRIMARY KEY,
    title TEXT,
    content TEXT,
    published TEXT,
    link TEXT,
    active BOOLEAN DEFAULT 1,
    saved BOOLEAN DEFAULT 0,
    UNIQUE(title, content, link)
)");

$rss_feeds = [
    //teacher layoffs
    "https://www.google.com/alerts/feeds/09799090004667660386/14564746603821698168",
    //teacher reduction in force
    "https://www.google.com/alerts/feeds/09799090004667660386/16541197399518915531",
    //teacher layoffs california
    "https://www.google.com/alerts/feeds/09799090004667660386/15986459700403287516",
    //low teacher pay
    "https://www.google.com/alerts/feeds/09799090004667660386/7381414631943293210",
    //boston teacher layoffs
    "https://www.google.com/alerts/feeds/09799090004667660386/13008520046193247680"
];

echo '<script>$("#loadingOverlay").show(); $("#loadingSpinner").show();</script>';

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

            // Prepare the insert statement to sqlite
            $stmt = $db->prepare("INSERT OR IGNORE INTO teacherRecruitment (title, content, published, link, active, saved) VALUES (:title, :content, :published, :link, 1,0)");

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

echo '<script>$("#loadingOverlay").hide(); $("#loadingSpinner").hide();</script>';