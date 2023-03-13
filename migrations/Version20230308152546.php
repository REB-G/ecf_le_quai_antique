<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308152546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD service_id INT DEFAULT NULL, DROP serve_time_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_42C84955ED5CA9E6 ON reservation (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955ED5CA9E6');
        $this->addSql('DROP INDEX IDX_42C84955ED5CA9E6 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD serve_time_id INT NOT NULL, DROP service_id');
    }
}
