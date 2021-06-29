<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiAppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends ApiAppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['post','get']);
        $this->paginate = [
            'contain' => ['Groups']
        ];
        $users = $this->paginate($this->Users);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $users
            ],
            '_serialize' => 'result'
        ]);        
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $this->request->allowMethod(['get']);
        $user = $this->Users->get($id, [
            'contain' => ['Groups']
        ]);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $user
            ],
            '_serialize' => 'result'
        ]);        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {            
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $user
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $user->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }                    
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $this->request->allowMethod(['put','patch']);
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $user
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $user->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->set([
                'result' => [
                    'success' => true
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    '_serialize' => ''
                ]
            ]);            
        }
    }
}
