<?php
class CoursesController extends AppController {

	var $name = 'Courses';
	
	
	function addfordegree($degreeid) {
		
		if (!empty($this->data)) {
			if (!empty($this->data['Course']['name'])) {
				$coursedata = array('Course'=>array('name'=>$this->data['Course']['name']));
				$coursedata['Degree']['Degree'][] = array(
					'degree_id' => $this->data['Degree']['Degree'], 
					'must' => $this->data['CoursesDegree']['must']
				);	
				$this->Course->create();
				if ($this->Course->save($coursedata)) {
					$this->redirect('/degrees/edit/'.$degreeid);
				}
			} else {
				$coursedata = array('Course'=>array('id'=>$this->data['Course']['id']));
				$coursedata['Degree']['Degree'][] = array(
					'degree_id' => $this->data['Degree']['Degree'], 
					'must' => $this->data['CoursesDegree']['must']
				);	
				if ($this->Course->addAssoc($this->data['Course']['id'], 'Degree', $coursedata['Degree']['Degree'])) {
					$this->redirect('/degrees/edit/'.$degreeid);
				}
			}
		}
		
		$degree = $this->Course->Degree->find('first', array(
			'conditions'=>array('Degree.id'=>$degreeid),
			'contain'=>array(
				'Course'
			)
		));
		$degreesCourses = array();
		foreach ($degree['Course'] as $course) {
			$degreesCourses[] = $course['id'];
		}
		$unlinkedCourses = $this->Course->find('list', array(
			'conditions'=>array(
				'Course.id NOT IN ('.implode(',', $degreesCourses).')'
			)
		));
		
		$this->set(compact('degree', 'unlinkedCourses'));
	}
	
	function freewilly($courseid, $degreeid) {
		$this->Course->CoursesDegree->updateAll(
			array('must' => 0), 
			array('CoursesDegree.course_id'=>$courseid, 'CoursesDegree.degree_id'=>$degreeid)
		);
		$this->redirect('/degrees/edit/'.$degreeid);
	}
	
	function makemust($courseid, $degreeid) {
		$this->Course->CoursesDegree->updateAll(
			array('must' => 1), 
			array('CoursesDegree.course_id'=>$courseid, 'CoursesDegree.degree_id'=>$degreeid)
		);
		$this->redirect('/degrees/edit/'.$degreeid);
	}
	
	
}
?>