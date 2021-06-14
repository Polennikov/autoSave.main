<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614182241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dtp DROP CONSTRAINT FK_ABC97720AC683CDB');
        $this->addSql('ALTER TABLE dtp ADD CONSTRAINT FK_ABC97720AC683CDB FOREIGN KEY (autos_id) REFERENCES auto (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dtp DROP CONSTRAINT fk_abc97720ac683cdb');
        $this->addSql('ALTER TABLE dtp ADD CONSTRAINT fk_abc97720ac683cdb FOREIGN KEY (autos_id) REFERENCES auto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
