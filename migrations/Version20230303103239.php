<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230303103239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP allergies, CHANGE reservation_date reservation_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE reservation_time reservation_time TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD allergies VARCHAR(255) NOT NULL, CHANGE reservation_date reservation_date DATETIME NOT NULL, CHANGE reservation_time reservation_time TIME NOT NULL');
    }
}
