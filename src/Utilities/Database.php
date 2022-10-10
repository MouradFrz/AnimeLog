<?php

namespace src\Utilities;

use PDO;

class Database{
    public static function connect(){
        return new PDO('mysql:host=127.0.0.1:3310;dbname=animelog','root','mourad');
    }
}