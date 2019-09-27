DROP DATABASE IF EXISTS aggie_access;

CREATE DATABASE aggie_access;

USE aggie_access;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE author (
  author_id INT(5) NOT NULL,
  author_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (author_id)
);

INSERT INTO author
  (author_id, author_name)
VALUES
  (1,'Robert Boylestad'),
  (2,'Dewayne Brown'),
  (3,'Jason Eckert'),
  (4,'Tony Gaddis'),
  (5,'Ramez Elmasri'),
  (6,'Sasha Vodnik'),
  (7,'Daniel Mittleman'),
  (8,'Jack Gido'),
  (9,'Jenny Preece'),
  (10,'Todd Lammle'),
  (11,'Carl Chatfield');

CREATE TABLE award (
  award_id INT(10) NOT NULL,
  banner_id INT(9) NOT NULL,
  school_year_id INT(5) NOT NULL,
  fund_id INT(5) NOT NULL,
  fall_amount DECIMAL(7,2) NOT NULL,
  spring_amount DECIMAL(7,2) NOT NULL,
  PRIMARY KEY (award_id),
  FOREIGN KEY (banner_id) REFERENCES users(banner_id),
  FOREIGN KEY (school_year_id) REFERENCES school_year(school_year_id),
  FOREIGN KEY (fund_id) REFERENCES fund(fund_id)
);

INSERT INTO award
  (award_id, banner_id, school_year_id, fund_id, fall_amount, spring_amount)
VALUES
  (1,123456789,1,1,500.00,500.00),
  (2,123456789,1,2,2000.00,2000.00),
  (3,123456789,1,3,1000.00,1000.00),
  (4,123456789,2,2,1000.00,1000.00),
  (5,123456789,2,3,500.00,500.00),
  (6,987654321,1,2,1500.00,1500.00),
  (7,987654321,1,3,700.00,700.00),
  (8,987654321,2,2,800.00,800.00);

CREATE TABLE classification (
  classification_id INT(1) NOT NULL,
  classification_title VARCHAR(255) NOT NULL,
  level_id INT(1) NOT NULL,
  PRIMARY KEY (classification_id),
  FOREIGN KEY (level_id) REFERENCES course_level(level_id)
);

INSERT INTO classification
  (classification_id, classification_title, level_id)
VALUES
  (1,'Freshman',1),
  (2,'Sophomore',1),
  (3,'Junior',1),
  (4,'Senior',1),
  (5,'Graduate',2);

CREATE TABLE college (
  college_id INT(3) NOT NULL,
  college_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (college_id)
);

INSERT INTO college
  (college_id, college_name)
VALUES
  (1,'College of Agriculture and Environmental Sciences'),
  (2,'College of Arts, Humanities, and Social Sciences'),
  (3,'College of Business and Economics'),
  (4,'College of Education'),
  (5,'College of Engineering'),
  (6,'College of Health and Human Sciences'),
  (7,'College of Science and Technology'),
  (8,'Joint School of Nanoscience and Nanoengineering');

CREATE TABLE course (
  course_id INT(5) NOT NULL,
  course_number INT(3) NOT NULL,
  course_title VARCHAR(255) NOT NULL,
  course_description TEXT NOT NULL,
  department_id INT(5) NOT NULL,
  subject_id VARCHAR(4) NOT NULL,
  credit_hours DECIMAL(2,1) NOT NULL,
  level_id INT(1) NOT NULL,
  prerequisite_id INT(9) DEFAULT NULL,
  corequisite_id INT(9) DEFAULT NULL,
  isbn VARCHAR(13) DEFAULT NULL,
  PRIMARY KEY (course_id),
  FOREIGN KEY (department_id) REFERENCES department(department_id),
  FOREIGN KEY (subject_id) REFERENCES subject(subject_id),
  FOREIGN KEY (level_id) REFERENCES course_level(level_id),
  FOREIGN KEY (prerequisite_id) REFERENCES course(course_id),
  FOREIGN KEY (corequisite_id) REFERENCES course(course_id),
  FOREIGN KEY (isbn) REFERENCES textbook(isbn)
);

INSERT INTO course
  (course_id, course_number, course_title, course_description, department_id, subject_id, credit_hours, level_id, prerequisite_id, corequisite_id, isbn)
