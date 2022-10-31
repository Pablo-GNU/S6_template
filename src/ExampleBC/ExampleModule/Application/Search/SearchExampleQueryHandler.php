<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Application\Search;

use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\Shared\Bus\Query\Domain\QueryHandler;

final class SearchExampleQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly ExampleSearcher $searcher
    ) {
    }

    public function __invoke(SearchExampleQuery $query): ?SearchExampleQueryResponse
    {
        $example = $this->searcher->__invoke(new ExampleId($query->id()));

        return new SearchExampleQueryResponse(
            $example->id()->value(),
            $example->name()->value(),
            $example->surname()->value(),
            $example->age()->value()
        );
    }
}
