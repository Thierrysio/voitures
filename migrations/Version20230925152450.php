<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230925152450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture ADD les_modeles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F385F5C92 FOREIGN KEY (les_modeles_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F385F5C92 ON voiture (les_modeles_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F385F5C92');
        $this->addSql('DROP INDEX IDX_E9E2810F385F5C92 ON voiture');
        $this->addSql('ALTER TABLE voiture DROP les_modeles_id');
    }
}
