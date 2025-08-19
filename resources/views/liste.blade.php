@extends('layout.app')

@section('title', 'Liste des Inscriptions - Psycho Praticien')

@section('header')
    <h1>Gestion des Inscriptions</h1>
    <p>Formation "Psycho Praticien"</p>
@endsection

@section('content')
    <div class="toolbar">
        <div class="search-bar">
            <input type="text" placeholder="Rechercher par nom ou e-mail...">
        </div>
        <div class="filters">
            <select name="statut_filtre">
                <option value="">Tous les statuts</option>
                <option value="validee">Validée</option>
                <option value="en_attente">En attente</option>
                <option value="dossier_incomplet">Dossier incomplet</option>
            </select>
        </div>
        <a href="{{route('ajouter')}}" class="btn btn-primary">Ajouter une inscription</a>
    </div>

    <div class="listing-container">
        <table>
            <thead>
            <tr>
                <th>Priorité</th>
                <th>Nom du participant</th>
                <th>Contact</th>
                <th>Date d'inscription</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($eleves as $eleve)
                <tr class="{{ $eleve->getStatutInscriptionClassAttribute() }} {{ $eleve->estPrioritaire ? 'prioritaire' : '' }}">
                    <td class="priorite">
                        @if($eleve->estPrioritaire)
                            <button title="Retirer la priorité" class="active">★</button>
                        @else
                            <button title="Mettre en avant">☆</button>
                        @endif
                    </td>
                    <td>{{ $eleve->nomPrenom }}</td>
                    <td>{{ $eleve->email }}</td>
                    <td>{{ $eleve->dateInscription->format('d/m/Y') }}</td>
                    <td><span class="badge">{{ $eleve->getStatutInscriptionLabelAttribute() }}</span></td>
                    <td class="actions">
                        <a href="">Modifier</a>
                        <a href="#" onclick="event.preventDefault(); if(confirm('Supprimer cet élève ?')) { document.getElementById('delete-{{ $eleve->id }}').submit(); }">
                            Supprimer
                        </a>
                        <form id="delete-{{ $eleve->id }}" action="" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun élève trouvé</td>
                </tr>
            @endforelse
{{--            <tr class="statut-validee">--}}
{{--                <td class="priorite"><button title="Mettre en avant">☆</button></td>--}}
{{--                <td>Alice Martin</td>--}}
{{--                <td>alice.martin@email.com</td>--}}
{{--                <td>15/07/2025</td>--}}
{{--                <td><span class="badge">Validée</span></td>--}}
{{--                <td class="actions">--}}
{{--                    <a href="#">Modifier</a>--}}
{{--                    <a href="#">Supprimer</a>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            <tr class="statut-en-attente prioritaire">--}}
{{--                <td class="priorite"><button title="Retirer la priorité" class="active">★</button></td>--}}
{{--                <td>Bob Lejeune</td>--}}
{{--                <td>bob.lejeune@email.com</td>--}}
{{--                <td>12/07/2025</td>--}}
{{--                <td><span class="badge">En attente</span></td>--}}
{{--                <td class="actions">--}}
{{--                    <a href="#">Modifier</a>--}}
{{--                    <a href="#">Supprimer</a>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            <tr class="statut-dossier-incomplet">--}}
{{--                <td class="priorite"><button title="Mettre en avant">☆</button></td>--}}
{{--                <td>Carole Durand</td>--}}
{{--                <td>carole.durand@email.com</td>--}}
{{--                <td>10/07/2025</td>--}}
{{--                <td><span class="badge">Dossier incomplet</span></td>--}}
{{--                <td class="actions">--}}
{{--                    <a href="#">Modifier</a>--}}
{{--                    <a href="#">Supprimer</a>--}}
{{--                </td>--}}
{{--            </tr>--}}
            </tbody>
        </table>
    </div>
@endsection
