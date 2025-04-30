<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class DashboardController extends AppController
{
    protected $modelClass = false; // desativa model automática

    public function index()
    {
        // Aqui você pode montar dados manuais ou chamadas a outras models
        // Exemplo: $dados = $this->loadModel('Usuarios')->find()->all();

        $this->set('mensagem', 'Bem-vindo à Dashboard!');
    }
}
