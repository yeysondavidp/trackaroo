<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index($code)
    {
        // Buscar proyecto por código
        $project = Project::where('code', $code)->first();

        if (!$project) {
            abort(404, 'Proyecto no encontrado.');
        }

        $user = Auth::user();

        return view('project.index', compact('project', 'user'));
    }

    public function start($code)
    {
        // Buscar proyecto por código
        $project = Project::where('code', $code)->first();

        if (!$project) {
            abort(404, 'Proyecto no encontrado.');
        }

        $user = Auth::user();

        return view('project.start', compact('project', 'user'));
    }

    public function insert(Request $request, $code)
    {

        $validated = $request->validate([
            'location' => 'nullable|string', // "lat,long"
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // hasta 5MB por foto
        ]);

        // Buscar proyecto por código
        $project = Project::where('code', $code)->first();

        if (!$project) {
            abort(404, 'Proyecto no encontrado.');
        }

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('projects', 'public');
                $photoPaths[] = $path;
            }
        }

        $project->start_photos=$photoPaths;
        $project->start_time=Carbon::now('Australia/Sydney');
        $project->start_gps=$validated['location'];
        $project->status="started";
        $flag=$project->save();


        return view('project.comments', compact('project', 'flag'));
    }

    public function comments(Request $request, $code)
    {

        $validated = $request->validate([
            'comments' => 'nullable|string', // "lat,long"
        ]);

        // Buscar proyecto por código
        $project = Project::where('code', $code)->first();

        if (!$project) {
            abort(404, 'Proyecto no encontrado.');
        }


        $project->comments=$validated['comments'];
        $project->status="commented";
        $flag=$project->save();


        return view('project.finish', compact('project', 'flag'));
    }

    public function finish(Request $request, $code)
    {

        $validated = $request->validate([
            'location' => 'nullable|string', // "lat,long"
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // hasta 5MB por foto
        ]);

        // Buscar proyecto por código
        $project = Project::where('code', $code)->first();

        if (!$project) {
            abort(404, 'Proyecto no encontrado.');
        }

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('projects', 'public');
                $photoPaths[] = $path;
            }
        }

        $project->finish_photos=$photoPaths;
        $project->finish_time=Carbon::now('Australia/Sydney');
        $project->finish_gps=$validated['location'];
        $project->status="completed";
        $flag=$project->save();


        return view('project.index', compact('project', 'flag'));
    }
}
