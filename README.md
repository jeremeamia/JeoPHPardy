# JeoPHPardy

This is a simple PHP/Javascript Jeopardy-like board that I've used to run some trivia games in the PHP community.

It has suited my needs well, along with my [Wireless Eggspert buzzer system](http://www.amazon.com/Educational-Insights-Wireless-Eggspert-2-4G/dp/B001ZMZK7A/), and I've had requests that I publish the source, so that they could use it as well. I can't offer any guarantees that it'll work though, since I have put absolutely no work into making it work anywhere but on my computer and for my needs.

If you end up using it and making any improvements, please consider sending me a PR.

## Requirements

This is what I used to develop/run the game. It may work in other browsers or operating systems, but I have not tested it anywhere but my laptop.

- Mac OS X Mavericks
- Google Chrome (up-to-date)
- PHP 5.4+ w/ built-in PHP server
- Fonts (download, install, and license yourself)
    - [ITC Korinna Bold](http://www.fontpalace.com/font-details/Korinna+Bold/)
    - [Gyparody](http://www.1001fonts.com/gyparody-font.html)

## Features

- Supports 5 categories
- Supports 5 question levels (e.g., 200, 400, 600, 800, 1000)
- Questions are loaded from a PHP array
- Base score can be configured, so that Double Jeopardy rounds can be scheduled
- Scoreboard with 6 players
- Players can be named
- On question screen, players can be given points (or have points taken away)
  by clicking on their name (or shift+clicking for negative). There is also a
  skull button which is used to reveal the answer if no player gets it correct.
- There is one Daily Double randomly assigned to one of the $800 or $1000
  dollar questions.
- Final Jeopardy is supported, but is a separate file.

## Limitations

- There is always 6 players
- There is always 1 Daily Double
- I wrote this code quickly, and I'm not very good with JavaScript.
- Don't refresh the page
- Final Jeopardy is a separate file and does not hook into the scores at all.
- No music or sound effects

## How to use

First you must create a round using `empty-round.php` as a template. It looks
like this:

```php
<?php return [
	'pointScale' => 200, // Change this to adjust point values
	'categories' => [
		[
			'name' => 'xx', // e.g., Potent Potables
			'questions' =>  [
				[
				 	'question' => 'xx', //e.g., This is my name.
				 	'answer'   => 'xx', //e.g., What is Jeremy?
				],
				[
				 	'question' => 'xx',
				 	'answer'   => 'xx',
				],
				[
				 	'question' => 'xx',
				 	'answer'   => 'xx',
				],
				[
				 	'question' => 'xx',
				 	'answer'   => 'xx',
				],
				[
				 	'question' => 'xx',
				 	'answer'   => 'xx',
				],
			]
		],
		// Repeated for each category...
```

Next, make sure `play.php` is set to load your round.

```php
$game = include 'my-round.php';
include 'template.php';
```

Then, start a PHP server in the directory containing the index.html, and go to
it in your browser. Yay!

## License

The MIT License (MIT)

Copyright (c) 2014 Jeremy Lindblom

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
