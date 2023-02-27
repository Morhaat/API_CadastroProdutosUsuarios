<?php
    class DB{
        public static function connect(){
            $host = '127.0.0.1';
            $user = 'root';
            $pass = '';
            $base = 'base1';

            return new PDO("mysql:host={$host};dbname={$base};charset=UTF8;",$user,$pass);
        }
    }

?>