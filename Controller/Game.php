<?php

namespace App\Controller;

use App\Entity\Beast;
use App\Entity\Orderus;
use stdClass;

include('Entity/Orderus.php');
include('Entity/Beast.php');

class Game
{
    private $turns = 25; // prevent endless battles

    public $is_running = true;
    private $first_attack = true;
    private $orderus_attacks;

    public function __construct($ui, $scenario)
    {
        $this->ui = $ui;
        $this->scenario = $scenario;
        $this->winner = new stdClass();
        $this->winner->is_orderus = false;
        $this->winner->is_beast = false;
        $this->orderus = new Orderus();
        $this->beast = new Beast();
    }

    public function displayStats()
    {
        $this->displayIndividualStats($this->orderus);
        $this->displayIndividualStats($this->beast);
    }

    private function displayIndividualStats($player)
    {
        // only show the stats that have changed
        $changes = $player->statChanges();
        if (count($changes) > 0) {
            $this->ui->display("* $player->name:");
            foreach ($changes as $change) {
                $this->ui->display("-   " . $change->type . ": " . $change->value);
            }
        }
        $player->saveStats();
    }

    public function playRound()
    {
        // pick the first attacker based on stats
        $this->checkFirstAttack();

        // Orderus attacks
        if ($this->orderus_attacks) {
            $attacks = $this->orderus->rapidStrike();
            if ($attacks > 1) {
                $this->ui->display($this->scenario->orderusRapidStrike());
                $this->ui->displayBlank();
            }
            while ($attacks > 0) {
                $this->ui->display($this->scenario->orderusAttacks());
                if ($this->orderus->attack($this->beast)) {
                    $this->ui->display($this->scenario->orderusHits());
                } else {
                    $this->ui->display($this->scenario->orderusMisses());
                }
                $attacks--;
                if ($attacks > 0) {
                    $this->displayStats();
                    $this->ui->displayBlank();
                }
            }

            // the wild beast attacks
        } else {
            $this->ui->display($this->scenario->beastAttacks());
            $damage_divider = $this->orderus->magicShield();
            if ($damage_divider > 1) {
                $this->ui->displayBlank();
                $this->ui->display($this->scenario->orderusMagicShield());
                $this->ui->displayBlank();
            }
            if ($this->beast->attack($this->orderus, $damage_divider)) {
                $this->ui->display($this->scenario->beastHits());
            } else {
                $this->ui->display($this->scenario->beastMisses());
            }
        }

        // take turns attacking
        $this->orderus_attacks = !$this->orderus_attacks;

        // prevent endless battles
        $this->turns--;
        $this->is_running = ($this->turns > 0);

        // check health stats
        if (($this->orderus->health() <= 0) || ($this->beast->health() <= 0)) {
            $this->is_running = false;
        }

        // Orderus wins
        if ($this->beast->health() <= 0) {
            $this->winner->is_orderus = true;
        }

        // the wild beast wins
        if ($this->orderus->health() <= 0) {
            $this->winner->is_beast = true;
        }
    }

    private function checkFirstAttack()
    {
        if ($this->first_attack) {

            // the faster player starts
            if ($this->orderus->speed() > $this->beast->speed()) {
                $this->ui->display($this->scenario->orderusFirstAttackSpeed());
                $this->orderus_attacks = true;
            } else if ($this->orderus->speed() < $this->beast->speed()) {
                $this->ui->display($this->scenario->beastFirstAttackSpeed());
                $this->orderus_attacks = false;

                // if both are equally fast, then the luckier player starts
            } else if ($this->orderus->luck() > $this->beast->luck()) {
                $this->ui->display($this->scenario->orderusFirstAttackLuck());
                $this->orderus_attacks = true;
            } else {
                $this->ui->display($this->scenario->beastFirstAttackLuck());
                $this->orderus_attacks = false;
            }

            $this->first_attack = false;
            $this->ui->displayBlank();
        }
    }
}
