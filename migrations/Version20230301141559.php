<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301141559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP picture');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955CC5AE6B3');
        $this->addSql('DROP INDEX IDX_42C84955CC5AE6B3 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP restaurant_table_id');
        $this->addSql('ALTER TABLE tables DROP FOREIGN KEY FK_84470221A76ED395');
        $this->addSql('DROP INDEX IDX_84470221A76ED395 ON tables');
        $this->addSql('ALTER TABLE tables DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes ADD picture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD restaurant_table_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955CC5AE6B3 FOREIGN KEY (restaurant_table_id) REFERENCES tables (id)');
        $this->addSql('CREATE INDEX IDX_42C84955CC5AE6B3 ON reservation (restaurant_table_id)');
        $this->addSql('ALTER TABLE tables ADD user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE tables ADD CONSTRAINT FK_84470221A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_84470221A76ED395 ON tables (user_id)');
    }
}
