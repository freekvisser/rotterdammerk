<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260803183747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP TABLE stock');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY `FK_stock_id`');
        $this->addSql('DROP INDEX FK_stock_id_idx ON product');
        $this->addSql('DROP INDEX id_UNIQUE ON product');
        $this->addSql('ALTER TABLE product ADD stock_id CHAR(36) NOT NULL, DROP stockid, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stock (id VARCHAR(45) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, stock INT DEFAULT NULL, UNIQUE INDEX id_UNIQUE (id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE product ADD stockid VARCHAR(45) DEFAULT NULL, DROP stock_id, CHANGE id id VARCHAR(45) NOT NULL, CHANGE name name VARCHAR(256) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT `FK_stock_id` FOREIGN KEY (stockid) REFERENCES stock (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX FK_stock_id_idx ON product (stockid)');
        $this->addSql('CREATE UNIQUE INDEX id_UNIQUE ON product (id)');
    }
}
