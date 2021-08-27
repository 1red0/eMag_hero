<?php

namespace App\Entity;

include('Entity/BasePlayer.php');

/**
 * @property int health
 * @property int strength
 * @property int defense
 * @property int speed
 * @property int luck
 */
class Orderus extends BasePlayer
{
    public $name = "Orderus";

    public function __construct()
    {
        $this->health = mt_rand(70, 100);
        $this->strength = mt_rand(70, 80);
        $this->defense = mt_rand(45, 55);
        $this->speed = mt_rand(40, 50);
        $this->luck = mt_rand(10, 30);
    }

    public function rapidStrike()
    {
        $attacks = 1;
        if (mt_rand(0, 100) <= 10) {
            $attacks = 2;
        }
        return $attacks;
    }

    public function magicShield()
    {
        $magic_shield = 1;
        if (mt_rand(0, 100) <= 20) {
            $magic_shield = 2;
        }
        return $magic_shield;
    }

    // If we want to add a new skill to our hero we can do it with ease here ex: public function *someCrazyPower(){...}

}
