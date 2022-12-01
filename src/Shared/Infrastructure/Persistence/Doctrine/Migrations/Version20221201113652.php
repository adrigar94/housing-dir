<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201113652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add columns gallery, updated_at and created_at to rental_properties';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental_properties ADD gallery JSON NOT NULL');
        $this->addSql('ALTER TABLE rental_properties ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE rental_properties ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE rental_properties DROP gallery');
        $this->addSql('ALTER TABLE rental_properties DROP updated_at');
        $this->addSql('ALTER TABLE rental_properties DROP created_at');
    }
}
