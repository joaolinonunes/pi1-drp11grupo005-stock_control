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
            if ($produto->qtd_estoque !== null && $produto->qtd_estoque <= 2) {
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
                } elseif ($produto->validade <= $hoje->addDays(2)) {
                    $notificacoes[] = [
                        'tipo' => 'validade_expirando',
                        'mensagem' => "{$produto->nome} está nos últimos dias de validade",
                        'cor' => 'bg-warning',
                    ];
                }
            }
        }

            // Contar produtos com pouco estoque (3 ou menos)
            $qtdPoucoEstoque = $produtosTable->find()
            ->where(['qtd_estoque <=' => 2])
            ->count();

            // Contar produtos com validade expirada (antes de hoje)
            $qtdValidadeExpirada = $produtosTable->find()
            ->where(function ($exp, $q) use ($hoje) {
                return $exp->lt('validade', $hoje);
            })
            ->count();

            // Contar produtos com validade próxima (hoje ou nos próximos 2 dias)
            $qtdValidadeProxima = $produtosTable->find()
            ->where(function ($exp, $q) use ($hoje) {
                return $exp->between('validade', $hoje, $hoje->addDays(2));
            })
            ->count();

            // Contar produtos
            $total = $produtosTable->find()
            ->count();


        $this->set(compact('notificacoes',
                            'qtdPoucoEstoque',
                            'qtdValidadeExpirada',
                            'qtdValidadeProxima',
                            'total'));
    }

    public function produtos(string $tipo = null): void
    {
    $this->request->allowMethod(['get']);
    $this->viewBuilder()->setLayout('ajax');
    $tipo = $this->request->getQuery('tipo');

    $produtosTable = TableRegistry::getTableLocator()->get('Produtos');
    $produtos = [];

    if ($tipo === 'pouco_estoque') {
        $produtos = $produtosTable->find()
            ->where(['qtd_estoque <=' => 2])
            ->all();
    } elseif ($tipo === 'validade_expirada') {
        $hoje = FrozenDate::today();
        $produtos = $produtosTable->find()
            ->where(function ($exp, $q) use ($hoje) {
                return $exp->lt('validade', $hoje);
            })->all();
    } elseif ($tipo === 'validade_proxima') {
        $hoje = FrozenDate::today();
        $proximo = $hoje->addDays(7);
        $produtos = $produtosTable->find()
            ->where(function ($exp, $q) use ($hoje, $proximo) {
                return $exp->between('validade', $hoje, $proximo);
            })->all();
    } else {
        $produtos = $produtosTable->find()->all();
    }

    $this->set(compact('produtos'));
    }


    public function filtroProdutos($tipo)
    {
        $this->request->allowMethod(['get']);
        $produtosTable = TableRegistry::getTableLocator()->get('Produtos');
        $hoje = FrozenDate::today();

            switch ($tipo) {
                case 'total':
                    $produtos = $produtosTable->find()->all();
                break;
                case 'pouco_estoque':
                    $produtos = $produtosTable->find()->where(['qtd_estoque <=' => 3])->all();
                break;
                case 'validade_expirada':
                    $produtos = $produtosTable->find()->where(function ($exp, $q) use ($hoje) {
                    return $exp->lt('validade', $hoje);
                     })->all();
                break;
                case 'validade_proxima':
                    $produtos = $produtosTable->find()->where(function ($exp, $q) use ($hoje) {
                    return $exp->between('validade', $hoje, $hoje->addDays(2));
                     })->all();
                break;
            default:
            $produtos = [];
            }

        $this->set(compact('produtos', 'tipo'));
        $this->render('ajax/filtro_produtos');
    }

    /**
     * Edit method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $produtosTable = TableRegistry::getTableLocator()->get('Produtos');
        $fornecedoresTable = TableRegistry::getTableLocator()->get('Fornecedores');
        $produto = $produtosTable->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $produto = $produtosTable->patchEntity($produto, $this->request->getData());
            if ($produtosTable->save($produto)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'produtos']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }

        // Busca a lista de fornecedores para o dropdown
        $fornecedores = $fornecedoresTable->find('list', [
        'keyField' => 'id_fornecedor',
        'valueField' => 'nome'
        ])->toArray();

        $this->set(compact('produto', 'fornecedores'));
        $this->viewBuilder()->setTemplate('/Produtos/edit');  // Adicione esta linha para usar o mesmo template edit() de produtosController
    }

    /**
     * Delete method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $produtosTable = TableRegistry::getTableLocator()->get('Produtos');

        $this->request->allowMethod(['post', 'delete']);
        $produto = $produtosTable->get($id);
        if ($produtosTable->delete($produto)) {
            $this->Flash->success(__('The produto has been deleted.'));
        } else {
            $this->Flash->error(__('The produto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'produtos']);
    }

    
}
