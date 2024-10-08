<?php
namespace App\Repositories;


use App\Models\Admin;
use App\Base\Repositories\BaseRepository;

class AdminRepository extends BaseRepository
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

}