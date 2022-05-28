<?php
require_once "vendor/autoload.php";
require_once "Lab1/Employee.php";
require_once "Lab1/EmployeeTest.php";
require_once "Lab1/Department.php";

use Symfony\Component\Validator\Validation;
use Labs\lab1\Employee;
use Labs\lab1\Department;

use function Labs\lab1\Test;

checkValidator();
echo "<br>";
checkDepartments();


function checkValidator(){
    $validator = Validation::createValidatorBuilder()
    ->enableAnnotationMapping()
    ->addDefaultDoctrineAnnotationReader()
    ->getValidator();

    echo"Демонстрация работы валидатора для Employee" . "<br>";
    Test($validator);
}

function checkDepartments(){
    $departments = createArrayDepartment();


    $departmentsWithMinimumSalary = findDepartmentsWithMinSalary($departments);
    echo "Departments with minimum salary" . "<br>";
    foreach($departmentsWithMinimumSalary as $department){
        echo strval($department) . "<br>";
    }


    $departmentsWithMaximumSalary = findDepartmentsWithMaxSalary($departments);
    echo "Departments with maximum salary" . "<br>";
    foreach($departmentsWithMaximumSalary as $department){
        echo strval($department) . "<br>";
    }

    
}

function createArrayDepartment() : array{
    $department1 = new Department("dep1", array(
        new Employee(1, "Dmitrii", 1750, "2022-01-13"),
        new Employee(2, "Alexey", 750, "2022-01-13"),
        new Employee(3, "Maksim", 70, "2022-01-13")
    ));

    $department2 = new Department("dep2", array(
        new Employee(4, "Valery", 200, "2022-01-13"),
        new Employee(5, "Kirill", 300, "2022-01-13"),
        new Employee(6, "Danil", 750, "2022-01-13")
    ));

    $department3 = new Department("dep3", array(
        new Employee(7, "Ilya", 300, "2022-01-13"),
        new Employee(8, "Inga", 750, "2022-01-13"),
        new Employee(9, "Natalya", 200, "2022-01-13")
    ));

    
    $departments = array(
        $department1,
        $department2,
        $department3
    );

    return $departments;
}

function findDepartmentsWithMinSalary($departments = []) : array{
    if(count($departments) == 0){
        return $departments;
    }

    $minSalary = findMinSalaryInDeparments($departments);
    $departmentsWithMinSalary = array();

    foreach($departments as $department){
        if($department->get_total_salary() == $minSalary){
            array_push($departmentsWithMinSalary, $department);
        }
    }

    $maximumNumberEmployee = 
        findMaxNumberEmployeeInDeparments($departmentsWithMinSalary);

    foreach($departmentsWithMinSalary as $i => $department){
        if(count($department->get_employees()) != $maximumNumberEmployee){
            unset($departmentsWithMinimumSalary[$i]);
        }
    }

    return $departmentsWithMinSalary;
}

function findDepartmentsWithMaxSalary($departments = []) : array{
    if(count($departments) == 0){
        return $departments;
    }

    $maxSalary = findMaxSalaryInDeparments($departments);
    $departmentsWithMaxSalary = array();

    foreach($departments as $department){
        if($department->get_total_salary() == $maxSalary){
            array_push($departmentsWithMaxSalary, $department);
        }
    }

    $maximumNumberEmployee = 
        findMaxNumberEmployeeInDeparments($departmentsWithMaxSalary);

    foreach($departmentsWithMaxSalary as $i => $department){
        if(count($department->get_employees()) != $maximumNumberEmployee){
            unset($departmentsWithMaxSalary[$i]);
        }
    }

    return $departmentsWithMaxSalary;
}  

function findMinSalaryInDeparments($departments = []) : float{
    if(count($departments) == 0){
        return 0;
    }
    
    $minimumSalary = $departments[0]->get_total_salary();
    foreach($departments as $department){
        if($department->get_total_salary() < $minimumSalary)
            $minimumSalary = $department->get_total_salary();
    }
    return $minimumSalary;
}

function findMaxSalaryInDeparments($departments = []) : float{
    if(count($departments) == 0){
        return 0;
    }

    $maximumSalary = $departments[0]->get_total_salary();
    foreach($departments as $department){
        if($department->get_total_salary() > $maximumSalary)
            $maximumSalary = $department->get_total_salary();
    }
    return $maximumSalary;
}

function findMaxNumberEmployeeInDeparments($departments = []) : float{
    if(count($departments) == 0){
        return $departments;
    }

    $numberEmployee = count($departments[0]->get_employees());
    foreach($departments as $department){
        if(count($department->get_employees()) > $numberEmployee)
            $numberEmployee = count($department);
    }

    return $numberEmployee;
}



