<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiAppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends ApiAppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['post','get']);
        $findQuery = $this->Products->find()->contain(['Categories']);
        if(!empty($this->request->getQuery()['categoryIdIn'])){
            $categoryIds = explode(',',$this->request->getQuery()['categoryIdIn']);
            $findQuery = $findQuery->matching('Categories', function($q) use ($categoryIds){
                return $q->where(['Categories.id IN' => $categoryIds]);
            });
        }
        $products = $this->paginate($findQuery);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $products
            ],
            '_serialize' => 'result'
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id)
    {
        $this->request->allowMethod(['get']);
        $product = $this->Products->get($id, [
            'contain' => ['Categories']
        ]);
        $this->set([
            'result' => [
                'success' => true,
                'data' => $product
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
        $product = $this->Products->newEntity();
        $product = $this->Products->patchEntity($product, $this->request->getData());
        if ($this->Products->save($product)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $product
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $product->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $this->request->allowMethod(['put','patch']);
        $product = $this->Products->get($id, [
            'contain' => ['Categories']
        ]);
        $product = $this->Products->patchEntity($product, $this->request->getData());
        if ($this->Products->save($product)) {
            $this->set([
                'result' => [
                    'success' => true,
                    'data' => $product
                ],
                '_serialize' => 'result'
            ]);
        } else {
            $this->set([
                'result' => [
                    'success' => false,
                    'errors' => $product->getErrors()
                ],
                '_serialize' => 'result'
            ]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
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