VALUES
  (1,101,'Microcomputer Applications','This course is designed to provide the student with basic computer skills as required in a typical business and technical environment. Emphasis is on business and technical software packages including spreadsheets, database management, word-processing, etc. as run on a Windows platform.',35,'26',3.0,1,NULL,NULL,''),
  (2,112,'Electric Circuits I','This course is a study of the fundamentals of direct current electrical circuits. Topics include series, parallel, series-parallel networks, Ohm\'s Law, Kirchhoff\'s Laws, network theorems, and practical applications.',35,'26',3.0,1,NULL,4,'9780133923605'),
  (3,120,'Fundamentals of Technology','This course provides the quantitative background needed in the field of electronics, computer, and information technology. Topics include arithmetic review, algebra, basic trigonometry, complex algebra, statistics, and Boolean algebra and fundamental units, as they relate to electronics, information and computer technology.',35,'26',3.0,1,NULL,NULL,'9781583902301'),
  (4,122,'Electric Circuits I Laboratory','In this laboratory, students will conduct experiments on direct current electrical circuits. Topics include: series and parallel networks, Ohm’s Law, Kirchoff’s Law, network theorems, and practical DC circuit applications.',35,'26',1.0,1,NULL,2,'9780133923605'),
  (5,130,'Introduction to Unix/Linux','The course will cover network management utilizing various Unix products, such as Linux and Solaris operating systems. Topics will include networking operating system (NOS) setup, network resource management, user and group management, and the security model.',35,'26',3.0,1,NULL,NULL,'9781305107168'),
  (6,140,'Introduction to Computer Programming','This course gives an introduction to computer programming. Topics include structured program development and the use of a high level programming language to develop software applications.',35,'26',3.0,1,NULL,7,'9780134543666'),
  (7,150,'Introduction to Computer Programming Laboratory','In this laboratory, students will apply the concepts and practices learned in the programming lecture by completing relevant programs with a practical or information technology focus.',35,'26',1.0,1,NULL,6,'9780134543666'),
  (8,225,'Computer Database Management I','This course focuses on the study of relational database management systems. Topics include conceptual data model, logical data model, schema normalization and query languages.',35,'26',3.0,1,NULL,10,'9780133970777'),
  (9,231,'Web Systems','This course provides integration of graphic communication application, the principles and elements of graphic design, and streamlined workflow for students to design and develop Web sites using Web development software. This course explores the fundamentals of Web design principles and elements. Students will develop dynamic, interactive, and multimedia Web sites.',35,'26',3.0,1,NULL,NULL,'9781305394049'),
  (10,235,'Computer Database Management I Laboratory','In this laboratory, students focus exclusively on the design and system issues related to distribution database systems via conducting experiments and projects. Students learn the usage of different design strategies for distributed databases; they study query processing techniques and algorithms, as well as transaction management and concurrency control concepts used in such systems. Additionally, design and implementation issues related to multi-database systems are discussed. Finally, the course focuses on applying the techniques learned in the course to commercial database management systems.',35,'26',1.0,1,NULL,8,'9780133970777'),
  (11,240,'Applied Java Programming','The course provides a comprehensive overview of basic programming concepts, the Java programming language using an object-oriented approach, and the software development life cycle. The course emphasizes problem solving and good practices for program construction, documentation, testing, and debugging.',35,'26',3.0,1,6,NULL,'9780134462011'),
  (12,285,'Economic and Social Impacts of Information Technology','This course is designed to access critically the institutional forces that shape and create the demand for Information Technology (IT). It also discusses how the consumption of new technologies impacts the economy and society. This course also helps students to think critically about the ethics of new technologies and their impact on society in a climate of ever-changing social and economic conditions.',35,'26',3.0,1,NULL,NULL,'9781260180282'),
  (13,300,'Introduction to Project Management for Information Technology Professionals','This course introduces the concept of project management to information technology majors. It will also teach students to create work breakdown structures, identify task dependencies and prerequisites, and identify a critical path to completion of a project.',35,'26',3.0,1,NULL,NULL,'9781337095471'),
  (14,315,'Network Security for Information Technology Professionals','This course focuses on basic concepts in network security. It aims to introduce students to the fundamental techniques used in implementing secure network communications, and to give them an understanding of common threats and attacks, as well as some practical experience in attacking and defending networked systems.',35,'26',3.0,1,NULL,NULL,''),
  (15,317,'Human Computer Interaction','The study of human-computer interaction enables system architects to design useful, efficient, and enjoyable computer interfaces. This course teaches the theory, design procedure, and programming practices behind effective human interaction with computers, and – a particular focus this quarter: smart phones and tablets.',35,'26',3.0,1,NULL,NULL,'9781119020752'),
  (16,325,'Computer Database Management II','This course is a continuation of CST 225. Topics include advanced query languages, query processing and optimization, transaction processing, concurrency control, backup and recovery, indexing and replication.',35,'26',3.0,1,8,NULL,'9780133970777'),
  (17,329,'Computer Networking I','This course introduces the student to Local Area Networks (LAN) and introduction to Wide Area Networks (WAN). The course also will provide the basic understanding of network concepts and router programming.',35,'26',3.0,1,NULL,19,'9781119288282'),
  (18,330,'Computer Networking II','This course covers the advanced study of Local Area Networks (LAN) and Wide Area Networks (WAN). The students will develop competences in designing and implementing enterprise-wide networks using routers and switches.',35,'26',3.0,1,17,NULL,'9781119288282'),
  (19,339,'Computer Networking I Laboratory','In this laboratory, students will conduct experiments with and simulations on Local Area Networks (LANs) and Wide Area Networks (WANs). This course also presents lab projects involving a basic understanding of network concepts and router programming.',35,'26',1.0,1,NULL,17,'9781119288282'),
  (20,340,'Introduction to Mainframe Operations','This course is an introduction to mainframe operations including concepts and functions of the OS/MVS operating system. Topics include virtual storage, Job Control Language (JCL), data management, data set organization, compilers, and linkage editor. Additional, topics include the study of instream data sets, portioned data sets, temporary and cataloged sequential data sets, and cataloged procedures.',35,'26',3.0,1,6,NULL,''),
  (21,430,'Linux Systems Administration','This course presents the fundamental knowledge and skills needed to install, manage, and maintain a Linux Operating System. Students will learn to install the system, add users, configure devices, and maintain system security.',35,'26',3.0,1,5,NULL,''),
  (22,460,'System Integration and Architecture','Examines the issues related to system integration. Topics include: data integration, business process integration, integration architecture, middleware, system security, and system management.',35,'26',3.0,1,NULL,NULL,''),
  (23,496,'Senior Colloquium','This course provides a forum for dialogue among students, industry, and academia. It will address the processes and skills needed for becoming a successful professional in the information technology field.',35,'26',1.0,1,NULL,NULL,''),
  (24,498,'Senior Project I: A Capstone Experience','Students are required to complete projects that demonstrate a comprehensive understanding of basic concepts taught throughout the curriculum. Each project will be accompanied by a formal report on the project. Students will also make regular presentations of project status. Proficiency in effective technical writing, technical presentation and project management skills are emphasized.',35,'26',3.0,1,NULL,NULL,'9780735669116'),
  (25,499,'Senior Project II: A Capstone Experience','Students are required to complete projects that demonstrate a comprehensive understanding of basic concepts taught throughout the curriculum. Each project will be accompanied by a formal report on the project. Students will also make regular presentations of project status. Proficiency in effective technical writing, technical presentation and project management skills are emphasized.',35,'26',3.0,1,24,NULL,'9780735669116');

