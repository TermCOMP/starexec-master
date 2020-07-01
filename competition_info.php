<?php

include 'Y2020_info.php';

// Making certified and demonstration categories
$demos = [];
$mcats = [];
foreach( $raw_mcats as $mcat_name => $raw_cats ) {
	$cats = [];
	foreach( $raw_cats as $cat_name => $cat ) {
		$certinfo = $cat['certified'];
		unset( $cat['certified'] );
		$certcat = $cat;
		$certcat['parts'] = array_key_exists('parts',$certinfo) ? $certinfo['parts'] : [];
		$certcat['jobid'] = array_key_exists('jobid',$certinfo) ? $certinfo['jobid'] : 0;
		$certcat['certified'] = true;
		$cats[$cat_name] = $cat;
		$cats[$cat_name . ' Certified'] = $certcat;
	}
	foreach( $cats as $cat_name => $cat ) {
		switch( count($cat['parts']) ) {
		case 0:
			if( !$cat['jobid'] > 0 ) {
				unset($cats[$cat_name]);// remove unparticipated category
			}
			break;
		case 1:
			$demos[$cat_name] = $cat;
			unset($cats[$cat_name]);
			break;
		}
	}
	$mcats[$mcat_name] = $cats;
}
$mcats['Demonstrations'] = $demos;
?>