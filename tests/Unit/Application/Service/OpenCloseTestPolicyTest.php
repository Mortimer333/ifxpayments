<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\Service;

use App\Application\Service\OpenCloseTestPolicy;
use App\Application\Service\Test1Service;
use App\Tests\Unit\BaseUnitAbstract;

class OpenCloseTestPolicyTest extends BaseUnitAbstract
{
    public function testRetrieveTestServiceByNameSuccessfully(): void
    {
        $testPolicy = $this->tester->getService(OpenCloseTestPolicy::class);
        $test1Service = $testPolicy->getTestServiceByName('test1');
        $this->assertInstanceOf(Test1Service::class, $test1Service);
    }
    public function testRetrieveTaggedServiceByNameSuccessfully(): void
    {
        $testPolicy = $this->tester->getService(OpenCloseTestPolicy::class);
        $test1Service = $testPolicy->getTaggedServiceByName('test1');
        $this->assertInstanceOf(Test1Service::class, $test1Service);
    }
}
