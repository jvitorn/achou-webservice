<?php
// coneção
$conn = mysqli_connect("localhost","id10950813_crudusuario","crudusuario","id10950813_crudusuario");

    $name  = $_POST['nomeUsuario'];
    $email = $_POST['email'];
    $nascimento = $_POST['dataNascimento'];
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
        //verificando se existe algum usuario com aquele email e senha 
        if(mysqli_num_rows($query) > 0 ){
            //se existe ira disparar um erro de email cadastrado 
           $errorEmailUnique = array('msg'=>'esse email já está cadastrado em nossa base de dados');
           echo json_encode($errorEmailUnique);
           exit;
        }
        else{
            $query = "INSERT INTO usuario VALUES (0000000000,'$name','$nascimento','$email' ,'$password','user','00000000000',2)";
            mysqli_query($conn,$query);

            $respond = array('msg'=>'usuario registrado com sucesso na base de dados');
            echo json_encode($respond);
            exit; 
        }

    }else{
        $errorPasswordEmpty = array('msg'=>'insira uma senha');
        echo json_encode($errorPasswordEmpty);
        exit;
    }
    
}
else{
    $errorEmailEmpty = array('msg'=>'insira um email valido');
    echo json_encode($errorEmailEmpty);
    exit;
}
