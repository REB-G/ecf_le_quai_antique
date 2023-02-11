<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230211173214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE reservation ADD restaurant_table_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955CC5AE6B3
        FOREIGN KEY (restaurant_table_id) REFERENCES tables (id)');
        $this->addSql('CREATE INDEX IDX_42C84955CC5AE6B3 ON reservation (restaurant_table_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955CC5AE6B3');
        $this->addSql('DROP INDEX IDX_42C84955CC5AE6B3 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP restaurant_table_id');
    }
}
