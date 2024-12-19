<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116053555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE depositary ADD stock_id INT NOT NULL, ADD portfolio_id INT NOT NULL, ADD quantity INT NOT NULL');
        $this->addSql('ALTER TABLE depositary ADD CONSTRAINT FK_7CD08B68DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE depositary ADD CONSTRAINT FK_7CD08B68B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id)');
        $this->addSql('CREATE INDEX IDX_7CD08B68DCD6110 ON depositary (stock_id)');
        $this->addSql('CREATE INDEX IDX_7CD08B68B96B5643 ON depositary (portfolio_id)');
        $this->addSql('ALTER TABLE portfolio ADD user_id INT NOT NULL, ADD balance DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE portfolio ADD CONSTRAINT FK_A9ED1062A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_A9ED1062A76ED395 ON portfolio (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE depositary DROP FOREIGN KEY FK_7CD08B68DCD6110');
        $this->addSql('ALTER TABLE depositary DROP FOREIGN KEY FK_7CD08B68B96B5643');
        $this->addSql('DROP INDEX IDX_7CD08B68DCD6110 ON depositary');
        $this->addSql('DROP INDEX IDX_7CD08B68B96B5643 ON depositary');
        $this->addSql('ALTER TABLE depositary DROP stock_id, DROP portfolio_id, DROP quantity');
        $this->addSql('ALTER TABLE portfolio DROP FOREIGN KEY FK_A9ED1062A76ED395');
        $this->addSql('DROP INDEX IDX_A9ED1062A76ED395 ON portfolio');
        $this->addSql('ALTER TABLE portfolio DROP user_id, DROP balance');
    }
}
