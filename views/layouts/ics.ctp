<?php 
// header("Content-Type: text/html");
header("Content-Type: text/Calendar");
header("Content-Disposition: inline; filename=calendar.ics");
echo $content_for_layout; 
?>