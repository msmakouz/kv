<?php

/**
 * This file is part of RoadRunner package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Spiral\RoadRunner\KeyValue\Tests;

use Spiral\RoadRunner\KeyValue\Factory;
use Spiral\RoadRunner\KeyValue\FactoryInterface;
use Spiral\RoadRunner\KeyValue\Serializer\SerializerInterface;

class FactoryTestCase extends TestCase
{
    /**
     * @param array<string, mixed> $mapping
     */
    private function factory(array $mapping = [], SerializerInterface $serializer = null): FactoryInterface
    {
        return new Factory($this->rpc($mapping), $serializer);
    }

    public function testFactoryCreation(): void
    {
        $this->expectNotToPerformAssertions();
        $this->factory();
    }

    public function testSuccessSelectOfUnknownStorage(): void
    {
        $name = \random_bytes(32);

        $driver = $this->factory()
            ->select($name)
        ;

        $this->assertSame($name, $driver->getName());
    }
}
