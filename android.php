<?php

$data = file_get_contents('http://m.devfest.mn/session');


$data = json_decode($data, true);

//print "<pre>";
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  

//var_dump($data);

$events = array();


foreach($data as $session) {
	$id = $session["ID"];
	$title = $session["SessionName"];
	$description = html_entity_decode (strip_tags(trim($session["SessionHTML"])));
	list($fName, $lName) = explode(" ", $session["Speaker"]);
	$location = $session["Room"];
	$time = strtotime('2015-03-21 ' . $session['StartHour'] . ":" . $session["StartMin"] . $session["AMPM"]);


	$events[] = array("event_id"=>$id,
		'title'=>$title,
		'location'=>$location,
		'description'=>$description,
		'speaker_first'=>$fName,
		'speaker_last'=>$lName,
		'speaker_bio'=>'',
		'time'=>$time);

}

$output["events"] = $events;
//var_dump($output);
print json_encode($output);
