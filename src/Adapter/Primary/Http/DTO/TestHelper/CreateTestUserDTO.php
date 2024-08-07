<?php

declare(strict_types=1);

namespace App\Adapter\Primary\Http\DTO\TestHelper;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @codeCoverageIgnore
 */
final readonly class CreateTestUserDTO
{
    public function __construct(
        #[Assert\NotBlank(message: 'Name cannot be blank')]
        #[Assert\Type(type: 'string', message: 'Name must be a string')]
        public ?string $name,
        #[Assert\NotBlank(message: 'Surname cannot be blank')]
        #[Assert\Type(type: 'string', message: 'Surname must be a string')]
        public ?string $surname,
        #[Assert\NotBlank(message: 'Email cannot be blank')]
        #[Assert\Email(message: 'Must be a valid email')]
        public ?string $email,
        #[Assert\NotBlank(message: 'Password cannot be blank')]
        #[Assert\Type(type: 'string', message: 'Password must be a string')]
        public ?string $password,
    ) {
    }
}
