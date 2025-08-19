<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nomPrenom
 * @property string $email
 * @property string $telephone
 * @property Carbon $dateInscription
 * @property string $statutInscription
 * @property boolean $estPrioritaire
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static Eleve find($id)
 * @method static Eleve findOrFail($id)
 * @method static Eleve first()
 * @method static Eleve[] all()
 * @method static Eleve[] get()
 */
class Eleve extends Model
{
    protected $table = 'eleves';

    protected $fillable = [
        'nomPrenom',
        'email',
        'telephone',
        'dateInscription',
        'statutInscription',
        'estPrioritaire'
    ];

    protected $casts = [
        'dateInscription' => 'datetime',
        'estPrioritaire' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
