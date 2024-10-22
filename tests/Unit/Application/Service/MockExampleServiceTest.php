<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Service;

use App\Application\Exception\UserNotFoundException;
use App\Application\Port\Secondary\DatabaseManagerInterface;
use App\Application\Port\Secondary\UserInterface;
use App\Application\Port\Secondary\UserRepositoryInterface;
use App\Application\Service\MockExampleService;
use App\Tests\Unit\BaseUnitAbstract;
use Codeception\Stub\Expected;

class MockExampleServiceTest extends BaseUnitAbstract
{
    public function testUserIsRetrievedSuccessfully(): void
    {
        $userId = 1;
        $databaseManagerMock = $this->makeEmpty(DatabaseManagerInterface::class, [
            'beginTransaction' => Expected::once(),
            'persist' => Expected::once(),
        ]);
        $userRepositoryMock = $this->makeEmpty(UserRepositoryInterface::class, [
            'get' => Expected::once($this->makeEmpty(UserInterface::class)),
        ]);
        $mockExampleService = new MockExampleService($databaseManagerMock, $userRepositoryMock);
        $user = $mockExampleService->getUser($userId);
        $this->assertInstanceOf(UserInterface::class, $user);
    }

    public function testNotFoundUserThrowsException(): void
    {
        $userId = 1;
        $databaseManagerMock = $this->makeEmpty(DatabaseManagerInterface::class, [
            'beginTransaction' => Expected::once(),
            'rollback' => Expected::once(),
        ]);
        $userRepositoryMock = $this->makeEmpty(UserRepositoryInterface::class, [
            'get' => function () use ($userId) {
                throw new UserNotFoundException($userId);
            },
        ]);
        $mockExampleService = new MockExampleService($databaseManagerMock, $userRepositoryMock);
        $this->expectException(UserNotFoundException::class);
        $mockExampleService->getUser($userId);
    }
}
