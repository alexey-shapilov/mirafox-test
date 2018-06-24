<?php


    namespace MirafoxTest\Models;


    class Power {
        public $win;
        public $draw;
        public $defeat;

        public function __construct($win, $draw, $defeat) {
            $this->win = round($win, 4);
            $this->draw = round($draw, 4);
            $this->defeat = round($defeat, 4);
        }
    }