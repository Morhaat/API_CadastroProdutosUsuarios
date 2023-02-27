<?php
    if($acao == 'adiciona'){
        if($param == ''){
            $codBarra = $_POST['codbarra'];
            $nome = $_POST['nome_produto'];
            $db = DB::connect();
            $rs = $db ->prepare("SELECT * FROM produtos WHERE codbarra = '{$codBarra}' OR nome_produto = '{$nome}'");
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_ASSOC);
            if(!$obj){
                $sql = "INSERT INTO produtos(";

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
                    "dados" => "código de barra e/ou nome do produto já existente!", 
                    "status" => false]);
            }
        } else{
            echo json_encode([
                "dados" => "Caminho inválido!", 
                "status" => false]);
        }
    } else{
        echo json_encode([
            "dados" => "Caminho não encontrado!", 
            "status" => false]);
    }

?>