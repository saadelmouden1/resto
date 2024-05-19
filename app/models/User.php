<?php
        class User{
            private $db;
            public function __construct(){
                $this->db = new Database;

            }   
              // ***************************************************************
            public function register($data){
                $this->db->query('INSERT INTO users (nom,email,password) VALUES(:nom,:email,:pass)');


                $this->db->bind(':nom',$data['name']);
                $this->db->bind(':email',$data['email']);
                $this->db->bind(':pass',$data['pass']);

                    if($this->db->execute()){
                        return true;
                    }
            }


              // Login User
        public function login($email,$pass){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row= $this->db->single();

            $hashed_password = $row->password;
            if(password_verify($pass, $hashed_password)){
                return $row;
            }else{
                return false;
            }

        }


             //Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            
            //Bind values
            $this->db->bind(':email' , $email);

            $row = $this->db->single();

            //Check row
            if($this->db->rowCount() >0){
                return true;
            }else{
                return false;
            }
        }
          // ***************************************************************
        public function getAllUsers(){
            $this->db->query('SELECT * FROM users ');
           

            $rows= $this->db->resultSet();

          
                return $rows;
            
  
        }
          // ***************************************************************
        public function deleteUser($id){
            $this->db->query('DELETE FROM users WHERE id_user = :id');
            
            //Bind values
            $this->db->bind(':id' , $id);

          

            if($this->db->execute()){
                return true;
            }
        }
          // ***************************************************************
        public function getNumUsers(){

            $this->db->query('SELECT * FROM users ');
           

            $rows= $this->db->resultSet();
            $num=$this->db->rowCount();
          
                return $num;
        }

         // ***************************************************************
         public function getUser(){
            $this->db->query('SELECT * FROM users where id_user=:id ');
           
            $this->db->bind(':id' , $_SESSION['']);
            $rows= $this->db->resultSet();

          
                return $rows;
            
  
        }

        }

        