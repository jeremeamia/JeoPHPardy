<!doctype html>
<html>
<head>
	<title>HTTP Jeoparody</title>
	<style>
		html, body, table {margin: 0; padding: 0; background-color: #0000ff; color: #ffffff;}
		td, th {text-align: center; vertical-align: middle; border: 1px #ccccff solid;}
		table {width: 100vw; height: 100vh; border-spacing: 0; border-collapse: collapse;}

		.game td {width: 20vw; height: 16.66vh; font-size: 10vh;}
		.game th {width: 20vw; height: 16.66vh; font-size: 6vh;}
		.game td.tile {cursor: pointer;}
		.game td.tile:hover {background-color: #1144ff;}

		.scores th {width: 33.33vw; height: 30vh; font-size: 10vh;}
		.scores td {width: 33.33vw; height: 20vh; font-size: 10vh;}

		.question {display: none; position: absolute; top: 0; left: 0; z-index: 1;}
		.question .text {width: 100vw; height: 85vh; font-size: 5vw; cursor: help; border: 0; padding-left: 5vw; padding-right: 5vw;}
		.question .award {width: 15vw; height: 15vh; font-size: 5vh; background-color: #006600; cursor: pointer; -webkit-user-select: none;}
		.question .award:hover {background-color: #008800;}
		.question .award.wrong {background-color: #660000;}
		.question .award.wrong:hover {background-color: #880000;}
		.question .show-answer {width: 10vw; height: 15vh; font-size: 8vh; background-color: #888800; cursor: pointer; color: black; text-shadow: #ff0 1px 1px;}
		.question .show-answer:hover {background-color: #999933;}

		.daily-double {display: none; position: absolute; top: 0; left: 0; z-index: 2;}
		.daily-double td {border: 0;}
		.daily-double .title {width: 100vw; height: 50vh; font-size: 15vw;}
		.daily-double .wager {width: 100vw; height: 50vh; font-size: 20vh;}
		.daily-double .wager-confirm {cursor: pointer; color: white;}

		.content-money {color: #ffff33; text-shadow: black 5px 5px; font-family: "Impact";}
		.content-name {color: #ffffee; text-shadow: black 3px 3px; font-family: "HelveticaNeue-CondensedBold";}
		.content-text {color: #ffffee; text-shadow: black 5px 5px; font-weight: bold; font-family: "Korinna";}
		.content-title {color: #ffffee; text-shadow: black 5px 5px; letter-spacing: 3pt; font-family: "Gyparody";}
	</style>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script>
		$(document).ready(function() {
			// Handle Daily Doubles
			$('.game .tile.dd').one('click', function(event) {
				var tile = $(this);
				event.stopImmediatePropagation();
				$('.daily-double').show();
				$('.daily-double .wager-confirm').mousedown(function() {$(this).css('text-shadow', 'none')});
				$('.daily-double .wager-confirm').click(function() {
					$('.daily-double').hide();
					tile.data('points', parseInt($('.daily-double .wager-value').text()));
					tile.click();
				});
			});
			// Click on a tile from the game board.
			$('.game .tile').one('click', function() {
				var points = parseInt($(this).data('points'));
				var answer = $(this).data('answer');
				// Show the question.
				$('.question').show();
				$('.award, .show-answer').show();
				// Setup question text
				$('.question .text').text($(this).data('question'));
				// Create buttons for score keeping.
				$('.award').click('click', function() {
					var score = $('.' + $(this).data('player') + '-score');
					var pointsAwarded = points;
					var isWrong = $(this).hasClass('wrong');
					if (isWrong) {
						pointsAwarded *= -1;
						$('.award').removeClass('wrong');
					}
					score.data('score', score.data('score') + pointsAwarded);
					score.text((score.data('score') < 0 ? '-' : '') + '$' + Math.abs(score.data('score')));
					if (!isWrong) {
						$('.show-answer').click();
					}
				});
				// Create button for when no one gets it
				$('.show-answer').one('click', function() {
					$('.award, .show-answer').off('click').hide();
					$('.question .text').text(answer)
						.one('click', function() {
							$('.question').hide();
						});
				});
				// Remove tile from game board.
				$(this).removeClass('tile').removeClass('dd').text('');
			});

			// Syncs the editable names on the score board with the question screen.
			$('.player').blur(function() {
				$('.' + $(this).data('player') + '-name').text($(this).text());
			});

			// Track shift button usage.
			$(document).keydown(function (event) {
				if (event.shiftKey) $('.question .award').addClass('wrong');
			});
			$(document).keyup(function (event) {
				$('.question .wrong').removeClass('wrong');
			});
		});
	</script>
</head>
<body>
	<!-- All the PHP code is in here -->
	<table class="game">
		<thead class="content-name">
			<tr>
				<?php foreach ($game['categories'] as $category): ?>
					<th><?php echo $category['name'] ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody class="content-money">
			<?php $dailyDouble = rand(3, 4) . rand(0, 4) ?>
			<?php for ($row = 0; $row < 5; $row++): ?>
				<?php $points = ($row + 1) * $game['pointScale'] ?>
				<tr>
					<?php for ($col = 0; $col < 5; $col++): ?>
						<?php $data = $game['categories'][$col]['questions'][$row]; ?>
						<?php $class = ($dailyDouble === $row . $col) ? 'tile dd' : 'tile' ?>
						<td class="<?php echo $class ?>" data-points="<?php echo $points ?>"
							data-question="<?php echo htmlentities($data['question'], ENT_QUOTES, 'UTF-8'); ?>"
							data-answer="<?php echo htmlentities($data['answer'], ENT_QUOTES, 'UTF-8'); ?>">$<?php echo $points ?></td>
					<?php endfor ?>
				</tr>
			<?php endfor; ?>
		</tbody>
	</table>
	<!-- End PHP code. -->
	<table class="question">
		<tr>
			<td class="text content-text" colspan="7">QUESTION</td>
		</tr>
		<tr class="content-name">
			<td class="award p1-name" colspan="1" data-player="p1" >Player 1</td>
			<td class="award p2-name" colspan="1" data-player="p2" >Player 2</td>
			<td class="award p3-name" colspan="1" data-player="p3" >Player 3</td>
			<td class="award p4-name" colspan="1" data-player="p4" >Player 4</td>
			<td class="award p5-name" colspan="1" data-player="p5" >Player 5</td>
			<td class="award p6-name" colspan="1" data-player="p6" >Player 6</td>
			<td class="show-answer" colspan="1">&#9760;</td>
		</tr>
	</table>
	<table class="scores">
		<tr class="content-name">
			<th><span class="player" data-player="p1" contenteditable="true">Player 1</span></th>
			<th><span class="player" data-player="p2" contenteditable="true">Player 2</span></th>
			<th><span class="player" data-player="p3" contenteditable="true">Player 3</span></th>
		</tr>
		<tr class="content-money">
			<td class="p1-score" data-score="0">$0</td>
			<td class="p2-score" data-score="0">$0</td>
			<td class="p3-score" data-score="0">$0</td>
		</tr>

		<tr class="content-name">
			<th><span class="player" data-player="p4" contenteditable="true">Player 4</span></th>
			<th><span class="player" data-player="p5" contenteditable="true">Player 5</span></th>
			<th><span class="player" data-player="p6" contenteditable="true">Player 6</span></th>
		</tr>
		<tr class="content-money">
			<td class="p4-score" data-score="0">$0</td>
			<td class="p5-score" data-score="0">$0</td>
			<td class="p6-score" data-score="0">$0</td>
		</tr>
	</table>
	<table class="daily-double">
		<tr>
			<td class="title content-title">Daily Double</td>
		</tr>
		<tr>
			<td class="wager content-money">
				$<span class="wager-value" contenteditable="true">0</span>&ensp;<span class="wager-confirm">&#x2713;</span>
			</td>
		</tr>
	</table>
</body>
</html>