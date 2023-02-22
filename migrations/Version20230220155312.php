<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230220155312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users_allergies
        (users_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\',
        allergies_id INT NOT NULL, INDEX IDX_EB64C5FA67B3B43D (users_id),
        INDEX IDX_EB64C5FA7104939B (allergies_id),
        PRIMARY KEY(users_id, allergies_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_allergies ADD CONSTRAINT FK_EB64C5FA67B3B43D
        FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_allergies ADD CONSTRAINT FK_EB64C5FA7104939B
        FOREIGN KEY (allergies_id) REFERENCES allergies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergies_users DROP FOREIGN KEY FK_A1C1B42E67B3B43D');
        $this->addSql('ALTER TABLE allergies_users DROP FOREIGN KEY FK_A1C1B42E7104939B');
        $this->addSql('DROP TABLE allergies_users');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TABLE allergies_users
        (allergies_id INT NOT NULL, users_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\',
        INDEX IDX_A1C1B42E7104939B (allergies_id), INDEX IDX_A1C1B42E67B3B43D (users_id),
        PRIMARY KEY(allergies_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci`
        ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE allergies_users ADD CONSTRAINT FK_A1C1B42E67B3B43D
        FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergies_users ADD CONSTRAINT FK_A1C1B42E7104939B
        FOREIGN KEY (allergies_id) REFERENCES allergies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_allergies DROP FOREIGN KEY FK_EB64C5FA67B3B43D');
        $this->addSql('ALTER TABLE users_allergies DROP FOREIGN KEY FK_EB64C5FA7104939B');
        $this->addSql('DROP TABLE users_allergies');
    }
}
