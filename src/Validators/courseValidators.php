<?php
namespace App\Validators;
class CourseValidator 
{
    private $data;
    public function construct(array $data) 
    {
        $this->data = $data;
    }
    public function validate(): array 
    {
        $errors = [];
        if (empty($this->data['name']))    $errors['name'] = 'Course name is required.';
        if (empty($this->data['id_prof'])) $errors['id_prof'] = 'Professor ID is required.';
        return $errors;
    }
}