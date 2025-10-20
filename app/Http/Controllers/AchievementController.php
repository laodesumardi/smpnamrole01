<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;

class AchievementController extends Controller
{
    /**
     * Display a listing of achievements
     */
    public function index(Request $request)
    {
        $query = Achievement::active();

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('participant_name', 'like', "%{$search}%");
            });
        }

        $achievements = $query->orderBy('year', 'desc')
                             ->orderBy('created_at', 'desc')
                             ->paginate(12);

        // Get filter options
        $years = Achievement::active()->distinct()->pluck('year')->sort()->values();
        $levels = Achievement::active()->distinct()->pluck('level')->sort()->values();
        $types = Achievement::active()->distinct()->pluck('type')->sort()->values();

        return view('achievements.index', compact('achievements', 'years', 'levels', 'types'));
    }
}
