<?php

use CourseParser\Model\Course;
use CourseParser\Model\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase 
{
    const COURSES = ['CS111','CS 111','CS:111','CS-111'];

    const FALL_SEMESTERS   = ['Fall 2016','fall 16','2016 Fall','F2016','Fall2016'];
    const SPRING_SEMESTERS = ['Spring 2016','spring 16','2016 Spring','S2016','Sp2016'];
    const SUMMER_SEMESTERS = ['Summer 2016','summer 16','2016 Summer','Su2016','SU2016'];

    public function testParse() {
        $fallCourse  = new Course('CS', 111, 2016, 'Fall');
        $fallCourseString = $fallCourse->toString();
        $springCourse  = new Course('CS', 111, 2016, 'Spring');
        $springCourseString = $springCourse->toString();
        $summerCourse  = new Course('CS', 111, 2016, 'Summer');
        $summerCourseString = $summerCourse->toString();

        foreach (self::COURSES as $course) {
            foreach (self::FALL_SEMESTERS as $semester) {
                $testInput = "$course $semester";
                $testCourse = Parser::parseInput($testInput);
                $testString = $testCourse->toString();

                $this->assertEquals($fallCourseString, $testString, 
                    "Failed to parse $testInput. Expected $fallCourseString but got $testString");
            }
            foreach(self::SPRING_SEMESTERS as $semester) {
                $testInput = "$course $semester";
                $testCourse = Parser::parseInput($testInput);
                $testString = $testCourse->toString();

                $this->assertEquals($springCourseString, $testString, 
                    "Failed to parse $testInput. Expected $springCourseString but got $testString");
            }
            foreach(self::SUMMER_SEMESTERS as $semester) {
                $testInput = "$course $semester";
                $testCourse = Parser::parseInput($testInput);
                $testString = $testCourse->toString();

                $this->assertEquals($summerCourseString, $testString, 
                    "Failed to parse $testInput. Expected $summerCourseString but got $testString");
            }
        }
    }
}
