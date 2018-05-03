<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180320062855 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tarsus_division (id INT AUTO_INCREMENT NOT NULL, division VARCHAR(255) NOT NULL, create_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarsus_user (id INT AUTO_INCREMENT NOT NULL, id_division_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) DEFAULT NULL, job_title VARCHAR(255) NOT NULL, email_address VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, user_role VARCHAR(255) NOT NULL, create_date DATETIME NOT NULL, update_date DATETIME NOT NULL, INDEX IDX_C2A1535F59975F7E (id_division_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tarsus_user ADD CONSTRAINT FK_C2A1535F59975F7E FOREIGN KEY (id_division_id) REFERENCES tarsus_division (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tarsus_user DROP FOREIGN KEY FK_C2A1535F59975F7E');
        $this->addSql('DROP TABLE tarsus_division');
        $this->addSql('DROP TABLE tarsus_user');
    }
}
