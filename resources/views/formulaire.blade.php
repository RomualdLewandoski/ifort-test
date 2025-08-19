@extends('layout.app')

@section('title', 'Nouvelle Inscription - Psycho Praticien')

@section('header')
    <h1>Nouvelle Inscription</h1>
    <p>Ajouter un nouveau participant à la formation "Psycho Praticien".</p>
@endsection

@section('content')
    <form action="#" method="POST" class="inscription-form">
        <div class="form-group">
            <label for="nom">Nom complet</label>
            <input type="text" id="nom" name="nom" placeholder="Ex: Jean Dupont" required>
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="Ex: jean.dupont@email.com" required>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone" placeholder="Ex: 06 12 34 56 78">
        </div>

        <div class="form-group">
            <label for="date_inscription">Date d'inscription</label>
            <input type="date" id="date_inscription" name="date_inscription" required>
        </div>

        <div class="form-group">
            <label for="statut">Statut de l'inscription</label>
            <select id="statut" name="statut">
                <option value="en_attente">En attente de paiement</option>
                <option value="validee">Validée</option>
                <option value="dossier_incomplet">Dossier incomplet</option>
                <option value="annulee">Annulée</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Enregistrer l'inscription</button>
            <a href="{{route('liste')}}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
@endsection
