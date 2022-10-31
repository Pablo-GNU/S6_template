<?php

declare(strict_types=1);

namespace Code\Test\ExampleBC\ExampleModule;

use Code\ExampleBC\ExampleModule\Application\Create\CreateExampleCommand;
use Code\ExampleBC\ExampleModule\Application\Delete\DeleteExampleCommand;
use Code\ExampleBC\ExampleModule\Application\Search\SearchExampleQuery;
use Code\ExampleBC\ExampleModule\Application\Search\SearchExampleQueryResponse;
use Code\ExampleBC\ExampleModule\Application\Update\UpdateExampleCommand;
use Code\Test\Shared\PHPUnit\Infrastructure\Symfony\PHPTestUnitCase;
use Ramsey\Uuid\Uuid;
use Throwable;

final class ExampleModuleTest extends PHPTestUnitCase
{


    public function setUp(): void
    {
        parent::setUp();
    }

    public function testExampleCreate(): string
    {
        $exception = null;
        $id = Uuid::uuid4()->toString();

        try {
            $this->commandBus()->dispatch(
                new CreateExampleCommand(
                    $id,
                    "Name",
                    "Surname",
                    14
                )
            );
        } catch (Throwable $throwable) {
            $exception = $throwable;
        }

        $this->assertNull($exception);

        return $id;
    }

    /**
     * @depends testExampleCreate
     */
    public function testExampleSearch(string $id): SearchExampleQueryResponse
    {
        /** @var SearchExampleQueryResponse $example */
        $example = $this->queryBus()->ask(
            new SearchExampleQuery($id)
        );

        $this->assertEquals($id, $example->id());

        return $example;
    }

    /**
     * @depends testExampleSearch
     */
    public function testExampleUpdate(SearchExampleQueryResponse $queryResponse): string
    {
        $exception = null;

        try {
            $this->commandBus()->dispatch(
                new UpdateExampleCommand(
                    $queryResponse->id(),
                    "Name 2",
                    "Surname 2",
                    15
                )
            );
        } catch (Throwable $throwable) {
            $exception = $throwable;
        }

        $this->assertNull($exception);

        /** @var SearchExampleQueryResponse $example */
        $example = $this->queryBus()->ask(
            new SearchExampleQuery($queryResponse->id())
        );

        $this->assertNotEquals($queryResponse->name(), $example->name());
        $this->assertNotEquals($queryResponse->surname(), $example->surname());
        $this->assertNotEquals($queryResponse->age(), $example->age());

        return $example->id();
    }

    /**
     * @depends testExampleUpdate
     */
    public function testExampleDelete(string $id): void
    {
        $exception = null;

        try {
            $this->commandBus()->dispatch(
                new DeleteExampleCommand($id)
            );
        } catch (Throwable $throwable) {
            $exception = $throwable;
        }

        $this->assertNull($exception);
    }
}
