<?php
// coneção
$conn = mysqli_connect("localhost","id10950813_crudusuario","crudusuario","id10950813_crudusuario");

    
    $email = $_POST['email'];
    $password = $_POST['senha'];
    
// caso error na coneccao
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//se o email tem algo inserido
if($email){
    // se existe algo inserido no password
    if($password){
        $query = "SELECT * FROM usuario WHERE email = '$email' and senha = '$password' and ds_nivel = 'user' LIMIT 1";

        $registros =  array(
            'usuario'=>array()
        );
    
        $i = 0;
        
        //verificando se foi retornado alguma linha
        if(mysqli_num_rows($query) > 0 ){
            // captura resultado 
            $result = mysqli_query($conn,$query);
            //laço de repetição mostrando os dados
            while($linha = mysqli_fetch_assoc($result)){
                $registros['usuario'][$i] = array(
                    'id'=>$linha['cd_cpf'],
                    'name'=>$linha['nm_usuario'],
                    'email'=>$linha['nm_email'],
                    'type'=>$linha['ds_nivel'],
                    'locate'=>$linha['cd_endereco']
                );
                $i++;
            }
            // codificando para json 
            echo json_encode($registros);
        }
        else{
            // error
            $errorResult = array('msg'=>'algo de errado nao parece certo nesse login')
            echo json_encode($errorResult);
        }
            // Do something


    }
    
}
