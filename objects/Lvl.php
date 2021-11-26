<?php

class Lvl {
    public $id;
    public $slot;
    public $grade;
    public $subject;
    public $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function save() {
        
    }
}