<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220909085745 extends AbstractMigration
{
    public const UNEXPECTED_TYPE_MESSAGE = 'Method %s expect string, %s given';

    public function getDescription(): string
    {
        return 'Implement VideoGameEntity';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE video_game_entity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE video_game_entity (id INT NOT NULL, title VARCHAR(255) NOT NULL, release_date DATE NOT NULL, website_url VARCHAR(255) NOT NULL, note INT DEFAULT NULL, completed BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_519F58012B36786B ON video_game_entity (title)');
        $this->addSql('COMMENT ON COLUMN video_game_entity.release_date IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE video_game_entity_id_seq CASCADE');
        $this->addSql('DROP TABLE video_game_entity');
    }
}
