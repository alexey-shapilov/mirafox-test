<?php


    namespace MirafoxTest\Models;


    class Goals {
        private $scored;
        private $skiped;

        public function __construct($scored, $skiped) {
            $this->scored = $scored;
            $this->skiped = $skiped;
        }

        /**
         * @return int
         */
        public function getScored() {
            return $this->scored;
        }

        /**
         * @return int
         */
        public function getSkiped() {
            return $this->skiped;
        }

        public function addScored($value = 1) {
            $this->scored += $value;
            return $this->scored;
        }

        public function addSkiped($value = 1) {
            $this->skiped += $value;
            return $this->skiped;
        }
    }