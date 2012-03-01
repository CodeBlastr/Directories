<?php
class RecordsController extends RecordsAppController {

	public $name = 'Records';
	public $uses = 'Records.Record';
	
	function index($letter = null) {
		$this->Record->recursive = -1;

		$this->paginate['fields'] = array(
			'Record.id',
			'Record.first_name',
			'Record.last_name',
			'Record.name',
			'Record.state',
			'Record.phone1',
			);

		$records = $this->paginate();
		
		$this->set('records', $records); 
		$this->set('letter', $letter); 
		$this->set('displayName', 'name');
		$this->set('displayDescription', ''); 
		$this->set('page_title_for_layout', 'Directory');
	}
	
	/* Function Search
	 * get results according to filled values
	 */
	function search(){
		$records = array();
		
		if (!empty($this->request->data)) {
			$categorized = array();
			
			//if category selected then find records for the category
			if(!empty($this->request->data['Category']['id'])) {
				$categorized = $this->Record->Category->Categorized->find('all', array(
				'conditions' => array(
					'Categorized.category_id' => $this->request->data['Category']['id'],
					'Categorized.model' => 'Record',
					),
				));
				$categorized = Set::extract('/Categorized/foreign_key', $categorized);	
			}

			//creating conditions according to filled values
			$conditions = array(); 
			
			if(!empty($this->request->data['Record']['first_name'])) {
				$conditions['Record.first_name like'] = $this->request->data['Record']['first_name'];
			}
			 
			if(!empty($this->request->data['Record']['street_address_1'])) {
				$conditions['Record.street_address_1 like'] = $this->request->data['Record']['street_address_1'];
			}
				
			if(!empty($this->request->data['Record']['city'])) {
				$conditions['Record.city like'] = $this->request->data['Record']['city'];
			}
			if(!empty($this->request->data['Record']['state'])) {
				$conditions['Record.state like'] = $this->request->data['Record']['state'];
			}
			if(!empty($this->request->data['Record']['phone1'])) {
				$conditions['Record.phone1 like'] = $this->request->data['Record']['phone1'];
			}
			if(!empty($categorized)) {
				$conditions['Record.id'] = $categorized;
			}

			$this->Record->recursive = 0;
			$this->paginate['conditions'] = $conditions ;
			$this->paginate['limit'] = 10 ;
			$records = $this->paginate();			
		}
		
		$categories = $this->Record->Category->find('list', array('conditions' => 
						'Category.model = "Record"'));
		
		$this->set(compact('categories', 'records'));
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid contact directory', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Record->recursive = 0;
		$this->set('contactDirectory', $this->Record->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Record->create();
			if ($this->Record->add($this->request->data, $this->Auth->user('id'))) {
				$this->Session->setFlash(__('The contact directory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact directory could not be saved. Please, try again.', true));
			}
		}
		
		$categories = $this->Record->Category->generateTreeList(array(
						'Category.model = "Record"', 
						'Category.parent_id is null'));
		
		$this->set(compact('categories'));
	}

	function get_records($id = null, $limit = 20, $model = 'Record'){

		if (!empty($model)) {		
			$categorized = $this->Record->Category->Categorized->find('all', array(
				'conditions' => array(
					'Categorized.category_id' => $id,
					'Categorized.model' => $model,
					),
				));
			$categorized = Set::extract('/Categorized/foreign_key', $categorized);
		}

		$records = $this->Record->find('all', array('conditions' => array(
					'Record.id' => $categorized), 'limit' => $limit, 'recursive' => -1));
		
		return $records;
	}
	
	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid contact directory', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Record->save($this->request->data)) {
				$this->Session->setFlash(__('The contact directory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact directory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Record->read(null, $id);
		}
		$users = $this->Record->User->find('list');
		$categories = $this->Record->Category->find('list');
		$this->set(compact('users', 'categories', 'creators', 'modifiers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for contact directory', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Record->delete($id)) {
			$this->Session->setFlash(__('Contact directory deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Contact directory was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}