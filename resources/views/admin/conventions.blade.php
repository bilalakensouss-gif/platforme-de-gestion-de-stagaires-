@extends('layouts.app')

@section('page_title', 'Conventions — Création comptes entreprises')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">❌ {{ session('error') }}</div>
    @endif

<div class="card">
    <div class="card-header">
        <h3>Conventions déposées par les étudiants</h3>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="fst-table">
            <thead>
\\c                <tr>
                    <th>Étudiant</th>
                    <th>Entreprise</th>
                    <th>Contact entreprise</th>
                    <th>Type</th>
                    <th>État</th>
                    <th>Compte entreprise</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($conventions as $conv)
                <tr>
                    <td>
                        {{ $conv->etudiant->prenom }} {{ $conv->etudiant->nom }}<br>
                        <span style="color:#888; font-size:11px;">
                            {{ $conv->etudiant->filiere }}
                        </span>
                    </td>
                    <td>
                        <strong>{{ $conv->entreprise_nom }}</strong><br>
                        <span style="color:#888; font-size:11px;">
                            {{ $conv->entreprise_adresse }}
                        </span>
                    </td>
                    <td style="font-size:12px;">
                        📧 {{ $conv->entreprise_email }}<br>
                        📞 {{ $conv->entreprise_telephone ?? '—' }}<br>
                        👤 {{ $conv->entreprise_representant ?? '—' }}
                    </td>
                    <td>
                        {{ $conv->type === 'stage_classique' ? 'Stage' : 'PFE' }}
                    </td>
                    <td>
                        @if($conv->etat === 'signee')
                            <span class="badge badge-success">Signée</span>
                        @elseif($conv->etat === 'partiellement_signee')
                            <span class="badge badge-warning">En cours</span>
                        @else
                            <span class="badge badge-danger">Non signée</span>
                        @endif
                    </td>
                    <td>
                        @if($conv->entreprise_id)
                            <span class="badge badge-success">✓ Créé</span><br>
                            <span style="font-size:11px; color:#888;">
                                {{ $conv->entreprise->email_contact }}
                            </span>
                        @else
                            <span class="badge badge-danger">Non créé</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; flex-direction:column; gap:5px;">
                            {{-- PDF --}}
                            <a href="{{ route('admin.conventions.pdf', $conv->id) }}"
                               class="btn btn-secondary btn-xs">📄 PDF</a>

                            {{-- Créer compte entreprise --}}
                            @if(!$conv->entreprise_id)
                            <button class="btn btn-primary btn-xs"
                                    onclick="document.getElementById('modal-{{ $conv->id }}')
                                             .style.display='flex'">
                                🏢 Créer compte
                            </button>
                            @endif
                        </div>

                        {{-- Modal création compte entreprise --}}
                        @if(!$conv->entreprise_id)
                        <div id="modal-{{ $conv->id }}"
                             style="display:none; position:fixed; inset:0;
                                    background:rgba(0,0,0,0.5); z-index:1000;
                                    align-items:center; justify-content:center;">
                            <div style="background:white; border-radius:12px;
                                        padding:28px; width:440px; max-width:90vw;">
                                <h3 style="color:#1a3a6b; margin-bottom:4px; font-size:16px;">
                                    Créer compte entreprise
                                </h3>
                                <p style="color:#888; font-size:12px; margin-bottom:16px;">
                                    {{ $conv->entreprise_nom }}
                                </p>

                                <div style="background:#f8f9ff; padding:12px;
                                            border-radius:8px; margin-bottom:16px;
                                            font-size:12px; color:#444;">
                                    <p> Email saisi : <strong>{{ $conv->entreprise_email }}</strong></p>
                                    <p> Tél : {{ $conv->entreprise_telephone ?? '—' }}</p>
                                    <p> Représentant : {{ $conv->entreprise_representant ?? '—' }}</p>
                                </div>

                                <form method="POST"
                                      action="{{ route('admin.conventions.creer_entreprise', $conv->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-label">
                                            Email de connexion entreprise
                                        </label>
                                        <input type="email" name="email_contact"
                                               class="form-control"
                                               value="{{ $conv->entreprise_email }}"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Mot de passe</label>
                                        <input type="password" name="password"
                                               class="form-control"
                                               placeholder="Minimum 8 caractères"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            Confirmer le mot de passe
                                        </label>
                                        <input type="password" name="password_confirmation"
                                               class="form-control" required>
                                    </div>

                                    <div style="display:flex; gap:10px; margin-top:16px;">
                                        <button type="submit" class="btn btn-success">
                                             Créer le compte
                                        </button>
                                        <button type="button" class="btn btn-secondary"
                                                onclick="document.getElementById('modal-{{ $conv->id }}')
                                                         .style.display='none'">
                                            Annuler
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:#999;padding:30px;">
                        Aucune convention déposée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection