<?php

declare(strict_types=1);

namespace App\Application\Service;

class DefaultTestService implements OpenCloseServiceInterface
{
    public function getName(): string
    {
        return 'default';
    }
}
