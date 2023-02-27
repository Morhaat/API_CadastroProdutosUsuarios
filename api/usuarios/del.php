<?php

    if($acao == 'delete'){
        if($param != ''){
            $db = DB::connect();
            $rs = $db ->prepare("SELECT * FROM usuarios WHERE ID = {$param}");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

            if($obj){
                $rs = $db ->prepare("DELETE FROM usuarios WHERE ID = {$param} ");
                $exec = $rs->execute();

                if($exec){
                    echo json_encode([
                        "dados" => "Dados excluídos com sucesso!",
                        "status" => true]);
                }else{
                    echo json_encode([
                        "dados" => "Erro ao excluir dados",
                        "status" => false]);
                }
            }else{
                echo json_encode([
                    "dados" => "Dados não localizados para exclusão!",
                    "status" => false]);
            }
        } else{
            echo json_encode([
                "dados" => "Dados necessários para exclusão pendentes!",
                "status" => false]);
        }
    } else{
        echo json_encode([
            "dados" => "Caminho não encontrado!",
            "status" => false]);
    }

?>