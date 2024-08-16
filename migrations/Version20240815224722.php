<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240815224722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribute (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribute_product (attribute_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_58D65D69B6E62EFA (attribute_id), INDEX IDX_58D65D694584665A (product_id), PRIMARY KEY(attribute_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, avatar_url VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1677722F9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_497DD634BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_product (categorie_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_8CC9AA0FBCF5E72D (categorie_id), INDEX IDX_8CC9AA0F4584665A (product_id), PRIMARY KEY(categorie_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, provider_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, description LONGTEXT NOT NULL, total_quantity DOUBLE PRECISION NOT NULL, minimum_quantity_for_sale DOUBLE PRECISION NOT NULL, unit VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D34A04ADA76ED395 (user_id), INDEX IDX_D34A04ADA53A8AA (provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, address VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) NOT NULL, postalcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, profession LONGTEXT DEFAULT NULL, education LONGTEXT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, skills LONGTEXT DEFAULT NULL, notes LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribute_product ADD CONSTRAINT FK_58D65D69B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attribute_product ADD CONSTRAINT FK_58D65D694584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avatar ADD CONSTRAINT FK_1677722F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE categorie_product ADD CONSTRAINT FK_8CC9AA0FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_product ADD CONSTRAINT FK_8CC9AA0F4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute_product DROP FOREIGN KEY FK_58D65D69B6E62EFA');
        $this->addSql('ALTER TABLE attribute_product DROP FOREIGN KEY FK_58D65D694584665A');
        $this->addSql('ALTER TABLE avatar DROP FOREIGN KEY FK_1677722F9D86650F');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634BCF5E72D');
        $this->addSql('ALTER TABLE categorie_product DROP FOREIGN KEY FK_8CC9AA0FBCF5E72D');
        $this->addSql('ALTER TABLE categorie_product DROP FOREIGN KEY FK_8CC9AA0F4584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA53A8AA');
        $this->addSql('DROP TABLE attribute');
        $this->addSql('DROP TABLE attribute_product');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}