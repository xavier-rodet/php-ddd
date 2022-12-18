<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204184108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create player entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player (id UUID NOT NULL, email VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, avatar_url VARCHAR(255) DEFAULT NULL, credits INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN player.id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE player');
    }
}
