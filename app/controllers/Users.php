<?php
    class Users extends Controller{
        public $userModel;
        public $cartModel;
        public function __construct(){
         $this->userModel=$this->model('User');
         $this->cartModel=$this->model('Cart');
        }
        // ************************************************************
        public function register(){

              //Check for POST
              if($_SERVER['REQUEST_METHOD']=='POST'){
                //Process form

                //Sanitize POST data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
               
                // $name=trim($_POST['name']);
                // $email=trim($_POST['email']);
                // $pass=trim($_POST['pass']);
                // $cpass=trim($_POST['cpass']);
                // //Init data
                $data=[
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'pass' => trim($_POST['pass']),
                    'cpass' => trim($_POST['cpass']),
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'cpass_err' => ''

                ];
                // *---------------------------------------------
                // if($pass != $cpass){

                //     echo'<script>alert("hello")</script>';

                // }
                // else{
                //     if($this->userModel->register($name,$email,$pass)){
                //         echo'<script>alert("done successfully")</script>';
                //         redirect('pages/register');

                //     }
                    
                // }
                // *------------------------------------------------

               

                //Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }else{
                    //Chek email
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken ';
                    }
                }

                 //Validate Name
                 if(empty($data['name'])){
                    $data['name_err'] = 'Please enter name';
                }

                 //Validate Password
                 if(empty($data['pass'])){
                    $data['pass_err'] = 'Please enter password';
                }elseif(strlen($data['pass']) < 6){
                    $data['pass_err'] = 'Password must be at leaset 6 characters';
                }

                //Validate Conform Password
                if(empty($data['cpass'])){
                    $data['cpass_err'] = 'Please confirm password';
                }else{
                    if($data['pass'] != $data['cpass']){
                        $data['cpass_err'] = 'Password do not match';
                    }
                }

                //Make sure errors are empty
                if(empty($data['email_err']) && empty($data['name_err']) && empty($data['pass_err']) && empty($data['cpass_err']) ){
                    //Validated

                    //Hash Password
                    $data['pass']=password_hash($data['pass'],PASSWORD_DEFAULT);

                    //Register User
                    if($this->userModel->register($data)){
                        flash('register_success','you are registred and can log in');
                       redirect('users/login');
                    }else{
                        die("somthing went wrong");
                    }
                    

                }
                else{
                    //Load the view

                    $this->view('pages/register',$data);
                }

              }else{
                //Init data
                $data=[
                    'name' => '',
                    'email' => '',
                    'pass' => '',
                    'cpass' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'cpass_err' => ''

                ];

                //Load view
                $this->view('pages/register',$data);
                
            }

            
           
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
                    $data['email_err']='No user found';
                }


                  //Make sure errors are empty
                  if(empty($data['email_err']) &&  empty($data['pass_err']) ){
                    //Validated
                    //Check and set logged in user
                    $loggedInUser=$this->userModel->login($data['email'], $data['pass']);

                    if($loggedInUser){
                        //Create Session
                        $this->createUserSession($loggedInUser);
                        $_SESSION['num_carts']=$this->cartModel->getNumCart();

                    }else{
                        $data['pass_err']='password incorrect';
                        $this->view('pages/login',$data);
                    }
                }
                else{
                    //Load the view

                    $this->view('pages/login',$data);
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
                $this->view('pages/login',$data);
            }


        }
        // ************************************************************
        //creat user session
        public Function createUserSession($user){
            $_SESSION['user_id']=$user->id_user;
            $_SESSION['user_email']=$user->email;
            $_SESSION['user_name']=$user->nom;

            
            redirect('pages/index');
        }
       // ************************************************************
        //logout
        public function logout(){
            
          
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);

            
          
            
            redirect('pages/index');
        }

        // ************************************************************
        // is loggedin

        public function isLoggedin(){
            if(isset($session['user_id'])){
                return true;
            }else{
                return false;
            }
        }



    }