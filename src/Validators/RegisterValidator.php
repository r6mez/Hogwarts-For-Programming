<?php

namespace App\Validators;

use App\Core\Database;

class RegisterValidator
{
    protected array $data;
    protected array $errors = [];

    public function __construct(array $data)
    {
        $this->data = array_map('trim', $data); // Trim all input fields
    }

    public function validate(): array
    {
        $name = $this->data['name'] ?? null;
        $email = $this->data['email'] ?? null;
        $password = $this->data['password'] ?? null;
        $accept = $this->data['accept'] ?? null;

        if (!$name) $this->errors[] = 'Name is required.';
        if (!$email) $this->errors[] = 'Email is required.';
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $this->errors[] = 'Invalid email format.';
        if (!$password) $this->errors[] = 'Password is required.';
        if ($password && strlen($password) < 6) $this->errors[] = 'Password must be at least 6 characters long.';
        if (!$accept) $this->errors[] = 'You must accept the terms.';

        if ($email) {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            if ($stmt->fetchColumn() > 0) {
                $this->errors[] = 'Email is already in use.';
            }
        }

        return $this->errors;
    }

    public function get(string $key)
    {
        return $this->data[$key] ?? null;
    }
}
