<?php
session_start();
require_once 'db_connect.php';

if(isset($_POST['btn-editar'])):
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $sobrenome = mysqli_escape_string($connect, $_POST['sobrenome']);
    $idade = mysqli_escape_string($connect, $_POST['idade']);
    $id = mysqli_escape_string($connect, $_POST['id']);
    var_dump($nome, $email, $sobrenome, $idade);
    $sql = "UPDATE clientes SET nome ='$nome', email ='$email', sobrenome ='$sobrenome', idade ='$idade' WHERE id = '$id'";

    if(mysqli_query($connect, $sql)):
        $_SESSION['mensagem'] = "Atualizado com sucesso!";
        header("Location: ../index.php");
    else:
        $_SESSION['mensagem'] = "Erro ao atualizar!";
        header("Location: ../index.php");
    endif;

endif;






