<?php
$senha = '1234';
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
echo $senha_hash;
