<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629093040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ant_detail (id INT AUTO_INCREMENT NOT NULL, antecedent_id INT NOT NULL, patient_id INT NOT NULL, detail LONGTEXT NOT NULL, INDEX IDX_2B4D850AE53D136E (antecedent_id), INDEX IDX_2B4D850A6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE antecedent (id INT AUTO_INCREMENT NOT NULL, nom_antecedent VARCHAR(100) NOT NULL, statut SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cabinet (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, date_consult DATETIME NOT NULL, test LONGTEXT DEFAULT NULL, traitement LONGTEXT DEFAULT NULL, conseil LONGTEXT DEFAULT NULL, note LONGTEXT DEFAULT NULL, montant DOUBLE PRECISION DEFAULT NULL, numero_cheque VARCHAR(50) DEFAULT NULL, INDEX IDX_964685A66B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE files (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, path VARCHAR(150) NOT NULL, INDEX IDX_63540596B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, sexe VARCHAR(100) DEFAULT NULL, date_naissance DATE NOT NULL, adresse VARCHAR(150) DEFAULT NULL, code_postal VARCHAR(10) DEFAULT NULL, ville VARCHAR(200) DEFAULT NULL, num_fixe VARCHAR(20) DEFAULT NULL, num_portable VARCHAR(20) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, profession VARCHAR(50) DEFAULT NULL, loisir LONGTEXT DEFAULT NULL, date_creation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_cabinet (patient_id INT NOT NULL, cabinet_id INT NOT NULL, INDEX IDX_118E505B6B899279 (patient_id), INDEX IDX_118E505BD351EC (cabinet_id), PRIMARY KEY(patient_id, cabinet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ant_detail ADD CONSTRAINT FK_2B4D850AE53D136E FOREIGN KEY (antecedent_id) REFERENCES antecedent (id)');
        $this->addSql('ALTER TABLE ant_detail ADD CONSTRAINT FK_2B4D850A6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE files ADD CONSTRAINT FK_63540596B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE patient_cabinet ADD CONSTRAINT FK_118E505B6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient_cabinet ADD CONSTRAINT FK_118E505BD351EC FOREIGN KEY (cabinet_id) REFERENCES cabinet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ant_detail DROP FOREIGN KEY FK_2B4D850AE53D136E');
        $this->addSql('ALTER TABLE patient_cabinet DROP FOREIGN KEY FK_118E505BD351EC');
        $this->addSql('ALTER TABLE ant_detail DROP FOREIGN KEY FK_2B4D850A6B899279');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A66B899279');
        $this->addSql('ALTER TABLE files DROP FOREIGN KEY FK_63540596B899279');
        $this->addSql('ALTER TABLE patient_cabinet DROP FOREIGN KEY FK_118E505B6B899279');
        $this->addSql('DROP TABLE ant_detail');
        $this->addSql('DROP TABLE antecedent');
        $this->addSql('DROP TABLE cabinet');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patient_cabinet');
        $this->addSql('DROP TABLE utilisateur');
    }
}
