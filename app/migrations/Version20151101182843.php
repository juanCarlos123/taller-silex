<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151101182843 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $hotelTable = $schema->createTable('hotels');
        $hotelTable->addColumn('hotel_id', 'integer', ['autoincrement' => true, 'length' => 10]);
        $hotelTable->addColumn('name', 'string', ['length' => 30]);
        $hotelTable->addColumn('address', 'string', ['length' => 150]);
        $hotelTable->addColumn('mobile', 'string', ['length' => 20,'notnull' => false]);
        $hotelTable->addColumn('phone', 'string', ['length' => 20, 'notnull' => false]);
        $hotelTable->addColumn('date_created', 'datetime',[
            'columnDefinition' => 'timestamp default current_timestamp'
        ]);
        $hotelTable->addColumn('date_modified', 'datetime');
        $hotelTable->setPrimaryKey(['hotel_id']);

        $roomTable = $schema->createTable('rooms');
        $roomTable->addColumn('room_id', 'integer', ['autoincrement' => true, 'length' => 10]);
        $roomTable->addColumn('date_arrival', 'date');
        $roomTable->addColumn('date_go', 'date');
        $roomTable->addColumn('services', 'string', ['length' => 150, 'notnull' => false]);
        $roomTable->addColumn('hotel_id','integer',['length'=>10]);
        $roomTable->addColumn('roomtype_id','integer',['length'=>10]);
        $roomTable->addColumn('user_id','integer',['length'=>10]);
        $roomTable->addColumn('date_created', 'datetime',[
            'columnDefinition' => 'timestamp default current_timestamp'
        ]);
        $roomTable->addColumn('date_modified', 'datetime');
        $roomTable->setPrimaryKey(['room_id']);

        $rtypeTable = $schema->createTable('roomtypes');
        $rtypeTable->addColumn('roomtype_id','integer',['autoincrement' => true, 'length' => 10]);
        $rtypeTable->addColumn('description','string',['length'=>50]);
        $rtypeTable->addColumn('date_created', 'datetime',[
            'columnDefinition' => 'timestamp default current_timestamp'
        ]);
        $rtypeTable->addColumn('date_modified', 'datetime');
        $rtypeTable->setPrimaryKey(['roomtype_id']);
        
        $userTable = $schema->createTable('users');
        $userTable->addColumn('user_id','integer',['autoincrement' => true, 'length' => 10]);
        $userTable->addColumn('name','string',['length'=> 100]);
        $userTable->addColumn('password','string',['length'=> 255]);
        $userTable->addColumn('date_created', 'datetime',[
            'columnDefinition' => 'timestamp default current_timestamp'
        ]);
        $userTable->addColumn('date_modified', 'datetime');
        $userTable->setPrimaryKey(['user_id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
