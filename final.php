<?php
	$game = include('round-final.php');
	if ((count($game) != 4) ||
	    !isset($game['category'], $game['question'],
	           $game['answer'], $game['thanks'])) {
		error_log("Final JeoPHPardy questions file is invalid.  ".
		          "Must contain 'category', 'question', 'answer', ".
		          "and 'thanks' sections.", E_USER_WARNING);
	}
?><!doctype html>
<html>
<head>
	<title>HTTP Jeoparody</title>
	<style>
		html, body, table {margin: 0; padding: 0; background-color: #0000ff;}
		table {width: 100vw; height: 100vh; border: 0;}
		td, th {width: 100%; height: 100%; padding-top: 30vh; text-align: center; vertical-align: middle; background-color: #0000ff; color: #ffffee;}

		.category td {font-size: 20vh; text-shadow: black 3px 3px; font-family: "HelveticaNeue-CondensedBold";
					  position: absolute; top: 0; left: 0; z-index: 4;}
		.question td {font-size: 5vw; text-shadow: black 5px 5px; font-weight: bold; font-family: "Korinna";
					  position: absolute; top: 0; left: 0; z-index: 3;}
		.answer td {font-size: 5vw; text-shadow: black 5px 5px; font-weight: bold; font-family: "Korinna";
					position: absolute; top: 0; left: 0; z-index: 2;}
		.thanks td {font-size: 20vh; text-shadow: black 5px 5px; letter-spacing: 3pt; font-family: "Gyparody";
					position: absolute; top: 0; left: 0; z-index: 1;}
	</style>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script>
		$(document).ready(function() {
			$('table').click(function() {
				$(this).hide();
			});
		});
	</script>
	<body>
		<?php foreach ($game as $stage => $text) : ?>
			<table class="<?php echo urlencode($stage); ?>">
				<tr>
					<td><?php echo htmlentities($text, ENT_QUOTES, 'UTF-8'); ?></td>
				</tr>
			</table>
		<?php endforeach; ?>
	</body>
</html>
