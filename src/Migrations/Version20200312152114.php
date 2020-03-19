<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200312152114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE likes (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_publicacion_id INT NOT NULL, fecha_like DATETIME NOT NULL, INDEX IDX_49CA4E7D79F37AE5 (id_user_id), INDEX IDX_49CA4E7DA7AD08E1 (id_publicacion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7DA7AD08E1 FOREIGN KEY (id_publicacion_id) REFERENCES pensamientos (id)');
        $this->addSql('ALTER TABLE comentarios CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_pensamiento_id id_pensamiento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE likes');
        $this->addSql('ALTER TABLE comentarios CHANGE id_user_id id_user_id INT DEFAULT NULL, CHANGE id_pensamiento_id id_pensamiento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
