<?php

declare(strict_types=1);

namespace Code\Shared\Persistence\Infrastructure\DBAL\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221028101903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Example Migration';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable("example");
        $table->addColumn("id", "string", ["length" => 120]);
        $table->addColumn("name", "string", ["length" => 60]);
        $table->addColumn("surname", "string", ["length" => 100]);
        $table->addColumn("age", "integer", ["unsigned" => true]);
        $table->setPrimaryKey(["id"]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable("example");
    }
}
