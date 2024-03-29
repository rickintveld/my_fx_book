<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329113502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, account_id INTEGER NOT NULL, gain DOUBLE PRECISION NOT NULL, daily DOUBLE PRECISION NOT NULL, monthly DOUBLE PRECISION NOT NULL, withdrawals INTEGER NOT NULL, deposits INTEGER NOT NULL, interest DOUBLE PRECISION NOT NULL, profit DOUBLE PRECISION NOT NULL, balance DOUBLE PRECISION NOT NULL, drawdown DOUBLE PRECISION NOT NULL, equity DOUBLE PRECISION NOT NULL, equity_percent DOUBLE PRECISION NOT NULL, last_update_date DATETIME NOT NULL, creation_date DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , first_trade_date DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , commission DOUBLE PRECISION NOT NULL, profit_factor DOUBLE PRECISION NOT NULL, pips DOUBLE PRECISION NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE account');
    }
}
