<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919153245 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE minivote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE minivote (id INT NOT NULL, category_id INT DEFAULT NULL, teacher_id INT DEFAULT NULL, vote_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ED6A425B12469DE2 ON minivote (category_id)');
        $this->addSql('CREATE INDEX IDX_ED6A425B41807E1D ON minivote (teacher_id)');
        $this->addSql('CREATE INDEX IDX_ED6A425B72DCDAFC ON minivote (vote_id)');
        $this->addSql('ALTER TABLE minivote ADD CONSTRAINT FK_ED6A425B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minivote ADD CONSTRAINT FK_ED6A425B41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE minivote ADD CONSTRAINT FK_ED6A425B72DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE minivote_id_seq CASCADE');
        $this->addSql('DROP TABLE minivote');
    }
}
