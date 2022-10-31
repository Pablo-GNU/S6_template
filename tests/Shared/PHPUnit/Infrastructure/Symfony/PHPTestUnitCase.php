<?php

declare(strict_types=1);

namespace Code\Test\Shared\PHPUnit\Infrastructure\Symfony;

use Code\Shared\Bus\Command\Domain\CommandBus;
use Code\Shared\Bus\Query\Domain\QueryBus;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Throwable;
use UnitEnum;

abstract class PHPTestUnitCase extends KernelTestCase
{
    private CommandBus $commandBus;
    private QueryBus $queryBus;

    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test']);
        parent::setUp();
        $this->commandBus = $this->service(CommandBus::class);
        $this->queryBus = $this->service(QueryBus::class);
    }

    protected function commandBus(): CommandBus
    {
        return $this->commandBus;
    }

    protected function queryBus(): QueryBus
    {
        return $this->queryBus;
    }

    /**
     * @throws Exception
     */
    protected function service(string $id): ?object
    {
        return self::getContainer()->get($id);
    }

    protected function parameter(string $parameter): UnitEnum|float|array|bool|int|string|null
    {
        return self::getContainer()->getParameter($parameter);
    }

    /**
     * @throws Throwable
     */
    protected function eventually(
        callable $fn,
        int $totalRetries = 3,
        int $timeToWaitOnErrorInSeconds = 1,
        int $attempt = 0
    ): void {
        try {
            $fn();
        } catch (Throwable $error) {
            if ($totalRetries === $attempt) {
                throw $error;
            }

            \sleep($timeToWaitOnErrorInSeconds);

            $this->eventually($fn, $totalRetries, $timeToWaitOnErrorInSeconds, $attempt + 1);
        }
    }
}
