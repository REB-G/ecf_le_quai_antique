<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306105850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD reservation_hour_id INT DEFAULT NULL, DROP reservation_time_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955D206C07C FOREIGN KEY (reservation_hour_id) REFERENCES reservation_time (id)');
        $this->addSql('CREATE INDEX IDX_42C84955D206C07C ON reservation (reservation_hour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955D206C07C');
        $this->addSql('DROP INDEX IDX_42C84955D206C07C ON reservation');
        $this->addSql('ALTER TABLE reservation ADD reservation_time_id INT NOT NULL, DROP reservation_hour_id');
    }
}
