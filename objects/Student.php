<?php 

class Student {
	public $id;
	public $firstname;
	public $lastname;
    public $user;
    public $lvl;
	public $cnx;

	public function __construct($cnx) {
		$this->cnx = $cnx;
	}

	public function save() {
		if (!empty($this->id)) {
			// Edit
		    $query = "UPDATE student SET user_id=:user, firstname=:firstname, lastname=:lastname, lvl=:lvl WHERE id=" . $this->id;

		    // prepare query statement
		    $stmt = $this->cnx->prepare($query);
		    
		    $stmt->bindParam(":firstname", $this->firstname);
		    $stmt->bindParam(":lastname", $this->lastname);
            $stmt->bindParam(":user", $this->user);
            $stmt->bindParam(":lvl", $this->lvl);

		    $stmt->execute();
		} else {
			// Save
		    $query = "INSERT INTO student SET user_id=:user, firstname=:firstname, lastname=:lastname, lvl=:lvl";

		    // prepare query statement
		    $stmt = $this->cnx->prepare($query);
		    
		    $stmt->bindParam(":firstname", $this->firstname);
		    $stmt->bindParam(":lastname", $this->lastname);
		    $stmt->bindParam(":user", $this->user);
		    $stmt->bindParam(":lvl", $this->lvl);
		    
		    // execute query
		    if ($stmt->execute()) {
	    		$this->id = $this->cnx->lastInsertId();
		    }
		}
	}
}