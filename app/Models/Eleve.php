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

    /**
     * Fonction de récupération du label correspondant au statut du dossier de l'élève
     * @return string
     */
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

    /**
     * Fonction de récupération du nom de la class css correspondant au statut du dossier de l'élève
     * @return string
     */
    public function getStatutInscriptionClassAttribute(): string
    {
        return match ($this->statutInscription) {
            'en_attente' => 'statut-en-attente',
            'validee' => 'statut-validee',
            'dossier_incomplet' => 'statut-dossier-incomplet',
            'annulee' => 'statut-annulee',
            default => 'statut-en-attente',
        };
    }

    /**
     * Scope de recherche d'élève par nom ou email
     * @param $query
     * @param string|null $value la chaine de caractères à rechercher
     * @return mixed
     */
    public function scopeSearch($query, ?string $value)
    {
        if (!empty($value)) {
            $query->where(function ($q) use ($value) {
                $q->where('nomPrenom', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%");
            });
        }
        return $query;
    }

    /**
     * Scope de recherche d'élève par statut
     * @param $query
     * @param string|null $statut le statut à rechercher
     * @return mixed
     */
    public function scopeStatut($query, ?string $statut)
    {
        if (!empty($statut)) {
            $query->where('statutInscription', $statut);
        }
        return $query;
    }
}
