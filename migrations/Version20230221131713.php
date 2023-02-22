<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230221131713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE menus_dishes
        (menus_id INT NOT NULL,
        dishes_id INT NOT NULL, INDEX IDX_877C5E7914041B84 (menus_id),
        INDEX IDX_877C5E79A05DD37A (dishes_id), PRIMARY KEY(menus_id, dishes_id))
        DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menus_dishes ADD CONSTRAINT FK_877C5E7914041B84 FOREIGN KEY (menus_id)
        REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menus_dishes ADD CONSTRAINT FK_877C5E79A05DD37A FOREIGN KEY (dishes_id)
        REFERENCES dishes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes_menus DROP FOREIGN KEY FK_8DD9051BA05DD37A');
        $this->addSql('ALTER TABLE dishes_menus DROP FOREIGN KEY FK_8DD9051B14041B84');
        $this->addSql('DROP TABLE dishes_menus');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TABLE dishes_menus
        (dishes_id INT NOT NULL, menus_id INT NOT NULL, INDEX IDX_8DD9051BA05DD37A (dishes_id),
        INDEX IDX_8DD9051B14041B84 (menus_id), PRIMARY KEY(dishes_id, menus_id))
        DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dishes_menus ADD CONSTRAINT FK_8DD9051BA05DD37A FOREIGN KEY (dishes_id)
        REFERENCES dishes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes_menus ADD CONSTRAINT FK_8DD9051B14041B84 FOREIGN KEY (menus_id)
        REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menus_dishes DROP FOREIGN KEY FK_877C5E7914041B84');
        $this->addSql('ALTER TABLE menus_dishes DROP FOREIGN KEY FK_877C5E79A05DD37A');
        $this->addSql('DROP TABLE menus_dishes');
    }
}
