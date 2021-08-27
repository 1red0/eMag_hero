<?php

use App\Controller\Game;
use App\Controller\Scenarios;
use App\Controller\UserInterface;

include('Controller/UserInterface.php');
include('Controller/Scenarios.php');
include('Controller/Game.php');

$ui = new UserInterface();
$ui->open();

$scenarios = new Scenarios();

$game = new Game($ui, $scenarios);

$ui->display($scenarios->start());
$game->displayStats();
$ui->displayBlank();

while ($game->is_running) {
    $ui->display($scenarios->round());
    $ui->displayBlank();

    $game->playRound();
    $game->displayStats();
    $ui->displayBlank();
}

if ($game->winner->is_orderus) {
    $ui->display($scenarios->won());
} else if ($game->winner->is_beast) {
    $ui->display($scenarios->lost());
} else {
    $ui->display($scenarios->draw());
}

$ui->close();
