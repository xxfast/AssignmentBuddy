
CREATE TABLE University
(
	UniversityID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	UniversityName VARCHAR(50) NOT NULL,
	Location VARCHAR(50) NOT NULL,
	Website VARCHAR(100)
	/*! assuming some universities doesnt have a website  */
);

CREATE TABLE Course
(
	CourseID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	CourseCode VARCHAR(10) NOT NULL, 
	CourseName VARCHAR(50) NOT NULL,
	UniversityID INT,
	FOREIGN KEY (UniversityID) REFERENCES University(UniversityID) ON DELETE SET NULL
	/*! If a given univeristy record is deleted, it'll set this field to null */
	/*! because we dont want the corresponding course to disappear */
);

CREATE TABLE Unit
(
	UnitID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	UnitCode VARCHAR(15) NOT NULL,
	UnitName VARCHAR(50) NOT NULL
	/*! Unitcode and Unit name is a must */
);

CREATE TABLE CourseUnit
(
	CourseID INT NOT NULL,
	UnitID INT NOT NULL,
	FOREIGN KEY (CourseID) REFERENCES Course(CourseID) ON DELETE CASCADE,
	FOREIGN KEY (UnitID) REFERENCES Unit(UnitID) ON DELETE CASCADE
	/*! if eithe the university or the unit is deleted, the record will be deleted too*/
);

CREATE TABLE Assignment
(
	AssignmentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	UnitID INT,
	AssignmentTitle VARCHAR(50),
	FOREIGN KEY (UnitID) REFERENCES Unit(UnitID) ON DELETE SET NULL
	/*! if the corresponding unit is deleted, this field will be set to null */
	/*! because we dont want that assignment to be deleted only because it's unit was deleted */
	
);

CREATE TABLE Student
(
	StudentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Email VARCHAR(50) NOT NULL,
	Password VARCHAR(50) NOT NULL,
	FirstName VARCHAR(50),
	LastName VARCHAR(50),
	DOB DATE,
	TellNo VARCHAR(20),
	Address VARCHAR(100),
	CourseID INT,
	UniversityID INT, 
	FOREIGN KEY (UniversityID) REFERENCES University(UniversityID) ON DELETE SET NULL,
	FOREIGN KEY (CourseID) REFERENCES Course(CourseID) ON DELETE SET NULL
	/*! Students wont get deleted if the university or the course get deleted */
);

CREATE TABLE Groups
(
	GroupID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	AdminID INT NOT NULL,
	AssignmentID INT,
	Description VARCHAR(100),
	Target CHAR(2) NOT NULL,
	MemberCount INT NOT NULL,
	FOREIGN KEY (AdminID) REFERENCES Student(StudentID)  ON DELETE CASCADE,
	/*! In deletion of the student (if the admin deactivates) the group will be deleted*/
	FOREIGN KEY (AssignmentID) REFERENCES Assignment(AssignmentID) ON DELETE SET NULL
	/*! In deletion of assignment, the group could still exist */
);

CREATE TABLE StudentGroup
(
	StudentID INT NOT NULL,
	GroupID INT NOT NULL,
	FOREIGN KEY (StudentID) REFERENCES Student(StudentID)  ON DELETE CASCADE,
	FOREIGN KEY (GroupID) REFERENCES Groups(GroupID)  ON DELETE CASCADE
	/*! These records exist as long as the student or the group exist*/
);
