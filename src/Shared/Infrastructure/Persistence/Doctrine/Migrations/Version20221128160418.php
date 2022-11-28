<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221128160418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add column characteristics';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE rental_properties ADD characteristics JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE rental_properties DROP characteristics');
    }
}
