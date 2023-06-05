<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512122517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_opinion (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, event_id INT NOT NULL, note SMALLINT NOT NULL, opinion LONGTEXT DEFAULT NULL, INDEX IDX_2E551988A76ED395 (user_id), INDEX IDX_2E55198871F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_opinion ADD CONSTRAINT FK_2E551988A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_opinion ADD CONSTRAINT FK_2E55198871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_opinion DROP FOREIGN KEY FK_2E551988A76ED395');
        $this->addSql('ALTER TABLE event_opinion DROP FOREIGN KEY FK_2E55198871F7E88B');
        $this->addSql('DROP TABLE event_opinion');
    }
}
