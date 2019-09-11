<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190911135357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE vote_teacher (vote_id INT NOT NULL, teacher_id INT NOT NULL, PRIMARY KEY(vote_id, teacher_id))');
        $this->addSql('CREATE INDEX IDX_3B44F94D72DCDAFC ON vote_teacher (vote_id)');
        $this->addSql('CREATE INDEX IDX_3B44F94D41807E1D ON vote_teacher (teacher_id)');
        $this->addSql('CREATE TABLE vote_category (vote_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(vote_id, category_id))');
        $this->addSql('CREATE INDEX IDX_F813B0E872DCDAFC ON vote_category (vote_id)');
        $this->addSql('CREATE INDEX IDX_F813B0E812469DE2 ON vote_category (category_id)');
        $this->addSql('ALTER TABLE vote_teacher ADD CONSTRAINT FK_3B44F94D72DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote_teacher ADD CONSTRAINT FK_3B44F94D41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote_category ADD CONSTRAINT FK_F813B0E872DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote_category ADD CONSTRAINT FK_F813B0E812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote DROP CONSTRAINT fk_5a10856441807e1d');
        $this->addSql('ALTER TABLE vote DROP CONSTRAINT fk_5a10856412469de2');
        $this->addSql('DROP INDEX idx_5a10856412469de2');
        $this->addSql('DROP INDEX idx_5a10856441807e1d');
        $this->addSql('ALTER TABLE vote DROP teacher_id');
        $this->addSql('ALTER TABLE vote DROP category_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE vote_teacher');
        $this->addSql('DROP TABLE vote_category');
        $this->addSql('ALTER TABLE vote ADD teacher_id INT NOT NULL');
        $this->addSql('ALTER TABLE vote ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT fk_5a10856441807e1d FOREIGN KEY (teacher_id) REFERENCES teacher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vote ADD CONSTRAINT fk_5a10856412469de2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5a10856412469de2 ON vote (category_id)');
        $this->addSql('CREATE INDEX idx_5a10856441807e1d ON vote (teacher_id)');
    }
}
