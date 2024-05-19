<?php
        class Menu{
            private $db;  
            public function __construct(){
                $this->db = new Database;

            }

                    // menu
        public function menu(){
            $this->db->query('SELECT * FROM menu ');
           

            $rows= $this->db->resultSet();

          
                return $rows;
            
  
        }

        // ***************************************************************

        public function findProductByName($nom){
            $this->db->query('SELECT * FROM menu WHERE nom_pr = :nom');
            
            //Bind values
            $this->db->bind(':nom' , $nom);

            $row = $this->db->single();

            //Check row
            if($this->db->rowCount() >0){
                return true;
            }else{
                return false;
            }
        }

          // ***************************************************************
        public function insertProduct($data){
            $this->db->query('INSERT INTO menu (nom_pr,details,price_pr,image) VALUES(:nom,:details,:price,:image)');


            $this->db->bind(':nom',$data['name']);
            $this->db->bind(':details',$data['details']);
            $this->db->bind(':price',$data['price']);
            $this->db->bind(':image',$data['image']);

                if($this->db->execute()){
                    return true;
                }
        }
          // ***************************************************************
        public function updatePr($data){
            $this->db->query('UPDATE menu SET nom_pr=:nom, details=:details, price_pr=:price ,image=:image WHERE id_pr=:id');

            $this->db->bind(':id',$data['id_pr']);
            $this->db->bind(':nom',$data['name']);
            $this->db->bind(':details',$data['details']);
            $this->db->bind(':price',$data['price']);
            $this->db->bind(':image',$data['image']);

                if($this->db->execute()){
                    return true;
                }
        }
          // ***************************************************************
        public function updatePrwithoutImg($data){
            $this->db->query('UPDATE menu SET nom_pr=:nom, details=:details, price_pr=:price WHERE id_pr=:id');

            $this->db->bind(':id',$data['id_pr']);
            $this->db->bind(':nom',$data['name']);
            $this->db->bind(':details',$data['details']);
            $this->db->bind(':price',$data['price']);
           

                if($this->db->execute()){
                    return true;
                }
        }

          // ***************************************************************
        public function deletePr($id){
            $this->db->query('DELETE FROM menu WHERE id_pr = :id');
            
            //Bind values
            $this->db->bind(':id' , $id);

          

            if($this->db->execute()){
                return true;
            }
        }
          // ***************************************************************
        //   get array of products
        public function getMenu(){
            $this->db->query('SELECT * FROM menu ');
           
            $cart_products=[];
            $rows= $this->db->resultSet();

            if($this->db->rowCount() > 0){
                foreach($rows as $row){
                    $cart_products[] = $row->nom_pr;
                   
                }
            }
          
                return $cart_products;
            
  
        }
         // ***************************************************************
        public function getProductByName($nom){
            $this->db->query('SELECT * FROM menu WHERE nom_pr = :nom');
            
            //Bind values
            $this->db->bind(':nom' , $nom);

            $rows= $this->db->resultSet();
            //Check row
            if($this->db->rowCount() >0){
                return $rows;
            }else{
                return false;
            }
        }
          // ***************************************************************
        public function getNumOProducts(){

            $this->db->query('SELECT * FROM menu ');
           

            $rows= $this->db->resultSet();
            $num=$this->db->rowCount();
          
                return $num;
        }
          // ***************************************************************
        public function getMenuData(){
            $this->db->query('SELECT * FROM menu ');
           
            $cart_products=[];
            $product_id=array_column($_SESSION['cart'],'product_id');
            $rows= $this->db->resultSet();

            if($this->db->rowCount() > 0){
                
                foreach($product_id as $id){
                     foreach($rows as $row){
                        if($row->id_pr== $id){
                            $cart_products[] = $row;
                        }
                        
                    }
                  
                   
                }
            }
          
                return $cart_products;
            
  
        }   
          // ***************************************************************
        public function getSessData(){
            $this->db->query('SELECT * FROM menu ');
           
            $total_pr=0;
            
            $products[]='';
            $product_id=array_column($_SESSION['cart'],'product_id');
            $rows= $this->db->resultSet();



            if($this->db->rowCount() > 0){
                
                foreach($_SESSION['cart'] as $key=>$value){
                    foreach($rows as $row){
                        if($row->id_pr== $value['product_id']){
                            $total_pr+=$value[$value['product_id']]*$row->price_pr;
                            $products[] = $row->nom_pr.' ('.$value[$value['product_id']].') ';
                            
                        }
                    }
                }
            }
            $data=[
                'cart_products'=>$products,
                'cart_total'=>$total_pr,
            ];
          
                return $data;
            
  
        }
        
        }