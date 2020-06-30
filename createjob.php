<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</script>
</head>
<body>
<?php
include 'Y2020_info.php';

$i = 0;
foreach( $raw_mcats as $mcat_name => $cats ) {
    foreach( $cats as $cat_name => $cat ) {
        $i++;
        echo
'<form method="POST" id="myform'.$i.'"
 action="https://www.starexec.org/starexec/secure/add/job"
 target="_blank">
    <input type="submit" value="'. $cat_name . '"><br>
    queue: <input type="number" name="queue" value=1>
    sid: <input type="number" name="sid" value='.$cat['spaceid'].'>
    desc: <input type="text" name="desc"><br>
    <select name="benchmarkingFramework">
        <option value="BENCHEXEC" selected="selected">BenchExec</option>
	    <option value="RUNSOLVER">runsolver</option>
    </select>
    <input type="hidden" name="preProcess" value="-1">
    <input type="hidden" name="seed" value=0>
    cpuTimeout: <input type="number" name="cpuTimeout" value=1200>
    wallclockTimeout: <input type="number" name="wallclockTimeout" value=300>
    maxMem: <input type="number" name="maxMem" value=128><br>
    pause: <input type="radio" name="pause" value="yes" id="pause_yes">
    <label for="pause_yes">yes</label>
    <input checked type="radio" name="pause" value="no" id="pause_no">
    <label for="pause_no">no</label>
    <input type="hidden" name="runChoice" value="choose">
    <select name="benchChoice">
        <option selected value="runAllBenchInHierarchy">runAllBenchInHierarchy</option>
        <option value="runAllBenchInSpace">runAllBenchInSpace</option>
    </select>
    <select name="traversal">
        <option value="depth">depth</option>
        <option value="robin">robin</option>
    </select><br>
    <input type="hidden" name="subscribe" value="no">
    <input type="hidden" name="suppressTimestamp" value="yes">
    <input type="number" name="postProcess" value='.
    ( $cat['certified'] ? '651' : '649' ) . '>
    Participants:
';
        foreach( $cat['parts'] as $partname => $configid ) {
            echo
'   '. $partname .': <input type="number" name="configs" value='. $configid . '>;
';
        }
        echo
'</form><br>
';
    }
}
?>
</body>
