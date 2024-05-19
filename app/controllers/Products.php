<?php
    class Products extends Controller{
        public function __construct(){
         $this->userModel=$this->model('Menu');
         $this->cartModel=$this->model('Cart');
        }

        // ************************************************************
        public function addProduct(){
            //Check for POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Process form

                //Sanitize POST data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


                //Init data
                $data=[
                    'name' => trim($_POST['name']),
                    'price' => trim($_POST['price']),
                    'details' => trim($_POST['details']),
                    'image' =>  $_FILES['image']['name'],
                    'image_name' =>  $_FILES['image']['tmp_name'],


                ];

                $image_folter ="../public/uploaded_img/".$data['image'];

                $nom=$_POST['name'];
                $pr_nom= $this->userModel->findProductByName($nom);
                if($pr_nom){
                    flash('aa','product is already added');
                    redirect('admins/admin_product');
                }
                else{
                    if($this->userModel->insertProduct($data)){
                        move_uploaded_file($data['image_name'] , $image_folter);
                        flash('aa',"product is added" );
                    redirect('admins/admin_product');
                    }
                    else{
                        flash('aa','sumthing went wrong');
                        redirect('admins/admin_product');
                    }
                }


            }
        }

       

        // ************************************************************
        public function getUpdatedProduct($id_pr){
          $row= $this->cartModel->getPr($id_pr);
           
          $data=[
            'prod' => $row
           
        ];
        
        
        $this->view('admins/update_admin_product',$data);

        }

        public function updateProduct(){
              //Check for POST
              if($_SERVER['REQUEST_METHOD']=='POST'){
                //Process form

                //Sanitize POST data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                

                  //Init data
                  $data=[
                    'id_pr' => trim($_POST['id_pr']),
                    'name' => trim($_POST['name']),
                    'price' => trim($_POST['price']),
                    'details' => trim($_POST['details']),
                    'image' =>  $_FILES['image']['name'],
                    'image_name' =>  $_FILES['image']['tmp_name'],


                ];
                $image_folter ="../public/uploaded_img/".$data['image'];

                if(!empty($data['image'])){
                    if($this->userModel->updatePr($data)){
                        move_uploaded_file($data['image_name'] , $image_folter);
                        flash('aa',"product is updated" );
                        redirect('admins/admin_product');
                    }

                }
                else{
                    if($this->userModel->updatePrwithoutImg($data)){
                       
                        flash('aa',"product is updated" );
                        redirect('admins/admin_product');
                    }

                }


              } 

        }
        // ************************************************************

        public function deletProduct($id){
            if($this->userModel->deletePr($id)){

                flash('aa',"product is deleted" );
                        redirect('admins/admin_product');
            }

        }

    }