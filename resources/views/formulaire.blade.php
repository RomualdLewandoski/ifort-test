@extends('layout.app')

@php
    $isEdit = isset($eleve);
@endphp

@section('title', $isEdit ? 'Modifier une inscription - Psycho Praticien' : 'Nouvelle Inscription - Psycho Praticien')

@section('header')
    <h1>{{ $isEdit ? 'Modifier l’inscription' : 'Nouvelle Inscription' }}</h1>
    <p>{{ $isEdit ? 'Mettre à jour un participant' : 'Ajouter un nouveau participant' }} à la formation "Psycho Praticien".</p>
@endsection

@section('content')
    <form
        action="{{ $isEdit ? route('eleve.update', $eleve) : route('ajouter.store') }}"
        method="POST"
        class="inscription-form">
        @csrf
        @if($isEdit)
            @method('PATCH')
        @endif

        <div class="form-group">
            <label for="nom">Nom complet</label>
            <input type="text" id="nom" name="nomPrenom"
                   class="{{ $errors->has('nomPrenom') ? 'is-invalid' : '' }}"
                   placeholder="Ex: Jean Dupont"
                   value="{{ old('nomPrenom', $eleve->nomPrenom ?? '') }}"
                   required>
            @error('nomPrenom') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email"
                   class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                   placeholder="Ex: jean.dupont@email.com"
                   value="{{ old('email', $eleve->email ?? '') }}"
                   required>
            @error('email') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone"
                   class="{{ $errors->has('telephone') ? 'is-invalid' : '' }}"
                   placeholder="Ex: 0612345678"
                   value="{{ old('telephone', $eleve->telephone ?? '') }}">
            @error('telephone') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="date_inscription">Date d'inscription</label>
            <input type="date" id="date_inscription" name="dateInscription"
                   class="{{ $errors->has('dateInscription') ? 'is-invalid' : '' }}"
                   value="{{ old('dateInscription', isset($eleve) ? optional($eleve->dateInscription)->format('Y-m-d') : '') }}"
                   required>
            @error('dateInscription') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label for="statut">Statut de l'inscription</label>
            @php $statut = old('statutInscription', $eleve->statutInscription ?? ''); @endphp
            <select id="statut" name="statutInscription" class="{{ $errors->has('statutInscription') ? 'is-invalid' : '' }}">
                <option value="en_attente" {{ $statut==='en_attente' ? 'selected' : '' }}>En attente de paiement</option>
                <option value="validee" {{ $statut==='validee' ? 'selected' : '' }}>Validée</option>
                <option value="dossier_incomplet" {{ $statut==='dossier_incomplet' ? 'selected' : '' }}>Dossier incomplet</option>
                <option value="annulee" {{ $statut==='annulee' ? 'selected' : '' }}>Annulée</option>
            </select>
            @error('statutInscription') <small class="error">{{ $message }}</small> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? "Mettre à jour l'inscription" : "Enregistrer l'inscription" }}
            </button>
            <a href="{{ route('liste') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>

@endsection
