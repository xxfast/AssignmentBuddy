/*! This script will return all info */
/*! of the given studentID */
/*! <param $StudentID > */

SELECT *
FROM Student s 
WHERE s.StudentID = $StudentID;