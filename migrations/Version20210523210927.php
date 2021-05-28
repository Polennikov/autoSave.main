<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210523210927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER number_driver DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER adress_driver DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER exp_driver DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER gender_driver DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER kbm DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ALTER number_driver SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER adress_driver SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER exp_driver SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER gender_driver SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER kbm SET NOT NULL');
    }
}
