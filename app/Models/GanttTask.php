<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GanttTask extends Model
{
    protected $table = 'gantt_tasks';

    protected $fillable = [
        'convention_id',
        'etudiant_id',
        'titre',
        'date_debut',
        'date_fin',
        'progression',
        'statut',
        'description',
        'ordre',
    ];

    
    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
    ];

    public function convention()
    {
        return $this->belongsTo(Convention::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }
}