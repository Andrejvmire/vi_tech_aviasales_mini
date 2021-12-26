<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211226102209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO vi_school_aviasales_db.airport 
    (full_name, city, code_iata) 
    VALUES ('Шереметьево', 'Москва', 'SVO'),
    ('Домодедово', 'Москва', 'DME'),
    ('Пулково', 'Санкт-Петербург', 'LED'),
    ('им. Чкалова', 'Нижний Новгород', 'GOJ')
    ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE vi_school_aviasales_db.airport');
    }
}
