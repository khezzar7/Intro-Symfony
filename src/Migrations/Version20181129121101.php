<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129121101 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B023471179CD6');
        $this->addSql('DROP INDEX UNIQ_2D5B023471179CD6 ON city');
        $this->addSql('ALTER TABLE city ADD name VARCHAR(255) NOT NULL, DROP name_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE city ADD name_id INT DEFAULT NULL, DROP name');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023471179CD6 FOREIGN KEY (name_id) REFERENCES country (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B023471179CD6 ON city (name_id)');
    }
}
