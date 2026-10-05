<?php

function conectarBanco()
{
    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'loja_estoque';

    $conn = new mysqli($host, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        throw new Exception('Não foi possível conectar ao banco de dados.');
    }

    $conn->set_charset('utf8mb4');

    return $conn;
}
