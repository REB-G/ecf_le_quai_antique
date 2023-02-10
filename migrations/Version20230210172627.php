<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230210172627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users
        (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\',
        email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL,
        roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\',
        name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL,
        default_number_of_guests INT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
        updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\',
        UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email),
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
