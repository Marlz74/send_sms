<?php
    class User{
        private $db;
        public function __construct(){
            $this->db=new Db();
        }
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email =?');
            $this->db->bind(1,$email);
            $this->db->execute();
            $this->db->singleResult();
            if($this->db->rowCount()>0){
                return true;
            }else{
                return false;
            }


        }
        public function register($data){
            $this->db->query('INSERT INTO users (`name`, `email`, `password`) VALUES (?,?,?)');
            $this->db->bind(1,$data['name']);
            $this->db->bind(2,$data['email']);
            $this->db->bind(3,$data['password']);
            return $this->db->execute()?true:false;
        }
        public function loggedin($email,$password){
            $this->db->query('SELECT * FROM users WHERE email = ?');
            $this->db->bind(1,$email);
            $this->db->execute();
            $row=$this->db->singleResult();
            if(password_verify($password,$row->password)){
                return $row;
            }else{
                return false;
            }

        }
    }