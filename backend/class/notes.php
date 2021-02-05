<?php
    class Notes{

        // Connection
        private $conn;

        // Table
        private $db_table = "notes";

        // Columns
        public $id;
        public $text;
        public $date;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getNotes(){
            $sqlQuery = "SELECT id, text, date  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createNotes(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        text = :text, 
                        date = :date";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
           
            $this->text=htmlspecialchars(strip_tags($this->text));
            $this->date=htmlspecialchars(strip_tags($this->date));
        
            $stmt->bindParam(":text", $this->text);
            $stmt->bindParam(":date", $this->date);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        //GET ITEM
        public function getSingleNotes(){
            $sqlQuery = "SELECT id, text, date  FROM " . $this->db_table . " WHERE id = " . $this->id . "";
            $stmt = $this->conn->prepare($sqlQuery);
            
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->text = $dataRow['text'];
            $this->date = $dataRow['date'];
        }        

        // UPDATE
        public function updateNotes(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        text = :text, 
                        date = :date, 
                    WHERE 
                        id = :id";
        
                        $stmt = $this->conn->prepare($sqlQuery);
           
                        $this->text=htmlspecialchars(strip_tags($this->text));
                        $this->date=htmlspecialchars(strip_tags($this->date));
                    
                        $stmt->bindParam(":text", $this->text);
                        $stmt->bindParam(":date", $this->date);
                    
                        if($stmt->execute()){
                           return true;
                        }
                        return false;
 
        }

        // DELETE
        function deleteNotes(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>

