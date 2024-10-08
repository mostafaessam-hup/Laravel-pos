<?php

namespace App\Base\Repositories;

use App\Base\Traits\Custom\ResizableImageTrait;
use App\Base\Traits\Logs\ActivityLogTrait;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Base\Traits\Model\FilterSort;
use App\Base\Traits\Response\ApiResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Schema;
use Spatie\QueryBuilder\QueryBuilder;

abstract class BaseRepository
{
    public const LIMIT = 10;
    public const ORDER_BY = 'id';
    public const ORDER_DIR = 'desc';
    
    protected Model $model;
    protected Builder|QueryBuilder $query;

    public function __construct(Model $model)
    {
        $this->query = $model->query();
        $this->model = $model;
        

    }


    public function setRelations(array $relations): mixed
    {
        if (!empty($relations))
            return $this->query->with(...$relations);

        return $this;
    }

    public function setCustomWhen(array $customWhen): mixed
    {
        if ($customWhen['condition'])
            return $this->query->when($customWhen['condition'], $customWhen['callback']);

        return $this;
    }

    public function getAllDataPaginated(int $limit = self::LIMIT, string $orderBy = self::ORDER_BY, string $orderDir = self::ORDER_DIR): LengthAwarePaginator
    {
        return $this->query->orderBy($orderBy, $orderDir)->paginate(request()->per_page ?? $limit);
    }

    public function findOrFail (int $id, array $relations = []):mixed
    {
        $query = $this->query;
        if(!empty($relations)){
            $query = $query->with($relations);
        }
        return $query->findOrFail($id);
    }

    public function create (array $attributes = []) : mixed
    {
        if (!empty($attributes)){
            $filtered = $this->cleanUpAttributes($attributes);
            $model = $this->query->create($filtered);
            return $model;
        }
        throw new HttpResponseException(response()->json(['error' => __("Attributes can not be empty")]));
    }

    public function update ($id, array $attributes): mixed
    {
        if(!empty($attributes)){
            $filtered = $this->cleanUpAttributes($attributes);
            $model = $this->query->findOrFail($id);

            tap($model)->update($filtered)->fresh();
            
            return $model;
        }
        throw new HttpResponseException(response()->json(['error' => 'No attributes to update'], 422));
    }


    public function remove ($id)
    {
        $model = $this->query->findOrFail($id);
        $model->delete();
        return response()->json(['success'=> "messages.responses.deleted"]);
    }

    public function cleanUpAttributes ($attributes):array
    {
        return collect($attributes)->filter(function($value, $key){
            return $this->model->isFillable($key);
        })->toArray();
    }
    
        
    
}
