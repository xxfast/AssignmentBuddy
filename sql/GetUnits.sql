/*! This script will return all the units */
/*! A user does in a given course */
/*! <param $StudentID > */

SELECT * FROM Units
WHERE Student s NATURAL JOIN CourseUnit cu
ON s.CourseID=cu.CourseID
NATURAL JOIN Unit u 
On cu.UnitID = u.UnitID;