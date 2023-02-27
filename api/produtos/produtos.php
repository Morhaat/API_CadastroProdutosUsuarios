<?php
    if($api == 'produtos'){
        if($method == 'GET'){
            include_once "get.php";            
        }
        else if ($method == 'POST'){
            if (isset($_POST['_method'])){
                switch ($_POST['_method']) {
                    case 'PUT':
                        include_once "put.php"; 
                        break;

                    case 'DELETE':
                        include_once "del.php"; 
                        break;
                }           
            }else{
                include_once "post.php";
            }
        }
    }
?>