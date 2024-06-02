<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cle',
        'nom_org',
        'adresse',
        'code_postal',
        'ville',
        'statut',
        'active'
    ];
        /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function contacts(){
        return $this->hasMany(Contact::class);
    }

}
