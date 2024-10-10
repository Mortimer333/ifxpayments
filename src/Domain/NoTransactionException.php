<?php

declare(strict_types=1);

namespace App\Domain;

class NoTransactionException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('NO TRANSACTION');
    }
}
