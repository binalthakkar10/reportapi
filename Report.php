<?php
class Report{
    private $conn;
    private $table_name = "reports";
 
    public $id;
    public $title;
    public $description;
    public $username;
    public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }
	function read(){
		
		if(!empty($this->id)){
			$query = "SELECT * FROM `reports`  WHERE
                id = ?";
		$stmt = $this->conn->prepare($query);
		 $stmt->bindParam(1, $this->id);		
		}else{
			$query = "SELECT * FROM `reports`";
			$stmt = $this->conn->prepare($query);
		}
		
		 
		$stmt->execute();
		 
		return $stmt;
	}
	function create(){
		$query = "INSERT INTO " . $this->table_name . "(title,description,username,timestamp) VALUES(:title,:description,:username,:timestamp)";
	 
		$stmt = $this->conn->prepare($query);

		$this->title=htmlspecialchars(strip_tags($this->title));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->username=htmlspecialchars(strip_tags($this->username));
	
		$date = date("Y-m-d H:i:s");  
		$stmt->bindParam(":title", $this->title);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":username", $this->username);
		$stmt->bindParam(":timestamp", $date);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
}
	function update(){
	 
		$query = "UPDATE
					" . $this->table_name . "
				SET
					title = :title,
					description = :description,
					username = :username,
					timestamp = :timestamp
				WHERE
					id = :id";
	 
		$stmt = $this->conn->prepare($query);
		
	    $this->id =htmlspecialchars(strip_tags($this->id));
		$this->title=htmlspecialchars(strip_tags($this->title));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->username=htmlspecialchars(strip_tags($this->username));
	 
		$date = date("Y-m-d H:i:s");  
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":title", $this->title);
		$stmt->bindParam(":description", $this->description);
		$stmt->bindParam(":username", $this->username);
		$stmt->bindParam(":timestamp", $date);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    $stmt = $this->conn->prepare($query);
 
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    $stmt->bindParam(1, $this->id);
 
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
}

?>