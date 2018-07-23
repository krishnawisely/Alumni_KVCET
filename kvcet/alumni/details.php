<?php

    class alumni{
        private $email;
        private $password;
        private $user_name;
        private $dob;
        private $age;
        private $workat;
        private $liveat;
        private $profile_pic;

        public function setEmail($email)
        {
            $this->email=$email;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public  function setPassword($password)
        {
            $this->password=$password;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function setUsername($user_name)
        {
            $this->user_name=$user_name;
        }
        public funtion getUsername()
        {
            return $this->user_name;
        }
        public function setDob($dob)
        {
            $this->dob=$dob;
        }
        public funtion getDob()
        {
            return $this->dob;
        }
        public function setAge($age)
        {
            $this->age=$age;
        }
        public funtion get()
        {
            return $this->age;
        }
        public function setWrokat($workat)
        {
            $this->workat=$workat;
        }
        public funtion getWorkat()
        {
            return $this->workat;
        }
        public function setLiveat($liveat)
        {
            $this->liveat=$liveat;
        }
        public funtion getLiveat()
        {
            return $this->liveat;
        }
        public function setProfilepic($profile_pic)
        {
            $this->profile_pic=$profile_pic;
        }
        public funtion get()
        {
            return $this->profile_pic;
        }
    }

?>