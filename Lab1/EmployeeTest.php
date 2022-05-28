<?php
namespace Labs\lab1;
require_once "Lab1/Employee.php";
use Labs\lab1\Employee;

function Test($validator){
    TestNullName($validator);
    TestInvalidName($validator);
    TestNegativeId($validator);
    TestNegativeSalary($validator);
    TestInvalidEmploymentDateString($validator);    
}

function TestNullName($validator){
    //Arrange
    $employee = new Employee(1, "", 1000, "2020-04-16");

    //Act
    $errors = $validator->validate($employee);

    //Assert
    if(count($errors) > 0){
        foreach($errors as $error){
            echo (string) $error . "<br>";
        }
    }
}

function TestInvalidName($validator){
    //Arrange
    $employee = new Employee(1, "1Dima", 1000, "2020-04-16");

    //Act
    $errors = $validator->validate($employee);

    //Assert
    if(count($errors) > 0){
        foreach($errors as $error){
            echo (string) $error . "<br>";
        }
    }
}

function TestNegativeId($validator){
    //Arrange
    $employee = new Employee(-1, "Dmitrii", 1000, "2020-04-16");

    //Act
    $errors = $validator->validate($employee);

    //Assert
    if(count($errors) > 0){
        foreach($errors as $error){
            echo (string) $error . "<br>";
        }
    }
}

function TestNegativeSalary($validator){
    //Arrange
    $employee = new Employee(1, "Dmitrii", -1000, "2020-04-16");

    //Act
    $errors = $validator->validate($employee);

    //Assert
    if(count($errors) > 0){
        foreach($errors as $error){
            echo (string) $error . "<br>";
        }
    }
}

function TestInvalidEmploymentDateString($validator){
     //Arrange
     $employee = new Employee(1, "Dmitrii", 1000, "InvalidDate");

     //Act
     $errors = $validator->validate($employee);
 
     //Assert
     if(count($errors) > 0){
         foreach($errors as $error){
             echo (string) $error . "<br>";
         }
     }
}
