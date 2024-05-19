<?php
        class Order{
            private $db;  
            public function __construct(){
                $this->db = new Database;

            }
            
              // ***************************************************************
            public function checkoutOrder($data,$total_pr,$total_price){
                    $this->db->query("SELECT * From orders WHERE name = :name AND number = :number AND email = :email AND
                                                                 method = :method AND place = :place AND total_pr = :total_pr AND total_price = :total_price ");
                     
                     $this->db->bind(':name',$data['name']);
                      $this->db->bind(':number',$data['number']);
                      $this->db->bind(':email',$data['email']);
                      $this->db->bind(':method',$data['method']);
                      $this->db->bind(':place',$data['addresse']);
                      $this->db->bind(':total_pr',$total_pr);
                      $this->db->bind(':total_price',$total_price);

                      $rows= $this->db->resultSet();

                    $num= $this->db->rowCount();

                
                        return $num;
            
  
        }
          // ***************************************************************
        public function registerOrder($data,$total_pr,$total_price){
            $this->db->query('INSERT INTO orders (user_id,name,number,email,method,place,total_pr,total_price) 
                                 VALUES(:user_id,:name,:number,:email,:method,:place,:total_pr,:total_price)');

                        $this->db->bind(':user_id',$_SESSION['user_id']);
                     $this->db->bind(':name',$data['name']);
                      $this->db->bind(':number',$data['number']);
                      $this->db->bind(':email',$data['email']);
                      $this->db->bind(':method',$data['method']);
                      $this->db->bind(':place',$data['addresse']);
                      $this->db->bind(':total_pr',$total_pr);
                      $this->db->bind(':total_price',$total_price);

                if($this->db->execute()){
                    return true;
                }
        }
          // ***************************************************************
        public function addOrd($data,$total_pr,$total_price){
                        $this->db->query('INSERT INTO orders (name,number,email,method,place,total_pr,total_price) 
                        VALUES(:name,:number,:email,:method,:place,:total_pr,:total_price)');

        
            $this->db->bind(':name',$data['name']);
            $this->db->bind(':number',$data['number']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':method',$data['method']);
            $this->db->bind(':place',$data['addresse']);
            $this->db->bind(':total_pr',$total_pr);
            $this->db->bind(':total_price',$total_price);

            if($this->db->execute()){
            return true;
            }

        }
          // ***************************************************************
        public function updateOrder($ps,$id){
     

                $this->db->query('UPDATE orders SET payment_status=:ps WHERE id_ord=:id')      ;

                        $this->db->bind(':ps',$ps);
                     $this->db->bind(':id',$id);
                   

                if($this->db->execute()){
                    return true;
                }
        }
          // ***************************************************************
        public function getOrders(){

            $this->db->query('SELECT * FROM `orders` ORDER BY `place_on` DESC');
           

            $rows= $this->db->resultSet();

          
                return $rows;
        }

          // ***************************************************************
        public function deletOrder($id){
            $this->db->query('DELETE FROM orders WHERE id_ord = :id');
            
            //Bind values
            $this->db->bind(':id' , $id);

          

            if($this->db->execute()){
                return true;
            }
        }

          // ***************************************************************
        public function getOrdersPending(){

            $this->db->query("SELECT * FROM orders WHERE payment_status = 'pending'");
           
            $total_pendings = 0;
            $rows= $this->db->resultSet();

            if($this->db->rowCount() > 0){
                foreach($rows as $row){
                   $total_pendings+=$row->total_price;
                }
            }

          
                return  $total_pendings;
        }

          // ***************************************************************
        public function getOrdersCompleted(){

            $this->db->query("SELECT * FROM orders WHERE payment_status = 'completed'");
           
            $total_completed = 0;
            $rows= $this->db->resultSet();

            if($this->db->rowCount() > 0){
                foreach($rows as $row){
                    $total_completed +=$row->total_price;
                }
            }

          
                return  $total_completed ;
        }
          // ***************************************************************
        public function getNumOrders(){

            $this->db->query('SELECT * FROM orders ');
           

            $rows= $this->db->resultSet();
            $num=$this->db->rowCount();
          
                return $num;
        }

          // ***************************************************************
        public function getNumOrdByMonth(){

            $this->db->query("SELECT *
            FROM orders");
            $dat=['01','02','03','04','05','06','07','08','09','10','11','12'];

            $month = date('m');
           
            $dt = "";
            $total=0;
            $rows= $this->db->resultSet();
            $i=1;
            if($this->db->rowCount() > 0){
                for($i=0;$i<$month;$i++){
                    $total=0;
                    foreach($rows as $row){
                        $timestamp = strtotime($row->place_on);
                        $date = date("m", $timestamp);
                       if($date==$dat[$i]){
                        $total+=1;
                       }
                    }
                    if($dt===""){
                        $dt=$total;
                    }
                    else{
                        $dt.=", $total";
                    }
                    
                }
               
            }

          
                return  $dt;
        }

        public function getComOrders(){

          $this->db->query('SELECT * FROM `orders` where payment_status=:ps ORDER BY `place_on` DESC');
          $this->db->bind(':ps' , "completed");

          $rows= $this->db->resultSet();

        
              return $rows;
      }

      public function getPenOrders(){

        $this->db->query('SELECT * FROM `orders` where payment_status=:ps ORDER BY `place_on` DESC');
        $this->db->bind(':ps' , "pending");

        $rows= $this->db->resultSet();

      
            return $rows;
    }
        }