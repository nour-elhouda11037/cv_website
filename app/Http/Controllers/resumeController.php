<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resume;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Experience;
use Barryvdh\DomPDF\Facade\Pdf;
use Inertia\Inertia;class ResumeController extends Controller{


       public function create(){
    return Inertia::render('Form', ['resume' => null]);}

        public function edit($id){
    $resume = Resume::where('id', $id)->where('id_user', Auth::id())->firstOrFail();
    $education = $resume->education;
    $experience = $resume->experience;
    $skills = $resume->skills;
    return Inertia::render('Form', [
        'resume' => $resume,
        'education' => $education,
        'experience' => $experience,


        'skills' => $skills,
    ]);}
    public function show($id)
{
    $resume = Resume::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $education = $resume->education;
    $experience = $resume->experience;
    $skills = $resume->skills;
    return Inertia::render('Show', [
        'resume' => $resume,
        'education' => $education,
        'experience' => $experience,
        'skills' => $skills,
    ]);
}
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'school_name' => 'required|array',
        'degree' => 'required|array',
        'edu_start' => 'required|array',
        'edu_end' => 'required|array',
        'company_name' => 'required|array',
        'position' => 'required|array',
        'exp_start' => 'required|array',
        'exp_end' => 'required|array',
        'skill' => 'required|array',
        'level' => 'required|array',
    ]);

    $resume = Resume::create([
        'id_user' => Auth::id(),
        'title' => $request->title,
        'created_at' => now(),
    ]);

    foreach ($request->school_name as $i => $school) {
        Education::create([
            'id_resume' => $resume->id,
            'school_name' => $school,
            'degree' => $request->degree[$i],
            'start_date' => $request->edu_start[$i],
            'end_date' => $request->edu_end[$i],
            'description' => $request->edu_desc[$i] ?? '',
        ]);
    }

    foreach ($request->company_name as $i => $company) {
        Experience::create([
            'id_resume' => $resume->id,
            'company_name' => $company,
            'position' => $request->position[$i],

            'start_date' => $request->exp_start[$i],
            'end_date' => $request->exp_end[$i],
            'description' => $request->exp_desc[$i] ?? '',
        ]);
    }

    foreach ($request->skill as $i => $skill) {
        Skill::create([
            'id_resume' => $resume->id,
            'skill' => $skill,
            'level' => $request->level[$i],
        ]);}

    return redirect()->route('dashboard')->with('success', 'CV saved successfully!');
}

   public function destroy($id){
    $resume = Resume::where('id', $id)->where('id_user', Auth::id())->firstOrFail();

    $resume->education()->delete();
    $resume->experience()->delete();
    $resume->skills()->delete();
    $resume->delete();
return redirect()->route('dashboard')->with('success', 'CV deleted successfully');}


public function export($id)
{
    $resume = Resume::where('id', $id)->where('id_user', auth()->id())->firstOrFail();
    $education = Education::where('id_resume', $id)->get();


    $experience = Experience::where('id_resume', $id)->get();
    $skills = Skill::where('id_resume', $id)->get();
    $pdf = Pdf::loadView('export', compact('resume', 'education', 'experience', 'skills'));
    return $pdf->download($resume->title . '_CV.pdf');
}
}

