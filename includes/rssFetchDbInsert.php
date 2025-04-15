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
    "https://www.google.com/alerts/feeds/09799090004667660386/13008520046193247680",
//    //education budget cuts
//    "https://www.google.com/alerts/feeds/09799090004667660386/3563118591475766579",
////school budget reduction
//    "https://www.google.com/alerts/feeds/09799090004667660386/667292593083508889",
////school funding shortfall
//    "https://www.google.com/alerts/feeds/09799090004667660386/12827376748378450272",
////education spending cuts
//    "https://www.google.com/alerts/feeds/09799090004667660386/8483989928501345192",
////reduced school funding
//    "https://www.google.com/alerts/feeds/09799090004667660386/667292593083506964",
////district financial crisis
//    "https://www.google.com/alerts/feeds/09799090004667660386/17472140243419811017",
////educator job cuts
//    "https://www.google.com/alerts/feeds/09799090004667660386/14275391908255443936",
//teacher position elimination
    "https://www.google.com/alerts/feeds/09799090004667660386/18101976017755315948",
//staff reduction in schools
    "https://www.google.com/alerts/feeds/09799090004667660386/52475976895069303",
//teacher workforce reduction
    "https://www.google.com/alerts/feeds/09799090004667660386/4599127304381303137",
//school personnel cuts
    "https://www.google.com/alerts/feeds/09799090004667660386/14687510447934336140",
//RIF teachers (Reduction in Force)
    "https://www.google.com/alerts/feeds/09799090004667660386/3220166897023135260",
////school district insolvency
//    "https://www.google.com/alerts/feeds/09799090004667660386/8496594285191549789",
////education funding emergency
//    "https://www.google.com/alerts/feeds/09799090004667660386/14687510447934335795",
////teacher furloughs
//    "https://www.google.com/alerts/feeds/09799090004667660386/3220166897023132720",
////school district bankruptcy
//    "https://www.google.com/alerts/feeds/09799090004667660386/18171685739672536217",
////education funding shortfall
//    "https://www.google.com/alerts/feeds/09799090004667660386/9457918898031762839",
////school financial restructuring
//    "https://www.google.com/alerts/feeds/09799090004667660386/10678312929522295402",
////state education budget cut
//    "https://www.google.com/alerts/feeds/09799090004667660386/18171685739672537481",
////federal education funding reduction
//    "https://www.google.com/alerts/feeds/09799090004667660386/5653421890419547668",
////school district consolidation
//    "https://www.google.com/alerts/feeds/09799090004667660386/14076469690962786057",
////education austerity measures
//    "https://www.google.com/alerts/feeds/09799090004667660386/14801085248135230335",
////school funding legislation
//    "https://www.google.com/alerts/feeds/09799090004667660386/8496775767134612104",
////education appropriations decrease
//    "https://www.google.com/alerts/feeds/09799090004667660386/14076469690962787338",
////Arizona teacher budget cuts
//    "https://www.google.com/alerts/feeds/09799090004667660386/12036828199553710379",
////Florida school district teacher layoffs
//    "https://www.google.com/alerts/feeds/09799090004667660386/8496775767134609783",
////New York education budget shortfall
//    "https://www.google.com/alerts/feeds/09799090004667660386/11050110222045785412",
////Washington state school funding
//    "https://www.google.com/alerts/feeds/09799090004667660386/8496775767134609978",
////educator job fair
//    "https://www.google.com/alerts/feeds/09799090004667660386/14212606872241344174",
////Teacher recruitment day
//    "https://www.google.com/alerts/feeds/09799090004667660386/6742652657741204809",
////frozen education funding
//    "https://www.google.com/alerts/feeds/09799090004667660386/14375973769527215270",
////teachers union strikes
//    "https://www.google.com/alerts/feeds/09799090004667660386/7128218369862356439",
////teachers union demand higher pay
//    "https://www.google.com/alerts/feeds/09799090004667660386/10154177009299758524",
////teachers pay strike
//    "https://www.google.com/alerts/feeds/09799090004667660386/14375973769527214894",
////teachers union
//    "https://www.google.com/alerts/feeds/09799090004667660386/7128218369862353482"
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