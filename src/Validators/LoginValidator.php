<?php

namespace App\Validators;

class LoginValidator
{
    protected array $data;
    protected array $errors = [];

    public function __construct(array $data)
    {
        $this->data = array_map('trim', $data); // Trim all input fields
    }

    public function validate(): array
    {
        $email = $this->data['email'] ?? null;
        $password = $this->data['password'] ?? null;

        if (!$email) $this->errors[] = 'Email is required.';
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $this->errors[] = 'Invalid email format.';
        if (!$password) $this->errors[] = 'Password is required.';

        return $this->errors;
    }
}
