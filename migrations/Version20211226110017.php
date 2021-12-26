<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211226110017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO vi_school_aviasales_db.flight 
    (departure_id, arrival_id, number, status, duration, base_price) 
    VALUES (
            (SELECT id FROM vi_school_aviasales_db.airport WHERE code_iata = 'DME'),
            (SELECT id FROM vi_school_aviasales_db.airport WHERE code_iata = 'SVO'),
            'RA 007', 0, 20, 1500
            ),
            (
             (SELECT id FROM vi_school_aviasales_db.airport WHERE code_iata = 'DME'),
            (SELECT id FROM vi_school_aviasales_db.airport WHERE code_iata = 'LED'),
             'SU 7443', 1, 70, 3200
            ),
            (
             (SELECT id FROM vi_school_aviasales_db.airport WHERE code_iata = 'SVO'),
            (SELECT id FROM vi_school_aviasales_db.airport WHERE code_iata = 'LED'),
             'IK 4463', 1, 80, 2700
            ),
            (
             (SELECT id FROM vi_school_aviasales_db.airport WHERE code_iata = 'GOJ'),
            (SELECT id FROM vi_school_aviasales_db.airport WHERE code_iata = 'LED'),
             'NW 3324', 1, 110, 3700
            )");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE vi_school_aviasales_db.flight');
    }
}
