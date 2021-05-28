<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210523213702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE Users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE Users (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, number_driver VARCHAR(255) DEFAULT NULL, surname VARCHAR(150) NOT NULL, name VARCHAR(150) NOT NULL, mid_name VARCHAR(150) NOT NULL, date_driver DATE NOT NULL, adress_driver VARCHAR(255) DEFAULT NULL, exp_driver INT DEFAULT NULL, gender_driver BOOLEAN DEFAULT NULL, kbm DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDE7927C74 ON Users (email)');
        $this->addSql('DROP TABLE "user"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE Users_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, number_driver VARCHAR(255) DEFAULT NULL, surname VARCHAR(150) NOT NULL, name VARCHAR(150) NOT NULL, mid_name VARCHAR(150) NOT NULL, date_driver DATE NOT NULL, adress_driver VARCHAR(255) DEFAULT NULL, exp_driver INT DEFAULT NULL, gender_driver BOOLEAN DEFAULT NULL, kbm DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->addSql('DROP TABLE Users');
    }
}
