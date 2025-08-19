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

    public function getStatutInscriptionLabelAttribute() :string
    {
        return match ($this->statutInscription){
            'en_attente' => 'En attente',
            'validee' => 'Validée',
            'dossier_incomplet' => 'Dossier incomplet',
            'annulee' => 'Annulée',
            default => 'En attente'
        };
    }

    public function getStatutInscriptionClassAttribute(): string
    {
        return match ($this->statutInscription) {
            'en_attente' => 'statut-en-attente',
            'validee' => 'statut-validee',
            'dossier_incomplet' => 'statut-incomplet',
            'annulee' => 'statut-annulee',
            default => 'statut-en-attente',
        };
    }


}
