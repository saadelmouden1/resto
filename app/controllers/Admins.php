<?php
    class Admins extends Controller{
        public function __construct(){
              
            

         $this->userModel=$this->model('Admin');
         $this->usModel=$this->model('User');
         $this->menuModel=$this->model('Menu');
         $this->orderModel=$this->model('Order');
         $this->msgrModel=$this->model('Message');

        }
        // *************************************************
        // loading view for admin page
        public function admin_page(){

            // if the session admin ID  is not exist go to log in view
            if(!isset($_SESSION['admin_id'])){
                redirect('admins/login');
         
             }
             // *-------------------------------------------------------
           else{
            

            $pending=$this->orderModel->getOrdersPending();
            $completed=$this->orderModel->getOrdersCompleted();
            $numOrd=$this->orderModel->getNumOrders();
            $numPro=$this->menuModel->getNumOProducts();
            $numUsers=$this->usModel->getNumUsers();
            $numMsgs=$this->msgrModel->getNumMsgs();


            $data=[
                'pending'=>$pending,
                'completed'=> $completed,
                'numOrders'=>$numOrd,
                'numPro'=>$numPro,
                'numUsers'=>$numUsers,
                'numMsgs'=>$numMsgs
            ];

            $this->view('admins/admin_page',$data);
           }
               
            
            
        }

        // ************************************************************
        // loding view for admin product
        public function admin_product(){
            // if the session admin ID  is not exist go to log in view
            if(!isset($_SESSION['admin_id'])){
                redirect('admins/login');
         
             }
            $dishes= $this->menuModel->menu();
            
            $data=[
                'menu' => $dishes,
               
            ];
            
            $this->view('admins/admin_product',$data);
        }

         // ************************************************************
         // loding view for admin users 
        public function admin_users(){
             // if the session admin ID  is not exist go to log in view
            if(!isset($_SESSION['admin_id'])){
                redirect('admins/login');
         
             }
           $users= $this->usModel->getAllUsers();
            
            $data=[
                'users' => $users,
               
            ];
            
            $this->view('admins/admin_users',$data);
        }

         // ************************************************************
         // loding view for admin orders
        public function admin_orders(){
             // if the session admin ID  is not exist go to log in view
             if($_SERVER['REQUEST_METHOD']=='POST'){

                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                if(!isset($_SESSION['admin_id'])){
                    redirect('admins/login');
             
                 }else{
                            $dt=[
                            'filter' => trim($_POST['flt'])
                                ];

                        if($dt["filter"]=="completed"){
                            $orders= $this->orderModel->getComOrders();
                            $data=[
                                'orders' =>  $orders,
                               
                            ];
                        }
                        if($dt["filter"]=="pending"){
                            $orders= $this->orderModel->getPenOrders();
                            $data=[
                                'orders' =>  $orders,
                               
                            ];
                        }
                        $this->view('admins/admin_orders',$data);
                 }
             }else{
                if(!isset($_SESSION['admin_id'])){
                    redirect('admins/login');
             
                 }
                $orders= $this->orderModel->getOrders();
                $data=[
                    'orders' =>  $orders,
                   
                ];
    
                $this->view('admins/admin_orders',$data);
             }
           
        } 

        // ************************************************************
         // loding view for admin message

        public function admin_messages(){
             // if the session admin ID  is not exist go to log in view
            if(!isset($_SESSION['admin_id'])){
                redirect('admins/login');
         
             }
            $messages= $this->msgrModel->getMessages();
            $data=[
                'messages' =>  $messages,
               
            ];

            $this->view('admins/admin_messages',$data);
        }
        
        // ************************************************************
         //login
         public function login(){
            //Check for POST
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Process form

                //Sanitize POST data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


                //Init data
                $data=[
                    'email' => trim($_POST['email']),
                    'pass' => trim($_POST['pass']),
                    'email_err' => '',
                    'pass_err' => '',

                ];

                 //Validate Email
                  if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }

                 //Validate Password
                 if(empty($data['pass'])){
                    $data['pass_err'] = 'Please enter password';
                }

                //Check for user/email
                if($this->userModel->findUserByEmail($data['email'])){
                    //User found

                  
                }else{
                    $data['email_err']='No admin found';
                }


                  //Make sure errors are empty
                  if(empty($data['email_err']) &&  empty($data['pass_err']) ){
                    //Validated
                    //Check and set logged in user
                    $loggedInUser=$this->userModel->login($data['email'], $data['pass']);

                    if($loggedInUser){
                        //Create Session
                        $this->createAdminSession($loggedInUser);
                    }else{
                        $data['pass_err']='admin password incorrect';
                        $this->view('admins/login',$data);
                    }
                }
                else{
                    //Load the view

                    $this->view('admins/login',$data);
                }


            }else{
                //Init data
                $data=[
                    
                    'email' => '',
                    'pass' => '',
                    'email_err' => '',
                    'pass_err' => ''

                ];

                //Load view
                $this->view('admins/login',$data);
            }


        }
         // ************************************************************
         //creat admin  session
         public Function createAdminSession($admin){
            $_SESSION['admin_id']=$admin->id_admin;
            $_SESSION['admin_email']=$admin->email;
            $_SESSION['admin_name']=$admin->nom;

            redirect('admins/admin_page');
        }
        // ************************************************************
          //logout for admin
          public function logout(){
            unset($session['admin_id']);
            unset($session['admin_email']);
            unset($session['admin_name']);
            
            session_destroy();
            redirect('Admins/login');
        }

        // ************************************************************
        // controler delete user
        public function deleteUsers($id){
      
            
            if($this->usModel->deleteUser($id)){
                flash('aa','user is deleted' );
                            redirect('admins/admin_users');

            }
        }
        // ************************************************************
        // public function isAdminLoggedin(){
        //     if(isset($session['Admin_id'])){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }

    }