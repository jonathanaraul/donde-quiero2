<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140708050621 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE localidad CHANGE postal postal INT(5) UNSIGNED ZEROFILL");
        $this->addSql("ALTER TABLE servicio CHANGE alquilerprojectrespantallas alquilerProyectoresPantallas TINYINT(1) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE localidad CHANGE postal postal INT UNSIGNED DEFAULT NULL");
        $this->addSql("ALTER TABLE servicio CHANGE alquilerproyectorespantallas alquilerProjectresPantallas TINYINT(1) DEFAULT NULL");
    }
}
