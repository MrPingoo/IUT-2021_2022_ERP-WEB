<?php 

class User {
	public $id;
	public $firstname;
	public $lastname;
	public $password;
	public $email;
	public $cnx;

	public function __construct($cnx) {
		$this->cnx = $cnx;
	}

	public function retrive($id) {
		// Edit
	    $query = "SELECT * FROM user WHERE id=" . $id;

	    // prepare query statement
	    $stmt = $this->cnx->prepare($query);
	    $stmt->execute();		
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

	    $this->setAll($user);
	}

	public static function findAll($db, $limit = 10, $offset = 0) {
		// Edit
	    $query = "SELECT * FROM user LIMIT $limit OFFSET $offset";

	    // prepare query statement
	    $stmt = $db->prepare($query);
	    $stmt->execute();		
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function setAll($user) {
	    $this->id = $user['id'];
	    $this->firstname = $user['firstname'];
	    $this->lastname = $user['lastname'];
	    $this->password = $user['password'];
	    $this->email = $user['email'];
	}

	public function binding(&$stmt) {
	    $stmt->bindParam(":email", $this->email);
	    $stmt->bindParam(":firstaname", $this->firstname);
	    $stmt->bindParam(":lastname", $this->lastname);
	    $stmt->bindParam(":password", $this->password);
	}

	public function save() {
		if (!empty($this->id)) {
			// Edit
		    $query = "UPDATE user SET email=:email, firstname=:firstaname, lastname=:lastname, password=:password WHERE id=" . $this->id;

		    // prepare query statement
		    $stmt = $this->cnx->prepare($query);
		    
		    $stmt->bindParam(":email", $this->email);
		    $stmt->bindParam(":firstaname", $this->firstname);
		    $stmt->bindParam(":lastname", $this->lastname);
		    $stmt->bindParam(":password", $this->password);

		    $stmt->execute();
		} else {
			// Save
		    $query = "INSERT INTO user SET email=:email, firstname=:firstaname, lastname=:lastname, password=:password";

		    // prepare query statement
		    $stmt = $this->cnx->prepare($query);
		    
		    $stmt->bindParam(":email", $this->email);
		    $stmt->bindParam(":firstaname", $this->firstname);
		    $stmt->bindParam(":lastname", $this->lastname);
		    $stmt->bindParam(":password", $this->password);
		    
		    // execute query
		    if ($stmt->execute()) {
	    		$this->id = $this->cnx->lastInsertId();
		    }
		}
	}
}