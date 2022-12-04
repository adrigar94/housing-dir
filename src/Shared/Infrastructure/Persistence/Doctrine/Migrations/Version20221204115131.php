<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204115131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create unique index for email column in users';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX u_user_email ON users (email)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX u_user_email');
    }
}
