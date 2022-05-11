<?php
namespace Labs\lab1;

use Symfony\Component\Validator\Constraints as Assert;
use \DateTime;

class Employee{

    /**
     * @Assert\PositiveOrZero
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @Assert\Type("string")
     * @Assert\NotBlank(
     *     message = "Name should not be empty"
     * )
     * @Assert\Regex(
     *     pattern = "/^[a-z ,.'-]+$/i",
     *     message = "Not a name"
     * )
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("float")
     * @Assert\PositiveOrZero
     */
    private $salary;

    /**
     * @Assert\Date()
     */
    private $employmentDateString;

    public function get_salary() : float
    {
        return $this->salary;
    }
    
    public function __construct(int $id, string $name, float $salary, string $employmentDateString)
    {            

        $this->id = $id;
        $this->name = $name;
        $this->salary = $salary;
        $this->employmentDateString = $employmentDateString;  
    }

    public function get_experienceInYears() : int
    {
        $employmentDate = new DateTime($this->employmentDateString);
        return $employmentDate->diff(new DateTime('now'))->y;

    }

    public function __toString() : string
    {
        return "Id: " . $this->id . ", Name: " . $this->name .
         ", Salary: " . $this->salary . ", Employment date: " 
         . $this->employmentDateString; 
    }

}