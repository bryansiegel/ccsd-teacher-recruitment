<?php

$today = date("F j, Y");

function formatDate($date) {
    return date("F j, Y", strtotime($date));
}
