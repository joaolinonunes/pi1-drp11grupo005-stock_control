<?php
require 'vendor/autoload.php';

use Authentication\PasswordHasher\DefaultPasswordHasher;

$hasher = new DefaultPasswordHasher();
echo $hasher->hash('654321'); // Altere aqui para a senha desejada