USE courseEvalsDB;
-- drop table courses;
-- create table if not exists courses ( 
-- 	id BIGINT UNSIGNED not null auto_increment,
-- 	courseTitle VARCHAR(255) not null,
--     syllabusAccuracy DECIMAL(4, 2) unsigned zerofill, 
--     responseCount DECIMAL(4, 2) unsigned zerofill, 
--     descriptionAccuracy DECIMAL(4, 2) unsigned zerofill, 
--     profName VARCHAR(255), 
--     profQuality DECIMAL(4, 2) unsigned zerofill, 
--     courseQuality DECIMAL(4, 2) unsigned zerofill, 
--     textBook DECIMAL(4, 2) unsigned zerofill, 
--     worldApplication DECIMAL(4, 2) unsigned zerofill, 
--     examRelevance DECIMAL(4, 2) unsigned zerofill, 
--     examTime DECIMAL(4, 2) unsigned zerofill, 
--     fairGrade DECIMAL(4, 2) unsigned zerofill, 
--     gradeConsistent DECIMAL(4, 2) unsigned zerofill, 
--     gradeAggregate DECIMAL(4, 2) unsigned zerofill,
--     primary key (id)
-- )engine = InnoDB default character set = utf8 collate = utf8_general_ci;



-- select * from courses;

-- create users table
-- drop table users;
-- create table if not exists users (
-- 	id BIGINT UNSIGNED not null auto_increment,
-- 	username VARCHAR(255) NOT NULL,
--     passcode VARCHAR(255) NOT NULL,
-- 	primary key (id),
--     unique key (username)
-- )engine = InnoDB default character set = utf8 collate = utf8_general_ci;
-- 
-- INSERT INTO users (username, passcode)
-- VALUES ("name@name", "code");

-- SELECT * FROM users WHERE username = "name@name" and passcode = "code";
select * from users;