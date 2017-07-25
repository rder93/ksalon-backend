<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Ticket;

use App\Models\User;

use Validator;

class TicketsController extends Controller
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
            if($user->rol_id!=0)
                $tickets = Ticket::where('owner_id' , $user->id)->orderBy('created_at','DESC')->get();
            else
                $tickets = Ticket::where('owner_id' , $user->id)->orderBy('created_at','DESC')->get();

            if(count($tickets)>0){
                foreach($tickets as $t){
                    $t->creator = User::find($t->owner_id);
                    $t->sender = User::find($t->user_id);

                    if($t->ticket_id == 0)
                        $t->thread = Ticket::where('ticket_id',$t->id)->first();
                        
                }
                    
            }

                return response()->json([
                    'suceess' => true,
                    'tickets' => $tickets
                    ]);
        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Usuario no encontrado',
                'id' => $request->id,
                'req' => $request
                ]);
        }
        
    }



    public function user_tickets($id)
    {
        $user = User::find($id);

        if($user){

            $tickets = Ticket::where('owner_id',$user->id);

            if(count($tickets)>0){
                foreach($tickets as $t){
                    $t->creator = User::find($t->owner_id);
                    $t->sender = User::find($t->user_id);

                    if($t->ticket_id != 0)
                        $t->thread = Ticket::find($t->ticket_id);
                    
                }
                
            }

            return response()->json([
                'success'   => true,
                'msj'       => 'Ticket enviado'
            ]);

        }else{
            return response()->json([
                'success'   => false,
                'msj'       => 'Usuario no encontrado'
            ]);
        }
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

        $input            = $request->all();

        $subject          = $request->subject;
        $content          = $request->content;

        $user_id          = $request->user_id;
        $owner_id         = $request->owner_id;
        $ticket_id        = $request->ticket_id;
        $rol              = $request->rol;

        $rules = [
            'subject'          => 'required',
            'content'          => 'required',

            'user_id'          => 'required|integer',
            'owner_id'         => 'required|integer',
            'ticket_id'        => 'required|integer',
            'rol'              => 'required|integer'
            
        ]; 

        $messages = [
            'subject.required'      => 'Indica un asunto para el ticket',
            'content.required'      => 'Ingresa un comentario',

            'user_id'               =>'Error al enviar ticket',
            'user_id'               =>'Error al enviar ticket',
            'owner_id'              =>'Error al enviar ticket',
            'owner_id'              =>'Error al enviar ticket',
            'ticket_id'             =>'Error al enviar ticket',
            'ticket_id'             =>'Error al enviar ticket',
            'rol'                   =>'Error al enviar ticket',
            'rol'                   =>'Error al enviar ticket'
        ];

        $valide = Validator::make($input , $rules , $messages);


        if ($valide->fails()) {
            return response()->json([
                'success' => false,
                'msj'     => $valide->errors()->first()
    
            ]);
        }else{

            if($rol != 0){
                $ticket = new Ticket;

                    $ticket->subject        = $subject;
                    $ticket->content        = $content;

                    $ticket->user_id        = $user_id;
                    $ticket->owner_id       = $owner_id;
                    $ticket->ticket_id      = $ticket_id;
                    $ticket->status         = 0;

                if($ticket->save()){
                    return response()->json([
                        'success'   => true,
                        'msj'       => 'Ticket enviado',
                        'type'      => 2
                    ]);
                }    
                

            }else{
                //admin es rol = 0
                return response()->json([
                    'success'   => true,
                    'msj'       => 'Esto sera para cuando un admin responda un ticket',
                    'type'      => 1
                ]);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);

        if($ticket){

            $ticket->creator = User::find($ticket->owner_id);
            $ticket->sender = User::find($ticket->user_id);

            if($ticket->ticket_id == 0){
                $ticket->thread = Ticket::where('ticket_id',$ticket->id)->first();

                if($ticket->thread){
                    $ticket->thread->creator = User::find($ticket->thread->owner_id);
                    $ticket->thread->sender = User::find($ticket->thread->user_id);
                }
            }


            return response()->json([
                'success'   => true,
                'ticket'       => $ticket
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msj'     => 'Ticket no encontrado'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
