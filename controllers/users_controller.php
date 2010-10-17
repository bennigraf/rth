<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $scaffold;
	
	function view($userid = null) {
		if ($userid == null) {
			$this->redirect('/users/signup');
		}
		
		$this->User->id = $userid;
		$user = $this->User->find('first', array(
			'contain'=>array(
				'Degree'
			)
		));
		
		if (empty($user['Degree'])) {
			$this->redirect('/users/setup/'.$userid);
		}
		
		$this->set(compact('user'));
	}
	
	function setup($userid = null) {
		if ($userid == null) {
			$this->redirect('/users/signup');
		}
		
		if(!empty($this->data)) {
			$user = $this->data;
			if (!empty($this->data['User']['newdegree'])) {
				$degree['Degree']['name'] = $this->data['User']['newdegree'];
				$this->User->Degree->save($degree);
				$user['Degree']['Degree'][] = $this->User->Degree->id;
			}
			$this->User->save($user);
			$this->redirect('/users/view/'.$userid);
		}
		
		$this->User->id = $userid;
		$user = $this->User->find('first', array(
			'contain'=>array(
				'Degree'
			)
		));
		$userDegrees = Array();
		foreach ($user['Degree'] as $degree) {
			$userDegrees[] = $degree['id'];
		}
		
		
		$degrees = $this->User->Degree->find('list', array(
			'recursive'=>-1
		));
		
		$this->set(compact('user', 'userDegrees', 'degrees'));
	}

}
?>