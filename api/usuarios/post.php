<?php

    if($acao == 'adiciona'){
        if($param == ''){
            $checkUser = $_POST['usuario'];
            $checkMail = $_POST['email'];
            $db = DB::connect();
            $rs = $db ->prepare("SELECT * FROM usuarios WHERE usuario = '$checkUser' OR email = '$checkMail'");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);
            if(!$obj){
                $sql = "INSERT INTO usuarios(";

                $contador = 1;
                foreach(array_keys($_POST) as $indice){
                    if(count($_POST) > $contador){
                        $sql .= "{$indice},";
                    }
                    else{
                        $sql .= "{$indice}";
                    }
                    $contador++;
                }
                $sql .= ")VALUES(";

                $contador = 1;
                foreach(array_values($_POST) as $valor){
                    if(count($_POST) > $contador){
                        $sql .= "'{$valor}',";
                    }
                    else{
                        $sql .= "'{$valor}'";
                    }
                    $contador++;
                }
                $sql .= ")";
                $rs = $db ->prepare($sql);
                $exec = $rs->execute();

                if($exec){
                    echo json_encode([
                        "dados" => "Dados gravados com sucesso!",
                        "status" => true]);
                }else{
                    echo json_encode([
                        "dados" => "Erro no banco de dados, informações não gravadas!",
                        "status" => false]);
                }
            }else{
                echo json_encode([
                    "dados" => "usuario e/ou email já existente!",
                    "status" => false]);
            }
        } else{
            echo json_encode([
                "dados" => "Caminho inválido!",
                "status" => false]);
        }
    } else{
        echo json_encode([
            "ERRO" => "Caminho não encontrado!",
            "status" => false]);
    }

?>