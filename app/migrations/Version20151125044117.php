<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151125044117 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('
            CREATE TABLE `users` (
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `email` VARCHAR(100) NOT NULL DEFAULT "",
                `password` VARCHAR(255) DEFAULT NULL,
                `salt` VARCHAR(255) NOT NULL DEFAULT "",
                `roles` VARCHAR(255) NOT NULL DEFAULT "",
                `name` VARCHAR(100) NOT NULL DEFAULT "",
                `time_created` INT(11) UNSIGNED NOT NULL DEFAULT 0,
                `username` VARCHAR(100),
                `isEnabled` TINYINT(1) NOT NULL DEFAULT 1,
                `confirmationToken` VARCHAR(100),
                `timePasswordResetRequested` INT(11) UNSIGNED,
                 PRIMARY KEY (`id`),
                 UNIQUE KEY `unique_email` (`email`),
                 UNIQUE KEY `username` (`username`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->addSql('
            CREATE TABLE `user_custom_fields` (
                user_id INT(11) UNSIGNED NOT NULL,
                attribute VARCHAR(50) NOT NULL DEFAULT "",
                value VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (user_id, attribute)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8
         ');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
