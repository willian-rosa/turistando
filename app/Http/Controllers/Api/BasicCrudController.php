<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BasicCrudController extends Controller
{

    protected $paginationSize = 15;

    /** @return Model */
    abstract protected function model();

    abstract protected function rulesStore(): array;
    abstract protected function rulesUpdate(): array;
    abstract protected function resource(): string;

    public function index()
    {
        $data = $this->paginationSize ? $this->model()::paginate($this->paginationSize) : $this->model()::all();

        $refClass = new \ReflectionClass($this->resource());
        $resourceCollectionClass = $this->resource();

        if ($refClass->isSubclassOf($resourceCollectionClass)) {
            return new $resourceCollectionClass($data);
        }

        return $resourceCollectionClass::collection($data);
    }

    public function store(Request $request)
    {
        $validateData = $this->validate($request, $this->rulesStore());
        $obj = $this->model()::create($validateData);
        $obj->refresh();
        $resource = $this->resource();
        return new $resource($obj);
    }

    public function show($id)
    {
        $obj = $this->findOrFail($id);
        $resource = $this->resource();
        return new $resource($obj);
    }

    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request, $this->rulesUpdate());
        $obj = $this->findOrFail($id);
        $obj->update($validateData);
        $obj->refresh();
        $resource = $this->resource();
        return new $resource($obj);
    }

    public function destroy($id)
    {
        $obj = $this->findOrFail($id);
        $obj->delete();
        return response()->noContent();
    }


    protected function findOrFail($id)
    {
        $model = $this->model();
        $keyName = (new $model)->getRouteKeyName();
        return $model::where($keyName, $id)->firstOrFail();
    }
}
