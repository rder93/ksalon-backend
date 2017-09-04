<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Score;
use App\Models\TransactionDetail;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find($request->id);

        if($user){
            if($user->rol_id != 0){

                if($user->rol_id==4)
                    $transactions = Transaction::where('user_id',$user->id)->orderBy('created_at','DESC')->get();
                else if($user->rol_id!=0 && $user->rol_id!=4)
                    $transactions = Transaction::where('user_to_id',$user->id)->orderBy('created_at','DESC')->get();


                $nonReview = 0;

                foreach($transactions as $t){  

                    $t->buyer = User::find($t->user_id);
                    $t->seller = User::find($t->user_to_id);
                    
                    $t->review = Score::where('transaction_id',$t->id)->where('user_id',$user->id)->first();


                    $rt = Score::where('transaction_id',$t->id)->where('user_id',$user->id)->get();
                        if( count($rt) > 0)
                            $t->reviews = $rt;
                        else
                            $nonReview = $nonReview + 1;         
                }

                return response()->json([
                    'success' => true,
                    'transactions' => $transactions,
                    'nonReview'    => $nonReview
                ]);

            }else{

                $transactions = Transaction::all();
        
                for ($i=0; $i < count($transactions); $i++) { 
                    $transactions[$i]['cliente'] = User::find($transactions[$i]['user_id']);
                    $transactions[$i]['vendedor'] = User::find($transactions[$i]['user_to_id']);
                }

                return response()->json($transactions->toArray());
            }

                
        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Usuario no encontrado'
            ]);
        }
    }

    public function indexAdmin()
    {
        $transactions = Transaction::all();
        
        for ($i=0; $i < count($transactions); $i++) { 
            $transactions[$i]['cliente'] = User::find($transactions[$i]['user_id']);
            $transactions[$i]['vendedor'] = User::find($transactions[$i]['user_to_id']);
        }

        return response()->json($transactions->toArray());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        // dd($input);
        try{
            // dd($input[0]);
            $transaction = Transaction::create(
                $input[0]
            );
            // dd($transaction['id']);
            foreach ($input[1] as $detail) {
                $detail['transaction_id']=$transaction['id'];
                $detailTransaction = TransactionDetail::create(
                    $detail
                );
            }
            return response()->json(
                [
                    'msj'=>'Se han pedido los servicios de forma correcta.',
                    'transaction' => $transaction,
                    'code' => 1
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'msj'=>'Error al pedir los servicios.',
                    'transaction' => $transactions,
                    'code' => 0
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $t =Transaction::find($id);

        if ($t) {
            $t->seller = User::find($t->user_to_id);
            $t->buyer  = User::find($t->user_id);

            $t->review = Score::where('transaction_id',$t->id)->get();

            $t->seller_review = Score::where('transaction_id',$t->id)->where('user_id',$t->user_to_id)->first();
            $t->buyer_review  = Score::where('transaction_id',$t->id)->where('user_id',$t->user_id)->first();

            if($t->seller_review)
                $t->seller_review->user = User::find($t->user_to_id);
            if($t->buyer_review)
                $t->buyer_review->user = User::find($t->user_id);
            $t['detalleFactura'] = TransactionDetail::where('transaction_id', '=', $id)->get();
            return response()->json([
                'success' => true,
                't' => $t
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Transaccion no encontrada'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
