<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608010744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE Users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE auto_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE book_kt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contract_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE dtp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE refresh_tokens_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE relation_driver_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE Users (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, number_driver VARCHAR(255) DEFAULT NULL, surname VARCHAR(150) NOT NULL, name VARCHAR(150) NOT NULL, mid_name VARCHAR(150) NOT NULL, date_driver DATE NOT NULL, adress_driver VARCHAR(255) DEFAULT NULL, exp_driver INT DEFAULT NULL, gender_driver BOOLEAN DEFAULT NULL, kbm DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AEDE7927C74 ON Users (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D5428AED84627FD8 ON Users (number_driver)');
        $this->addSql('CREATE TABLE auto (id INT NOT NULL, users_id INT NOT NULL, vin VARCHAR(255) NOT NULL, marka VARCHAR(100) NOT NULL, model VARCHAR(100) NOT NULL, number VARCHAR(10) NOT NULL, color VARCHAR(100) NOT NULL, year INT NOT NULL, power INT NOT NULL, mileage INT DEFAULT NULL, category VARCHAR(5) NOT NULL, number_sts VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66BA25FAB1085141 ON auto (vin)');
        $this->addSql('CREATE INDEX IDX_66BA25FA67B3B43D ON auto (users_id)');
        $this->addSql('CREATE TABLE book_kt (id INT NOT NULL, region VARCHAR(255) NOT NULL, index DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contract (id INT NOT NULL, auto_id INT DEFAULT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, amount VARCHAR(100) NOT NULL, purpose VARCHAR(255) NOT NULL, status INT NOT NULL, agent_id VARCHAR(255) DEFAULT NULL, date_start_one DATE NOT NULL, date_end_one DATE NOT NULL, date_start_two DATE DEFAULT NULL, date_end_two DATE DEFAULT NULL, date_start_three DATE DEFAULT NULL, date_end_three DATE DEFAULT NULL, diagnostic_card VARCHAR(255) NOT NULL, non_limited BOOLEAN NOT NULL, trailer BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E98F28591D55B925 ON contract (auto_id)');
        $this->addSql('CREATE TABLE dtp (id INT NOT NULL, date_dtp DATE NOT NULL, description TEXT NOT NULL, adress_dtp VARCHAR(255) NOT NULL, degree VARCHAR(100) NOT NULL, initiator BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE refresh_tokens (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
        $this->addSql('CREATE TABLE relation_driver (id INT NOT NULL, users_id INT NOT NULL, contracts_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6427C4F67B3B43D ON relation_driver (users_id)');
        $this->addSql('CREATE INDEX IDX_6427C4F24584564 ON relation_driver (contracts_id)');
        $this->addSql('ALTER TABLE auto ADD CONSTRAINT FK_66BA25FA67B3B43D FOREIGN KEY (users_id) REFERENCES Users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28591D55B925 FOREIGN KEY (auto_id) REFERENCES auto (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE relation_driver ADD CONSTRAINT FK_6427C4F67B3B43D FOREIGN KEY (users_id) REFERENCES Users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE relation_driver ADD CONSTRAINT FK_6427C4F24584564 FOREIGN KEY (contracts_id) REFERENCES contract (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE auto DROP CONSTRAINT FK_66BA25FA67B3B43D');
        $this->addSql('ALTER TABLE relation_driver DROP CONSTRAINT FK_6427C4F67B3B43D');
        $this->addSql('ALTER TABLE contract DROP CONSTRAINT FK_E98F28591D55B925');
        $this->addSql('ALTER TABLE relation_driver DROP CONSTRAINT FK_6427C4F24584564');
        $this->addSql('DROP SEQUENCE Users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE auto_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE book_kt_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contract_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE dtp_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE refresh_tokens_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE relation_driver_id_seq CASCADE');
        $this->addSql('DROP TABLE Users');
        $this->addSql('DROP TABLE auto');
        $this->addSql('DROP TABLE book_kt');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE dtp');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE relation_driver');
    }
}
