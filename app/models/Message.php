<?php
        class Message{
            private $db;  
            public function __construct(){
                $this->db = new Database;

            }
              // ***************************************************************
            public function insertMessage($data){
                $this->db->query('INSERT INTO messages (user_id,name,email,number,message) VALUES(:user_id,:name,:email,:number,:message)');
    
    
                $this->db->bind(':user_id',$_SESSION['user_id']);
                $this->db->bind(':name',$data['name']);
                $this->db->bind(':email',$data['email']);
                $this->db->bind(':number',$data['number']);
                $this->db->bind(':message',$data['message']);
    
                    if($this->db->execute()){
                        return true;
                    }
            }
            // ***********************************************************
            // isert message without user ID
            public function insertMsg($data){
                $this->db->query('INSERT INTO messages (name,email,number,message) VALUES(:name,:email,:number,:message)');
    
    
              
                $this->db->bind(':name',$data['name']);
                $this->db->bind(':email',$data['email']);
                $this->db->bind(':number',$data['number']);
                $this->db->bind(':message',$data['message']);
    
                    if($this->db->execute()){
                        return true;
                    }
            }
              // ***************************************************************
            public function getMessages(){
                $this->db->query('SELECT * FROM messages ORDER BY `date` DESC');
               
    
                $rows= $this->db->resultSet();
    
              
                    return $rows;
                
      
            }
              // ***************************************************************
            public function deleteMsg($id){
                $this->db->query('DELETE FROM messages WHERE id_ms = :id');
                
                //Bind values
                $this->db->bind(':id' , $id);
    
              
    
                if($this->db->execute()){
                    return true;
                }
            }
              // ***************************************************************
            public function getNumMsgs(){

                $this->db->query('SELECT * FROM messages ');
               
    
                $rows= $this->db->resultSet();
                $num=$this->db->rowCount();
              
                    return $num;
            }
    
        }