<?php


namespace App\Services\Stateless;


use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

abstract class AbstractModelService
{
    private $beforeQuery = [];
    private $afterQuery = [];
    private $returnAsQuery = [];

    abstract public function getModelClass(): string;

    public function beforeQuery(callable $func)
    {
        $this->beforeQuery[] = $func;

        return $this;
    }

    public function afterQuery(callable $func)
    {
        $this->afterQuery[] = $func;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function returnAsQuery(bool $value = true)
    {
        if(!$value){
            array_pop($this->returnAsQuery);
        }
        $this->returnAsQuery[] = $value;

        return $this;
    }

    public function willReturnAsQuery(): bool
    {
        end($this->returnAsQuery);

        return current($this->returnAsQuery) ?? false;
    }

    public function cache()
    {
        if(
            !empty($this->beforeQuery) ||
            !empty($this->afterQuery) ||
            $this->willReturnAsQuery()
        ){
            return cache()->store('stub');
        }

        return cache();
    }

    /**
     * @param Builder|\Illuminate\Database\Eloquent\Builder $query
     * @param array $columns
     * @return mixed
     */
    protected function get($query, array $columns = ['*'])
    {
        if($this->beforeQuery){
            foreach($this->beforeQuery as $key => $fn){
                unset($this->beforeQuery[$key]);
                call_user_func($fn, $query);
            }
            $this->beforeQuery = [];
        }
        if($this->willReturnAsQuery()){
            array_pop($this->returnAsQuery);

            return $query->addSelect($columns);
        }

        $result = $query->get($columns);

        if($this->afterQuery){
            foreach($this->afterQuery as $key => $fn){
                unset($this->afterQuery[$key]);
                $result = call_user_func($fn, $result);
            }
            $this->afterQuery = [];
        }

        return $result;
    }

    /**
     * @param Model|int $model
     * @return Model
     * @throws Exception
     */
    protected function findOrFail($model)
    {
        $modelClass = $this->getModelClass();
        if($model instanceof $modelClass){
            return $model;
        }

        $modelId = (int)$model;
        if(
            ($modelId > 0) &&
            ($result = $this->find($modelId))
        ){
            return $result;
        }

        throw (new \Exception('Model ("'.$this->getModelClass().'") with id = '.$modelId.' not found'))->setModel($model);
    }

    public function find($id)
    {
        $modelClass = $this->getModelClass();

        return $modelClass::find($id);
    }
}
