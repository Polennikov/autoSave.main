<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608221025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dtp ADD users_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dtp ADD autos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dtp ADD CONSTRAINT FK_ABC9772067B3B43D FOREIGN KEY (users_id) REFERENCES Users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dtp ADD CONSTRAINT FK_ABC97720AC683CDB FOREIGN KEY (autos_id) REFERENCES auto (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ABC9772067B3B43D ON dtp (users_id)');
        $this->addSql('CREATE INDEX IDX_ABC97720AC683CDB ON dtp (autos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dtp DROP CONSTRAINT FK_ABC9772067B3B43D');
        $this->addSql('ALTER TABLE dtp DROP CONSTRAINT FK_ABC97720AC683CDB');
        $this->addSql('DROP INDEX IDX_ABC9772067B3B43D');
        $this->addSql('DROP INDEX IDX_ABC97720AC683CDB');
        $this->addSql('ALTER TABLE dtp DROP users_id');
        $this->addSql('ALTER TABLE dtp DROP autos_id');
    }
}
