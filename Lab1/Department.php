<?php
namespace Labs\lab1;

class Department{
    private $name;
    private $employees;

    public function __construct(string $name = "ВМ-1", $employees = [])
    {
        $this->employees = $employees;        
        $this->name = $name;
    }

    public function get_total_salary() : float
    {
        $total_salary = 0;
        foreach($this->employees as $employee){
            $total_salary += $employee->get_salary();
        }
        return $total_salary;
    }

    public function get_employees() : array
    {
        return $this->employees;
    }

    public function __toString() : string
    {
        $result = "Department name: $this->name<br>"; 
        foreach($this->employees as $employee){
            $result .=  strval($employee) . "<br>";
        }
        return $result;
    }

}