CREATE TABLE course_level (
  level_id INT(1) NOT NULL,
  level_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (level_id)
);

INSERT INTO course_level
  (level_id, level_name)
VALUES
  (1,'Undergraduate'),
  (2,'Graduate');

CREATE TABLE course_type (
  type_id INT(1) NOT NULL,
  type_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (type_id)
);

INSERT INTO course_type
  (type_id, type_name)
VALUES
  (1,'On-Campus'),
  (2,'Online');

CREATE TABLE degree (
  degree_id INT(5) NOT NULL,
  degree_title VARCHAR(255) NOT NULL,
  level_id INT(1) NOT NULL,
  PRIMARY KEY (degree_id),
  FOREIGN KEY (level_id) REFERENCES course_level(level_id)
);

INSERT INTO degree
  (degree_id, degree_title, level_id)
VALUES
  (1,'Bachelor of Arts',1),
  (2,'Bachelor of Science',1),
  (3,'Bachelor of Fine Arts',1),
  (4,'Bachelor of Science in Nursing',1),
  (5,'Master of Arts',2),
  (6,'Master of Arts in Education',2),
  (7,'Master of Arts in Teaching',2),
  (8,'Master of Business Administration',2),
  (9,'Master of Science',2),
  (10,'Master of Science in Administration',2),
  (11,'Master of Social Work',2);

CREATE TABLE department (
  department_id INT(5) NOT NULL,
  department_name VARCHAR(255) NOT NULL,
  college_id INT(3) NOT NULL,
  PRIMARY KEY (department_id),
  FOREIGN KEY (college_id) REFERENCES college(college_id)
);

INSERT INTO department
  (department_id, department_name, college_id)
VALUES
  (1,'Agribusiness, Applied Economics and Agriscience Education',1),
  (2,'Animal Sciences',1),
  (3,'Family and Consumer Sciences',1),
  (4,'Natural Resources and Environmental Design',1),
  (5,'English',2),
  (6,'History and Political Science',2),
  (7,'Journalism and Mass Communication',2),
  (8,'Liberal Studies',2),
  (9,'Criminal Justice',2),
  (10,'Visual and Performing Arts',2),
  (11,'Accounting and Finance',3),
  (12,'Business Education',3),
  (13,'Economics',3),
  (14,'Management',3),
  (15,'Marketing and Supply Chain Management',3),
  (16,'Administration and Instructional Services',4),
  (17,'Counseling',4),
  (18,'Educator Preparation',4),
  (19,'Leadership Studies and Adult Education',4),
  (20,'Civil, Architectural and Environmental Engineering',5),
  (21,'Chemical, Biological and Bio Engineering',5),
  (22,'Computer Science',5),
  (23,'Computational Science and Engineering',5),
  (24,'Electrical and Computer Engineering',5),
  (25,'Industrial and Systems Engineering',5),
  (26,'Mechanical Engineering',5),
  (27,'Human Performance and Leisure Studies',6),
  (28,'School of Nursing',6),
  (29,'Psychology',6),
  (30,'Social Work and Sociology',6),
  (31,'Applied Engineering Technology',7),
  (32,'Biology',7),
  (33,'Built Environment',7),
  (34,'Chemistry',7),
  (35,'Computer Systems Technology',7),
  (36,'Applied Science and Technology',7),
  (37,'Graphic Design Technology',7),
  (38,'Mathematics',7),
  (39,'Physics',7),
  (40,'Nanoengineering',8);

