<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321031223 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tarsus_division ADD id_authorizer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tarsus_division ADD CONSTRAINT FK_89889E4C82C7742C FOREIGN KEY (id_authorizer_id) REFERENCES tarsus_user (id)');
        $this->addSql('CREATE INDEX IDX_89889E4C82C7742C ON tarsus_division (id_authorizer_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tarsus_division DROP FOREIGN KEY FK_89889E4C82C7742C');
        $this->addSql('DROP INDEX IDX_89889E4C82C7742C ON tarsus_division');
        $this->addSql('ALTER TABLE tarsus_division DROP id_authorizer_id');
    }
}
