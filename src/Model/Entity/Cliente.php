<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $dni
 * @property string $direccion
 * @property int $telefono
 * @property string $email
 *
 * @property \App\Model\Entity\Producto[] $productos
 */
class Cliente extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'nombre' => true,
        'apellidos' => true,
        'dni' => true,
        'direccion' => true,
        'telefono' => true,
        'email' => true,
        'productos' => true,
    ];
}
