drop table courses;
create table if not exists courses (
	id BIGINT UNSIGNED not null auto_increment,
	courseTitle VARCHAR(255) not null,
	content DECIMAL(4, 2) unsigned zerofill,
    readingsAreUseful DECIMAL(4, 2) unsigned zerofill,
    hwsAreUseful DECIMAL(4, 2) unsigned zerofill,
    reasonableWorkload DECIMAL(4, 2) unsigned zerofill,
    goodProfFeedback DECIMAL(4, 2) unsigned zerofill,
    labsAreHelpful DECIMAL(4, 2) unsigned zerofill,
    relevant DECIMAL(4, 2) unsigned zerofill,
    examsReflectMaterial DECIMAL(4, 2) unsigned zerofill,
    enoughTimeForExams DECIMAL(4, 2) unsigned zerofill,
    gradesReflectUnderstandingMaterial DECIMAL(4, 2) unsigned zerofill,
    fairGrading DECIMAL(4, 2) unsigned zerofill,
    hoursPerWeekSpentOnCourse DECIMAL(4, 2) unsigned zerofill,
    percentOfLecturesAttended DECIMAL(4, 2) unsigned zerofill,
    wouldYouRecommendCourse DECIMAL(4, 2) unsigned zerofill,
    primary key (id)
)engine = InnoDB default character set = utf8 collate = utf8_general_ci;
insert into courses (courseTitle, content, readingsAreUseful, hwsAreUseful, reasonableWorkload, goodProfFeedback, labsAreHelpful,
relevant, examsReflectMaterial, enoughTimeForExams, gradesReflectUnderstandingMaterial, fairGrading, hoursPerWeekSpentOnCourse,
percentOfLecturesAttended, wouldYouRecommendCourse)
VALUES('CSETEST', 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5);

select * from courses;
