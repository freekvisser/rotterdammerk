<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version202609022209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS cart (id CHAR(36) NOT NULL, session_id CHAR(36) NOT NULL, created DATETIME NOT NULL, expires_at DATETIME DEFAULT NULL, PRIMARY KEY (id), UNIQUE KEY id_UNIQUE (id), UNIQUE KEY session_id_UNIQUE (session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('CREATE TABLE IF NOT EXISTS cart_item (id CHAR(36) NOT NULL, cart_id CHAR(36) NOT NULL, product_id CHAR(36) NOT NULL, quantity INT NOT NULL, PRIMARY KEY (id), UNIQUE KEY id_UNIQUE (id), CONSTRAINT FK_cartItem_cart FOREIGN KEY (cart_id) REFERENCES cart (id), CONSTRAINT FK_cartItem_product FOREIGN KEY (product_id) REFERENCES product (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci`');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS cart');
        $this->addSql('DROP TABLE IF EXISTS cart_item');
    }
}
