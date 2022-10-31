<?php

declare(strict_types=1);

namespace Code\ExampleBC\ExampleModule\Infrastructure\Persistence\DBAL;

use Code\ExampleBC\ExampleModule\Domain\Example;
use Code\ExampleBC\ExampleModule\Domain\ExampleId;
use Code\ExampleBC\ExampleModule\Domain\Persistence\ExampleRepositoryInterface;
use Code\Shared\Persistence\Infrastructure\DBAL\DBALRepositoryConnection;
use Doctrine\DBAL\Exception as DBALException;

final class ExampleRepository extends DBALRepositoryConnection implements ExampleRepositoryInterface
{
    /**
     * @throws DBALException
     */
    public function create(Example $example): void
    {
        $qb = $this->queryBuilder();
        $qb->insert(self::EXAMPLE)
            ->values(
                [
                    'id' => ':Id',
                    'name' => ':Name',
                    'surname' => ':Surname',
                    'age' => ':Age',
                ]
            )
            ->setParameter('Id', $example->id()->value())
            ->setParameter('Name', $example->name()->value())
            ->setParameter('Surname', $example->surname()->value())
            ->setParameter('Age', $example->age()->value())
            ->executeQuery();
    }

    /**
     * @throws DBALException
     */
    public function search(ExampleId $exampleId): ?Example
    {
        $qb = $this->queryBuilder();
        $qb->select('*')
            ->from(self::EXAMPLE)
            ->where('id = :Id')
            ->setParameter('Id', $exampleId->value());

        $data = $qb->executeQuery()->fetchAllAssociative();

        if (empty($data)) {
            return null;
        }

        $example = $data[0];

        return Example::fromPrimitives(
            (string) $example['id'],
            (string) $example['name'],
            (string) $example['surname'],
            (int) $example['age']
        );
    }

    /**
     * @throws DBALException
     */
    public function update(Example $example): void
    {
        $qb = $this->queryBuilder();
        $qb->update(self::EXAMPLE)
            ->set('name', ':Name')
            ->set('surname', ':Surname')
            ->set('age', ':Age')
            ->where('id = :Id')
            ->setParameter('Name', $example->name()->value())
            ->setParameter('Surname', $example->surname()->value())
            ->setParameter('Age', $example->age()->value())
            ->setParameter('Id', $example->id()->value())
            ->executeQuery();
    }

    /**
     * @throws DBALException
     */
    public function delete(ExampleId $exampleId): void
    {
        $qb = $this->queryBuilder();
        $qb->delete(self::EXAMPLE)
            ->where('id = :Id')
            ->setParameter('Id', $exampleId->value())
            ->executeQuery();
    }
}
