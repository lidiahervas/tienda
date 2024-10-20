<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Productos Model
 *
 * @property \App\Model\Table\ClientesTable&\Cake\ORM\Association\BelongsToMany $Clientes
 *
 * @method \App\Model\Entity\Producto newEmptyEntity()
 * @method \App\Model\Entity\Producto newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Producto> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Producto get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Producto findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Producto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Producto> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Producto|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Producto saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Producto>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Producto>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Producto>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Producto> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Producto>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Producto>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Producto>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Producto> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('productos');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Clientes', [
            'foreignKey' => 'producto_id',
            'targetForeignKey' => 'cliente_id',
            'joinTable' => 'clientes_productos',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 50)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

        $validator
            ->scalar('descripcion')
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        $validator
            ->nonNegativeInteger('cantidad')
            ->requirePresence('cantidad', 'create')
            ->notEmptyString('cantidad');

        $validator
            ->decimal('precio')
            ->greaterThanOrEqual('precio', 0)
            ->requirePresence('precio', 'create')
            ->notEmptyString('precio');

        $validator
            ->scalar('imagen')
            ->maxLength('imagen', 255)
            ->requirePresence('imagen', 'create')
            ->notEmptyString('imagen');

        return $validator;
    }
}
