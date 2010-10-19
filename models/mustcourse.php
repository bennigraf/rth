<?php
class Mustcourse extends AppModel {
	var $name = 'Mustcourse';
	var $useTable = 'courses';
	var $displayField = 'name';
	
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
			'unique' => true
		)
	);

}
?>