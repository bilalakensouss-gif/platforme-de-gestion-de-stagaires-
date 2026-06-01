<?php
// app/Models/ActivityLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'acteur_type',
        'acteur_id',
        'action',
        'cible_type',
        'cible_id',
        'details',
    ];

    // Helper statique pour logger facilement
    public static function log(
        string $acteurType,
        int $acteurId,
        string $action,
        string $cibleType = null,
        int $cibleId = null,
        string $details = null
        
    ): void {
        self::create([
            'acteur_type' => $acteurType,
            'acteur_id'   => $acteurId,
            'action'      => $action,
            'cible_type'  => $cibleType,
            'cible_id'    => $cibleId,
            'details'     => $details,
        ]);
    }
}