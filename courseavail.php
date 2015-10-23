<?php
//Interface provided by Professor Atkinson


//term broken down to year = 37 and quarter = 00
//each year goes up by 2 i.e. 2015 = 37, 2016 = 39, etc.
//each quarter goes up by 20 i.e. fall = 00, 
//winter = 20, spring = 40, summer = 60
//admins are aware of this, so a simple config file should suffice
$term = 3700;
$wsdl = 'http://cms01.scu.edu/docs/ws/catalog/project.cfc?wsdl';
$client = new SoapClient($wsdl);

$args = array();
$results = $client->__soapCall('qSchools', $args);
$schools = $results->data;

//foreach ($schools as $school) {
    $schoolid = 'EGR'; //$school[0]; //EGR is the schoolid for the School of Engineering
    echo "$schoolid -> ";

    $args = array('schoolid' => $schoolid);
    $results = $client->__soapCall('qSubjects', $args);
    $subjects = $results->data;

    foreach($subjects as $subject) {
		$subjectid = $subject[0]; //qSubjects contains the different subjects in EGR i.e. COEN, ELEN, MECH, etc.

		echo "	$subjectid\n";
		$args = array('subjectid' => $subjectid, 'term' => $term);
		$results = $client->__soapCall('qCourses', $args);
		$courses = $results->data;

		foreach ($courses as $course) {
			if($course[2] == "Graduate Engineering") { continue; } //filters out graduate courses

		    print_r($course); //recursively prints array of course information
		    $courseid = $course[5]; //index 5 contains the course ID number unique to that particular course topic within the department  
		    //echo "$courseid\n";

		    //this retrieves information for sections offered during the particular term
		    // $args = array('courseid' => $courseid, 'term' => $term);
		    // $results = $client->__soapCall('qCourse', $args);
		    // print_r($results);
		}
		echo "\n";
    }
    echo "\n";
//}
?>
