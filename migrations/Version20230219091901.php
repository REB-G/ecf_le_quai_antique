<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230219091901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE allergies (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergies_users (
            allergies_id INT NOT NULL,
            users_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\',
            INDEX IDX_A1C1B42E7104939B (allergies_id), INDEX IDX_A1C1B42E67B3B43D (users_id),
            PRIMARY KEY(allergies_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allergies_users ADD CONSTRAINT FK_A1C1B42E7104939B
            FOREIGN KEY (allergies_id) REFERENCES allergies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergies_users ADD CONSTRAINT FK_A1C1B42E67B3B43D
            FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users DROP allergies');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE allergies_users DROP FOREIGN KEY FK_A1C1B42E7104939B');
        $this->addSql('ALTER TABLE allergies_users DROP FOREIGN KEY FK_A1C1B42E67B3B43D');
        $this->addSql('DROP TABLE allergies');
        $this->addSql('DROP TABLE allergies_users');
        $this->addSql('ALTER TABLE users ADD allergies VARCHAR(255) DEFAULT NULL');
    }
}
