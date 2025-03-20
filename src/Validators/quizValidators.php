<?php
namespace App\Validators;
class QuizValidator 
{
    private $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function validate(): array 
    {
        $errors = [];
        if (empty($this->data['id_cour']))  $errors['id_cour'] = 'Course ID is required.';
        if (empty($this->data['id_prof']))  $errors['id_prof'] = 'Professor ID is required.';
        if (empty($this->data['id_stud']))  $errors['id_stud'] = 'Student ID is required.';
        if (empty($this->data['score']))    $errors['score'] = 'Score is required.';
        return $errors;
    }
}