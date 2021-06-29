<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiAppController;

/**
 * Places Controller
 *
 * @property \App\Model\Table\PlacesTable $Places
 *
 * @method \App\Model\Entity\Place[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlacesController extends ApiAppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['post','get']);

        $findQuery = $this->Places->find()->contain(['Categories']);
        if(!empty($this->request->getQuery()['categoryIdIn'])){
            $categoryIds = explode(',',$this->request->getQuery()['categoryIdIn']);
            $findQuery = $findQuery->matching('Categories', function($q) use ($categoryIds){
                return $q->where(['Categories.id IN' => $categoryIds]);
            });
        }

        $places = $this->paginate($findQuery);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $places
            ],
            '_serialize' => 'result'
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Place id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $this->request->allowMethod(['get']);
        $place = $this->Places->get($id, [
            'contain' => ['Categories']
        ]);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $place
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
        $place = $this->Places->newEntity();
        $place = $this->Places->patchEntity($place, $this->request->getData());
        if ($this->Places->save($place)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $place
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $place->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Place id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $this->request->allowMethod(['put','patch']);
        $place = $this->Places->get($id, [
            'contain' => ['Categories']
        ]);
        $place = $this->Places->patchEntity($place, $this->request->getData());
        if ($this->Places->save($place)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $place
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $place->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Place id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $place = $this->Places->get($id);
        if ($this->Places->delete($place)) {
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
