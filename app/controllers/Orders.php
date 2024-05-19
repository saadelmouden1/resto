<?php
    class Orders extends Controller{
        public function __construct(){
            $this->orderModel=$this->model('Order');
            $this->cartModel=$this->model('Cart');
            $this->menuModel=$this->model('Menu');
        }
         //  controler adding order
        public function addOrder(){

            //Check for POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Process form

                //Sanitize POST data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data=[
                    'name'=>$_POST['name'],
                    'number'=>$_POST['number'],
                    'email'=>$_POST['email'],
                    'method'=>$_POST['method'],
                    'addresse'=>'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code'],
                    'placed_on'=>date('d-M-Y')

                ];
                $cart_total = 0;
                $cart_products[] = '';
            //    if the user is log in
                
                if(isLoggedin()){
                    $info=$this->cartModel->getInfo();
                        if( $info){
                            $total_products = implode(', ',$info['cart_products']);
                            

                        $num_rows = $this->orderModel->checkoutOrder($data, $total_products , $info['cart_total']);

                            if($info['cart_total'] == 0){
                                flash('aa',"your cart is empty!" );
                                redirect('pages/checkout');
                            }elseif($num_rows){
                            
                                flash('aa','order placed already!' );
                                
                                redirect('pages/checkout');
                            }else{
                                if($this->orderModel->registerOrder($data, $total_products , $info['cart_total']) and  $this->cartModel->deleteCart($_SESSION['user_id'])){
                                    flash('aa','order placed' );
                                    redirect('pages/checkout');
                                }
                            }


                        }

            }
             //    if the user is not log in
            else{
              
                $var=$this->menuModel->getSessData();
                $total_products = implode(', ',$var['cart_products']);
            
                    
               $rg= $this->orderModel->addOrd($data,$total_products,$var['cart_total']);
               if($rg){
                unset($_SESSION['cart']);
                flash('aa','order placed' );
                redirect('pages/index');
               }
          
                
            }
            }


        }
        // ************************************************************
        // controler update order
        public function updateOrders(){
             //Check for POST
             if($_SERVER['REQUEST_METHOD']=='POST'){
                //Process form

                //Sanitize POST data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                

                  //Init data
                  $id=$_POST['order_id'];

                $ps=$_POST['upd'];

                    if($this->orderModel->updateOrder($ps,$id)){
                        flash('aa','order is updated' );
                            redirect('admins/admin_orders');
                    }
                


              } 


        }
        // ************************************************************
              // controler delete oreder
        public function deleteOrders($id_ord){

            
            if($this->orderModel->deletOrder($id_ord)){
                flash('aa','order is deleted' );
                 redirect('admins/admin_orders');
            }
        }
        // ************************************************************
        // get data for chart
        public function chart(){

            $b="";
            $a=$this->orderModel->getNumOrdByMonth();

            $b=(string) $a;
            
            echo $a;
            
        }
    }