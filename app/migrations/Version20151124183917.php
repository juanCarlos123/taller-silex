<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151124183917 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $tableRooms = $schema->getTable('rooms');
        $tableRooms->dropColumn('date_arrival');
        $tableRooms->dropColumn('date_go');

        $tableReservations = $schema->createTable('reservations');
        $tableReservations->addColumn('reservation_id','integer',['autoincrement' => true, 'length' => 10]);
        $tableReservations->addColumn('room_id','integer',['length' => 10]);
        $tableReservations->addColumn('user_id','integer',['length' => 10]);
        $tableReservations->addColumn('date_arrival', 'date');
        $tableReservations->addColumn('date_go', 'date');
        $tableReservations->addColumn('date_created', 'datetime',[
            'columnDefinition' => 'timestamp default current_timestamp'
        ]);
        $tableReservations->addColumn('date_modified', 'datetime');
        $tableReservations->setPrimaryKey(['reservation_id']);

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
