<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211221111728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, departure_id INT NOT NULL, arrival_id INT NOT NULL, number VARCHAR(15) NOT NULL, status SMALLINT NOT NULL, duration INT NOT NULL, base_price DOUBLE PRECISION NOT NULL, INDEX IDX_C257E60E7704ED06 (departure_id), INDEX IDX_C257E60E62789708 (arrival_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E7704ED06 FOREIGN KEY (departure_id) REFERENCES airport (id)');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E62789708 FOREIGN KEY (arrival_id) REFERENCES airport (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE flight');
    }
}
