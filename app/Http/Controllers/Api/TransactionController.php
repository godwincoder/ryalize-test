<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
     /**
     * List transaction
     *
     * This method list all transaction of a particular user
     *
     * @param \Illuminate\Http\Request $request The incoming request containing pagination data.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the list of transaction.
     * 
     */

    public function listTransaction( Request $request ){

        $user       =   Auth::user();
        $perPage    =   $request->input('per_page', 100);

        $result     =   Transaction::with(['user','location'])->where('user_id', $user->id)
                                ->paginate($perPage); 

        return response()->json($result);
    }

    /**
     * Filter transaction
     *
     * This method filter transaction based on the user input
     *
     * @param \Illuminate\Http\Request $request The incoming request to filter transaction data.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with the list of transaction.
     * @throws \Illuminate\Validation\ValidationException If validation fails.
     * 
     */
    public function filterTransaction( Request $request ){

        $request->validate([
            'date'          => 'required|date',
            'location_id'   => 'required|exists:locations,id', // Check if location exists
        ]);

        $transaction   = Transaction::select('user_id','location_id', DB::raw('count(transactions.id) as total_count'))
                            ->with(['user','location']);

        if( $request->location_id ){
            $transaction->where('location_id', $request->location_id);
        }

        if( $request->date ){
            $transaction->whereDate('created_at', $request->date);
        }

        $transaction->groupBy('user_id','location_id');
        $result  = $transaction->get();
        
        return response()->json($result);

    }
}
