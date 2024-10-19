<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateClientsProductsTable extends AbstractMigration
{
    /**
     * Método para crear la tabla intermedia clientes_productos para poder
     * conocer los productos asignados a determinados clientes
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('clientes_productos');

        $table->addColumn('id_cliente', 'integer');

        $table->addColumn('id_producto', 'integer');

        $table->addForeignKey('id_cliente', 'clientes', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ]);

        $table->addForeignKey('id_producto', 'productos', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ]);
        
        $table->create();
    }
}
