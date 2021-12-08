#!/usr/bin/php
<?php declare(strict_types=1);

use Tris\PhpBrackets\Bracket;

require __DIR__ . "/vendor/autoload.php";


echo "Input bracket expression: ";

while ($input = fgets(STDIN)) {
    $bracket = new Bracket($input);

    if ($bracket->isBalance()) {
        echo "Bracket expression of $input is balance\n\n";
    } else {
        echo "Bracket expression of $input is not balance\n\n";
    }

    echo "total pairings:\n";
    $round = count($bracket->getPairings('round'));
    $curly = count($bracket->getPairings('curly'));
    $square = count($bracket->getPairings('square'));
    echo "\t round bracket: {$round}\n";
    echo "\t curly bracket: {$curly}\n";
    echo "\t square bracket: {$square}\n\n";

    echo "Input bracket expression: ";
}