CREATE TABLE fund (
  fund_id INT(5) NOT NULL,
  fund_title VARCHAR(255) NOT NULL,
  PRIMARY KEY (fund_id)
);

INSERT INTO fund
  (fund_id, fund_title)
VALUES
  (1,'Federal Pell Grant'),
  (2,'UNC Need Based Grant'),
  (3,'Campus Based Tuition Fund');

CREATE TABLE grades (
  grade_id INT(10) NOT NULL,
  registration_id INT(10) NOT NULL,
  letter_grade VARCHAR(2) DEFAULT NULL,
  PRIMARY KEY (grade_id),
  FOREIGN KEY (registration_id) REFERENCES registration(registration_id),
  FOREIGN KEY (letter_grade) REFERENCES grading_scale(letter_grade)
);

INSERT INTO grades
  (grade_id, registration_id, letter_grade)
VALUES
  (1,1,'A'),
  (2,2,'B-'),
  (3,3,'A'),
  (4,4,'C'),
  (5,5,'A'),
  (6,6,'A'),
  (7,7,'A-'),
  (8,8,'D'),
  (9,9,'A');

CREATE TABLE grading_scale (
  letter_grade VARCHAR(2) NOT NULL,
  quality_points DECIMAL(2,1) NOT NULL,
  PRIMARY KEY (letter_grade)
);

INSERT INTO grading_scale
  (letter_grade, quality_points)
VALUES
  ('A',4.0),
  ('A-',3.7),
  ('B+',3.3),
  ('B',3.0),
  ('B-',2.7),
  ('C+',2.3),
  ('C',2.0),
  ('C-',1.7),
  ('D+',1.3),
  ('D',1.0),
  ('F',0.0);

CREATE TABLE instructor (
  instructor_id INT(9) NOT NULL,
  first_name VARCHAR(255) NOT NULL,
  middle_initial CHAR(1) DEFAULT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  office_location VARCHAR(255) DEFAULT NULL,
  office_phone CHAR(10) DEFAULT NULL,
  department_id INT(5) NOT NULL,
  PRIMARY KEY (instructor_id),
  FOREIGN KEY (department_id) REFERENCES department(department_id)
);

INSERT INTO instructor
  (instructor_id, first_name, middle_initial, last_name, email, office_location, office_phone, department_id)
VALUES
  (1,'Dewayne','R','Brown','dbrown@ncat.edu','Price Hall 206','3362853140',35),
  (2,'Gina','L','Bullock','glbulloc@ncat.edu','Smith Hall 3004','3362853103',35),
  (3,'Karreem','A','Hogan','kahogan@ncat.edu','Price Hall 201-D','3363347717',35),
  (4,'Anthony','C','Joyner','acjoyner@ncat.edu','Price Hall 203','3362853135',35),
  (5,'Catina','A','Lynch','calynch@ncat.edu','Price Hall 203','3362853135',35),
  (6,'Kathryn','J','Moland','kjmoland@ncat.edu','Price Hall 201-E-3','3362853135',35),
  (7,'Rahmira','S','Rufus','rsrufus@ncat.edu','Price Hall 203','3362853135',35),
  (8,'Mariama','O','Sidibe','moumarou@ncat.edu','Price Hall 213','3362853105',35),
  (9,'Evelyn','R','Sowells','sowells@ncat.edu','Price Hall 201 E-4','3362853145',35),
  (10,'Li-Shiang','','Tsay','ltsay@ncat.edu','Smith Hall 4017','3362853146',35),
  (11,'Peter','M','Udo','pnudo@ncat.edu','Price Hall 210','3362853141',35),
  (12,'Qingan','','Zeng','qzeng@ncat.edu','Price Hall 203','3362853093',35);

CREATE TABLE major (
  major_id INT(5) NOT NULL,
  major_title VARCHAR(255) NOT NULL,
  degree_id INT(5) NOT NULL,
  department_id INT(5) NOT NULL,
  PRIMARY KEY (major_id),
  FOREIGN KEY (degree_id) REFERENCES degree(degree_id),
  FOREIGN KEY (department_id) REFERENCES department(department_id)
);

