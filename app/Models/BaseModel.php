<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    protected $table            = '';         // Nombre de la tabla en la base de datos
    protected $primaryKey       = 'id';       // Clave primaria de la tabla
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';    // Tipo de dato a retornar (array, object, etc.)
    protected $useSoftDeletes   = false;      // Habilitar o deshabilitar borrado suave
    protected $protectFields    = true;       // Evitar asignación masiva de campos no definidos
    protected $allowedFields    = [];         // Lista de campos que se pueden asignar masivamente

    // Fechas
    protected $useTimestamps    = false;      // Habilitar o deshabilitar timestamps automáticos
    protected $dateFormat       = 'datetime'; // Formato de las fechas
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    // Validación
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    /**
     * Encuentra un registro por su ID.
     *
     * @param int|string $id
     * @return array|object|null
     */
    public function findById(int|string $id)
    {
        return $this->find($id);
    }

    /**
     * Obtiene todos los registros.
     *
     * @return array
     */
    public function getAll()
    {
        return $this->findAll();
    }

    /**
     * Guarda un nuevo registro o actualiza uno existente.
     *
     * @param array $data
     * @param int|null $id
     * @return bool
     */
    public function saveItem(array $data, int $id): bool
    {
        if ($id === null) {
            return $this->insert($data);
        } else {
            return $this->update($id, $data);
        }
    }

    /**
     * Elimina un registro por su ID.
     *
     * @param int|string $id
     * @param bool $purge Borrado forzado (sin borrado suave)
     * @return bool
     */
    public function deleteItem(int|string $id, bool $purge = false): bool
    {
        if ($this->useSoftDeletes && !$purge) {
            return $this->delete($id);
        } else {
            return $this->purge($id);
        }
    }
}