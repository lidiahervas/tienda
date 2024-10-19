<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateClientsTable extends AbstractMigration
{
    /**
     * Método para crear la tabla clientes
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('clientes');
        $table->addColumn('nombre', 'string', ['limit' => 50])
            ->addColumn('apellidos', 'string', ['limit' => 100])
            ->addColumn('dni', 'string', ['limit' => 9])
            ->addColumn('direccion', 'string', ['limit' => 100])
            ->addColumn('telefono', 'integer', ['limit' => 9])
            ->addColumn('email', 'string', ['limit' => 50]);

        $table->addPrimaryKey('id');

        $table->create();
    }
}
