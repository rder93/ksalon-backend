<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

use App\Models\User;

use App\Models\Score;

use App\Models\Transaction;

use Validator;

use Mail;


class MessagesController extends Controller
{
    
    // public function conversation($user_id, $user_to_id){
    //     $user_to = User::find($user_to_id);

    //     if($user_to){
    //         $matchThese = ['user_id' => $user_id, 'user_to_id' => $user_to_id];
    //         $orThose = ['user_id' => $user_to_id, 'user_to_id' => $user_id];

    //         $messages = Message::where($matchThese)->orWhere($orThose)->orderBy('created_at','ASC')->get();
    //         Message::where($matchThese)->orWhere($orThose)->update(['ready' => 0]);

    //         return response()->json([
    //             'success'    => true,
    //             'user_to_data'   => $user_to,
    //             'messages' => $messages
    //          ]);
    //     }else{
    //         return response()->json([
    //             'success' => false,
    //             'msj'     => 'Usuario no encontrado'
    //         ]);
    //     }
    // }



    // public function conversations($id){
    // 	$user = User::find($id);

    //     if($user){
    //         $messages = Message::where('user_id',$id)->orWhere('user_to_id',$id)->get();

    //         foreach($messages as $m){
    //             $m->send_by     = User::find($m->user_id);
    //             $m->receive_by  = User::find($m->user_to_id);

    //             if($m->user_id == $user->id)
    //                 $matchThese = ['user_id' => $m->user_to_id, 'user_to_id' => $user->id, 'ready' => '1'];
    //             else
    //                 $matchThese = ['user_id' => $m->user_id, 'user_to_id' => $user->id, 'ready' => '1'];

    //             $m->sin_leer = count(Message::where($matchThese)->get());
    //         }

    //         return response()->json([
    //             'success'    => true,
    //             'user_data'   => $user,
    //             'messages' => $messages
    //          ]);

    //     }else{
    //         return response()->json([
    //             'success' => false,
    //             'msj'     => 'Usuario no encontrado'
    //         ]);
    //     }
    // }

    public function conversation($user_id, $user_to_id, $transaction_id){

        $user = User::find($user_id);
        $user_to = User::find($user_to_id);

        if($user_to){
            $matchThese = ['user_id' => $user_id, 'user_to_id' => $user_to_id, 'transaction_id' => $transaction_id];
            $orThose = ['user_id' => $user_to_id, 'user_to_id' => $user_id, 'transaction_id' => $transaction_id];

            // $messages = Message::where('user_id',$user_id)->where('user_to_id',$user_to_id)->get();
            $messages = Message::where($matchThese)->orWhere($orThose)->get();
            
            $transaction = Transaction::find($transaction_id);

            if($transaction)
                $transaction->reviews = Score::where('transaction_id',$transaction->id)->get();;
                                 

            return response()->json([
                'success'           => true,
                'user'              => $user,
                'user_to'           => $user_to,
                'messages'          => $messages,
                'transaction_data'  => $transaction
             ]);
        }else{

            return response()->json([
                'success' => false,
                'msj'     => 'Vendedor no encontrado'
            ]);
        }
    }



    public function userMessages($id){

        $user = User::find($id);

        if($user){
            // $messages = Message::where('user_id',$id)->orWhere('user_to_id',$id)->get();
            $messages = Message::where('user_id',$id)->orWhere('user_to_id',$id)->distinct('transaction_id')->get();


            foreach($messages as $m){
                $m->send_by     = User::find($m->user_id);
                $m->receive_by  = User::find($m->user_to_id);

                // $matchThese = ['user_id' => $m->user_id, 'user_to_id' => $m->user_to_id, 'ready' => '1'];
                // $orThose = ['user_id' => $m->user_to_id, 'user_to_id' => $m->user_id, 'ready' => '1'];

                if($m->user_id == $user->id)
                    $matchThese = ['user_id' => $m->user_to_id, 'user_to_id' => $user->id, 'transaction_id' => $m->transaction_id ,'ready' => '1'];
                else
                    $matchThese = ['user_id' => $m->user_id, 'user_to_id' => $user->id, 'transaction_id' => $m->transaction_id ,'ready' => '1'];

                $m->sin_leer = count(Message::where($matchThese)->get());
            
            }


            return response()->json([
                'success'    => true,
                'user_data'   => $user,
                'messages' => $messages
             ]);

        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Usuario no encontrado'
            ]);
        }
    }




    public function store(Request $request)
    {
        
        $input            = $request->all();
        $message          = $request->message;
        $user_id          = $request->user_id;
        $user_to_id       = $request->user_to_id;
        $transaction_id   = $request->transaction;

        $rules = [
            'message'    => 'required',
            'user_id'       => 'required|integer',
            'user_to_id'    => 'required|integer',
        ]; 

        $messages = [
            'message.required' => 'Ingresa un mensaje valido' 
        ];

        $valide = Validator::make($input , $rules , $messages);

        if ($valide->fails()) {
            return response()->json([
                'success' => false,
                'msj'     => $valide->errors()->first()
    
            ]);
        }else{
            $msg                = new Message;
            $msg->user_id       = $user_id;
            $msg->user_to_id    = $user_to_id;
            $msg->transaction_id= $transaction_id;
            $msg->message       = $message;
            $msg->ready         = 0;


            if($msg->save()){

                // $msg->user   = User::find($msg->user_to_id);
                // $data        = array( 'msg' => $msg );

                // $from = 'jonathancuotto@gmail.com';
                // $to   = 'jonathancuotto@gmail.com';


                // if(Mail::send('mails.message_mail', $data, 
                //     function ($m) use ($data,$from,$to) {
                //         $m->from($from, 'Ksalon App');
                //         $m->to($to, 'Ksalon App.')->subject('Nuevo mensaje!');
                // }))


                return response()->json([
                    'success'   => true,
                    'msj'       => 'Mensaje Enviado',
                    'route'     => 'message',
                    'message'    => $message
                ]);

            }else{
                return response()->json([
                    'success' => false,
                    'msj'     => 'Error al enviar mensaje'
                ]);
            }

        }
        
        if( !empty($msg) ){
            return response()->json([
                    'success'   => true,
                    'msj'       => 'Mensaje Enviado',
                    'route'     => 'message',
                    'message'    => $message
                ]);
        }else{
            return response()->json([
                    'success' => false,
                    'msj'     => 'Error al enviar mensaje'
                ]);
        }

    }
}
