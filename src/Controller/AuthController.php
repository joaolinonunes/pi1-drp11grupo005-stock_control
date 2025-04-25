<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Auth Controller
 *
 */
class AuthController extends AppController
{

    public function initialize(): variant_mod
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        
    }

    public function beforeFilter(\cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    
    public function login()
    {
        $this->request->allowMethod(['post']);

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity();
            return $this->response->withType('application/json')->withStringBody(json_encode([
                'status' => 'ok',
                'message' => 'Login realizado!',
                'user' => $user,
            ]));
        }

        return $this->response->withType('application/json')->withStatus(401)->withStringBody(json_encode([
            'status' => 'erro',
            'message' => 'Credenciais inválidas!',
        ]));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Auth->find();
        $auth = $this->paginate($query);

        $this->set(compact('auth'));
    }

    /**
     * View method
     *
     * @param string|null $id Auth id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $auth = $this->Auth->get($id, contain: []);
        $this->set(compact('auth'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $auth = $this->Auth->newEmptyEntity();
        if ($this->request->is('post')) {
            $auth = $this->Auth->patchEntity($auth, $this->request->getData());
            if ($this->Auth->save($auth)) {
                $this->Flash->success(__('The auth has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The auth could not be saved. Please, try again.'));
        }
        $this->set(compact('auth'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Auth id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $auth = $this->Auth->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auth = $this->Auth->patchEntity($auth, $this->request->getData());
            if ($this->Auth->save($auth)) {
                $this->Flash->success(__('The auth has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The auth could not be saved. Please, try again.'));
        }
        $this->set(compact('auth'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Auth id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $auth = $this->Auth->get($id);
        if ($this->Auth->delete($auth)) {
            $this->Flash->success(__('The auth has been deleted.'));
        } else {
            $this->Flash->error(__('The auth could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
