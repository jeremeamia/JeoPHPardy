<!doctype html>
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
		<table class="category">
			<tr>
				<td>INI Directives</td>
			</tr>
		</table>
		<table class="question">
			<tr>
				<td>This INI directive allows you to specify the name of a file that will be parsed before the main file being executed.</td>
			</tr>
		</table>
		<table class="answer">
			<tr>
				<td>What is auto_prepend_file?</td>
			</tr>
		</table>
		<table class="thanks">
			<tr>
				<td>Thanks</td>
			</tr>
		</table>
	</body>
</html>
