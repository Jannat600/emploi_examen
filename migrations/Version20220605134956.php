<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605134956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance ADD professeur_id INT DEFAULT NULL, ADD emploi_id INT DEFAULT NULL, ADD jour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES upfien (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EEC013E12 FOREIGN KEY (emploi_id) REFERENCES emploi (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0EBAB22EE9 ON seance (professeur_id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0EEC013E12 ON seance (emploi_id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0E220C6AD0 ON seance (jour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EBAB22EE9');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EEC013E12');
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0E220C6AD0');
        $this->addSql('DROP INDEX IDX_DF7DFD0EBAB22EE9 ON seance');
        $this->addSql('DROP INDEX IDX_DF7DFD0EEC013E12 ON seance');
        $this->addSql('DROP INDEX IDX_DF7DFD0E220C6AD0 ON seance');
        $this->addSql('ALTER TABLE seance DROP professeur_id, DROP emploi_id, DROP jour_id');
    }
}
