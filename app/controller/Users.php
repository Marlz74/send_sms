<?php
    class Users extends Controller{
        protected $userModel;
        public function __construct(){
            isloggedin()?urlRedirect('posts/index'):'';
            $this->userModel=$this->model('User');
                
        }
        public function index(){
            urlRedirect('users/signin');
        }
        
         
        public function register(){
            // check for post
            if($_SERVER['REQUEST_METHOD']=='POST'){
                
                
                $data=[
                    'name'=>sanitize_data($_POST['name']),
                    'email'=>sanitize_data($_POST['email']),
                    'password'=>$_POST['pwd'],
                    'confirm_password'=>$_POST['cpwd'],
                    'name_err'=>'',
                    'password_err'=>'',
                    'email_err'=>'',
                    'confirm_password_err'=>''
                ];
                
                
                $data['name_err']=empty($data['name'])?'Please enter your name':'';
                
                if(empty($data['email'])){
                    $data['email_err']='Please enter your email';
                }elseif($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']= 'Email has already been registered';
                }
                
                switch(true){
                    
                    case empty($data['password']):
                        $data['password_err']='Please enter your password';
                        break;
                    case strlen($data['password'])<7:
                        $data['password_err']='Please use a strong password';
                        break;
                    default:
                        $data['password_err']='';
                }

                $data['confirm_password_err']=($data['password']!=$data['confirm_password'])?'Password do not match':'';
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                    $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
                    if($this->userModel->register($data)){
                        $_SESSION['flash_alert']=true;
                        $_SESSION['flash_message']='Post uploaded sucessfully';
                        urlRedirect('users/signin');
                    }else{
                        $_SESSION['flash_alert']=null;
                        $_SESSION['flash_message']='An unexpected error occured';
                    }
                }else{
                    $this->view('users/register',$data);
                    
                }

                $data=[
                    'name'=>'',
                    'email'=>'',
                    'password'=>'',
                    'confirm_password'=>'',
                    'name_err'=>'',
                    'password_err'=>'',
                    'email_err'=>'',
                    'confirm_password_err'=>''
                ];
                
                $this->view('users/register',$data);
                
            }else{
                $data=[
                    'name'=>'',
                    'email'=>'',
                    'password'=>'',
                    'confirm_password'=>'',
                    'name_err'=>'',
                    'password_err'=>'',
                    'email_err'=>'',
                    'confirm_password_err'=>''
                ];
                $this->view('users/register',$data);

            }
                ?>
            <script src="<?php APPROOT ?>/controller/js/script.js"></script>
            <?php
        }
        public function signin(){
            // check for post
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $data=[
                    'email'=>sanitize_data($_POST['email']),
                    'password'=>$_POST['pwd'],
                    'password_err'=>'',
                    'email_err'=>''
                ];
                if(empty($data['email'])){
                    $data['email_err']='Please enter your email';
                }elseif(!$this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']= 'Email is not registered';
                }
                if(empty($data['password'])){
                    $data['password_err']='Please enter your password';
                }

                if(empty($data['email_err']) && empty($data['password_err'])){
                    $loggedin=$this->userModel->loggedin($data['email'],$data['password']);
                    if(!$loggedin){
                        $data['password_err']='Incorrect password';
                        $this->view('users/signin',$data);
                    }else{
                        $this->createUserSession($loggedin);
                    }
                    
                }else{
                    $this->view('users/signin',$data);

                }
            }else{

                $data=[
                    'email_err'=>'',
                    'password_err'=>''
                ];
                $this->view('users/signin',$data);
            }




        }
        public function createUserSession($user){
            $_SESSION['user_id']=$user->id;
            $_SESSION['user_name']=$user->name;
            $_SESSION['user_email']=$user->email;
            urlRedirect('posts/index');
        }
        public function signout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            // session_destroy();
            urlRedirect('users/signin');
        }

    }

