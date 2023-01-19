<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118155030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create a domain_events table';
    }


    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE domain_events (id UUID NOT NULL, aggregate_id UUID NOT NULL, name VARCHAR(255) NOT NULL, body JSON NOT NULL, ocurred_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE domain_events');
    }
}
