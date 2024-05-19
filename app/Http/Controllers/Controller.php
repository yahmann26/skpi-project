<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dataTableLogic(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select('*');
            return datatables()->of($users)
                ->make(true);
        }

        return view('y-dataTables');
    }
}
