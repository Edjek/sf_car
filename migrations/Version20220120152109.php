<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120152109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D44F5D008');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D7A45358C');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D7A45358C FOREIGN KEY (groupe_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY FK_FE3BECAAA76ED395');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY FK_FE3BECAAC3C6F69F');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT FK_FE3BECAAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT FK_FE3BECAAC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FC3C6F69F');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3A76ED395');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3C3C6F69F');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D44F5D008');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D7A45358C');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D7A45358C FOREIGN KEY (groupe_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY FK_FE3BECAAA76ED395');
        $this->addSql('ALTER TABLE dislike DROP FOREIGN KEY FK_FE3BECAAC3C6F69F');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT FK_FE3BECAAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE dislike ADD CONSTRAINT FK_FE3BECAAC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FC3C6F69F');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3A76ED395');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3C3C6F69F');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
    }
}
