<?php
        class Admin{
            private $db;
            public function __construct(){
                $this->db = new Database;

            }
           

              // Login admin
        public function login($email,$pass){
            $this->db->query('SELECT * FROM admins WHERE email = :email');
            $this->db->bind(':email', $email);

            $row= $this->db->single();

            $hashed_password = $row->password;
            if($pass == $hashed_password){
                return $row;
            }else{
                return false;
            }

        }


             //Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM admins WHERE email = :email');
            
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
        }