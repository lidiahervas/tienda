<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProductsTable extends AbstractMigration
{
    /**
     * Método para generar la tabla productos
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('productos');
        $table->addColumn('nombre', 'string', ['limit' => 50])
            ->addColumn('descripcion', 'text')
            ->addColumn('cantidad', 'integer', ['signed' => false])
            ->addColumn('precio', 'decimal', ['precision' => 5, 'scale' => 2, 'signed' => false])
            ->addColumn('imagen', 'string');

        $table->addPrimaryKey('id');

        $table->create();
    }
}
