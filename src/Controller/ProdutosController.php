<?php
declare(strict_types=1);

namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Produtos Controller
 *
 * @property \App\Model\Table\ProdutosTable $Produtos
 */
class ProdutosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Produtos->find();
        $produtos = $this->paginate($query);

        $this->set(compact('produtos'));

        //setando a lista de fornecedores para preencher na criação de produtos
        $fornecedoresTable = TableRegistry::getTableLocator()->get('Fornecedores');
        $fornecedores = $fornecedoresTable->find('list', [
            'keyField' => 'id_fornecedor',
            'valueField' => 'nome'
        ])->toArray();

        $this->set(compact('fornecedores'));

        // Notificações
        $hoje = date('Y-m-d');
        $amanha = date('Y-m-d', strtotime('+1 day'));

        $notificacoes = [];

        // Pouco ou nenhum estoque (limiar: 5 unidades)
        $baixoEstoque = $this->Produtos->find()
        ->where(['qtd_estoque <=' => 2])
        ->all();

        foreach ($baixoEstoque as $produto) {
            $notificacoes[] = [
                'tipo' => 'pouco_estoque',
                'mensagem' => "Produto {$produto->nome} está com pouco estoque ({$produto->qtd_estoque})",
                'cor' => 'bg-warning'
            ];
        }

        // Validade expirada
        $expirados = $this->Produtos->find()
            ->where(function ($exp) use ($hoje) {
                return $exp->lt('validade', $hoje);
            })
            ->all();

        foreach ($expirados as $produto) {
            $notificacoes[] = [
                'tipo' => 'validade_expirada',
                'mensagem' => "{$produto->nome} teve sua validade expirada",
                'cor' => 'bg-danger'
            ];
        }

        // Validade expira hoje
        $vencendoHoje = $this->Produtos->find()
            ->where(['validade' => $hoje])
            ->all();

        foreach ($vencendoHoje as $produto) {
            $notificacoes[] = [
                'tipo' => 'validade_vencendo',
                'mensagem' => "{$produto->nome} está no último dia de validade",
                'cor' => 'bg-warning'
            ];
        }   

            $this->set(compact('notificacoes'));
    }

    /**
     * View method
     *
     * @param string|null $id Produto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $produto = $this->Produtos->get($id, contain: []);
        $this->set(compact('produto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $produto = $this->Produtos->newEmptyEntity();
        if ($this->request->is('post')) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $this->set(compact('produto'));
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
        $fornecedoresTable = TableRegistry::getTableLocator()->get('Fornecedores');
        $produto = $this->Produtos->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $produto = $this->Produtos->patchEntity($produto, $this->request->getData());
                    //dd($produto->getErrors());
            if ($this->Produtos->save($produto)) {
                $this->Flash->success(__('The produto has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produto could not be saved. Please, try again.'));
        }
        $fornecedores = $fornecedoresTable->find('list', [
        'keyField' => 'id_fornecedor',
        'valueField' => 'nome'
        ])->toArray();

        $this->set(compact('produto', 'fornecedores'));
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
        $this->request->allowMethod(['post', 'delete']);
        $produto = $this->Produtos->get($id);
        if ($this->Produtos->delete($produto)) {
            $this->Flash->success(__('The produto has been deleted.'));
        } else {
            $this->Flash->error(__('The produto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
