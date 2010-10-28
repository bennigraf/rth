<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $scaffold;

	function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->fields = array(
			'username' => 'name',
			'password' => 'password'
		);
		$this->Auth->allow('signup');
		$this->Auth->loginRedirect = array('action' => 'view', $this->Auth->user('id'));
		
    }
    
	
	function login() {
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function signup() {
		if (!empty($this->data)) {
			$this->User->save($this->data);
			$this->Auth->login($this->data);
			$this->redirect(array('action'=>'view'));
		}
	}
	
	function setup($userid = null) {
		if ($this->Auth->User('id')) {
			$userid = $this->Auth->User('id');
		}
		if ($userid == null) {
			$this->redirect('/users/login');
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
		
		$user = $this->User->find('first', array(
			'conditions'=>array('User.id'=>$userid),
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
	
	
	
	
	function view($userid = null) {
		if ($this->Auth->user('id')) {
			$userid = $this->Auth->user('id');
		}
		if ($userid == null) {
			$this->redirect('/users/login');
		}

		$user = $this->User->find('first', array(
			'conditions'=>array('User.id'=>$userid),
			'contain'=>array(
				'Degree'=>array(
					'Mustcourse' => array('conditions'=>array('CoursesDegree.must' => 1)),
					'Course' => array('conditions'=>array('CoursesDegree.must' => 0))
					// 'Linkage'=>array(
					// 	'Course',
					// 	'conditions'=>array('Linkage.must'=>1)
					// )
				),
				'Participation'=>array(
					'Course'=>array(
						'Degree'
					)
				)
			)
		));
		$participations = array();
		foreach ($user['Participation'] as $participation) {
			$participations[] = array(
				'course_id'=>$participation['course_id']
			);
		}
		
		foreach ($user['Degree'] as $degk => $deg) {
			foreach ($deg['Course'] as $couk => $cou) {
				if(in_array(array('course_id'=>$cou['id']), $participations) ) {
					$user['Degree'][$degk]['Course'][$couk]['attend'] = 1;
				} else {
					$user['Degree'][$degk]['Course'][$couk]['attend'] = 0;
				}
			}
			foreach ($deg['Mustcourse'] as $mcouk => $mcou) {
				if(in_array(array('course_id'=>$mcou['id']), $participations) ) {
					$user['Degree'][$degk]['Mustcourse'][$mcouk]['attend'] = 1;
				} else {
					$user['Degree'][$degk]['Mustcourse'][$mcouk]['attend'] = 0;
				}
			}
		}
		
		if (empty($user['Degree'])) {
			$this->redirect('/users/setup/'.$userid);
		}
		
		$this->set(compact('user', 'participations'));
	}
	
	function entercourse($courseid) {
		$userid = $this->Auth->user('id');
		$participation = array(
			'user_id'=>$userid,
			'course_id'=>$courseid
		);
		if ($this->User->Participation->save($participation)) {
			$this->redirect('/users/view');
		}
	}
	
	function leavecourse($courseid) {
		$userid = $this->Auth->user('id');
		
		if ($this->User->Participation->deleteAll(
			array(
				'Participation.user_id'=>$userid,
				'Participation.course_id'=>$courseid
			)
		)) {
			$this->redirect('/users/view');
		}
	}
	
	function timetable($userid = null) {
		if ($this->Auth->user('id')) {
			$userid = $this->Auth->user('id');
		}
		if ($userid == null) {
			$this->redirect('/users/login');
		}
		
		$user = $this->User->find('first', array(
			'conditions'=>array('User.id'=>$userid),
			'contain'=>array(
				'Participation'=>array(
					'Course'=>array(
						'Degree'
					)
				)
			)
		));
		
		$courses = array();
		foreach ($user['Participation'] as $part) {
			if (!empty($part['Course']['time']) &&
				!empty($part['Course']['weekday']) &&
				!empty($part['Course']['duration'])
			) {
				$courses[$part['Course']['weekday']][$part['Course']['time']]['Course'] = $part['Course'];
			}
		}
		
		
		$this->set(compact('user', 'courses'));
		
	}
	
	function timetableics($userid = null) {
		$this->layout = 'ics';
		
		if ($this->Auth->user('id')) {
			$userid = $this->Auth->user('id');
		}
		if ($userid == null) {
			$this->redirect('/users/login');
		}
		
		$user = $this->User->find('first', array(
			'conditions'=>array('User.id'=>$userid),
			'contain'=>array(
				'Participation'=>array(
					'Course'=>array(
						'Degree'
					)
				)
			)
		));
		
		$courses = array();
		foreach ($user['Participation'] as $part) {
			if (!empty($part['Course']['time']) &&
				!empty($part['Course']['weekday']) &&
				!empty($part['Course']['duration'])
			) {
				$date = date('o-\WW').'-'.$part['Course']['weekday'];
				$time = $part['Course']['time'];
				$part['Course']['date'] = date('Y-m-d H:i:s', strtotime($date.' '.$time));
				$courses[] = $part;
			}
		}
		
		$exdates = array(
			'20101224',
			'20101225',
			'20101226',
			'20101227',
			'20101228',
			'20101229',
			'20101230',
			'20101231',
			'20110101',
			'20110102',
			'20110103',
			'20110104',
			'20110105',
			'20110106'
		);
		
		
		$this->set(compact('user', 'courses', 'exdates'));
		
	}

}
?>