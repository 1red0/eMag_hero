<?php

namespace App\Entity;

/**
 * @property int health
 * @property int strength
 * @property int defense
 * @property int speed
 * @property int luck
 */
class Beast extends BasePlayer
{
    public $name = "Beast";

    public function __construct()
    {
        $this->health = mt_rand(60, 90);
        $this->strength = mt_rand(60, 90);
        $this->defense = mt_rand(40, 60);
        $this->speed = mt_rand(40, 60);
        $this->luck = mt_rand(25, 40);
    }
}