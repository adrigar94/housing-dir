<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221201120549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add column price_month to rental_properties';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE rental_properties ADD price_month JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE rental_properties DROP price_month');
    }
}
