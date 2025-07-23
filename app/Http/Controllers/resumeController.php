<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Resume;
class ResumeController extends Controller
{
    public function showForm($id = null)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $resume = null;
        $editing = false;

        if ($id) {
            $resume = Resume::where('id', $id)->where('id_user', Auth::id())->first();
            if (!$resume) {
                return back()->withErrors(['resume' => 'Invalid Resume']);
            }
            $editing = true;
        }

        return view('form', compact('resume', 'editing'));
    }
}
?>