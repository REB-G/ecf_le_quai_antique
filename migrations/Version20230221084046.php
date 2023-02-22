<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230221084046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE reservation_allergies
        (reservation_id INT NOT NULL, allergies_id INT NOT NULL,
        INDEX IDX_975EDE84B83297E7 (reservation_id), INDEX IDX_975EDE847104939B (allergies_id),
        PRIMARY KEY(reservation_id, allergies_id))
        DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_allergies ADD CONSTRAINT FK_975EDE84B83297E7
        FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_allergies ADD CONSTRAINT FK_975EDE847104939B
        FOREIGN KEY (allergies_id) REFERENCES allergies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD created_at
        DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
        ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE reservation_allergies DROP FOREIGN KEY FK_975EDE84B83297E7');
        $this->addSql('ALTER TABLE reservation_allergies DROP FOREIGN KEY FK_975EDE847104939B');
        $this->addSql('DROP TABLE reservation_allergies');
        $this->addSql('ALTER TABLE reservation DROP created_at, DROP updated_at');
    }
}
