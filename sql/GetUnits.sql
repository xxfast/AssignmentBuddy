/*! This script will return all the units */
/*! A user does in a given course */
/*! <param $CourseID > */

SELECT u.UnitID, u.UnitCode, u.UnitName 
FROM Unit u NATURAL JOIN CourseUnit cu NATURAL JOIN Course c 
WHERE c.CourseID = $CourseID;