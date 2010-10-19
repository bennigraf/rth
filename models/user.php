<?php
class User extends AppModel {
	var $name = 'User';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Gib bitte einen Benutzernamen an.'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Dieser Benutzername ist bereits vergeben.'
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Gib bitte ein Passwort an.'
			),
		),
	);
	
	var $hasMany = array(
		'Participation'
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Degree' => array(
			'className' => 'Degree',
			'joinTable' => 'degrees_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'degree_id',
			'unique' => true,
			'order' => 'Degree.name ASC'
		)
	);
}
?>