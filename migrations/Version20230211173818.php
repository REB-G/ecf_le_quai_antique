<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230211173818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dishes ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35D12469DE2
        FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_584DD35D12469DE2 ON dishes (category_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35D12469DE2');
        $this->addSql('DROP INDEX IDX_584DD35D12469DE2 ON dishes');
        $this->addSql('ALTER TABLE dishes DROP category_id');
    }
}
