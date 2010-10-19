<?php
class DegreesController extends AppController {

	var $name = 'Degrees';

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->redirect('/');
		}
		if (!empty($this->data)) {
			
		}
		
		$degree = $this->Degree->find('first', array(
			'conditions'=>array('Degree.id'=>$id),
			'contain'=>array(
				'Mustcourse' => array('conditions'=>array('CoursesDegree.must' => 1)),
				'Course' => array('conditions'=>array('CoursesDegree.must' => 0))
			)
		));
		
		$this->set(compact('degree'));
	}
	
	function delcourse($degreeid, $courseid) {
		if ($this->Degree->CoursesDegree->deleteAll(
				array(
					'CoursesDegree.degree_id'=>$degreeid,
					'CoursesDegree.course_id'=>$courseid
				)
			)) {
			$this->redirect('/degrees/edit/'.$degreeid);
		}
	}

}
?>