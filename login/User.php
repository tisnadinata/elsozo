<?php
class User {
    private $dbHost     = "mysql.hostinger.co.id";
    private $dbUsername = "u656899135_elszo";
    private $dbPassword = "Elsozo27";
    private $dbName     = "u656899135_elszo";
    private $userTbl    = 'tbl_users';
    
    function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    function checkUser($userData = array()){
        if(!empty($userData)){
            //Check whether user data already exists in database
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE email = '".$userData['email']."'";
            $prevResult = $this->db->query($prevQuery);
            if($prevResult->num_rows > 0){
                //Update user data if already exists
            }else{
                //Insert user data
				if($userData['email'] != ''){
					$email= $userData['email'];
				}else{
					$email= "";
				}
                $query = "INSERT INTO ".$this->userTbl." SET display_name = '".$userData['first_name']." ".$userData['last_name']."', email = '".$email."', picture = '".$userData['picture']."'";
                $insert = $this->db->query($query);
            }
            
            //Get user data from the database
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }
        
        //Return user data
        return $userData;
    }
}
?>