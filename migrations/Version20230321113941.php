<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321113941 extends AbstractMigration
{


    /**
     * Gets Phone description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return '';
        // end getDescription()

    }


    /**
     * Updates database
     *
     * @return void
     */
    public function up(Schema $schema): void
    {
        // This up() migration is auto-generated, please modify it to your needs.
        $this->addSql('ALTER TABLE phone CHANGE length width DOUBLE PRECISION DEFAULT NULL');

    }

    /**
     * Down method
     *
     * @return void
     */
    public function down(Schema $schema): void
    {
        // This down() migration is auto-generated, please modify it to your needs.
        $this->addSql('ALTER TABLE phone CHANGE width length DOUBLE PRECISION DEFAULT NULL');
    }
}
