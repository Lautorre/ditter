<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190723101328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deet (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, likes INT DEFAULT NULL, shares INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, banner VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hashtag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hashtag_deet (hashtag_id INT NOT NULL, deet_id INT NOT NULL, INDEX IDX_21C774DDFB34EF56 (hashtag_id), INDEX IDX_21C774DD9623FAB5 (deet_id), PRIMARY KEY(hashtag_id, deet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hashtag_deet ADD CONSTRAINT FK_21C774DDFB34EF56 FOREIGN KEY (hashtag_id) REFERENCES hashtag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hashtag_deet ADD CONSTRAINT FK_21C774DD9623FAB5 FOREIGN KEY (deet_id) REFERENCES deet (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hashtag_deet DROP FOREIGN KEY FK_21C774DD9623FAB5');
        $this->addSql('ALTER TABLE hashtag_deet DROP FOREIGN KEY FK_21C774DDFB34EF56');
        $this->addSql('DROP TABLE deet');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE hashtag');
        $this->addSql('DROP TABLE hashtag_deet');
    }
}
