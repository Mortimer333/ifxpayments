<?php

declare(strict_types=1);

namespace App\Application\Service;

class Test1Service implements OpenCloseServiceInterface
{
    public function getName(): string
    {
        return 'test1';
    }
}
