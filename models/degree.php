<?php
class Degree extends AppModel {
	var $name = 'Degree';
	var $displayField = 'name';
	var $order = 'Degree.name ASC';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Darf nicht leer sein!',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'degrees_users',
			'foreignKey' => 'degree_id',
			'associationForeignKey' => 'user_id',
			'unique' => true
		),		
		'Course' => array(
			'className' => 'Course',
			'joinTable' => 'courses_degrees',
			'foreignKey' => 'degree_id',
			'associationForeignKey' => 'course_id',
			'unique' => true,
			'order' => 'Course.name ASC'
		),
		'Mustcourse' => array(
			'className' => 'Mustcourse',
			'joinTable' => 'courses_degrees',
			'foreignKey' => 'degree_id',
			'associationForeignKey' => 'course_id',
			'unique' => true,
			'order' => 'Mustcourse.name ASC'
		)
	);

}
?>