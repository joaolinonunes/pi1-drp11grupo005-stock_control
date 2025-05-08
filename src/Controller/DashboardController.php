<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenDate;

class DashboardController extends AppController
{
    protected $modelClass = false; // desativa model automática

    public function index()
    {
        // Aqui você pode montar dados manuais ou chamadas a outras models
        // Exemplo: $dados = $this->loadModel('Usuarios')->find()->all();

        $this->set('mensagem', 'Bem-vindo à Dashboard!');


        $hoje = FrozenDate::today();
        $notificacoes = [];

        $produtosTable = TableRegistry::getTableLocator()->get('Produtos');
        $produtos = $produtosTable->find()->all();

        //$notificacoes = $produtosTable->find()
            //->where([
                //'OR' => [
                //'qtd_estoque <' => 5,
                //'validade <=' => FrozenDate::now()->addDays(2)
                //]
            //])
            //->all();

        foreach ($produtos as $produto) {
            if ($produto->qtd_estoque !== null && $produto->qtd_estoque <= 3) {
                $notificacoes[] = [
                    'tipo' => 'pouco_estoque',
                    'mensagem' => "Produto {$produto->nome} está com pouco estoque ({$produto->qtd_estoque})",
                    'cor' => 'bg-warning',
                ];
            }

            if ($produto->validade !== null) {
                if ($produto->validade < $hoje) {
                    $notificacoes[] = [
                        'tipo' => 'validade_expirada',
                        'mensagem' => "{$produto->nome} teve sua validade expirada",
                        'cor' => 'bg-danger',
                    ];
                } elseif ($produto->validade == $hoje) {
                    $notificacoes[] = [
                        'tipo' => 'validade_expirando',
                        'mensagem' => "{$produto->nome} está no último dia de validade",
                        'cor' => 'bg-warning',
                    ];
                }
            }
        }

        $this->set(compact('notificacoes'));
    }

    
}
