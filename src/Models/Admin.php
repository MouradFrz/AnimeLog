<?php
namespace src\Models;
class Admin
{
    private string $email;
    private string $password;
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    public function setEmail($value)
    {
        $this->email = $value;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setPassword($value)
    {
        $this->password = $value;
    }
    public function getPassword()
    {
        return $this->passowrd;
    }
}
