<?php
// src/Controller/Api/ProductosController.php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry; // Necesario para cargar modelos
use Cake\Http\Exception\NotFoundException; // Aseguramos que las excepciones estén correctamente importadas
use Cake\Http\Exception\BadRequestException; // Para gestionar errores en los datos

class ProductosController extends AppController
{
    public $Productos;

    public function initialize(): void
    {
        parent::initialize();

        // Usamos TableLocator para obtener el modelo 'Productos'
        $this->Productos = TableRegistry::getTableLocator()->get('Productos');

        // Métodos permitidos
        $this->request->allowMethod(['get', 'post', 'put', 'delete']);
    }

    // Método para listar todos los productos
    public function index()
    {
        $productos = $this->Productos->find('all')->toArray();
        $this->set([
            'productos' => $productos,
            '_serialize' => ['productos']
        ]);
    }

    // Método para ver un producto específico
    public function view($id = null)
    {
        $producto = $this->Productos->get($id);
        if (!$producto) {
            throw new NotFoundException(__('Producto no encontrado'));
        }
        $this->set([
            'producto' => $producto,
            '_serialize' => ['producto']
        ]);
    }

    // Método para agregar un nuevo producto
    public function add()
    {
        $producto = $this->Productos->newEmptyEntity();
        if ($this->request->is('post')) {
            $producto = $this->Productos->patchEntity($producto, $this->request->getData());
            if ($this->Productos->save($producto)) {
                $message = 'Producto guardado con éxito.';
            } else {
                throw new BadRequestException(__('Error al guardar el producto.'));
            }
            $this->set([
                'message' => $message,
                'producto' => $producto,
                '_serialize' => ['message', 'producto']
            ]);
        }
    }

    // Método para actualizar un producto
    public function edit($id = null)
    {
        $producto = $this->Productos->get($id);
        if (!$producto) {
            throw new NotFoundException(__('Producto no encontrado'));
        }
        if ($this->request->is(['put'])) {
            $producto = $this->Productos->patchEntity($producto, $this->request->getData());
            if ($this->Productos->save($producto)) {
                $message = 'Producto actualizado con éxito.';
            } else {
                throw new BadRequestException(__('Error al actualizar el producto.'));
            }
            $this->set([
                'message' => $message,
                'producto' => $producto,
                '_serialize' => ['message', 'producto']
            ]);
        }
    }

    // Método para eliminar un producto
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $producto = $this->Productos->get($id);
        if (!$producto) {
            throw new NotFoundException(__('Producto no encontrado'));
        }
        if ($this->Productos->delete($producto)) {
            $message = 'Producto eliminado.';
        } else {
            throw new BadRequestException(__('Error al eliminar el producto.'));
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
}