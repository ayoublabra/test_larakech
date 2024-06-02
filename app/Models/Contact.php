<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cle',
        'email',
        'nom',
        'prenom',
        'telephone_fixe',
        'service',
        'fonction',
        'organisation_id',
        'active'
    ];
        /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function organisation(){
        return $this->belongsTo(Organisation::class);
    }
}
