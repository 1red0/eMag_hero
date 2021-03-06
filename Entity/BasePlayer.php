<?php

namespace App\Entity;

use stdClass;

Class BasePlayer
{
    public $name;

    private $health_last = 0;
    private $strength_last = 0;
    private $defense_last = 0;
    private $speed_last = 0;
    private $luck_last = 0;

    public function statChanges()
    {
        $stat_changes = array();
        if ($this->health !== $this->health_last) {
            $change = new StdClass();
            $change->type = "Health";
            $change->value = $this->health;
            $stat_changes[] = $change;
        }
        if ($this->strength !== $this->strength_last) {
            $change = new StdClass();
            $change->type = "Strength";
            $change->value = $this->strength;
            $stat_changes[] = $change;
        }
        if ($this->defense !== $this->defense_last) {
            $change = new StdClass();
            $change->type = "Defense";
            $change->value = $this->defense;
            $stat_changes[] = $change;
        }
        if ($this->speed !== $this->speed_last) {
            $change = new StdClass();
            $change->type = "Speed";
            $change->value = $this->speed;
            $stat_changes[] = $change;
        }
        if ($this->luck !== $this->luck_last) {
            $change = new StdClass();
            $change->type = "Luck";
            $change->value = $this->luck;
            $stat_changes[] = $change;
        }
        return $stat_changes;
    }

    public function saveStats()
    {
        $this->health_last = $this->health;
        $this->strength_last = $this->strength;
        $this->defense_last = $this->defense;
        $this->speed_last = $this->speed;
        $this->luck_last = $this->luck;
    }

    public function health()
    {
        return $this->health;
    }

    public function speed()
    {
        return $this->speed;
    }

    public function luck()
    {
        return $this->luck;
    }

    public function attack($defender, $damage_divider = 1)
    {
        $chance = mt_rand(0, 100);
        if ($chance < $this->luck) {
            $damage = ($this->strength - $defender->defense) / $damage_divider;
            $defender->health -= $damage;
            if ($defender->health < 0) {
                $defender->health = 0;  // it just makes more sense
            }
            $success = true;
        } else {
            $success = false;
        }
        return $success;
    }
}
