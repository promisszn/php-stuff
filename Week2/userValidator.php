<?php

class UserValidator{

    private $data;
    private $errors = [];
    private static $fields = ['name', 'email', 'username', 'password'];

    public function __construct($postData) {
        $this->data = $postData;
    }

    public function validateForm() {
        foreach(self::$fields as $field) {
            if(!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
        }

        $this->validateName();
        $this->validateEmail();
        $this->validateUsername();
        $this->validatePassword();
        return $this->errors;
    }

    private function validateName() {
        $val = trim($this->data['name']);

        if(empty($val)){
            $this->addError('name', 'Name is required');
        }else {
            if(!preg_match("/^[a-zA-Z-' ]*$/", $val)){
                $this->addError('name','Only letters and white space allowed');
            }
        }
    }

    private function validateEmail() {
        $val = trim($this->data['email']);

        if(empty($val)){
            $this->addError('email', 'Email is required');
        }else {
            if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
                $this->addError('email','email must be valid');
            }
        }
    }

    private function validateUsername() {
        $val = trim($this->data['username']);

        if(empty($val)){
            $this->addError('username', 'Username is required');
        }else {
            if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){
                $this->addError('username','username must be 6-12 chars');
            }
        }
    }

    private function validatePassword() {
        $val = trim($this->data['password']);

        if(empty($val)){
            $this->addError('password', 'Password is required');
        }else {
            if(strlen($val) <= '6'){
                $this->addError('password','Password must be contain at least 6 characters');
            }
        }
    }

    private function addError($key, $val) {
        $this->errors[$key] = $val;
    }

}

?>