<?php


namespace JbSilva\ORM;

use JbSilva\ORM\Drivers\Mysql;
use JbSilva\ORM\QueryBuilder\Insert;
use JbSilva\ORM\QueryBuilder\Update;
use JbSilva\ORM\QueryBuilder\Select;
use JbSilva\ORM\QueryBuilder\Delete;
use JbSilva\ORM\Drivers\DriverInterface;
use JbSilva\ORM\Filters\RelationsShips;

abstract class Model
{
    use RelationsShips;

    /**
     * @var $data
     * @param array
     */
    protected $data;
    /**
     * @var $driver
     * @param DriverInterface
     */
    protected $driver;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->setDriver(new Mysql());
    }

    /**
     * @param array $data
     */
    public function setAll(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        if (empty($this->table)) {
            $table = explode('\\', get_class($this));
            return strtolower(array_pop($table));
        }

        return $this->table;
    }

    /**
     * @param DriverInterface $driver
     */
    public function setDriver(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function beginTransaction()
    {
        $this->driver->beginTransaction();
    }

    public function commit()
    {
        $this->driver->commit();
    }

    public function rollBack()
    {
        $this->driver->rollBack();
    }

    /**
     * @return Model
     */
    public function save()
    {
        if (!is_null($this->id)) {
            return $this->update();
        }

        return $this->insert();
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function all(array $conditions = [])
    {
        $collection = [];

        $data = $this->driver
            ->setQueryBuilder(new Select($this->getTable(), $conditions))
            ->exec()
            ->all();

        foreach ($data as $given) {
            $className = get_class($this);
            $class = new $className;
            $class->setAll($given);
            $collection[] = $class;
        }

        return $collection;
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id)
    {
        $conditions[] = ['id', $id];

        $data = $this->driver
            ->setQueryBuilder(new Select($this->getTable(), $conditions))
            ->exec()
            ->first();

        if ($data) {
            $this->setAll($data);
        }

        return $this;
    }

    /**
     * @param $id
     * @return Model
     */
    public function findByColumn($condition = [])
    {
        $conditions[] = $condition;

        $data = $this->driver
            ->setQueryBuilder(new Select($this->getTable(), $conditions))
            ->exec()
            ->first();

        if ($data) {
            $this->setAll($data);
        }

        return $this;
    }

    public function paginate(int $num_registers = 10, $current_page = 1, array $orderBy = [], array $conditions = [])
    {
        $collection = [];
        $junctions = [];
        $pagination = [$num_registers, $current_page, $orderBy];
        $model = null;

        $total = $this->driver
            ->setQueryBuilder(new Select($this->getTable(), $conditions))
            ->exec()
            ->count();

        $collection['paginator'] = new Paginator($total, $num_registers, $current_page);

        $data = $this->driver
            ->setQueryBuilder(new Select($this->getTable(), $conditions, $junctions, $model, $pagination))
            ->exec()
            ->all();

        foreach ($data as $given) {
            $className = get_class($this);
            $class = new $className;
            $class->setAll($given);
            $collection['data'][] = $class;
        }

        return $collection;
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        $conditions[] = ['id', $this->id];

        return $this->driver
            ->setQueryBuilder(new Delete($this->getTable(), $conditions))
            ->exec();
    }

    /**
     * @return Model
     */
    public function insert()
    {
        $this->driver
            ->setQueryBuilder(new Insert($this->getTable(), $this))
            ->exec();

        return $this->find($this->driver->lastInsertedId());
    }

    /**
     * @return Model
     */
    public function update()
    {
        $conditions[] = ['id', $this->id];

        $this->driver
            ->setQueryBuilder(new Update($this->getTable(), $this, $conditions))
            ->exec();

        return $this->find($this->id);
    }

    /**
     * @param $name
     * @return |null
     */
    public function __get($name)
    {
        $method = $this->methodName('get', $name);

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return $this->data[$name] ?? null;
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $method = $this->methodName('set', $name, $value);

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        $this->data[$name] = $value;
    }

    /**
     * @param $prefix
     * @param $name
     * @return string
     */
    private function methodName($prefix, $name)
    {
        return $prefix . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }
}
