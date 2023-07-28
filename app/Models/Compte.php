<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    public $guarded=[
        'id'
    ];

    public function clients(){
        return $this->belongsTo(Client::class);
    }
    public function transactions(){
        return $this->Hasmany(Transaction::class, 'source_id','compte_id' );
    }
}
