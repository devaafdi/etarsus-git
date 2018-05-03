<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180427090000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE budget_code (id INT AUTO_INCREMENT NOT NULL, budget_code VARCHAR(10) NOT NULL, account VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, create_date DATETIME NOT NULL, update_date DATETIME DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_item (id INT AUTO_INCREMENT NOT NULL, id_invoice_id INT DEFAULT NULL, budget_code_id INT DEFAULT NULL, project_code_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, currency VARCHAR(10) NOT NULL, quantity INT NOT NULL, total INT NOT NULL, INDEX IDX_1DDE477B8C03712A (id_invoice_id), INDEX IDX_1DDE477BE559B4F6 (budget_code_id), INDEX IDX_1DDE477BB1C4F272 (project_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prject_name (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_name (id INT AUTO_INCREMENT NOT NULL, project_code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendor (id INT AUTO_INCREMENT NOT NULL, invoice_id INT DEFAULT NULL, company_name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, email_address VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, INDEX IDX_F52233F62989F1FD (invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477B8C03712A FOREIGN KEY (id_invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477BE559B4F6 FOREIGN KEY (budget_code_id) REFERENCES budget_code (id)');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477BB1C4F272 FOREIGN KEY (project_code_id) REFERENCES project_name (id)');
        $this->addSql('ALTER TABLE vendor ADD CONSTRAINT FK_F52233F62989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477BE559B4F6');
        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477B8C03712A');
        $this->addSql('ALTER TABLE vendor DROP FOREIGN KEY FK_F52233F62989F1FD');
        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477BB1C4F272');
        $this->addSql('DROP TABLE budget_code');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('DROP TABLE prject_name');
        $this->addSql('DROP TABLE project_name');
        $this->addSql('DROP TABLE vendor');
    }
}
