<?php

use CourseParser\Model\Course;
use PHPUnit\Framework\TestCase;

class CourseTest extends TestCase 
{
    const DEPARTMENT = "CS";
    const NUMBER     = 410;
    const YEAR       = 2017;
    const SEMESTER   = "Fall";

    public function testCourse() {
        $course = new Course(self::DEPARTMENT, self::NUMBER, self::YEAR, self::SEMESTER);

        $this->assertEquals(self::NUMBER, $course->number);
        $newNumber = 500;
        $course->number = $newNumber;
        $this->assertEquals($newNumber, $course->number);
    }
}
