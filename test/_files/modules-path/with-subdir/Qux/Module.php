<?php

declare(strict_types=1);

namespace Qux;

use Laminas\ModuleManager\Feature\InitProviderInterface;
use Laminas\ModuleManager\ModuleManagerInterface;
use Psr\Container\ContainerInterface;
use stdClass;

class Module implements InitProviderInterface
{
    public function getConfig(): array
    {
        return [
            'service_manager' => [
                'factories' => [
                    'QuxObject' => static fn(ContainerInterface $sm): stdClass => new stdClass(),
                ],
            ],
        ];
    }

    public function init(ModuleManagerInterface $manager): void
    {
        $manager->loadModule('Foo');
    }
}
