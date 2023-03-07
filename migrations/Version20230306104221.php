<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306104221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opening_days (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opening_days_services (opening_days_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_F77D5B6311F5419 (opening_days_id), INDEX IDX_F77D5B63AEF5A6C1 (services_id), PRIMARY KEY(opening_days_id, services_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE opening_days_services ADD CONSTRAINT FK_F77D5B6311F5419 FOREIGN KEY (opening_days_id) REFERENCES opening_days (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opening_days_services ADD CONSTRAINT FK_F77D5B63AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opening_days_services DROP FOREIGN KEY FK_F77D5B6311F5419');
        $this->addSql('ALTER TABLE opening_days_services DROP FOREIGN KEY FK_F77D5B63AEF5A6C1');
        $this->addSql('DROP TABLE opening_days');
        $this->addSql('DROP TABLE opening_days_services');
    }
}
