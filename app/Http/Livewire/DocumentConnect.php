<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Link;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class DocumentConnect extends Component
{
    Use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selected_document,$link_document;
    public $search,$department_filter,$title_filter,$users;

    public function mount(){
        $this->users = User::select('id','job_title')->orderBy('job_title','asc')->get();
        $this->selected_document = Session::get('doc')->id;
        //$this->selected_document = 5;
        $this->link_document = Document::findOrFail($this->selected_document);
    }

    public function render()
    {
        return view('livewire.document-connect',[

            'documents' => Document::with('links.parent')
                        ->where('status','Implemented')
                        ->whereNotIn('id', [$this->selected_document])
                        ->when($this->department_filter, function ($query) {
                            $query->where('department', $this->department_filter);
                          })
                          ->when($this->title_filter, function ($query) {
                            $query->where('title', $this->title_filter);
                          })
                        ->search(trim($this->search))
                        ->paginate(7),
            
            'my_doc' => Link::where('parent_id',$this->selected_document)->select('children_id')->get()->toArray()
        ]);
    }

    public function createLink($id){
        Link::create(['parent_id'=> $this->selected_document , 'children_id' => $id]);
        Link::create(['parent_id'=> $id , 'children_id' => $this->selected_document]);
    }

    public function unLink($id){
        Link::where([['parent_id', $this->selected_document] , ['children_id' , $id]])->delete();
        Link::where([['parent_id', $id ], ['children_id' , $this->selected_document]])->delete();
    }

    public function clearFilters(){
        $this->reset('search','department_filter','title_filter');
    }

}
