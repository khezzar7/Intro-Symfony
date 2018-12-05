<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181129145456 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966FC2D9FF7');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966FC2D9FF7 FOREIGN KEY (capital_id) REFERENCES city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966FC2D9FF7');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966FC2D9FF7 FOREIGN KEY (capital_id) REFERENCES country (id)');
    }
}
