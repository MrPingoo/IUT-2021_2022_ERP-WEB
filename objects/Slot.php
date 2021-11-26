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
        if (!empty($this->id)) {
            // Edit
            $query = "UPDATE slot SET begin=:begin, end=:end, room_idroom=:room WHERE id=" . $this->id;

            // prepare query statement
            $stmt = $this->cnx->prepare($query);

            $stmt->bindParam(":room", $this->room);
            $stmt->bindParam(":begin", $this->begin);
            $stmt->bindParam(":end", $this->end);
            $stmt->bindParam(":lvl", $this->lvl);

            $stmt->execute();
        } else {
            // Save
            $query = "INSERT INTO slot SET begin=:begin, end=:end, room_idroom=:room";

            // prepare query statement
            $stmt = $this->cnx->prepare($query);

            $stmt->bindParam(":room", $this->room);
            $stmt->bindParam(":begin", $this->begin);
            $stmt->bindParam(":end", $this->end);

            // execute query
            if ($stmt->execute()) {
                $this->id = $this->cnx->lastInsertId();
            }
        }
    }
}