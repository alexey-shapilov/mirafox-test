<?php


    namespace MirafoxTest\Models;


    class Probability {
        private $probability;

        /**
         * Probability constructor.
         *
         * @param Power $team1Power
         * @param Power $team2Power
         */
        public function __construct($team1Power, $team2Power) {
            $pWin = $team1Power->win * (1 - $team2Power->win) / ($team1Power->win * (1 - $team2Power->win) + $team2Power->win * (1 - $team1Power->win));
            $pDraw = $team1Power->draw * (1 - $team2Power->draw) / ($team1Power->draw * (1 - $team2Power->draw) + $team2Power->draw * (1 - $team1Power->draw));
            $pDefeat = $team1Power->defeat * (1 - $team2Power->defeat) / ($team1Power->defeat * (1 - $team2Power->defeat) + $team2Power->defeat * (1 - $team1Power->defeat));

            $this->probability = new Power($pWin, $pDraw, $pDefeat);
        }

        /**
         * @return Power
         */
        public function getProbability():Power {
            return $this->probability;
        }
    }