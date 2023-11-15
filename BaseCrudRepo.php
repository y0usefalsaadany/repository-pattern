<?php

namespace App\Repository;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\UploadedFile;

abstract class BaseCrudRepo extends Controller
{

    protected $model, $storeRequest, $updateRequest;
    private $fileName, $folderName;

    public function __construct()
    {
        $this->setData();
        $this->fileName = $this->model::FILE_KEY;
        $this->folderName = $this->model::FOLDER_NAME;
    }
    abstract function setData();

    public function index()
    {
        return response()->json([
            "data" => $this->model->get()
        ]);
    }

    public function store()
    {
        $data = app($this->storeRequest)->all();
        if (request()->has($this->fileName)) {
            $data[$this->fileName] = request()->file($this->fileName)->store($this->folderName, 'public');
        }
        $data = $this->model->create($data);
        return response()->json([
            "data" => $data
        ]);
    }

    public function show($id)
    {
        $data = $this->model->find($id);
        return response()->json([
            "data" => $data
        ]);
    }


    public function update($id)
    {
        $data = app($this->storeRequest)->all();
        $model = $this->model->findOrfail($id);
        if (request()->has($this->fileName)) {
            $data[$this->fileName] = $data[$this->fileName] instanceof UploadedFile ?
                request()->file($this->fileName)->store($this->folderName, 'public')
                :
                $model[$this->fileName];
        }
        $data = $model->update($data);
        return response()->json([
            "message" => "updated"
        ]);
    }

    public function destroy($id)
    {
        $data = $this->model->findOrFail($id)->delete();
        return response()->json([
            "message" => "deleted"
        ]);
    }
}
