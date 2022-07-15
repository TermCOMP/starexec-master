<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
 <meta http-equiv="Pragma" content="no-cache">
 <meta http-equiv="Expires" content="0">
<?php
include 'definitions.php';

if( !array_key_exists('competition',$_GET) ) {
	echo 'No competition to present.'.PHP_EOL;
	exit(-1);
}

$competition = $_GET['competition'];

if( preg_match('/\\.\\.?|.*[\\/:].*/',$competition) ) {
	echo "Bad competition name.".PHP_EOL;
	exit(-1);
}
if( array_key_exists('root',$_GET) ) {
	$root_html = $_GET['root'].'/';
	$path_html = '';
} else {
	$path_html = $competition.'/';
	$root_html = '';
}

echo ' <link rel="stylesheet" type="text/css" href="'.$root_html.'master.css">'.PHP_EOL;

echo ' <script src="'.$root_html.'definitions.js"></script>'.PHP_EOL;

include $competition.'/info.php';
$mcats = make_categories($categories,$closed);

$refresh = array_key_exists( 'refresh', $_GET );
$finalize = array_key_exists( 'finalize', $_GET );
$team_ranking = array_key_exists( 'team-ranking', $_GET );

?>
 <title><?php echo $title; ?></title>
</head>
<body>
 <h1><?php echo $title; ?>
 <span class="headerFollower">
  <?php echo $note.PHP_EOL; ?>
  <span id=configToggler class=button></span>
  <span id=scoreToggler class=button></span>
  <span id=columnToggler class=button></span>
 </span>
</h1>
<script>
var configToggler = StyleToggler(
	document.getElementById("configToggler"), ".config", [
		{ text: "Show configs", assign: { display: "none" } },
		{ text: "Hide configs", assign: { display: "" } },
	],
	<?php echo $showconfig ? '1' : '0'; ?>
);
var scoreToggler = StyleToggler(
	document.getElementById("scoreToggler"), ".score", [
		{ text: "Show scores", assign: { display: "none" } },
		{ text: "Hide scores", assign: { display: "" } },
	],
	<?php echo $showscore ? '1' : '0'; ?>
);
var columnToggler = StyleToggler(
	document.getElementById("columnToggler"), "span.category", [
		{ text: "One column", assign: { display: "inline" } },
		{ text: "Many column", assign: { display: "block" } },
	]
);
<?php
if( $team_ranking ) {
	// team scoring
	echo 'var teamCategoryScores = [';
	foreach($teams as $team) { echo '[],'; }
	echo '];'.PHP_EOL;
	echo 'var teamScores = [';
	foreach($teams as $team) { echo '0,'; }
	echo '];'.PHP_EOL;
	echo 'const solver_id2team_id = {'.PHP_EOL;
	$team_id = 0;
	foreach( $teams as $team => $solvers ) {
		foreach( $mcats as $mcat => $cats ) {
			foreach( $cats as $cat => $info ) {
				foreach( $solvers as $solver ) {
					if( array_key_exists($solver,$info['participants']) ) {
						echo '	"'.$info['participants'][$solver].'": "'.$team_id.'",'.PHP_EOL;
					}
					if( array_key_exists($solver,$info['certified']['participants']) ) {
						echo '	"'.$info['certified']['participants'][$solver].'": "'.$team_id.'",'.PHP_EOL;
					}
				}
			}
		}
		$team_id++;
	}
	echo '};'.PHP_EOL;

	echo 'const score_exponent = 2;// Ln norm. 2 means Euclidean

function updateScores(catname,participants) {
	// first clear scores for the teams of this category
	for( let solver_id in participants ) {
		teamCategoryScores[solver_id2team_id[solver_id]][catname] = 0;
	}
	// then add up scores of the team, in case it participates in certified category. We don\'t support two tools from one team in the same category!
	for( let solver_id in participants ) {
		let score = participants[solver_id].normalized;
		teamCategoryScores[solver_id2team_id[solver_id]][catname] += Math.pow(score,score_exponent);
	}
	// updating the team scores
	for( let i in teamScores ) {
		let score_sum = Object.values(teamCategoryScores[i]).reduce((x,y) => { return x + y; }, 0);
		teamScores[i] = Math.pow(score_sum,1/score_exponent).toFixed(4);
	}
	// sorting the team ranking. For smooth display, do not apply sorting directly on the dom objects.
	let ranking = Object.keys(teamScores).sort( (i,j) => { return teamScores[j] - teamScores[i];} );
	// refreshing the display. For smooth display, do not move elements if they don\'t have to.
	let div = document.getElementById("team_ranking");
	var cur = div.firstElementChild;
	for( var i = 0; i < ranking.length; i++ ) {
		let span = document.getElementById("team"+ranking[i]);
		let score = teamScores[ranking[i]];
		let elt = span.querySelector(".score");
		if( elt.innerHTML != score ) {// don\'t touch unless necessary
			elt.innerHTML = score;
		}
		if( span == cur ) {
			cur = cur.nextSibling;
		} else {
			div.insertBefore(span,cur);
		}
	}
}
</script>
';
	echo ' <div id="team_ranking">Team Ranking:'.PHP_EOL;
	// creating team ranking
	$team_id = 0;
	foreach( $teams as $team => $solvers ) {
		echo '  <span id="team'.$team_id.'">'.$team.'<span class="score"></span></span>'.PHP_EOL;
		$team_id++;
	}
	echo ' </div>'.PHP_EOL;
} else {
	echo '</script>'.PHP_EOL;
}
if( !$closed ) {
	echo 'Registration is open! Please register following the README of <a href="https://github.com/TermCOMP/starexec-master">this repository</a>';
}