INSERT INTO major
  (major_id, major_title, degree_id, department_id)
VALUES
  (1,'Accounting',2,11),
  (2,'Adult Education',9,19),
  (3,'Agricultural & Environmental Systems',2,1),
  (4,'Agricultural & Environmental Systems',9,1),
  (5,'Agricultural Education',2,1),
  (6,'Agricultural Education',9,1),
  (7,'Animal Science',2,2),
  (8,'Applied Engineering Technology',2,31),
  (9,'Applied Mathematics',9,38),
  (10,'Architectural Engineering',2,20),
  (11,'Atmospheric Sciences & Meteorology',2,39),
  (12,'Bioengineering',2,21),
  (13,'Bioengineering',9,21),
  (14,'Biological Engineering',2,4),
  (15,'Biology',2,32),
  (16,'Biology',9,32),
  (17,'Business Administration',8,12),
  (18,'Business Education',2,12),
  (19,'Chemical Engineering',2,21),
  (20,'Chemical Engineering',9,21),
  (21,'Chemistry',2,34),
  (22,'Chemistry',9,34),
  (23,'Child Development & Family Studies',2,3),
  (24,'Civil Engineering',2,20),
  (25,'Civil Engineering',9,20),
  (26,'Computational Science & Engineering',9,23),
  (27,'Computer Engineering',2,24),
  (28,'Computer Science',2,22),
  (29,'Computer Science',9,22),
  (30,'Construction Management',2,33),
  (31,'Criminal Justice',2,9),
  (32,'Economics',2,13),
  (33,'Electrical Engineering',2,24),
  (34,'Electrical Engineering',9,24),
  (35,'Electronics Technology',2,35),
  (36,'Elementary Education',2,16),
  (37,'Elementary Education',6,18),
  (38,'English',1,5),
  (39,'English & African American Literature',5,5),
  (40,'Environmental Health & Safety',2,33),
  (41,'Family & Consumer Sciences',2,3),
  (42,'Finance',2,11),
  (43,'Food & Nutritional Sciences',2,3),
  (44,'Food & Nutritional Sciences',9,3),
  (45,'Geomatics',2,33),
  (46,'Graphic Communication Systems',2,37),
  (47,'History',1,6),
  (48,'Industrial & Systems Engineering',2,25),
  (49,'Industrial & Systems Engineering',9,25),
  (50,'Information Technology',2,35),
  (51,'Information Technology',9,35),
  (52,'Instructional Technology',9,16),
  (53,'Journalism & Mass Communication',2,7),
  (54,'Laboratory Animal Science',2,2),
  (55,'Landscape Architecture',2,4),
  (56,'Liberal Studies',1,8),
  (57,'Management',2,14),
  (58,'Marketing',2,15),
  (59,'Mathematics',2,38),
  (60,'Mechanical Engineering',2,26),
  (61,'Mechanical Engineering',9,26),
  (62,'Mental Health Counseling',9,17),
  (63,'Motorsports Technology',2,31),
  (64,'Music',1,10),
  (65,'Nanoengineering',9,40),
  (66,'Nursing',4,28),
  (67,'Physics',2,39),
  (68,'Political Science',1,6),
  (69,'Professional Theatre',3,10),
  (70,'Psychology',1,29),
  (71,'Reading Education',6,16),
  (72,'School Administration',10,16),
  (73,'School Counseling',9,17),
  (74,'Social Work',11,30),
  (75,'Sociology',1,30),
  (76,'Speech',1,16),
  (77,'Supply Chain Management',2,15),
  (78,'Visual Arts, Design',1,10);

CREATE TABLE publisher (
  publisher_id INT(5) NOT NULL,
  publisher_name VARCHAR(255) NOT NULL,
  PRIMARY KEY (publisher_id)
);

INSERT INTO publisher
  (publisher_id, publisher_name)
VALUES
  (1,'Pearson'),
  (2,'XanEdu'),
  (3,'Cengage Learning'),
  (4,'McGraw-Hill Education'),
  (5,'Wiley');

CREATE TABLE registration (
  registration_id INT(10) NOT NULL AUTO_INCREMENT,
  banner_id INT(9) NOT NULL,
  semester_id INT(5) NOT NULL,
  crn INT(5) NOT NULL,
  PRIMARY KEY (registration_id),
  FOREIGN KEY (banner_id) REFERENCES users(banner_id),
  FOREIGN KEY (semester_id) REFERENCES semester(semester_id),
  FOREIGN KEY (crn) REFERENCES section(crn)
);

INSERT INTO registration
  (registration_id, banner_id, semester_id, crn)
VALUES
  (1,123456789,2,21903),
  (2,123456789,2,21997),
  (3,123456789,2,21406),
  (4,123456789,2,21944),
  (5,123456789,2,21906),
  (6,987654321,2,21406),
  (7,987654321,2,21944),
  (8,987654321,2,21906),
  (9,987654321,2,21054);

