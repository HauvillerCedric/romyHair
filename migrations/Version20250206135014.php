<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206135014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_prestation (category_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_77D6DFD312469DE2 (category_id), INDEX IDX_77D6DFD39E45C554 (prestation_id), PRIMARY KEY(category_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, postal_code VARCHAR(20) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, INDEX IDX_2D5B0234AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(80) NOT NULL, postal_code VARCHAR(20) NOT NULL, INDEX IDX_CD1DE18AF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hair_salon (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, email VARCHAR(80) NOT NULL, telephone VARCHAR(20) NOT NULL, opening_date DATE DEFAULT NULL, close_date DATE DEFAULT NULL, INDEX IDX_17637AAF8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hair_salon_prestation (hair_salon_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_A2FDA159B50E7EE4 (hair_salon_id), INDEX IDX_A2FDA1599E45C554 (prestation_id), PRIMARY KEY(hair_salon_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, duration INT NOT NULL, price INT NOT NULL, is_quote TINYINT(1) NOT NULL, optional LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation_service (prestation_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_220B694B9E45C554 (prestation_id), INDEX IDX_220B694BED5CA9E6 (service_id), PRIMARY KEY(prestation_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, prestation_id INT DEFAULT NULL, user_id INT DEFAULT NULL, start_date_reservation DATE NOT NULL, end_date_reservation DATE NOT NULL, is_reserved TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_42C849559E45C554 (prestation_id), INDEX IDX_42C84955A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_enabled TINYINT(1) NOT NULL, is_male TINYINT(1) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, address_number VARCHAR(10) DEFAULT NULL, address_extension VARCHAR(10) DEFAULT NULL, address_street VARCHAR(20) DEFAULT NULL, address VARCHAR(100) NOT NULL, telephone VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8D93D6498BAC62AF (city_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_hair_salon (user_id INT NOT NULL, hair_salon_id INT NOT NULL, INDEX IDX_B004BC43A76ED395 (user_id), INDEX IDX_B004BC43B50E7EE4 (hair_salon_id), PRIMARY KEY(user_id, hair_salon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_prestation ADD CONSTRAINT FK_77D6DFD312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_prestation ADD CONSTRAINT FK_77D6DFD39E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE hair_salon ADD CONSTRAINT FK_17637AAF8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE hair_salon_prestation ADD CONSTRAINT FK_A2FDA159B50E7EE4 FOREIGN KEY (hair_salon_id) REFERENCES hair_salon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hair_salon_prestation ADD CONSTRAINT FK_A2FDA1599E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_service ADD CONSTRAINT FK_220B694B9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_service ADD CONSTRAINT FK_220B694BED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE user_hair_salon ADD CONSTRAINT FK_B004BC43A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_hair_salon ADD CONSTRAINT FK_B004BC43B50E7EE4 FOREIGN KEY (hair_salon_id) REFERENCES hair_salon (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_prestation DROP FOREIGN KEY FK_77D6DFD312469DE2');
        $this->addSql('ALTER TABLE category_prestation DROP FOREIGN KEY FK_77D6DFD39E45C554');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234AE80F5DF');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AF92F3E70');
        $this->addSql('ALTER TABLE hair_salon DROP FOREIGN KEY FK_17637AAF8BAC62AF');
        $this->addSql('ALTER TABLE hair_salon_prestation DROP FOREIGN KEY FK_A2FDA159B50E7EE4');
        $this->addSql('ALTER TABLE hair_salon_prestation DROP FOREIGN KEY FK_A2FDA1599E45C554');
        $this->addSql('ALTER TABLE prestation_service DROP FOREIGN KEY FK_220B694B9E45C554');
        $this->addSql('ALTER TABLE prestation_service DROP FOREIGN KEY FK_220B694BED5CA9E6');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559E45C554');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498BAC62AF');
        $this->addSql('ALTER TABLE user_hair_salon DROP FOREIGN KEY FK_B004BC43A76ED395');
        $this->addSql('ALTER TABLE user_hair_salon DROP FOREIGN KEY FK_B004BC43B50E7EE4');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_prestation');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE hair_salon');
        $this->addSql('DROP TABLE hair_salon_prestation');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE prestation_service');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_hair_salon');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
