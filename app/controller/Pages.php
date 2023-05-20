<?php
    class Pages extends Controller{
        public function __construct(){
            
        }

        public function index(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                
                $data=[
                    'title'=>'Send SMS',
                    'phone_number'=>sanitize_data($_POST['number']),
                    'message'=>sanitize_data($_POST['message']),
                    'phone_number_err'=>isEmpty(sanitize_data($_POST['number']))?'Enter reciever phone number':'',
                    'message_err'=>isEmpty(sanitize_data($_POST['message']))?'Enter a message':''
                ];

                if(!$data['phone_number_err'] && !$data['message_err']){
                    $response=$this->sendSMS($data['phone_number'],$data['message']);
                    $data=[
                        'title'=>'Send SMS',
                        'phone_number'=>'',
                        'message'=>'',
                        'phone_number_err'=>'',
                        'message_err'=>'',
                        'status'=>$response
                    ];
                    $this->view('pages/index',$data);
                }else{
                    $this->view('pages/index',$data);    
                }

            }else{

                $data=[
                    'title'=>'Send SMS',
                    'phone_number'=>'',
                    'message'=>'',
                    'phone_number_err'=>'',
                    'message_err'=>''
                ];
                $this->view('pages/index',$data);
            }
        }

        public function about(){
            $data=[
                'title'=>'About us',
            ];
            $this->view('pages/about',$data);
        }

        public function sendSMS($phone,$message){
            $url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.getenv('API_TOKEN').'&from='.SMS_SENDER.'&to='.$phone.'&body='.$message.'&dnd=2';
            $response = file_get_contents($url);
            if($response){
                $response=json_decode($response);
                return ($response->data->status=='success')?true:false;
            }
        }
    }
    