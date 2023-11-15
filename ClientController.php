<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Repository\BaseCrudRepo;
use Illuminate\Http\Request;

class ClientController extends BaseCrudRepo
{
    public function setData()
    {
        $this->model = new Client();
        $this->storeRequest = StoreClientRequest::class;
        $this->updateRequest = StoreClientRequest::class;
    }
}
