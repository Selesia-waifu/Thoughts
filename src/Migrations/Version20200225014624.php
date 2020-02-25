<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225014624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comentarios (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_pensamiento_id INT DEFAULT NULL, contenido_comentario VARCHAR(1000) NOT NULL, fecha_comentario DATETIME NOT NULL, INDEX IDX_F54B3FC079F37AE5 (id_user_id), INDEX IDX_F54B3FC0F2079710 (id_pensamiento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pensamientos (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, titulo VARCHAR(255) NOT NULL, contenido VARCHAR(8000) NOT NULL, fecha_pensamiento DATETIME NOT NULL, INDEX IDX_537D8ACF79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comentarios ADD CONSTRAINT FK_F54B3FC079F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comentarios ADD CONSTRAINT FK_F54B3FC0F2079710 FOREIGN KEY (id_pensamiento_id) REFERENCES pensamientos (id)');
        $this->addSql('ALTER TABLE pensamientos ADD CONSTRAINT FK_537D8ACF79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comentarios DROP FOREIGN KEY FK_F54B3FC0F2079710');
        $this->addSql('ALTER TABLE comentarios DROP FOREIGN KEY FK_F54B3FC079F37AE5');
        $this->addSql('ALTER TABLE pensamientos DROP FOREIGN KEY FK_537D8ACF79F37AE5');
        $this->addSql('DROP TABLE comentarios');
        $this->addSql('DROP TABLE pensamientos');
        $this->addSql('DROP TABLE user');
    }
}
