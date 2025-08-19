@extends('layout.app')

@section('title', 'Liste des Inscriptions - Psycho Praticien')

@section('header')
    <h1>Gestion des Inscriptions</h1>
    <p>Formation "Psycho Praticien"</p>
@endsection

@section('content')
    <form class="toolbar" method="GET" action="{{ route('liste') }}">
        <div class="search-bar">
            <input type="text" name="query"
                   placeholder="Rechercher par nom ou e-mail..."
                   value="{{ request('query') }}">
        </div>

        <div class="filters">
            <select name="statutInscription">
                <option value="">Tous les statuts</option>
                <option value="validee" {{ request('statutInscription')==='validee' ? 'selected' : '' }}>Validée</option>
                <option value="en_attente" {{ request('statutInscription')==='en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="dossier_incomplet" {{ request('statutInscription')==='dossier_incomplet' ? 'selected' : '' }}>
                    Dossier incomplet
                </option>
                <option value="annulee" {{ request('statutInscription')==='annulee' ? 'selected' : '' }}>Annulée</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Filtrer</button>

        <a href="{{ route('ajouter') }}" class="btn btn-primary">Ajouter une inscription</a>
    </form>

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

            </tbody>
        </table>
        <x-pagination :paginator="$eleves"/>


    </div>
@endsection
