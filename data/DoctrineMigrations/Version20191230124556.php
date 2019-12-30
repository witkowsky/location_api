<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191230124556 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'fill locations';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');


        $this->addSql('INSERT INTO locations (name, address, latitude, longitude, distance, isHomePl) VALUES (\'Home.pl\', \'Zbożowa 4, Szczecin\', 53.4224, 14.5635, 0, 1)');
        $this->addSql('INSERT INTO locations (name, address, latitude, longitude, distance, isHomePl) VALUES (\'RedSky\', \'Aleja Piastów 22, Szczecin\', 53.4211, 14.5337, 1.98, 0)');
        $this->addSql('INSERT INTO locations (name, address, latitude, longitude, distance, isHomePl) VALUES (\'Tieto\', \'Aleja Piastów 30, Szczecin\', 53.4183, 14.5321, 2.13, 0)');
        $this->addSql('INSERT INTO locations (name, address, latitude, longitude, distance, isHomePl) VALUES (\'Cd Projekt\', \'Jagiellońska 74, Warszawa\', 52.2674, 21.0210, 452.09, 0)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DELETE FROM locations WHERE name IN (\'Home.pl\',\'RedSky\',\'Tieto\',\'Cd Projekt\')');
    }
}
