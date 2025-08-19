@extends('layout.app')

@section('title', 'Nouvelle Inscription - Psycho Praticien')

@section('header')
    <h1>Nouvelle Inscription</h1>
    <p>Ajouter un nouveau participant à la formation "Psycho Praticien".</p>
@endsection

@section('content')
    <form action="{{ route('ajouter.store') }}" method="POST" class="inscription-form">
        @csrf

        <div class="form-group">
            <label for="nom">Nom complet</label>
            <input type="text" id="nom" name="nomPrenom"
                   class="{{ $errors->has('nomPrenom') ? 'is-invalid' : '' }}"
                   placeholder="Ex: Jean Dupont"
                   value="{{ old('nomPrenom') }}" required>
            @error('nomPrenom')
            <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email"
                   class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                   placeholder="Ex: jean.dupont@email.com"
                   value="{{ old('email') }}" required>
            @error('email')
            <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone"
                   class="{{ $errors->has('telephone') ? 'is-invalid' : '' }}"
                   placeholder="Ex: 0612345678"
                   value="{{ old('telephone') }}">
            @error('telephone')
            <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_inscription">Date d'inscription</label>
            <input type="date" id="date_inscription" name="dateInscription"
                   class="{{ $errors->has('dateInscription') ? 'is-invalid' : '' }}"
                   value="{{ old('dateInscription') }}" required>
            @error('dateInscription')
            <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="statut">Statut de l'inscription</label>
            <select id="statut" name="statutInscription" class="{{ $errors->has('statutInscription') ? 'is-invalid' : '' }}">
                <option value="en_attente" {{ old('statutInscription') === 'en_attente' ? 'selected' : '' }}>En attente de paiement</option>
                <option value="validee" {{ old('statutInscription') === 'validee' ? 'selected' : '' }}>Validée</option>
                <option value="dossier_incomplet" {{ old('statutInscription') === 'dossier_incomplet' ? 'selected' : '' }}>Dossier incomplet</option>
                <option value="annulee" {{ old('statutInscription') === 'annulee' ? 'selected' : '' }}>Annulée</option>
            </select>
            @error('statutInscription')
            <small class="error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Enregistrer l'inscription</button>
            <a href="{{ route('liste') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>

@endsection
