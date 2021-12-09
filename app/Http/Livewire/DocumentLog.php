<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Link;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentLog extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selected_document, $link_document;
    public $search, $department_filter, $title_filter, $current_status;
    public $assign_access, $user_to_have_access, $users;

    public function mount()
    {
        $this->users = User::select('id', 'job_title')->orderBy('job_title', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.document-log', [

            'documents' => Document::with('user', 'creator', 'personIncharge', 'HOD', 'QC', 'MD', 'Imp', 'links', 'access')
                ->when($this->department_filter, function ($query) {
                    $query->where('department', $this->department_filter);
                })
                ->when($this->title_filter, function ($query) {
                    $query->where('title', $this->title_filter);
                })
                ->when($this->current_status, function ($query) {
                    $query->where('status', $this->current_status);
                })
                ->search(trim($this->search))
                ->paginate(7),
        ]);
    }

    public function clearFilters()
    {
        $this->reset('search', 'department_filter', 'title_filter', 'current_status','assign_access');
    }

    public function removeRole($id)
    {
        Role::findOrFail($id)->delete();
    }

    public function chosenDoc($id)
    {
        $this->assign_access = $id;
    }

    public function AssignRole()
    {
        $this->validate([
            'user_to_have_access' => 'required',
        ]);

        $check_if_has_role = Role::where([['user_id', $this->user_to_have_access], ['doc_id', $this->assign_access]])->first();
        if ($check_if_has_role == '') {
            Role::create(['user_id' => $this->user_to_have_access, 'doc_id' => $this->assign_access]);
        }

        session()->flash('message', 'Access rights assigned');
        $this->reset('assign_access', 'user_to_have_access');
    }

    public function GoToLinking($id)
    {
        $doc = Document::findOrFail($id);
        return redirect()->to('/link/documents')->with(['doc' => $doc]);
    }
}
