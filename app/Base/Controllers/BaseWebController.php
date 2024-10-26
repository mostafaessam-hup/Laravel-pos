<?php

namespace App\Base\Controllers;

use App\Base\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseWebController
{
    protected $request;
    protected $model;
    protected BaseService $service;
    protected $view_path;
    protected $hasCreate;
    protected $hasShow;
    protected $hasEdit;
    protected $hasDelete;


    public function __construct(
        FormRequest $request,
        Model $model,
        BaseService $service,
        $view_path = null,
        $hasCreate = true,
        $hasEdit = true,
        $hasShow = true,
        $hasDelete = true,
    ) {

        $this->request = $request;
        $this->model = $model;
        $this->service = $service;
        $this->view_path = $view_path;
        $this->hasDelete = $hasDelete;
        $this->hasCreate = $hasCreate;
        $this->hasEdit = $hasEdit;
        $this->hasShow = $hasShow;
    }

    public function index()
    {
        $create_route = str_replace('index', 'create', Request::route()->getName());
        $edit_route = str_replace('index', 'edit', Request::route()->getName());
        $show_route = str_replace('index', 'show', Request::route()->getName());
        $destroy_route = str_replace('index', 'destroy', Request::route()->getName());
        $hasCreate = $this->hasCreate;
        $hasShow = $this->hasShow;
        $hasEdit = $this->hasEdit;
        $hasDelete = $this->hasDelete;
        $records = $this->service->index();

        return view($this->view_path . __FUNCTION__, compact(
            'create_route',
            'hasCreate',
            'records',
            'hasShow',
            'hasEdit',
            'hasDelete',
            'edit_route',
            'show_route',
            'destroy_route'
        ));
    }

    public function create()
    {
        if (!$this->hasCreate)
            return redirect()->back()->with('error', __('admin.add_is_not_allowed'));

        $store_route = str_replace('create', 'store', Request::route()->getName());
        return view($this->view_path . __FUNCTION__, compact('store_route'));
    }

    public function store()
    {
        $this->service->store($this->request->validated());
        $index_route = str_replace('store', 'index', Request::route()->getName());
        return redirect()->route($index_route)->with('success', __('admin.successfully_added'));
    }

    public function show($id)
    {
        if (!$this->hasShow) {
            return redirect()->back()->with('error', __('admin.show_is_not_allowed'));
        }
        $record = $this->service->findOrFail($id);
        return view($this->view_path . __FUNCTION__, compact('record'));
    }

    public function edit($id)
    {
        if (!$this->hasEdit)
            return redirect()->back()->with('error', __('admin.edit_is_not_allowed'));

        $record = $this->service->findOrFail($id);
        $update_route = str_replace('edit', 'update', Request::route()->getName());
        return view($this->view_path . __FUNCTION__, compact('record', 'update_route'));
    }

    public function update($id)
    {
        if (!$this->hasEdit)
            return redirect()->back()->with('error', __('admin.edit_is_not_allowed'));

        $this->service->update($id, $this->request->validated());
        $index_route = str_replace('update', 'index', Request::route()->getName());
        return redirect()->route($index_route)->with('success', __('admin.successfully_updated'));
    }

    public function destroy($id)
    {
        if ($this->hasDelete) {
            $this->service->destroy($id);
            return response()->json(['status' => 1, 'message' => __('admin.successfully_deleted'), 'id' => $id]);
        }
        return response()->json(['status' => 0, 'message' => __('admin.delete_is_not_allowed'), 'id' => $id]);
    }

    public function toggleBoolean($id, $action)
    {
        $record = $this->model->findOrFail($id);
        if (toggleBoolean($record, $action))
            return response()->json(['status' => 'success']);

        return response()->json(['status' => 'fail']);
    }
}

