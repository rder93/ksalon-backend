<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Independent;
use App\Models\IndependentService;
use App\Models\Lounge;
use App\Models\Rol;
use App\Models\Transaction;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'username','avatar', 'email', 'password', 'latitud', 'longitud', 'rol_id', 'dni', 'passport', 'paypal'
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function crear($request)
    {
        
        $user = User::create(
            $request->only(
                'name',
                'surname',
                'username',
                'email',
                'dni',
                'passport',
                'rol_id'
            )
        );

        $user = bcrypt($request->get('password'));

        try{
            DB::beginTransaction();
            
            switch ($request->get('rol')) {
                case '1':
                    
                    break;
                case '2':
                    
                    break;
                case '3':
                    
                    break;
                case '4':
                    
                    break;
                default:
                    
                    break;
            }



            DB::commit();
        } catch(Exception $e){
            DB::rollback();
            session()->flash('msg_danger', $e->getMessage());
        };


        if ($user->save()) {
            return true;
        }

        return false;        
    }

    public function lounges()
    {
        return $this->hasMany(Lounge::class);
    }

    public function rol(){
        return $this->belongsTo(Rol::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function services()
    {
        return $this->hasMany(IndependentService::class);
    }
}
