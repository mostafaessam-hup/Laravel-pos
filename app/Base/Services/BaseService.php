<?php


namespace App\Base\Services;

use App\Repositories\AdminRepository;
use App\Base\Repositories\BaseRepository;
use App\Base\Traits\Response\ApiResponseTrait;
use App\Base\Traits\Custom\AttachmentAttribute;
use App\Base\Traits\Custom\ResizableImageTrait;

abstract class BaseService
{
    protected BaseRepository $repository;

    protected $indexRelations = [];
    protected $oneItemRelations = [];
    protected $customWhen = [];

    public function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
    }



    public function index()
    {
        $this->repository->setRelations($this->getIndexRelations());
        $this->repository->setCustomWhen($this->getCustomWhen());
        return $this->repository->getAllDataPaginated();
    }

    public function setIndexRelations($relations)
    {
        $this->indexRelations = $relations;
    }

    public function getIndexRelations()
    {
        return $this->indexRelations;
    }

    public function setCustomWhen ($customWhen)
    {
        $this->customWhen = $customWhen;
    }
    public function getCustomWhen()
    {
        return empty($this->customWhen) ? $this->defaultCustomWhenArray() : $this->customWhen;
    }

    public function setOneItemRelations($relations)
    {
        $this->oneItemRelations = $relations;
    }

    public function getOneItemRelations()
    {
        return $this->oneItemRelations;
    }

    public function defaultCustomWhenArray()
    {
        return [
            'condition' => false,
            'callback' => function ($q) {},
        ];
    }


    public function store($data)
    {
        $model = $this->repository->create($data);
        !empty($this->getOneItemRelations()) ? $model->load(...$this->getOneItemRelations()) : null;
        $model->refresh();
        return $model;
    }

    public function findOrFail($id)
    {
        return $this->repository->findOrFail($id);
    }

    public function update($id, $data)
    {
        $this->repository->setCustomWhen($this->getCustomWhen());
        $this->repository->setRelations($this->getOneItemRelations());
        $model = $this->repository->update($id, $data);
        $model->refresh();
        return $model;
    }


    public function destroy($id)
    {
        $this->repository->setCustomWhen($this->getCustomWhen());
        return $this->repository->remove($id);
    }
}
