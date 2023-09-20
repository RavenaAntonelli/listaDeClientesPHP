<?php
session_start();

require_once 'db_connect.php';

function clear($input) {
    global $connect;
    $var = mysqli_escape_string($connect, $input);
    $var = htmlspecialchars($var);
    return $var;
}

$tableName = 'clientes';

if (isset($_POST['btn-cadastrar'])) {
    $databaseName = 'crud';
    $createDatabaseSQL = "CREATE DATABASE IF NOT EXISTS $databaseName";
    $createTableSQL = "CREATE TABLE IF NOT EXISTS $tableName (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            sobrenome VARCHAR(255) NOT NULL,
            idade INT
    )";

        if (mysqli_query($connect, $createTableSQL)) {
            $nome = clear($_POST['nome']);
            $email = clear($_POST['email']);
            $sobrenome = clear($_POST['sobrenome']);
            $idade = clear($_POST['idade']);

            $sql = "INSERT INTO $tableName (nome, email, sobrenome, idade) VALUES ('$nome', '$email', '$sobrenome', '$idade')";

            if (mysqli_query($connect, $sql)) {
                $_SESSION['mensagem'] = "Cadastrado com sucesso!";
                header("Location: ../index.php");
            } else {
                $_SESSION['mensagem'] = "Erro ao cadastrar!";
                header("Location: ../index.php");
            }
        } else {
            $_SESSION['mensagem'] = "Erro ao criar a tabela!";
            header("Location: ../index.php");
        }
    } else {
        $_SESSION['mensagem'] = "Erro ao criar o banco de dados!";
        header("Location: ../index.php");
    }

?>
