<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180801125456 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lessons (id INT AUTO_INCREMENT NOT NULL, idcategories_id INT NOT NULL, name VARCHAR(75) NOT NULL, lesson LONGTEXT NOT NULL, INDEX IDX_3F4218D9DB88036C (idcategories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D9DB88036C FOREIGN KEY (idcategories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE categories ADD lessons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668FED07355 FOREIGN KEY (lessons_id) REFERENCES lessons (id)');
        $this->addSql('CREATE INDEX IDX_3AF34668FED07355 ON categories (lessons_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668FED07355');
        $this->addSql('DROP TABLE lessons');
        $this->addSql('DROP INDEX IDX_3AF34668FED07355 ON categories');
        $this->addSql('ALTER TABLE categories DROP lessons_id');
    }
}
