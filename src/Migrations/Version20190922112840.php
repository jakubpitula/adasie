<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190922112840 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE vote_teacher');
        $this->addSql('DROP TABLE vote_category');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE vote_teacher (vote_id INT NOT NULL, teacher_id INT NOT NULL, PRIMARY KEY(vote_id, teacher_id))');
        $this->addSql('CREATE INDEX idx_3b44f94d72dcdafc ON vote_teacher (vote_id)');
        $this->addSql('CREATE INDEX idx_3b44f94d41807e1d ON vote_teacher (teacher_id)');
        $this->addSql('CREATE TABLE vote_category (vote_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(vote_id, category_id))');
        $this->addSql('CREATE INDEX idx_f813b0e812469de2 ON vote_category (category_id)');
        $this->addSql('CREATE INDEX idx_f813b0e872dcdafc ON vote_category (vote_id)');
        $this->addSql('ALTER TABLE vote_teacher ADD CONSTRAINT fk_3b44f94d72dcdafc FOREIGN KEY (vote_id) REFERENCES vote (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote_teacher ADD CONSTRAINT fk_3b44f94d41807e1d FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote_category ADD CONSTRAINT fk_f813b0e872dcdafc FOREIGN KEY (vote_id) REFERENCES vote (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote_category ADD CONSTRAINT fk_f813b0e812469de2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
