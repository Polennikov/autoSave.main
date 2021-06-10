<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210609232752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE book_kbc_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE book_kbm_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE book_tb_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE book_kbc (id INT NOT NULL, age VARCHAR(255) NOT NULL, year_one_min VARCHAR(255) NOT NULL, year_one VARCHAR(255) NOT NULL, year_two VARCHAR(255) NOT NULL, year_three VARCHAR(255) NOT NULL, year_five VARCHAR(255) NOT NULL, year_seven VARCHAR(255) NOT NULL, year_ten VARCHAR(255) NOT NULL, year_fivten VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE book_kbm (id INT NOT NULL, class VARCHAR(255) NOT NULL, index VARCHAR(255) NOT NULL, payout_one VARCHAR(255) NOT NULL, payout_two VARCHAR(255) NOT NULL, payout_three VARCHAR(255) NOT NULL, payout_four VARCHAR(255) NOT NULL, payouts_null VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE book_tb (id INT NOT NULL, category VARCHAR(255) NOT NULL, index VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE book_kbc_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE book_kbm_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE book_tb_id_seq CASCADE');
        $this->addSql('DROP TABLE book_kbc');
        $this->addSql('DROP TABLE book_kbm');
        $this->addSql('DROP TABLE book_tb');
    }
}
