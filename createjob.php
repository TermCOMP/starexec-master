<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<style>
 label { display: inline-block; }
 input[type=number] { width: 8em; }
</style>
</head>
<body>
<?php
include 'definitions.php';
include $_GET['competition'].'/info.php';

$queue = 201402;// StarExec queue id
$default_postproc = 784;// postprocessor id
$cpu_timeout = 1200;
$timeout = 300;
$max_memory = 128;

$i = 0;

foreach( make_categories($categories,$closed) as $mcat_name => $cats ) {
echo
'<h2>'.$mcat_name.'</h2>
';
	foreach( $cats as $cat_name => $cat ) {
		foreach(
			[	['name' => $cat_name, 'postproc' => $cat['postproc'], 'participants' => $cat['participants'] ],
				['name' => $cat_name.' Certified', 'postproc' => $cat['certified']['postproc'], 'participants' => $cat['certified']['participants'] ]
			] as $job ) {
            if( empty($job['postproc']) ) {
                $job['postproc'] = $default_postproc;
            }
			if( $job['participants'] != [] ) {
    			$i++;
    			echo
'<form method="POST" id="myform'.$i.'"
 action="https://www.starexec.org/starexec/secure/add/job"
 target="_blank">
    <input type="submit" value="Create Job">
    <input type="text" name="name" value="'. $job['name'] . '" style="width:30em;">
    <label>desc: <input type="text" name="desc"></label>
    <br>
    <label>queue: <input type="number" name="queue" value='.$queue.'></label>
    <label>sid: <input type="number" name="sid" value='.$cat['spaceid'].'></label>
    <select name="benchmarkingFramework">
        <option value="BENCHEXEC" selected="selected">BenchExec</option>
	    <option value="RUNSOLVER">runsolver</option>
    </select>
    <label>pause: <input checked type="radio" name="pause" value="yes">yes</label>
    <label><input type="radio" name="pause" value="no" id="pause_no">no</label>
    <br>
    <input type="hidden" name="preProcess" value="-1">
    <input type="hidden" name="seed" value="0">
    <label>cpuTimeout: <input type="number" name="cpuTimeout" value="'.$cpu_timeout.'"></label>
    <label>wallclockTimeout: <input type="number" name="wallclockTimeout" value="'.$timeout.'"></label>
    <label>maxMem: <input type="number" name="maxMem" value="'.$max_memory.'"></label>
    <input type="hidden" name="runChoice" value="choose">
    <select name="benchChoice">
        <option selected value="runAllBenchInHierarchy">runAllBenchInHierarchy</option>
        <option value="runAllBenchInSpace">runAllBenchInSpace</option>
    </select>
    <select name="traversal">
        <option value="depth">depth</option>
        <option value="robin">robin</option>
    </select>
    <input type="hidden" name="subscribe" value="no">
    <input type="hidden" name="suppressTimestamp" value="yes">
    <input type="hidden" name="resultsInterval" value="0">
    <input type="hidden" name="saveOtherOutput" value="false">
    <input type="hidden" name="killDelay" value="0">
    <input type="hidden" name="softTimeLimit" value="0">
    <label>postProcess: <input type="number" name="postProcess" value='. $job['postproc'] . '></label>
    <br>
';
				foreach( $job['participants'] as $partname => $configid ) {
					echo
'   <label>'. $partname .':
     <input type="number" name="configs" value='. $configid . '>
    </label>
';
				}
				echo
'</form><br>
';
			}
		}
	}
}
?>
</body>
