<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\admin\EstablishmentResource as AdminEstablishmentResource;
use App\Models\Establishment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class EstablishmentController extends Controller
{
    public function index()
    {

        return AdminEstablishmentResource::collection(Establishment::all());
    }

    private static function getColumnNames()
    {
        $est = new Establishment();
        $tableName = $est->getTable();
        return Schema::getColumnListing($tableName);
    }
}
