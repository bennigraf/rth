<?php
class Course extends AppModel {
	var $name = 'Course';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Dieser Kurs existiert bereits.'
			)
		),
	);
	
	var $hasMany = array(
		'Participation'
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Degree' => array(
			'className' => 'Degree',
			'joinTable' => 'courses_degrees',
			'foreignKey' => 'course_id',
			'associationForeignKey' => 'degree_id',
			'unique' => true,
			'order' => 'Degree.name ASC'
		)
	);

}
?>