<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230211153933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE tables
        (id INT AUTO_INCREMENT NOT NULL,
        table_number INT NOT NULL,
        number_of_places INT NOT NULL,
        is_available TINYINT(1) NOT NULL,
        UNIQUE INDEX UNIQ_84470221C8421A97 (table_number),
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE tables');
    }
}
