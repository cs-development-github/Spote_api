<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230607142049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_networks_event DROP FOREIGN KEY FK_4DC04C671F7E88B');
        $this->addSql('ALTER TABLE event_networks_event DROP FOREIGN KEY FK_4DC04C6CBC4DFFC');
        $this->addSql('DROP TABLE event_networks_event');
        $this->addSql('ALTER TABLE event_networks ADD event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event_networks ADD CONSTRAINT FK_9F555DFB71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_9F555DFB71F7E88B ON event_networks (event_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_networks_event (event_networks_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_4DC04C671F7E88B (event_id), INDEX IDX_4DC04C6CBC4DFFC (event_networks_id), PRIMARY KEY(event_networks_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event_networks_event ADD CONSTRAINT FK_4DC04C671F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_networks_event ADD CONSTRAINT FK_4DC04C6CBC4DFFC FOREIGN KEY (event_networks_id) REFERENCES event_networks (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_networks DROP FOREIGN KEY FK_9F555DFB71F7E88B');
        $this->addSql('DROP INDEX IDX_9F555DFB71F7E88B ON event_networks');
        $this->addSql('ALTER TABLE event_networks DROP event_id');
    }
}
