<?php
        class Cart{
            private $db;  
            public function __construct(){
                $this->db = new Database;

            }


                       // cart
        public function cart(){
            $this->db->query("SELECT *, carts.id_cart as cartsID, 
                                        menu.id_pr as  menuId FROM carts  inner join menu on carts.pid = menu.id_pr and carts.id_user=".$_SESSION['user_id']."");
           

            $rows= $this->db->resultSet();

          
                return $rows;
            
  
        }


                  // select from menu by id
        public function getPr($id){
            $this->db->query('SELECT * FROM menu WHERE id_pr = :id');
            $this->db->bind(':id', $id);

            $row= $this->db->single();

            
                return $row;
           
        }
        // inserting cart in table carts
        public function registerCart($pid){
            $this->db->query('INSERT INTO carts (id_user,pid,quntite) VALUES(:id_user,:pid,:qt)');


            $this->db->bind(':id_user',$_SESSION['user_id']);
            $this->db->bind(':pid',$pid);
            $this->db->bind(':qt',1);

                if($this->db->execute()){
                    return true;
                }
        }

        // update cart 
        public function updateCrt($id,$qt){
            $this->db->query('UPDATE carts SET quntite=:qt WHERE id_cart=:id');


            $this->db->bind(':id',$id);
            $this->db->bind(':qt',$qt);
           

                if($this->db->execute()){
                    return true;
                }
        }
        // delete cart 
        public function deleteCart($id){
            $this->db->query('DELETE FROM carts WHERE id_user = :id');
            
            //Bind values
            $this->db->bind(':id' , $id);

          

            if($this->db->execute()){
                return true;
            }
        }

        // get number of carts for specific user
        public function getNumCart(){
            $this->db->query("SELECT * From carts Where id_user=:id");
            $this->db->bind(':id',$_SESSION['user_id']);
            $rows=  $this->db->single();

            $num= $this->db->rowCount();

          
                return $num;
            
  
        }
        // get inforamtion of product related  cart  of specific user 
        public function getInfo(){
            $this->db->query("SELECT *, carts.id_cart as cartsID, 
            menu.id_pr as  menuId FROM carts  inner join menu on carts.pid = menu.id_pr and carts.id_user=".$_SESSION['user_id']."");

            $cart_total=0;
            $cart_products[] = '';

            $rows= $this->db->resultSet();
            if($this->db->rowCount() > 0){
                foreach($rows as $row){
                    $cart_products[] = $row->nom_pr.' ('.$row->quntite.') ';
                    $sub_total = ($row->price_pr * $row->quntite);
                    $cart_total += $sub_total;
                }
            }
            $data=[
                'cart_products'=>$cart_products,
                'cart_total'=>$cart_total
            ];


                return  $data;


        }

        // 
          // delete cart 
          public function deleteCartById($id){
            $this->db->query('DELETE FROM carts WHERE id_cart = :id');
            
            //Bind values
            $this->db->bind(':id' , $id);

          

            if($this->db->execute()){
                return true;
            }
        }


        public function findPrById($id){
            $this->db->query('SELECT * FROM carts WHERE pid = :id and id_user=:user');
            
            //Bind values
            $this->db->bind(':id' , $id);
            $this->db->bind(':user' , $_SESSION['user_id']);

            $row = $this->db->single();

            //Check row
            if($this->db->rowCount() >0){
                return true;
            }else{
                return false;
            }
        }

        }