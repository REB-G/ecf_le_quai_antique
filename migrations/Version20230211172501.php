<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230211172501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE tables ADD user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE tables ADD CONSTRAINT FK_84470221A76ED395
        FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_84470221A76ED395 ON tables (user_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE tables DROP FOREIGN KEY FK_84470221A76ED395');
        $this->addSql('DROP INDEX IDX_84470221A76ED395 ON tables');
        $this->addSql('ALTER TABLE tables DROP user_id');
    }
}
