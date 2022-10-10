<?php 
namespace src;
class User{
    public string $name;
    public function __construct($name)
    {
        $this->name=$name;
    }
}