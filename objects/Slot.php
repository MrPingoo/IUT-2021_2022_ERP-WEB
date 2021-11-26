<?php

class Slot {
    public $id;
    public $room;
    public $begin;
    public $end;
    public $lvl = [];
    public $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function save() {
        
    }
}