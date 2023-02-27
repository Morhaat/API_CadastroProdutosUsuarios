<?php

    if($acao == 'lista'){
        $db = DB::connect();
        if($param == ''){
            $rs = $db ->prepare("SELECT * FROM produtos");
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
            $rs = $db ->prepare("SELECT * FROM produtos WHERE id_produto = '$param'");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

            if($obj){
                echo json_encode([
                    "dados" => $obj,
                    "status" => true]);
            } else{
                $rs = $db ->prepare("SELECT * FROM produtos WHERE nome_produto LIKE '%$param%'");
                $rs->execute();
                $obj2 = $rs->fetchAll(PDO::FETCH_ASSOC);
                if($obj2){
                    echo json_encode([
                        "dados" => $obj2,
                        "status" => true]);
                }else{
                    echo json_encode([
                        "dados" => "Não existem dados!",    
                        "status" => false]);
                }
            }
        }
    } else{
        echo json_encode([
            "dados" => "Caminho não encontrado",
            "status" => false]);
    }

?>