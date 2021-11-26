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
        if (!empty($this->id)) {
            // Edit
            $query = "UPDATE lvl SET id_grade=:grade, id_slot=:slot, id_subject=:subject WHERE id=" . $this->id;

            // prepare query statement
            $stmt = $this->cnx->prepare($query);

            $stmt->bindParam(":grade", $this->grade);
            $stmt->bindParam(":slot", $this->slot);
            $stmt->bindParam(":subject", $this->subject);

            $stmt->execute();
        } else {
            // Save
            $query = "INSERT INTO lvl SET id_grade=:grade, id_slot=:slot, id_subject=:subject";

            // prepare query statement
            $stmt = $this->cnx->prepare($query);

            $stmt->bindParam(":grade", $this->grade);
            $stmt->bindParam(":slot", $this->slot);
            $stmt->bindParam(":subject", $this->subject);

            // execute query
            if ($stmt->execute()) {
                $this->id = $this->cnx->lastInsertId();
            }
        }
    }
}