<?php
    class Carts extends Controller{
        public function __construct(){
            $this->userModel=$this->model('Cart');
        }

        // ************************************************************
        // controler adding carts 
        public function cart($id_pr){
             //    if the user is log in
            if(isLoggedin()){
               if($this->userModel->findPrById($id_pr)){
                flash('aa','product is allready in cart');
                        redirect('pages/index');
               } 
               else{
                if($this->userModel->registerCart($id_pr)){
                    flash('aa','product is added to cart');
                    redirect('pages/index');
                }
               }
               
               
            
            
            }   
             //    if the user is not  log in
            else{

                if(isset($_SESSION['cart'])){

                    $item_array_id=array_column($_SESSION['cart'],'product_id');

                  

                    if(in_array($id_pr,$item_array_id)){
                        flash('aa','product is allready in cart');
                        redirect('pages/index');
                    }else{
                        $count=count($_SESSION['cart']);
                        $item_array=[
                            'product_id'=>$id_pr,
                            $id_pr=>1
                            
    
                        ];
                        $_SESSION['cart'][$count]=$item_array;
                        flash('aa','product is added to cart');
                        redirect('pages/index');

                    }
                    // unset($_SESSION['cart']);
                  

                }
                else{
                    
                    // starting array
                    $item_array=[
                        'product_id'=>$id_pr,
                        $id_pr=>1
                        

                    ];

                    $_SESSION['cart'][0]=$item_array;
                    flash('aa','product is added to cart');
                    redirect('pages/index');

                 
                  
                    
                }




                // redirect('pages/index');
            }
            
        }
        // ************************************************************
        // upadte cart for register users
        public function updateCart(){
            //Check for POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Process form

                //Sanitize POST data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $id = $_POST['cart_id'];
                $qt= $_POST['cart_quantity'];

                if($this->userModel->updateCrt($id,$qt)){
                    flash('aa','carts is updated');
                    redirect('pages/cart');
                }

                
        }
      }
      // ************************************************************
      // delete  cart for register users
      public function deleteAllCarts($id){
        if($this->userModel->deleteCart($id)){
            flash('aa','carts is deleted');
            redirect('pages/cart');
        }
      }

      public function ptc(){
          echo $_SESSION['num_carts'];
      }
        //****************************************************************** 
        public function deletFromCart($id){
            
            if($this->userModel->deleteCartById($id)){
                flash('aa','product is deleted from cart');
                redirect('pages/cart');
            }

        } 
       // ************************************************************
      // delete session cart

      public function deletFromSession($id){
        
        foreach($_SESSION['cart'] as $key=>$value){
            if($value['product_id'] == $id){
                unset($_SESSION['cart'][$key]);
                flash('aa','product deleted');
            redirect('pages/cart');
            }
        }
      }
      public function deleteAllSession(){
        unset($_SESSION['cart']);
        flash('aa','products deleted');
            redirect('pages/cart');
      }
        // ************************************************************
      // update session cart

      public function updateSession($id,$vl){
        // *--------------------------------------------
        // echo $vl;
        // echo '<br>';

    //   foreach($_SESSION['cart'] as $cr=>$value){
    //     if($value['product_id']==$id){
    //      $_SESSION['cart'][$cr][$id]=$vl;
    //     }
    //   }
    //   flash('aa','carts is updated');
    //   redirect('pages/cart');

    //  echo $vl;
    //     echo '<br>';
     // *--------------------------------------------

      foreach($_SESSION['cart'] as $cr=>$value){
        if($value['product_id']==$id){
            $_SESSION['cart'][$cr][$value['product_id']]=$vl;
                }
      
      }
     
          flash('aa','carts is updated');
      redirect('pages/cart');
   

        
      }

    }