<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class TransactionDetail extends Model
{
    protected $fillable = ['descripcion','precio','transaction_id','tipo'];

    protected $table= 'transaction_details';
    protected $primarykey = 'id';

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
	
}
