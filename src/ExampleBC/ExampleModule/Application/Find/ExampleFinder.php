<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Find;

use Code\ExampleBC\ExampleModule\Application\Search\ExampleSearcher;
use Code\ExampleBC\ExampleModule\Domain\Example;
use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\ExampleBC\ExampleModule\Domain\Exceptions\ExampleNotExist;

final class ExampleFinder
{
    public function __construct(private readonly ExampleSearcher $searcher)
    {
    }

    public function __invoke(ExampleId $exampleId): Example
    {
        $example = $this->searcher->__invoke($exampleId);

        if (\is_null($example)) {
            throw new ExampleNotExist();
        }

        return $example;
    }
}
