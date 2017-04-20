<?php

namespace CourseParser\Model;

class Course {
    private $department;
    private $number;
    private $year;
    private $semester;

    public function __construct($department=null, $number=null, $year=null, $semester=null) {
        $this->department = $department;
        $this->number     = $number;
        $this->year       = $year;
        $this->semester   = $semester;
    }

    public function __get($property) {
        if(! property_exists($this, $property)) { return; }
        
        return $this->$property;
    }

    public function __set($property, $value) {
        if(! property_exists($this, $property) || ! isset($value)) { return; }

        $this->$property = $value;
    }

    public function toString() {
        return sprintf(
            "● Department: %s\n● Course Number: %s\n● Year: %s\n● Semester: %s",
            $this->department, $this->number, $this->year, $this->semester
        );
    }
}
