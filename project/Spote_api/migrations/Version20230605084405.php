<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605084405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User_Conversation (conversation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3CD0B3E99AC0396 (conversation_id), INDEX IDX_3CD0B3E9A76ED395 (user_id), PRIMARY KEY(conversation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, location VARCHAR(255) NOT NULL, parution TINYINT(1) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3BAE0AA7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_networks (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, network_name VARCHAR(255) NOT NULL, link LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_9F555DFB71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_opinion (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, event_id INT NOT NULL, note SMALLINT NOT NULL, opinion LONGTEXT DEFAULT NULL, INDEX IDX_2E551988A76ED395 (user_id), INDEX IDX_2E55198871F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_schedules (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, day INT NOT NULL, end_time TIME NOT NULL, start_time TIME NOT NULL, INDEX IDX_B7AEE2B371F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_type (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_93151B8271F7E88B (event_id), INDEX IDX_93151B82BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, conversation_id_id INT NOT NULL, content LONGTEXT NOT NULL, image LONGBLOB NOT NULL, sent_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B6BD307F6B92BD7B (conversation_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE User_Conversation ADD CONSTRAINT FK_3CD0B3E99AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE User_Conversation ADD CONSTRAINT FK_3CD0B3E9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_networks ADD CONSTRAINT FK_9F555DFB71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_opinion ADD CONSTRAINT FK_2E551988A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_opinion ADD CONSTRAINT FK_2E55198871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_schedules ADD CONSTRAINT FK_B7AEE2B371F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_type ADD CONSTRAINT FK_93151B8271F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_type ADD CONSTRAINT FK_93151B82BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F6B92BD7B FOREIGN KEY (conversation_id_id) REFERENCES conversation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE User_Conversation DROP FOREIGN KEY FK_3CD0B3E99AC0396');
        $this->addSql('ALTER TABLE User_Conversation DROP FOREIGN KEY FK_3CD0B3E9A76ED395');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A76ED395');
        $this->addSql('ALTER TABLE event_networks DROP FOREIGN KEY FK_9F555DFB71F7E88B');
        $this->addSql('ALTER TABLE event_opinion DROP FOREIGN KEY FK_2E551988A76ED395');
        $this->addSql('ALTER TABLE event_opinion DROP FOREIGN KEY FK_2E55198871F7E88B');
        $this->addSql('ALTER TABLE event_schedules DROP FOREIGN KEY FK_B7AEE2B371F7E88B');
        $this->addSql('ALTER TABLE event_type DROP FOREIGN KEY FK_93151B8271F7E88B');
        $this->addSql('ALTER TABLE event_type DROP FOREIGN KEY FK_93151B82BCF5E72D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F6B92BD7B');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE User_Conversation');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_networks');
        $this->addSql('DROP TABLE event_opinion');
        $this->addSql('DROP TABLE event_schedules');
        $this->addSql('DROP TABLE event_type');
        $this->addSql('DROP TABLE message');
    }
}
