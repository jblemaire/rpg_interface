<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190707191432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE element_stat (element_id INT NOT NULL, stat_id INT NOT NULL, INDEX IDX_6386DED81F1F2A24 (element_id), INDEX IDX_6386DED89502F0B (stat_id), PRIMARY KEY(element_id, stat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE element_stat ADD CONSTRAINT FK_6386DED81F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE element_stat ADD CONSTRAINT FK_6386DED89502F0B FOREIGN KEY (stat_id) REFERENCES stat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE element ADD rarity_id INT DEFAULT NULL, ADD type_id INT DEFAULT NULL, ADD family_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39F3747573 FOREIGN KEY (rarity_id) REFERENCES rarity (id)');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39C35E566A FOREIGN KEY (family_id) REFERENCES family (id)');
        $this->addSql('CREATE INDEX IDX_41405E39F3747573 ON element (rarity_id)');
        $this->addSql('CREATE INDEX IDX_41405E39C54C8C93 ON element (type_id)');
        $this->addSql('CREATE INDEX IDX_41405E39C35E566A ON element (family_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE element_stat');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39F3747573');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39C54C8C93');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39C35E566A');
        $this->addSql('DROP INDEX IDX_41405E39F3747573 ON element');
        $this->addSql('DROP INDEX IDX_41405E39C54C8C93 ON element');
        $this->addSql('DROP INDEX IDX_41405E39C35E566A ON element');
        $this->addSql('ALTER TABLE element DROP rarity_id, DROP type_id, DROP family_id');
    }
}
