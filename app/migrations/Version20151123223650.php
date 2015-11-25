<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151123223650 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $tableHotels = $schema->getTable('hotels');
        $tableHotels->addColumn('num_rooms','integer',['length' => '4','notnull' => false]);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {

    }
}
