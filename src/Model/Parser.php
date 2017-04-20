<?php

namespace CourseParser\Model;

use CourseParser\Model\Course;
use Exception;
use InvalidArgumentException;

class Parser
{
    const ALPHA_REGEX = '/[A-Za-z]+/';
    const NUMBER_REGEX = '/[0-9]+/';

    const SEMESTER_DICT = [
        'f' => 'Fall',
        's' => [
            'p' => 'Spring',
            'u' => 'Summer',
            'default' => 'Spring',
        ],
        'w' => 'Winter',
    ];

    /**
     * Parses user input into the components of a course.
     *
     * @param String $input  The input to parse.
     * @param boolean $asString  Whether or not to return a string.
     *
     * @return CourseParser\Model\Course  An object representing the course.
     */
    public static function parseInput($input) {
        if (! isset($input) || trim($input) == '') {
            Throw new InvalidArgumentException("No input");
        }

        // First parse the alphabetical bis of the string:
        $alphaStrings = [];
        preg_match_all(self::ALPHA_REGEX, $input, $alphaStrings);

        // Then parse the numeric portions:
        $numberStrings = [];
        preg_match_all(self::NUMBER_REGEX, $input, $numberStrings);

        if (count($alphaStrings) < 1) { 
            Throw new Exception("Could not parse Department or Semester");
        }

        if (count($numberStrings) < 1) { 
            Throw new Exception("Could not parse Department or Semester");
        }

        // Assign the matched values to variables for further processing:
        $department     = ($alphaStrings[0][0]);
        $semesterString = ($alphaStrings[0][1]);
        $courseNumber   = ($numberStrings[0][0]);
        $yearString     = ($numberStrings[0][1]);

        // Semester lookup:
        $semester = self::lookupSemester(strtolower($semesterString), self::SEMESTER_DICT);

        if ($semester == '') {
            Throw new Exception("Could not parse Semester from string '$semesterString'");
        }

        // Convert the date to 4 chars:
        $year = (strlen($yearString) == 4) 
            ? (int) $yearString 
            : self::padYear($yearString);

        // Create the new course object
        $course = new Course($department, $courseNumber, $year, $semester);

        // Return the object
        return $course;
    }

    private static function lookupSemester($semesterString, $dictionary) {
        // Base case - we've reached the end of the search dictionary
        if (! is_array($dictionary)) { return $dictionary; }

        // We've reached the end of the search string, return the default if set
        if ($semesterString == '') {
            return (isset($dictionary['default'])) 
                ? $dictionary['default'] 
                : '';
        }

        // Otherwise, recurse into the next level of the dictionary:
        $semesterChar = $semesterString[0];
        if (isset($dictionary[$semesterChar])) {
            return self::lookupSemester(substr($semesterString,1), $dictionary[$semesterChar]);
        } 

        // No match...
        return '';
    }

    private static function padYear($yearString) {
        $currentYear = date('Y');
        return substr($currentYear, 0, 2) . $yearString;
    }
}