CREATE TABLE registration_pin (
  registration_pin INT(6) NOT NULL,
  banner_id INT(9) NOT NULL,
  semester_id INT(5) NOT NULL,
  PRIMARY KEY (registration_pin),
  FOREIGN KEY (banner_id) REFERENCES users(banner_id),
  FOREIGN KEY (semester_id) REFERENCES semester(semester_id)
);

INSERT INTO registration_pin
  (registration_pin, banner_id, semester_id)
VALUES
  (123456,123456789,5),
  (654321,987654321,5);

CREATE TABLE school_year (
  school_year_id INT(5) NOT NULL,
  school_year_name VARCHAR(255) NOT NULL,
  fall_id INT(5) NOT NULL,
  spring_id INT(5) NOT NULL,
  summer_i_id INT(5) NOT NULL,
  summer_ii_id INT(5) NOT NULL,
  PRIMARY KEY (school_year_id),
  FOREIGN KEY (fall_id) REFERENCES semester(semester_id),
  FOREIGN KEY (spring_id) REFERENCES semester(semester_id),
  FOREIGN KEY (summer_i_id) REFERENCES semester(semester_id),
  FOREIGN KEY (summer_ii_id) REFERENCES semester(semester_id)
);

INSERT INTO school_year
  (school_year_id, school_year_name, fall_id, spring_id, summer_i_id, summer_ii_id)
VALUES
  (1,'2018 - 2019',1,2,3,4),
  (2,'2019 - 2020',5,6,7,8);

CREATE TABLE section (
  crn INT(5) NOT NULL,
  course_id INT(5) NOT NULL,
  section_number VARCHAR(3) NOT NULL,
  instructor_id INT(9) NOT NULL,
  semester_id INT(5) NOT NULL,
  type_id INT(1) NOT NULL,
  meeting_days VARCHAR(5) DEFAULT NULL,
  start_time TIME DEFAULT NULL,
  end_time TIME DEFAULT NULL,
  meeting_location VARCHAR(255) NOT NULL,
  seat_capacity INT(3) NOT NULL,
  PRIMARY KEY (crn),
  FOREIGN KEY (course_id) REFERENCES course(course_id),
  FOREIGN KEY (instructor_id) REFERENCES instructor(instructor_id),
  FOREIGN KEY (semester_id) REFERENCES semester(semester_id),
  FOREIGN KEY (type_id) REFERENCES course_type(type_id)
);

INSERT INTO section
  (crn, course_id, section_number, instructor_id, semester_id, type_id, meeting_days, start_time, end_time, meeting_location, seat_capacity)
VALUES
  (10928,1,'001',8,5,1,'MWF','10:00:00','10:50:00','Smith 4001',40),
  (11672,1,'05A',8,5,2,'',NULL,NULL,'Blackboard',35),
  (10929,3,'001',1,5,1,'MWF','14:00:00','14:50:00','Smith 2014',100),
  (11102,3,'002',1,5,1,'TR','09:30:00','10:45:00','Smith 2014',100),
  (11674,5,'05A',5,5,2,'',NULL,NULL,'Blackboard',45),
  (11676,9,'05A',4,5,2,'',NULL,NULL,'Blackboard',35),
  (10933,11,'001',4,5,1,'TR','18:00:00','19:15:00','Smith 4008',28),
  (11239,11,'002',11,5,1,'TR','13:30:00','14:45:00','Smith 4001',45),
  (11675,11,'05A',4,5,2,'',NULL,NULL,'Blackboard',40),
  (11186,16,'001',10,5,1,'TR','11:00:00','12:15:00','Smith 4016',30),
  (12088,16,'05A',7,5,2,'',NULL,NULL,'Blackboard',25),
  (11654,22,'001',3,5,1,'TR','09:30:00','10:45:00','Price 201-B',35),
  (10938,24,'001',9,5,1,'TR','11:00:00','12:15:00','Smith 4001',40),
  (12089,24,'05A',7,5,2,'',NULL,NULL,'Blackboard',25),
  (12448,25,'05A',7,5,2,'',NULL,NULL,'Blackboard',30),
  (21903,6,'05A',4,2,2,'',NULL,NULL,'Blackboard',40),
  (21997,7,'002',11,2,1,'W','18:00:00','20:50:00','Price 201-B',30),
  (21406,8,'002',8,2,1,'MWF','16:00:00','16:50:00','Smith 4016',30),
  (21944,10,'002',8,2,1,'W','08:30:00','10:50:00','Smith 4016',30),
  (21906,12,'05A',8,2,2,'',NULL,NULL,'Blackboard',35),
  (21054,13,'001',6,2,1,'TR','18:00:00','19:15:00','GCB A211',50);

