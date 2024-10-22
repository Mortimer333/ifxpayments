<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Kernel;

final class OpenCloseTestPolicy
{
    private array $serviceHashMap = [];
    private array $taggedServiceHashMap = [];

    public function __construct(
        protected Kernel $kernel,
        protected \IteratorAggregate $services
    ) {
        $this->initServiceHashMap();
        $this->initTaggedServicesHashMap();
    }

    /**
     * @throws \Exception
     */
    public function getTestServiceByName(string $name): OpenCloseServiceInterface
    {
        return $this->serviceHashMap[$name] ?? throw new \Exception('Not handled test case');
    }

    public function getTaggedServiceByName(string $name): OpenCloseServiceInterface
    {
        return $this->taggedServiceHashMap[$name] ?? throw new \Exception('Not handled test case');
    }

    private function initTaggedServicesHashMap(): void
    {
        $this->taggedServiceHashMap = [];
        /** @var OpenCloseServiceInterface $service */
        foreach ($this->services as $service) {
            $this->taggedServiceHashMap[$service->getName()] = $service;
        }
    }

    private function initServiceHashMap(): void
    {
        $container = $this->kernel->getContainer();

        $this->serviceHashMap = [
            'test1' => $container->get('app.service.test1'),
            'default' => $container->get('app.service.default'),
        ];
    }
}
