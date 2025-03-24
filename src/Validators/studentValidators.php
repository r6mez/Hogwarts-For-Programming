<?php
namespace App\Validators;
class StudentValidator 
{
    private $data;
    public function __construct(array $data) 
    {
        $this->data = $data;
    }
    public function validate(): array 
    {
        $errors = [];
        if (empty($this->data['id']))      $errors['id'] = 'Student ID is required.';
        if (empty($this->data['points']))  $errors['points'] = 'Points are required.';
        if (empty($this->data['house_id']))$errors['house_id'] = 'House ID is required.';
        return $errors;
    }
}