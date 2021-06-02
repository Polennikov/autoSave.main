<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210531233620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE book_kt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE dtp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE book_kt (id INT NOT NULL, region VARCHAR(255) NOT NULL, index DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE dtp (id INT NOT NULL, date_dtp DATE NOT NULL, description TEXT NOT NULL, adress_dtp VARCHAR(255) NOT NULL, degree VARCHAR(100) NOT NULL, initiator BOOLEAN NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE book_kt_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE dtp_id_seq CASCADE');
        $this->addSql('DROP TABLE book_kt');
        $this->addSql('DROP TABLE dtp');
    }
}
