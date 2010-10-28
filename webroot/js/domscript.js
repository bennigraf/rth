$("#CourseEditForm").livequery(function(){
	var form = this;
	$('#CourseHasdate', form).change(function(){
		if ($('#CourseHasdate', form).is(':checked') ) {
			$("#CourseWeekday, #CourseTime, #CourseDuration").parent().show();
		} else {
			$("#CourseWeekday, #CourseTime, #CourseDuration").parent().hide();
		};
	}).change();
});