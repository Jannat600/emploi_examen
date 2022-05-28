<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527204150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaire_jour (horaire_id INT NOT NULL, jour_id INT NOT NULL, INDEX IDX_8279C49D58C54515 (horaire_id), INDEX IDX_8279C49D220C6AD0 (jour_id), PRIMARY KEY(horaire_id, jour_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, filiere_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, INDEX IDX_4BDFF36B180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE horaire_jour ADD CONSTRAINT FK_8279C49D58C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE horaire_jour ADD CONSTRAINT FK_8279C49D220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE emploi ADD user_id INT DEFAULT NULL, ADD semestre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FA5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('CREATE INDEX IDX_74A0B0FAA76ED395 ON emploi (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_74A0B0FA5577AFDB ON emploi (semestre_id)');
        $this->addSql('ALTER TABLE jour ADD emploi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jour ADD CONSTRAINT FK_DA17D9C5EC013E12 FOREIGN KEY (emploi_id) REFERENCES emploi (id)');
        $this->addSql('CREATE INDEX IDX_DA17D9C5EC013E12 ON jour (emploi_id)');
        $this->addSql('ALTER TABLE seance ADD module_id INT NOT NULL, ADD horaire_id INT DEFAULT NULL, ADD salle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E58C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DF7DFD0EAFC2B591 ON seance (module_id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0E58C54515 ON seance (horaire_id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0EDC304035 ON seance (salle_id)');
        $this->addSql('ALTER TABLE semestre ADD niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE semestre ADD CONSTRAINT FK_71688FBCB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_71688FBCB3E9C81 ON semestre (niveau_id)');
        $this->addSql('ALTER TABLE upfien ADD niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upfien ADD CONSTRAINT FK_F83456D3180AA129 FOREIGN KEY (niveau_id) REFERENCES filiere (id)');
        $this->addSql('CREATE INDEX IDX_F83456D3180AA129 ON upfien (niveau_id)');
        $this->addSql('ALTER TABLE user ADD upfien_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64924DB40C6 FOREIGN KEY (upfien_id) REFERENCES upfien (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64924DB40C6 ON user (upfien_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBCB3E9C81');
        $this->addSql('DROP TABLE horaire_jour');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FAA76ED395');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FA5577AFDB');
        $this->addSql('DROP INDEX IDX_74A0B0FAA76ED395 ON emploi');
        $this->addSql('DROP INDEX UNIQ_74A0B0FA5577AFDB ON emploi');
        $this->addSql('ALTER TABLE emploi DROP user_id, DROP semestre_id');
        $this->addSql('ALTER TABLE jour DROP FOREIGN KEY FK_DA17D9C5EC013E12');
        $this->addSql('DROP INDEX IDX_DA17D9C5EC013E12 ON jour');
        $this->addSql('ALTER TABLE jour DROP emploi_id');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EAFC2B591');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E58C54515');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EDC304035');
        $this->addSql('DROP INDEX UNIQ_DF7DFD0EAFC2B591 ON seance');
        $this->addSql('DROP INDEX IDX_DF7DFD0E58C54515 ON seance');
        $this->addSql('DROP INDEX IDX_DF7DFD0EDC304035 ON seance');
        $this->addSql('ALTER TABLE seance DROP module_id, DROP horaire_id, DROP salle_id');
        $this->addSql('DROP INDEX IDX_71688FBCB3E9C81 ON semestre');
        $this->addSql('ALTER TABLE semestre DROP niveau_id');
        $this->addSql('ALTER TABLE upfien DROP FOREIGN KEY FK_F83456D3180AA129');
        $this->addSql('DROP INDEX IDX_F83456D3180AA129 ON upfien');
        $this->addSql('ALTER TABLE upfien DROP filiere_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64924DB40C6');
        $this->addSql('DROP INDEX UNIQ_8D93D64924DB40C6 ON user');
        $this->addSql('ALTER TABLE user DROP upfien_id');
    }
}
