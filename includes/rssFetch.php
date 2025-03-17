<?php

$rss_url = "https://www.google.com/alerts/feeds/09799090004667660386/14564746603821698168"; // Replace with your RSS feed URL

// Load the RSS feed
$rss = simplexml_load_file($rss_url);

if ($rss === false) {
    die("Error loading RSS feed.");
}
//var_dump($rss->entry->link);
?>