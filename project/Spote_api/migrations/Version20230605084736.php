<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605084736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE User_Conversation RENAME INDEX idx_3cd0b3e99ac0396 TO IDX_A425AEB9AC0396');
        $this->addSql('ALTER TABLE User_Conversation RENAME INDEX idx_3cd0b3e9a76ed395 TO IDX_A425AEBA76ED395');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_conversation RENAME INDEX idx_a425aeba76ed395 TO IDX_3CD0B3E9A76ED395');
        $this->addSql('ALTER TABLE user_conversation RENAME INDEX idx_a425aeb9ac0396 TO IDX_3CD0B3E99AC0396');
    }
}
