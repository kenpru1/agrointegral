<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Stock\ManageStockRequest;
use App\Models\Auth\User;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {



        $empresaUser=Auth::user()->empresaUser();

        if (auth()->user()->hasRole('administrator')) {

            $stocks = Stock::orderBy('id','desc')->get();

        }else{
            $stocks = Stock::whereHas('bodega', function ($query) use ($empresaUser) {
                $query->where('empresa_id', $empresaUser->id);
            })->orderBy('id','desc')->get();
        }


        return view('backend.stock.index', compact('stocks'));
    }
}
