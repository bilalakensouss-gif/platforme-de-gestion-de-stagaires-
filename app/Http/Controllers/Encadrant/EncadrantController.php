<?php

namespace App\Http\Controllers\Encadrant;

use App\Http\Controllers\Controller;
use App\Models\Convention;
use App\Models\GanttTask;
use Illuminate\Http\Request;

class EncadrantController extends Controller
{
    // =====================
    // Dashboard
    // =====================
    public function dashboard()
    {
        $conventions = Convention::with(['etudiant', 'entreprise'])
                                 ->where('encadrant_id', auth()->id())
                                 ->get();

        $stats = [
            'etudiants'    => $conventions->count(),
            'en_cours'     => $conventions->whereIn('etat', ['non_signee', 'partiellement_signee'])->count(),
            'termines'     => $conventions->where('etat', 'signee')->count(),
        ];

        return view('encadrant.dashboard', compact('conventions', 'stats'));
    }

    // =====================
    // Liste étudiants
    // =====================
    public function etudiants()
    {
        $conventions = Convention::with(['etudiant', 'entreprise', 'rapport'])
                                 ->where('encadrant_id', auth()->id())
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        return view('encadrant.etudiants', compact('conventions'));
    }

    // =====================
    // Détail étudiant
    // =====================
    public function etudiant($id)
    {
        $convention = Convention::with(['etudiant', 'entreprise', 'rapport'])
                                ->where('encadrant_id', auth()->id())
                                ->findOrFail($id);

        $tasks = GanttTask::where('convention_id', $convention->id)
                          ->orderBy('ordre')
                          ->get();

        return view('encadrant.etudiant-show', compact('convention', 'tasks'));
    }

    // =====================
    // Gantt global
    // =====================
    public function gantt()
    {
        $conventions = Convention::with(['etudiant', 'entreprise'])
                                 ->where('encadrant_id', auth()->id())
                                 ->get();

        $allTasks = GanttTask::whereIn(
                                'convention_id',
                                $conventions->pluck('id')
                              )
                              ->with(['etudiant', 'convention'])
                              ->orderBy('convention_id')
                              ->orderBy('ordre')
                              ->get();

        return view('encadrant.gantt', compact('conventions', 'allTasks'));
    }

    // =====================
    // Mise à jour progression Gantt
    // =====================
    public function updateGantt(Request $request, $id)
    {
        $request->validate([
            'progression' => 'required|integer|min:0|max:100',
            'statut'      => 'required|in:non_commence,en_cours,termine',
        ]);
        

        $task = GanttTask::findOrFail($id);

        // Vérifier que la convention appartient à cet encadrant
        $convention = Convention::where('encadrant_id', auth()->id())
                                ->findOrFail($task->convention_id);

        $task->update([
            'progression' => $request->progression,
            'statut'      => $request->statut,
        ]);

        return back()->with('success', 'Progression mise à jour.');
    }
}