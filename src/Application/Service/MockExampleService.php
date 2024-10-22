<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Exception\UserNotFoundException;
use App\Application\Port\Secondary\DatabaseManagerInterface;
use App\Application\Port\Secondary\UserInterface;
use App\Application\Port\Secondary\UserRepositoryInterface;

/**
 * Just a mock test service to create example unit tests with mocking. It doesn't have to make sense
 */
final class MockExampleService
{
    private array $serviceHashMap;

    public function __construct(
        private DatabaseManagerInterface $databaseManager,
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function getUser(int $id): UserInterface
    {
        try {
            $this->databaseManager->beginTransaction();
            $user = $this->userRepository->get($id);
            $this->databaseManager->persist();

            return $user;
        } catch (UserNotFoundException $e) {
            $this->databaseManager->rollback();
            throw $e;
        }
    }
}
