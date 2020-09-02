<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629153506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient ADD date_naissance DATE NOT NULL, ADD num_fixe VARCHAR(20) DEFAULT NULL, ADD num_portable VARCHAR(20) DEFAULT NULL, ADD date_creation DATE NOT NULL, DROP dateNaissance, DROP numFixe, DROP numPortable, DROP dateCreation, CHANGE codepostal code_postal VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient ADD dateNaissance DATE NOT NULL, ADD numFixe VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD numPortable VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD dateCreation DATE NOT NULL, DROP date_naissance, DROP num_fixe, DROP num_portable, DROP date_creation, CHANGE code_postal codePostal VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateur CHANGE roles roles JSON DEFAULT NULL');
    }
}
