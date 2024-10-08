<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\BaseWebController;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\Admin\UserService;

class UserController extends BaseWebController
{
    protected $UserService;
    public function __Construct(
        UserRequest $request,
        User $model,
        UserService $service,
    ) {
        parent::__Construct(
            $request,
            $model,
            $service,
            $view_path = 'admin.users.',
            $hasCreate = true,
            $hasEdit = true,
            $hasShow = true,
            $hasDelete = true,
        );
        $this->UserService = $service;
        $this->UserService->setIndexRelations([]);
        $this->UserService->setOneItemRelations([]);
        $this->UserService->setCustomWhen($this->customWhen());
    }

    public function customWhen(): array
    {
        return [
            'condition' => false,
            'callback' => function ($q) {},
        ];
    }
}
