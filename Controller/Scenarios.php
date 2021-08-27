<?php

namespace App\Controller;

class Scenarios
{
    public function pickScenario($scenarios)
    {
        if (count($scenarios) === 1) {
            return $scenarios[0];
        }

        if (count($scenarios) > 1) {
            return $scenarios[mt_rand(0, count($scenarios) - 1)];
        }

        return 'ERROR';
    }

    public function start()
    {
        return $this->pickScenario($this->start_scenarios);
    }

    public function round()
    {
        if (!$this->round_narrated) {
            $this->round_narrated = true;
            return $this->pickScenario($this->round_scenario_start);
        }
        return $this->pickScenario($this->round_scenarios);
    }

    public function orderusFirstAttackSpeed()
    {
        return $this->pickScenario($this->orderus_first_attack_speed_scenarios);
    }

    public function orderusFirstAttackLuck()
    {
        return $this->pickScenario($this->orderus_first_attack_luck_scenarios);
    }

    public function beastFirstAttackSpeed()
    {
        return $this->pickScenario($this->beast_first_attack_speed_scenarios);
    }

    public function beastFirstAttackLuck()
    {
        return $this->pickScenario($this->beast_first_attack_luck_scenarios);
    }

    public function orderusRapidStrike()
    {
        return $this->pickScenario($this->orderus_rapid_strike_scenarios);
    }

    public function orderusMagicShield()
    {
        return $this->pickScenario($this->orderus_magic_shield_scenarios);
    }

    public function orderusAttacks()
    {
        return $this->pickScenario($this->orderus_attacks_scenarios);
    }

    public function beastAttacks()
    {
        return $this->pickScenario($this->beast_attacks_scenarios);
    }

    public function orderusHits()
    {
        return $this->pickScenario($this->orderus_hits_scenarios);
    }

    public function orderusMisses()
    {
        return $this->pickScenario($this->orderus_misses_scenarios);
    }

    public function beastHits()
    {
        return $this->pickScenario($this->beast_hits_scenarios);
    }

    public function beastMisses()
    {
        return $this->pickScenario($this->beast_misses_scenarios);
    }

    public function won()
    {
        return $this->pickScenario($this->won_scenarios);
    }

    public function lost()
    {
        return $this->pickScenario($this->lost_scenarios);
    }

    public function draw()
    {
        return $this->pickScenario($this->draw_scenarios);
    }

    // gameplay utterances are inscribed below.

    private $start_scenarios = array(
        [
            "Once upon a time, there was a great hero named Orderus.",
            "After more than a hundred years of battles with all kinds of monsters,",
            "he encountered a wild beast while walking the evergreen forests of Emagia.",
        ],
    );

    private $round_narrated = false;

    private $round_scenario_start = array(
        "Orderus is encountered by a wild beast!",
    );
    private $round_scenarios = array(
        "They go at it again.",
        "Once again, they fight!",
        "The battle continues.",
        "They clash...",
    );

    private $orderus_first_attack_speed_scenarios = array(
        "Orderus is faster. He attacks first!"
    );

    private $beast_first_attack_speed_scenarios = array(
        "Beast is faster. It attacks first!"
    );

    private $orderus_first_attack_luck_scenarios = array(
        "Orderus is luckier. He attacks first!"
    );

    private $beast_first_attack_luck_scenarios = array(
        "Beast is luckier. It attacks first!"
    );

    private $orderus_rapid_strike_scenarios = array(
        "RAPID STRIKE!"
    );

    private $orderus_magic_shield_scenarios = array(
        "Orderus deflects the attack with his MAGIC SHIELD!"
    );

    private $orderus_attacks_scenarios = array(
        "Orderus attacks...",
        "Orderus strikes with his sword against the beast!"
    );

    private $orderus_hits_scenarios = array(
        "Orderus hits the wild beast!"
    );

    private $orderus_misses_scenarios = array(
        "Orderus misses!"
    );

    private $beast_hits_scenarios = array(
        "The wild beast hits Orderus!"
    );

    private $beast_misses_scenarios = array(
        "The wild beast misses!"
    );

    private $beast_attacks_scenarios = array(
        "The wild beast attacks..."
    );

    private $won_scenarios = array(
        "Orderus won!"
    );

    private $lost_scenarios = array(
        "The beast won..!"
    );

    private $draw_scenarios = array(
        "This is strange, but the battle appeareth to be a draw."
    );
}
