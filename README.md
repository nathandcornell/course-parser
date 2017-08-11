# Course Parser
Parses the details of a course (department, number, year, semester) from a given
input string (e.g. 'CS-111 Fall 2016') and return a bullet list of the details.

## Usage:
- Add "natec/course-parser" to your composer.json (NOTE: not actually on packagist yet)
- Include the Course object and parser:
    use CourseParser\Model\Course;
    use CourseParser\Model\Parser;
- Feed it strings and get the output:
    $course = Parser::parseInput($inputString);
    $courseString = $testCourse->toString();

## Development/Testing:
- Make sure you have [Composer](http s://getcomposer.org/) installed.
- Clone/fork this repository
- Run ```$ composer install``` to install dev dependencies
- Test by running ```$ phpunit --colors=always ./test``` from the project folder

Copyright © 2017 Nate Cornell <nathandcornell@gmail.com>