CREATE TABLE semester (
  semester_id INT(5) NOT NULL,
  semester_title VARCHAR(255) NOT NULL,
  start_date DATE NOT NULL,
  finish_date DATE NOT NULL,
  PRIMARY KEY (semester_id)
);

INSERT INTO semester
  (semester_id, semester_title, start_date, finish_date)
VALUES
  (1,'Fall 2018','2018-08-15','2018-12-07'),
  (2,'Spring 2019','2019-01-14','2019-05-10'),
  (3,'Summer I 2019','2019-05-20','2019-06-25'),
  (4,'Summer II 2019','2019-06-27','2019-08-02'),
  (5,'Fall 2019','2019-08-21','2019-12-13'),
  (6,'Spring 2020','2020-01-13','2020-05-08'),
  (7,'Summer I 2020','2020-05-18','2020-06-23'),
  (8,'Summer II 2020','2020-06-25','2020-07-31');

CREATE TABLE student (
  banner_id INT(9) NOT NULL,
  first_name VARCHAR(255) NOT NULL,
  middle_initial CHAR(1) DEFAULT NULL,
  last_name VARCHAR(255) NOT NULL,
  birth_date DATE NOT NULL,
  student_email VARCHAR(255) NOT NULL,
  level_id INT(1) NOT NULL,
  classification_id INT(1) NOT NULL,
  college_id INT(3) NOT NULL,
  degree_id INT(5) NOT NULL,
  major_id INT(5) NOT NULL,
  graduation_year YEAR(4) NOT NULL,
  holds TINYINT(1) NOT NULL DEFAULT '0',
  address VARCHAR(255) NOT NULL,
  phone_number CHAR(10) NOT NULL,
  PRIMARY KEY (banner_id,last_name),
  FOREIGN KEY (level_id) REFERENCES course_level(level_id),
  FOREIGN KEY (classification_id) REFERENCES classification(classification_id),
  FOREIGN KEY (college_id) REFERENCES college(college_id),
  FOREIGN KEY (degree_id) REFERENCES degree(degree_id),
  FOREIGN KEY (major_id) REFERENCES major(major_id)
);

INSERT INTO student
  (banner_id, first_name, middle_initial, last_name, birth_date, student_email, level_id, classification_id, college_id, degree_id, major_id, graduation_year, holds, address, phone_number)
VALUES
  (123456789,'Aggie','T','Bulldog','2019-03-09','aggie@aggies.ncat.edu',1,4,7,2,50,2020,0,'1601 East Market Street, Greensboro, NC 27401','3363347500'),
  (987654321,'John','J','Doe','2018-08-01','john@aggies.ncat.edu',1,3,5,2,28,2019,0,'345 Main Street, Greensboro, NC 27401','3363453455');

CREATE TABLE subject (
  subject_id INT(5) NOT NULL,
  subject_title VARCHAR(255) NOT NULL,
  subject_abbreviation VARCHAR(4) NOT NULL,
  PRIMARY KEY (subject_id)
);

INSERT INTO subject
  (subject_id, subject_title, subject_abbreviation)
