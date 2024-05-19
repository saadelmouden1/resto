<?php
    class Pages extends Controller{
        public function __construct(){
            // if(!isLoggedin()){
            //     redirect('users/login');
        
            // }
            $this->userModel=$this->model('Menu');
            $this->cartModel=$this->model('Cart');
        }


        // loading index view
        public function index(){

         
           
            // view if the user is log in 
                if(isLoggedin()){
                  
                    
                    $dishes= $this->userModel->menu();
                    $num= $this->cartModel->getNumCart();
            
                    $data=[
                        'menu' => $dishes,
                        'title' => 'is logged in',
                        'num'=>$num
                    ];
                    $this->view('pages/index',$data);
                   
        
            }
             // view if the user is not log in 
            else{
               
                $num='';
                
                $dishes= $this->userModel->menu();
                if(isset($_SESSION['cart'])){
                    $num= count($_SESSION['cart']);
                   
                }else{
                    $num= '0';
                }
            
                    $data=[
                        'menu' => $dishes,
                        'title' => 'fuck',
                        'num'=>$num
                    ];
                    $this->view('pages/index',$data);
                
            }
            
            
          
        }
        // *************************************************************
        // public function about(){
        //     $this->view('pages/about',['title' => 'about']);
        // }

         // *************************************************************
        // loading view cart 
        public function cart(){
            // view if the user is log in 
            if(isLoggedin()){
                $num=' ';

           
            $dishes= $this->cartModel->cart();
            $num= $this->cartModel->getNumCart();
          
            $data=[
                'cart' => $dishes,
                'num'=>$num
            ];
            
            
            $this->view('pages/cart',$data);
            }
            // view if the user is not log in 
            else{

                $num=' ';

           
                
                if(isset($_SESSION['cart'])){
                    $num= count($_SESSION['cart']);
                    $dishes= $this->userModel-> getMenuData();
                }else{
                    $num= '0';
                }
               
              
                $data=[
                    'cart' => $dishes,
                    'num'=>$num
                ];
                
                
                $this->view('pages/cart',$data);


            }
            
            
        }

        // ************************************************************

        // get the products name for searche part

        public function pst($str){
            $products[]='';
           $products= $this->userModel->getMenu();
            $q=$str;

            $suggestion = "";

            // Get Suggestions
            if($q !== ""){
                $q = strtolower($q);
                $len = strlen($q);
                foreach($products as $pro){
                    if(stristr($q, substr($pro, 0, $len))){
                        if($suggestion === ""){
                            $suggestion = $pro;
                        } else {
                            $suggestion .= ",$pro";
                        }
                    }
                }

                
            }
            else{
                $suggestion='';
            }
            echo $suggestion;
           
        }
         // ************************************************************
        // the checkout if the user is log in

        public function checkout(){

            if(isLoggedIn()){
                  
                    $num=' ';
                   

                    $dishes= $this->cartModel->cart();
                    $num= $this->cartModel->getNumCart();
                    
                    $data=[
                        'cart' => $dishes,
                        'num'=>$num
                    ];


                    $this->view('pages/checkout', $data);
            }
            
          
        }
         // ************************************************************
        // the checkout if the user is not log in
        public function checkoute($gt){
            if(!isLoggedIn()){
                $num=' ';
                $dishes= $this->userModel->menu();
                
                if(isset($_SESSION['cart'])){
                    $num= count($_SESSION['cart']);
                    
                }else{
                    $num= '0';
                }


                $data=[
                    'cart' => $dishes,
                    'gt' => $gt,
                    'num'=>$num
                ];


                $this->view('pages/checkout', $data);


            }

        }

      // ************************************************************
       // loading  search view 
        public function search($name){
           
            if(isLoggedIn()){
                $num=' ';

           
           
                $num= $this->cartModel->getNumCart();
    
                $prod=$this->userModel->getProductByName($name);
    
                if($prod){
                    $data=[
                        'prod' => $prod,
                        'num'=>$num
                    ];
                    
                    
                    $this->view('pages/search_product',$data);
    
                }
            }
            else{

                $num=' ';

           
                
                if(isset($_SESSION['cart'])){
                    $num= count($_SESSION['cart']);
                    
                }else{
                    $num= '0';
                }
               
              
                $prod=$this->userModel->getProductByName($name);
    
                if($prod){
                    $data=[
                        'prod' => $prod,
                        'num'=>$num
                    ];
                    
                    
                    $this->view('pages/search_product',$data);
    
                }


            }
           
        }
    }