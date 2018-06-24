<?php


    namespace MirafoxTest\Repository;


    use MirafoxTest\Models\Team;

    class TeamsRepository {
        private $teams;

        private static $instance;

        public static function getInstance($data = null) {
            if (!self::$instance) {
                self::$instance = new self($data);
            }

            return self::$instance;
        }

        /**
         * @param $index
         *
         * @return Team|null
         */
        public function getTeam($index) {
            return $this->teams[$index] ?? null;
        }

        public function addTeam($datum, $index = null) {
            try {
                $team = new Team($datum);
                if (null !== $index) {
                    $this->teams[$index] = $team;
                } else {
                    $this->teams[] = $team;
                }
            } catch (\MirafoxTest\Exception\TeamException $e) {
                error_log($e->getMessage());
            }
        }

        private function __construct($data) {
            foreach ($data as $index => $datum) {
                try {
                    $team = new Team($datum);
                    $this->teams[$index] = $team;
                } catch (\MirafoxTest\Exception\TeamException $e) {
                    error_log($e->getMessage());
                }
            }
        }
    }