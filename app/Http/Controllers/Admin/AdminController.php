<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\BaseWebController;
use App\Services\Admin\AdminService;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;

class AdminController extends BaseWebController
{

    protected $AdminService ;

    public function __construct(
        AdminService $service,
        AdminRequest $request,
        Admin $model,

    ) {
        parent::__construct(
            $request,
            $model,
            $service,
            $view_path = 'admin.admins.',
            $hasCreate = true,
            $hasEdit = true,
            $hasShow = true,
            $hasDelete = true,
        );

        $this->AdminService = $service;
        $this->AdminService->setIndexRelations([]);
        $this->AdminService->setOneItemRelations([]);
        $this->AdminService->setCustomWhen($this->customWhen());

    }


    public function customWhen(): array
    {
        return [
            'condition' => true,
            'callback' => function ($q) {
                $q->whereNotIn('id', [1]);
            },
        ];
    }
}
