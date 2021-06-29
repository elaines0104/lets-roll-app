<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CategoriesPlaces Controller
 *
 * @property \App\Model\Table\CategoriesPlacesTable $CategoriesPlaces
 *
 * @method \App\Model\Entity\CategoriesPlace[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesPlacesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Places'],
        ];
        $categoriesPlaces = $this->paginate($this->CategoriesPlaces);

        $this->set(compact('categoriesPlaces'));
    }

    /**
     * View method
     *
     * @param string|null $id Categories Place id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoriesPlace = $this->CategoriesPlaces->get($id, [
            'contain' => ['Categories', 'Places'],
        ]);

        $this->set('categoriesPlace', $categoriesPlace);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoriesPlace = $this->CategoriesPlaces->newEntity();
        if ($this->request->is('post')) {
            $categoriesPlace = $this->CategoriesPlaces->patchEntity($categoriesPlace, $this->request->getData());
            if ($this->CategoriesPlaces->save($categoriesPlace)) {
                $this->Flash->success(__('The categories place has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories place could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesPlaces->Categories->find('list', ['limit' => 200]);
        $places = $this->CategoriesPlaces->Places->find('list', ['limit' => 200]);
        $this->set(compact('categoriesPlace', 'categories', 'places'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Categories Place id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categoriesPlace = $this->CategoriesPlaces->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoriesPlace = $this->CategoriesPlaces->patchEntity($categoriesPlace, $this->request->getData());
            if ($this->CategoriesPlaces->save($categoriesPlace)) {
                $this->Flash->success(__('The categories place has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The categories place could not be saved. Please, try again.'));
        }
        $categories = $this->CategoriesPlaces->Categories->find('list', ['limit' => 200]);
        $places = $this->CategoriesPlaces->Places->find('list', ['limit' => 200]);
        $this->set(compact('categoriesPlace', 'categories', 'places'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Categories Place id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $categoriesPlace = $this->CategoriesPlaces->get($id);
        if ($this->CategoriesPlaces->delete($categoriesPlace)) {
            $this->Flash->success(__('The categories place has been deleted.'));
        } else {
            $this->Flash->error(__('The categories place could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
