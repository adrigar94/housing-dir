<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221127113828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table rental_properties';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE rental_properties (id UUID NOT NULL, title VARCHAR(70) NOT NULL, description VARCHAR(5120) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE rental_properties');
    }
}
