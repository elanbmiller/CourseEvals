USE courseEvalsDB;
drop table courses;
create table if not exists courses ( 
	id BIGINT UNSIGNED not null auto_increment,
	courseTitle VARCHAR(255) not null,
    syllabusAccuracy DECIMAL(4, 2) unsigned zerofill, 
    responseCount DECIMAL(4, 2) unsigned zerofill, 
    descriptionAccuracy DECIMAL(4, 2) unsigned zerofill, 
    profName VARCHAR(255), 
    profQuality DECIMAL(4, 2) unsigned zerofill, 
    courseQuality DECIMAL(4, 2) unsigned zerofill, 
    textBook DECIMAL(4, 2) unsigned zerofill, 
    worldApplication DECIMAL(4, 2) unsigned zerofill, 
    examRelevance DECIMAL(4, 2) unsigned zerofill, 
    examTime DECIMAL(4, 2) unsigned zerofill, 
    fairGrade DECIMAL(4, 2) unsigned zerofill, 
    gradeConsistent DECIMAL(4, 2) unsigned zerofill, 
    gradeAggregate DECIMAL(4, 2) unsigned zerofill,
    primary key (id)
)engine = InnoDB default character set = utf8 collate = utf8_general_ci;
insert into courses (courseTitle, syllabusAccuracy, responseCount, descriptionAccuracy, profName, profQuality, courseQuality,
textBook, worldApplication, examRelevance, examTime, fairGrade, gradeConsistent,
gradeAggregate)
VALUES('CSETEST', 5.5, 5.5, 5.5, 'Name of Professor', 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5);

insert into courses (courseTitle, syllabusAccuracy, responseCount, descriptionAccuracy, profName, profQuality, courseQuality,
textBook, worldApplication, examRelevance, examTime, fairGrade, gradeConsistent,
gradeAggregate)
VALUES('Course 2', 5.5, 5.5, 5.5, 'Second Professor', 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5, 5.5);

select * from courses;
