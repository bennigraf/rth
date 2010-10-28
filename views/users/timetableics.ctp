BEGIN:VCALENDAR
PRODID:-//rth//RockTheHochschule//DE
VERSION:2.0
BEGIN:VTIMEZONE
TZID:Europe/Berlin
X-LIC-LOCATION:Europe/Berlin
BEGIN:DAYLIGHT
TZOFFSETFROM:+0100
TZOFFSETTO:+0200
TZNAME:CEST
DTSTART:19700329T020000
RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=-1SU;BYMONTH=3
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:+0200
TZOFFSETTO:+0100
TZNAME:CET
DTSTART:19701025T030000
RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=-1SU;BYMONTH=10
END:STANDARD
END:VTIMEZONE
<?php 

foreach ($courses as $course) {
	echo "BEGIN:VEVENT\n";
	echo "DTSTART;TZID=Europe/Berlin:".date('Ymd\THis', strtotime($course['Course']['date']))."\n";
	echo "DURATION:PT".$course['Course']['duration']."M\n";
	echo "SUMMARY:".$course['Course']['name']."\n";
	echo "UID:HFM-WS2010-USER".$course['user_id']."-COURSE".$course['course_id']."@RTH\n";
	echo "RRULE:FREQ=WEEKLY;UNTIL=20110212\n";
	echo "EXDATE;TZID=Europe/Berlin:";
	$first = true;
	foreach ($exdates as $date) {
		if (!$first) { echo ","; } else { $first = false; }
		echo $date."T".date('His', strtotime($course['Course']['date']));
	}
	echo "\n";
	echo "END:VEVENT\n\n";
}


Configure::write ('debug', 0);


debug($courses);



/*
foreach($therapist['Date'] as $date) {
echo "BEGIN:VEVENT\n";
// echo "DTSTART:".date('Ymd\THis\Z', strtotime($date['date']))."\n";
echo "DTSTART;TZID=Europe/Berlin:".date('Ymd\THis', strtotime($date['date']))."\n";
echo "DURATION:PT".$date['Treatment']['duration-all']."M\n";
echo "SUMMARY:".iconv("iso-8859-1", "UTF-8", $date['Client']['fname'].' '.$date['Client']['lname'].': '.$date['Treatment']['short'])."\n";
echo "UID:".$date['uid']."\n";
if(!empty($date['Room'])) {
echo "LOCATION:".iconv("iso-8859-1", "UTF-8", $date['Room']['house'].'/'.$date['Room']['short'].': '.$date['Room']['title'])."\n";
}
echo "END:VEVENT\n";
}*/


?>
END:VCALENDAR