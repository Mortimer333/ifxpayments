<?php

declare(strict_types=1);

namespace App\Application\Infrastructure\Message;

/**
 * @codeCoverageIgnore
 */
final readonly class ProcessTransactionMessage
{
    public function __construct(public int $transactionId)
    {
    }
}
