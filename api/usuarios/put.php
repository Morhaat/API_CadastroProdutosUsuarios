<?php

    if($acao == 'update'){
        if($param != ''){
            array_shift($_POST);
            $sql = "UPDATE usuarios SET ";

                $contador = 1;
                foreach(array_keys($_POST) as $indice){
                    if(count($_POST) > $contador){
                        $sql .= "{$indice} = '{$_POST[$indice]}',";
                    }
                    else{
                        $sql .= "{$indice} = '{$_POST[$indice]}' ";
                    }
                    $contador++;
                }
                $sql .= "WHERE id = {$param} ";

                $db = DB::connect();
                $rs = $db ->prepare("SELECT * FROM usuarios WHERE id = {$param}");
                $rs->execute();
                $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

                if($obj){
                    $rs = $db ->prepare($sql);
                    $exec = $rs->execute();

                    if($exec){
                        echo json_encode([
                            "dados" => "Dados atualizados com sucesso!",
                            "status" => true]);
                    }else{
                        echo json_encode([
                            "ERRO" => "Erro ao atualizar dados",
                            "status" => false]);
                    }
                }else{
                    echo json_encode([
                        "ERRO" => "Dados não localizados para atualização!",
                        "status" => false]);
                }

        } else{
            echo json_encode([
                "ERRO" => "Dados necessários para atualização pendentes!",
                "status" => false]);
        }
    } else{
        echo json_encode([
            "ERRO" => "Caminho não encontrado",
            "status" => false]);
    }

?>