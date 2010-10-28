<?php
class CoursesController extends AppController {

	var $name = 'Courses';
	
	
	function edit($id = null, $degreeid = false) {
		if ($id==null && empty($this->data)) {
			$this->redirect('/');
		}
		
		if (!empty($this->data)) {
			$nodate = false;
			if ($this->data['Course']['hasdate']==1) {
				// check if all fields are filled - validation would be smarter here...
				// hey, first comment! 2010-10-19 11:36p
				if (!(isset($this->data['Course']['weekday']) &&
						isset($this->data['Course']['time']) &&
						isset($this->data['Course']['duration'])
				)) {
					$nodate = true;
				}
				
			} else {
				$nodate = true;
			}
			
			if ($nodate) {				
				$this->data['Course']['weekday'] = null;
				$this->data['Course']['time'] = null;
				$this->data['Course']['duration'] = null;
			}
			
			if ($this->Course->save($this->data)) {
				if (!empty($this->data['Course']['degreeid'])) {
					$this->redirect('/degrees/edit/'.$this->data['Course']['degreeid']);
				} else {
					$this->redirect('/');
				}
			}
		}
		
		$course = $this->Course->find('first', array(
			'conditions'=>array('Course.id'=>$id),
			// 'contain'=>array(
			// 	'Degree'
			// )
		));
		
		if(isset($course['Course']['weekday']) && isset($course['Course']['time']) && isset($course['Course']['duration'])) {
			$course['Course']['hasdate'] = true;
		} else {
			$course['Course']['hasdate'] = false;
		}
		if($degreeid) {
			$this->set(compact('degreeid'));
		}
		$referer = $this->referer();
		$this->set(compact('course', 'referer'));
		
	}
	
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