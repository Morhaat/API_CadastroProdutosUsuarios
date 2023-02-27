<?php

    if($acao == 'lista'){
        $db = DB::connect();
        if($param == ''){
            $rs = $db ->prepare("SELECT * FROM usuarios");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

            if($obj){
                echo json_encode([
                    "dados" => $obj,
                    "status" => true]);
            } else{
                echo json_encode([
                    "dados" => "Não existem dados!",
                    "status" => false]);
            }
        } else{
            $rs = $db ->prepare("SELECT * FROM usuarios WHERE ID = '$param' OR email = '$param'");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

            if($obj){
                echo json_encode([
                    "dados" => $obj,
                    "status" => true]);
            } else{
                $Anome = explode(',', $param);
                if(count($Anome) > 1){
                    $rs = $db ->prepare("SELECT * FROM usuarios WHERE nome LIKE '%$Anome[0]%' AND sobrenome LIKE '%$Anome[1]%'");
                }else{
                    $rs = $db ->prepare("SELECT * FROM usuarios WHERE nome LIKE '%$param%' OR sobrenome LIKE '%$param%'");   
                }
                $rs->execute();
                $obj = $rs->fetchAll(PDO::FETCH_ASSOC);
                if($obj){
                    echo json_encode([
                        "dados" => $obj,
                        "status" => true]);
                }else{
                    echo json_encode([
                        "dados" => "Não existem dados!",
                        "status" => false,
                        "count"=>count($Anome)]);
                }
            }
        }
    } else{
        echo json_encode([
            "dados" => "Caminho não encontrado",
            "status" => false]);
    }

?>