$mcatid = 0;
$catid = 0;
foreach( $mcats as $mcatname => $cats ) {
	$total_done = 0;
	$total_togo = 0;
	$total_cpu = 0;
	$total_time = 0;
	echo '<h2>'.$mcatname.' <span id=stat'.$mcatid.' class=stats></span></h2>'.PHP_EOL;
	$table = [];
	$tools = [];
	// creating progress summary
	echo ' <script>'.PHP_EOL.
	     '  function summer(a,b){'.PHP_EOL.
	     '   return {done: a.done + b.done, cpu: a.cpu + b.cpu, time: a.time + b.time, togo: a.togo + b.togo};'.PHP_EOL.
	     '  }'.PHP_EOL.
	     '  var progress'.$mcatid.' = [];'.PHP_EOL.
	     '  function updateProgress'.$mcatid.'() {'.PHP_EOL.
	     '   var sum = progress'.$mcatid.'.reduce(summer);'.PHP_EOL.
	     '   document.getElementById("stat'.$mcatid.'").innerHTML ='.PHP_EOL.
	     '    "Progress: " + Math.floor(1000 * sum.done / (sum.done + sum.togo))/10 +'.PHP_EOL.
	     '    "%, CPU Time: " + seconds2str(sum.cpu) + ", Node Time: "+ seconds2str(sum.time);'.PHP_EOL.
	     '  }'.PHP_EOL.
	     '</script>'.PHP_EOL;
	$catindex = 0;
	foreach( $cats as $catname => $cat ) {
		$type = $cat['type'];
		$id = $cat['id'];
		$spaceid = array_key_exists('spaceid',$cat) ? $cat['spaceid'] : null;
		$jobids = explode('_',$id);
		$jobid = $jobids[0];
		$overlay = array_key_exists( 1, $jobids ) ? $jobids[1] : false;
		if( $id == null ) {// This means the job is not yet started or linked to starexec-master.
			echo ' <div class=category>';
			if( $spaceid != null ) {
				echo '<a href="'.spaceid2url($spaceid).'">'.$catname.'</a>'.PHP_EOL;
			} else {
				echo $catname.PHP_EOL;
			}
			echo '  <div class=ranking>'.PHP_EOL;
			foreach( $cat['certified']['participants'] as $partname => $configid ) {
				echo '   <div class="CERTIFIED participant">'.PHP_EOL.
				     '   '.$partname.'<a class=starexecid href="'. configid2url($configid) .'">'. $configid .'</a></div>'.PHP_EOL;
			}
			foreach( $cat['participants'] as $partname => $configid ) {
				echo '   <div class="participant">'. $partname.
				     '<a class=starexecid href="'. configid2url($configid) .'">'. $configid .'</a></div>'.PHP_EOL;
			}
			echo '  </div>'.PHP_EOL.
			     ' </div>';
			continue;
		}
		// creating job html
		$job_file = jobname2local($catname);
		$graph_file = jobname2graph($catname);
		$jobargs = [
			'id' => $id,
			'name' => $catname,
			'mcatname' => $mcatname,
			'type' => $type,
			'competition' => $competition,
			'competitionname' => $shortname,
			'db' => $db,
			'dir' => $cat['dir'],
			'refresh' => $refresh,
		];
		if( isset($previous) ) {
			if( array_key_exists('previous',$cat) ) {
				if( $cat['previous'] != null ) {
					$jobargs['previous-category'] = $cat['previous'];
					$jobargs['previous-competition'] = $previous;
				}
			} else {
				$jobargs['previous-competition'] = $previous;
			}
		}
		$query = http_build_query( $jobargs, '', ' ' );
		$tmp = tempnam('','');
		system( 'php-cgi -f "job.php" '. $query .' > "'. $tmp . '"');
		rename($tmp,$competition.'/'.$job_file);
		$tmp = tempnam('','');
		system( 'php-cgi -f "graph.php" '. $query .' > "'. $tmp . '"');
		rename($tmp,$competition.'/'.$graph_file);
		echo ' <span id="'.$id.'" class=category></span>'.PHP_EOL.
		     ' <script>'.PHP_EOL.
		     '  function load'.$id.'() {'.PHP_EOL.
		     '   var elm = document.getElementById("'.$id.'");'.PHP_EOL.
		     '   loadURL("'.$path_html.$graph_file.'", function(xhttp) {'.PHP_EOL.
		     '    elm.innerHTML = xhttp.responseText;'.PHP_EOL.
		     '    scoreToggler.apply(elm);'.PHP_EOL.
		     '    configToggler.apply(elm);'.PHP_EOL.
		     '   });'.PHP_EOL.
		     '   loadURL("'.$path_html.jobname2sumfile($catname).'", function(xhttp) {'.PHP_EOL.
		     '    var data = JSON.parse(xhttp.responseText);'.PHP_EOL.
		     '    progress'.$mcatid.'['.$catindex.'] = data["layers"].reduce(summer);'.PHP_EOL.
		     '    updateProgress'.$mcatid.'();'.PHP_EOL;
		if( $mcatname != 'Demonstrations' ) {
			echo '    updateScores("'.$catname.'",data["participants"]);'.PHP_EOL;
		}
		echo '   });'.PHP_EOL.
		     '  }'.PHP_EOL.
		     '  load'.$id.'();'.PHP_EOL.
		     '  setInterval(load'.$id.', 10000);'.PHP_EOL.
		     ' </script>'.PHP_EOL;
		$catindex++;
		$catid++;
	}
	$mcatid++;
}

?>

</body>
</html>
