<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiAppController;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends ApiAppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['post','get']);

        $findQuery = $this->Events->find()->contain(['Categories']);
        if(!empty($this->request->getQuery()['categoryIdIn'])){
            $categoryIds = explode(',',$this->request->getQuery()['categoryIdIn']);
            $findQuery = $findQuery->matching('Categories', function($q) use ($categoryIds){
                return $q->where(['Categories.id IN' => $categoryIds]);
            });
        }

        $events = $this->paginate($findQuery);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $events
            ],
            '_serialize' => 'result'
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $this->request->allowMethod(['get']);
        $event = $this->Events->get($id, [
            'contain' => ['Categories']
        ]);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $event
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
        $event = $this->Events->newEntity();
        $event = $this->Events->patchEntity($event, $this->request->getData());
        if ($this->Events->save($event)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $event
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $event->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $this->request->allowMethod(['put','patch']);
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        $event = $this->Events->patchEntity($event, $this->request->getData());
        if ($this->Events->save($event)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $event
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $event->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
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
