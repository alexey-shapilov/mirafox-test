<?php


    namespace MirafoxTest\Models;


    use MirafoxTest\Exception\TeamException;

    class Team {
        private $name;
        private $games;
        private $win;
        private $draw;
        private $defeat;
        private $goals;

        private $power;

        /**
         * Team constructor.
         *
         * @param $data
         *
         * @throws TeamException
         */
        public function __construct($data) {
            if (empty($data['name'])) {
                throw new TeamException('Team name is absent');
            }
            $this->name = $data['name'];
            $this->games = $data['games'] ?? 0;
            $this->win = $data['win'] ?? 0;
            $this->draw = $data['draw'] ?? 0;
            $this->defeat = $data['defeat'] ?? 0;
            $this->goals = new Goals($data['goals']['scored'] ?? 0, $data['goals']['skiped'] ?? 0);
        }

        /**
         * @param int $value
         */
        public function addWin($value = 1) {
            $this->win += $value;
            $this->addGames($value);
        }

        /**
         * @param int $value
         */
        public function addDraw($value = 1) {
            $this->draw += $value;
            $this->addGames($value);
        }

        /**
         * @param int $value
         */
        public function addDefeat($value = 1) {
            $this->defeat += $value;
            $this->addGames($value);
        }

        /**
         * @param int $value
         */
        public function addGoalsScored($value = 1) {
            $this->goals->addScored($value);
            $this->power = null;
        }

        /**
         * @param int $value
         */
        public function addGoalsSkiped($value = 1) {
            $this->goals->addSkiped($value);
            $this->power = null;
        }

        public function getAverageGoalsScored() {
            return round($this->goals->getScored() / $this->getGames(), 1);
        }

        public function getAverageGoalsSkiped() {
            return round($this->goals->getSkiped() / $this->getGames(), 1);
        }

        /**
         * @return Power
         */
        public function getPower() {
            if (!isset($this->power)) {
                $this->power = new Power($this->getWin() / $this->getGames(), $this->getDraw() / $this->getGames(), $this->getDefeat() / $this->getGames());
            }

            return $this->power;
        }

        /**
         * @return mixed
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @return int
         */
        public function getGames():int {
            return $this->games;
        }

        /**
         * @return int
         */
        public function getWin():int {
            return $this->win;
        }


        /**
         * @return int
         */
        public function getDraw():int {
            return $this->draw;
        }

        /**
         * @return int
         */
        public function getDefeat():int {
            return $this->defeat;
        }

        /**
         * @return Goals
         */
        public function getGoals():Goals {
            return $this->goals;
        }

        /**
         * @param int $value
         */
        private function addGames($value = 1) {
            $this->games += $value;
            $this->power = null;
        }
    }