VALUES
  (1,'Accounting','ACCT'),
  (2,'Adult Education','ADED'),
  (3,'Aerospace Studies','AERO'),
  (4,'Agribusiness Management','ABM'),
  (5,'Agricultural','AGRI'),
  (6,'Agricultural Economics','AGEC'),
  (7,'Agricultural Education','AGED'),
  (8,'Agricultural Education Research','AGER'),
  (9,'Animal Science','ANSC'),
  (10,'Applied Engineering Technology','AET'),
  (11,'Applied Science and Technology','AST'),
  (12,'Architectural Engineering','AREN'),
  (13,'Art','ART'),
  (14,'Atmospheric Science and Meteorology','ASME'),
  (15,'Biological Engineering','BIOE'),
  (16,'Biology','BIOL'),
  (17,'Biomedical Engineering','BMEN'),
  (18,'Business Education','BUED'),
  (19,'Center for Academic Excellence','SCS'),
  (20,'Chemical Engineering','CHEN'),
  (21,'Chemistry','CHEM'),
  (22,'Civil Engineering','CIEN'),
  (23,'Civil, Architecture and Environmental Engineering','CAEE'),
  (24,'Computational Science and Engineering','CSE'),
  (25,'Computer Science','COMP'),
  (26,'Computer Systems Technology','CST'),
  (27,'Construction Management','CM'),
  (28,'Cooperative Education','COOP'),
  (29,'Counseling','COUN'),
  (30,'Criminal Justice','CRJS'),
  (31,'Curriculum and Instruction','CUIN'),
  (32,'Dance','DANC'),
  (33,'Dissertation','DISU'),
  (34,'Economics','ECON'),
  (35,'Educator Preparation','EDPR'),
  (36,'Electrical and Computer Engineering','ECEN'),
  (37,'Elementary Education','ELED'),
  (38,'English','ENGL'),
  (39,'Environmental Health and Safety','EHS'),
  (40,'Environmental Studies','ENVS'),
  (41,'Family and Consumer Sciences','FCS'),
  (42,'Finance','FIN'),
  (43,'French','FREN'),
  (44,'Freshman Studies','FRST'),
  (45,'General Engineering','GEEN'),
  (46,'Geography','GEOG'),
  (47,'Geomatics','GEOM'),
  (48,'Global Studies','GSCP'),
  (49,'Graduate Thesis Cont','GRAD'),
  (50,'Graphic Communications','GCS'),
  (51,'Health and Physical Education','HPED'),
  (52,'History','HIST'),
  (53,'Horticulture','HORT'),
  (54,'Industrial Systems Engineering','ISEN'),
  (55,'Journalism and Mass Communication','JOMC'),
  (56,'Laboratory Animal Science','LASC'),
  (57,'Landscape Architecture','LDAR'),
  (58,'Leadership Studies','LEST'),
  (59,'Leisure Studies','LSS'),
  (60,'Liberal Studies','LIBS'),
  (61,'Management','MGMT'),
  (62,'Marketing','MKTG'),
  (63,'Master Science Technology Management','MSTM'),
  (64,'Masters School Administration','MSA'),
  (65,'Masters School Administration/Exe','MSAL'),
  (66,'Mathematics','MATH'),
  (67,'Mechanical Engineering','MEEN'),
  (68,'Military Science','MISC'),
  (69,'Motorsports Technology','MST'),
  (70,'Music','MUSI'),
  (71,'Nanoengineering','NANO'),
  (72,'Natural Resources','NARS'),
  (73,'Nursing','NURS'),
  (74,'Occupational Safety and Health','OSH'),
  (75,'Philosophy','PHIL'),
  (76,'Physics','PHYS'),
  (77,'Political Science','POLI'),
  (78,'Psychology','PSYC'),
  (79,'Reading','READ'),
  (80,'Social Work','SOWK'),
  (81,'Sociology','SOCI'),
  (82,'Sociology and Social Work','SOSW'),
  (83,'Soil Management','SLMG'),
  (84,'Soil Science','SLSC'),
  (85,'Spanish','SPAN'),
  (86,'Special Education','SPED'),
  (87,'Speech','SPCH'),
  (88,'Sport Science and Fitness Management','SSFM'),
  (89,'Statistics','STAT'),
  (90,'Supply Chain Management','SCMG'),
  (91,'Systems Engineering','SYEN'),
  (92,'Technology','TECH'),
  (93,'Theatre','THEA'),
  (94,'Waste Management','WMI');

CREATE TABLE textbook (
  isbn VARCHAR(13) NOT NULL,
  textbook_title VARCHAR(255) NOT NULL,
  author_id INT(5) NOT NULL,
  textbook_edition INT(2) NOT NULL,
  textbook_release_year YEAR(4) NOT NULL,
  publisher_id INT(5) NOT NULL,
  PRIMARY KEY (isbn),
  FOREIGN KEY (author_id) REFERENCES author(author_id),
  FOREIGN KEY (publisher_id) REFERENCES publisher(publisher_id)
);

INSERT INTO textbook
  (isbn, textbook_title, author_id, textbook_edition, textbook_release_year, publisher_id)
VALUES
  ('9780133923605','Introductory Circuit Analysis',1,13,2016,1),
  ('9781583902301','Fundamentals of Technology',2,1,2016,2),
  ('9781305107168','CompTIA Linux+ Guide to Linux Certification',3,4,2015,3),
  ('9780134543666','Starting Out With Python',4,4,2018,1),
  ('9780133970777','Fundamentals of Database Systems',5,7,2016,1),
  ('9781305394049','HTML5 and CSS3: Illustrated Complete',6,2,2016,3),
  ('9780134462011','Starting Out with Java: Early Objects',4,6,2017,1),
  ('9781260180282','Technologies, Social Media, and Society',7,23,2019,4),
  ('9781337095471','Successful Project Management',8,7,2018,3),
  ('9781119020752','Interaction Design: Beyond Human-Computer Interaction',9,4,2015,5),
  ('9781119288282','CCNA Routing and Switching Complete Study Guide',10,2,2016,5),
  ('9780735669116','Microsoft Project 2013: Step By Step',11,13,2013,1);

CREATE TABLE users (
  banner_id INT(9) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(100) NOT NULL DEFAULT 'student',
  status ENUM('y','n') NOT NULL DEFAULT 'y',
  PRIMARY KEY (banner_id)
);

INSERT INTO users
  (banner_id, password, role, status)
VALUES
  (123456789, 'aggie', 'administrator', 'y'),
  (987654321, 'ncat', 'student', 'y');

SET FOREIGN_KEY_CHECKS=1;
