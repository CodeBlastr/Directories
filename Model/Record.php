<?php
class Record extends RecordsAppModel {

	public $name = 'Record';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Categories.Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'conditions' => 'Category.model = "Record"',
		),
	);
	
	public $hasAndBelongsToMany = array(
        'Category' => array(
            'className' => 'Categories.Category',
       		'joinTable' => 'categorized',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'category_id',
    		'conditions' => 'Categorized.model = "Record"',
    		// 'unique' => true,
        ),
        'CategoryOption' => array(
            'className' => 'Categories.CategoryOption',
       		'joinTable' => 'categorized_options',
            'foreignKey' => 'foreign_key',
            'associationForeignKey' => 'category_option_id',
    		//'unique' => true,
        ),
    );
	
	public function __construct($id = false, $table = null, $ds = null) {
    	parent::__construct($id, $table, $ds);
	   	$this->virtualFields['name'] = sprintf('CONCAT(%s.first_name, " ", %s.last_name)', $this->alias, $this->alias);
	}
    
	public function add($data) {
		$ret = false;
		
		if ($this->save($data['Record'])) {
			
			if (isset($data['Category']['Category'][0])) :
				$categorized = array('Record' => array('id' => array($this->id)));
				foreach ($data['Category']['Category'] as $catId) :
					$categorized['Category']['id'][] = $catId;
				endforeach;
				$this->Category->categorized($categorized, 'Record');
			endif;
			
			$ret = true;
		} else {
			$errors = $this->validationErrors;
			debug($errors);
			throw new Exception(__d('catalogs', 'Error: ...', true));
		}
		return $ret;
	}
    
}
?>