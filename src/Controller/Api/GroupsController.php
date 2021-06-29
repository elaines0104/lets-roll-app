<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiAppController;

/**
 * Groups Controller
 *
 * @property \App\Model\Table\GroupsTable $Groups
 *
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GroupsController extends ApiAppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['post','get']);
        $groups = $this->paginate($this->Groups);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $groups
            ],
            '_serialize' => 'result'
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $this->request->allowMethod(['get']);
        $group = $this->Groups->get($id, [
            'contain' => ['Users']
        ]);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $group
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
        $group = $this->Groups->newEntity();
        $group = $this->Groups->patchEntity($group, $this->request->getData());
        if ($this->Groups->save($group)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $group
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $group->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $this->request->allowMethod(['put','patch']);
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        $group = $this->Groups->patchEntity($group, $this->request->getData());
        if ($this->Groups->save($group)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $group
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $group->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
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
