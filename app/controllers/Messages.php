<?php
    class Messages extends Controller{
        public function __construct(){
          
         $this->msgModel=$this->model('Message');

        }
        // iserting message 
        public function insertMsg(){
               //Check for POST
               if($_SERVER['REQUEST_METHOD']=='POST'){
                //Process form

                //Sanitize POST data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


                //Init data
                $data=[
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'number' => trim($_POST['number']),
                    'message' => trim($_POST['message'])
                    
                    

                ];
                //    if the user is log in
                if(isLoggedin()){
                    if($this->msgModel->insertMessage($data)){
                        flash('aa','message is inserted');
                        redirect('pages/index');
                    }
                }
                //    if the user is not log in
                else{
                    if($this->msgModel->insertMsg($data)){
                        flash('aa','message is inserted');
                        redirect('pages/index');
                    }
                }

        }


    }

    // delete message 
    public function deteleMessage($id_ms){
       

        if($this->msgModel->deleteMsg($id_ms)){
            flash('aa','message is deleted' );
             redirect('admins/admin_messages');
        }
    }

    }  