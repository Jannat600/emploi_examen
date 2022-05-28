<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527212907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE niveau_module (niveau_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_A81085B7B3E9C81 (niveau_id), INDEX IDX_A81085B7AFC2B591 (module_id), PRIMARY KEY(niveau_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upfien_module (upfien_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_A298139724DB40C6 (upfien_id), INDEX IDX_A2981397AFC2B591 (module_id), PRIMARY KEY(upfien_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE niveau_module ADD CONSTRAINT FK_A81085B7B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE niveau_module ADD CONSTRAINT FK_A81085B7AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE upfien_module ADD CONSTRAINT FK_A298139724DB40C6 FOREIGN KEY (upfien_id) REFERENCES upfien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE upfien_module ADD CONSTRAINT FK_A2981397AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE emploi ADD annee_univ_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FA7D34CA3C FOREIGN KEY (annee_univ_id) REFERENCES annee_univ (id)');
        $this->addSql('CREATE INDEX IDX_74A0B0FA7D34CA3C ON emploi (annee_univ_id)');
        $this->addSql('ALTER TABLE upfien DROP FOREIGN KEY FK_F83456D3180AA129');
        $this->addSql('DROP INDEX IDX_F83456D3180AA129 ON upfien');
        $this->addSql('ALTER TABLE upfien CHANGE filiere_id niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upfien ADD CONSTRAINT FK_F83456D3B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_F83456D3B3E9C81 ON upfien (niveau_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE niveau_module');
        $this->addSql('DROP TABLE upfien_module');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FA7D34CA3C');
        $this->addSql('DROP INDEX IDX_74A0B0FA7D34CA3C ON emploi');
        $this->addSql('ALTER TABLE emploi DROP annee_univ_id');
        $this->addSql('ALTER TABLE upfien DROP FOREIGN KEY FK_F83456D3B3E9C81');
        $this->addSql('DROP INDEX IDX_F83456D3B3E9C81 ON upfien');
        $this->addSql('ALTER TABLE upfien CHANGE niveau_id filiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upfien ADD CONSTRAINT FK_F83456D3180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('CREATE INDEX IDX_F83456D3180AA129 ON upfien (filiere_id)');
    }
}
