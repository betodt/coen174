<?php
$term = 3700;
$wsdl = 'http://cms01.scu.edu/docs/ws/catalog/project.cfc?wsdl';
$client = new SoapClient($wsdl);

$args = array();
$results = $client->__soapCall('qSchools', $args);
$schools = $results->data;

foreach ($schools as $school) {
    $schoolid = $school[0];
    echo "$schoolid\n";

    $args = array('schoolid' => $schoolid);
    $results = $client->__soapCall('qSubjects', $args);
    $subjects = $results->data;

    foreach($subjects as $subject) {
	$subjectid = $subject[0];

	echo "$subjectid\n";
	$args = array('subjectid' => $subjectid, 'term' => $term);
	$results = $client->__soapCall('qCourses', $args);
	$courses = $results->data;

	foreach ($courses as $course) {
	    print_r($course);
	    $courseid = $course[5];

	    $args = array('courseid' => $courseid, 'term' => $term);
	    $results = $client->__soapCall('qCourse', $args);
	    print_r($results);
	}
    }
}
?>
