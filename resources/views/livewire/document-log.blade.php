<div class="content">
    <div class="container">

        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="px-3 py-2  border-b-2 flex justify-between">
                        <h5 class="font-semobold text-green-600 mt-1 px-3">Logs</h5>
                        <svg class="mt-0.5 stroke-current h-9 w-9 animate-spin text-gray-400" wire:loading fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="bg-white shadow-lg rounded-md overflow-hidden">
                        <div class="content bg-indigo-50 animate__animated animate__zoomIn px-4 py-3">

                            @if($search || $department_filter || $title_filter || $current_status || $assign_access)
                            <div class="flex justify-end">
                                <a wire:click.prevent="clearFilters()" class="btn btn-warning btn-sm">Reset</a>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="text-green-700">Filter by Doc Name:</label>
                                                <select wire:model="title_filter" class="border-2 transition duration-500 border-gray-200 text-xs focus:border-green-300 focus:ring-green-400 rounded-md w-full">
                                                    <option value="">-- Select Title --</option>
                                                    <option value="Flow Chart">Flow Chart</option>
                                                    <option value="Company Policy">Company Policy</option>
                                                    <option value="Work Instruction">Work Instruction</option>
                                                    <option value="Procedure">Procedure</option>
                                                    <option value="Company Record">Company Record</option>
                                                    <option value="Reference Document">Reference Document</option>
                                                    <option value="Policy">Policy</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="text-green-700">Department:</label>
                                                <select wire:model="department_filter" class="border-2 transition duration-500 border-gray-200 text-xs focus:border-green-300 focus:ring-green-400 rounded-md w-full" style="width: 100%;">
                                                    <option value="">-- Select Department --</option>
                                                    <option value="Forestry">Forestry</option>
                                                    <option value="Operations">Operations</option>
                                                    <option value="HR">HR</option>
                                                    <option value="IT">IT</option>
                                                    <option value="Communications">Communications</option>
                                                    <option value="Miti Magazine">Miti Magazine</option>
                                                    <option value="Accounts">Accounts</option>
                                                    <option value="ME">M&E</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="text-green-700">Doc Status:</label>
                                                <select wire:model="current_status" class="border-2 transition duration-500 border-gray-200 text-xs focus:border-green-300 focus:ring-green-400 rounded-md w-full" style="width: 100%;">
                                                    <option value="">-- Select Status --</option>
                                                    <option value="Implemented">Implemented</option>
                                                    <option value="MD accepted">MD accepted</option>
                                                    <option value="MD rejected">MD rejected</option>
                                                    <option value="QC accepted">QC accepted</option>
                                                    <option value="QC rejected">QC rejected</option>
                                                    <option value="HOD accepted">HOD accepted</option>
                                                    <option value="HOD rejected">HOD rejected</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="text-green-700">Search:</label>
                                                <input type="search" wire:model.debounce.300ms="search" class="border-2 transition duration-500 border-gray-200 text-xs text-center focus:border-green-300 focus:ring-green-400 rounded-md w-full" placeholder="Type your keywords here">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <x-auth-validation-errors :errors="$errors" />
                                @if(session()->has('message'))
                                <script>
                                    toastr.info('{{ session('
                                        message ') }}');
                                </script>
                                @endif
                            </div>
                            <div class="row overflow-x-auto">
                                <table class="table table-hover text-nowrap">
                                    <thead class="text-blue-700">
                                        <tr>
                                            <th>Doc No</th>
                                            <th>Type</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th>implemetations Info</th>
                                            <th>File Name</th>
                                            <th>Revision Status</th>
                                            <th>Doc Location</th>
                                            <th>Creator</th>
                                            <th>Process Owner</th>
                                            <th>HOD Reviewer</th>
                                            <th>HOD Comment</th>
                                            <th>QC Reviewer</th>
                                            <th>QC Comment</th>
                                            <th>Approver</th>
                                            <th>Approver Comment</th>
                                            <th>Communicator</th>
                                            <th>Communicator Comment</th>
                                            <th>Communication Date</th>
                                            @if(auth()->user()->QC)
                                            <th>Users with Access</th>
                                            @endif
                                            <th>Documents Attached</th>
                                            @if(auth()->user()->QC)
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($documents as $doc)
                                        <tr class="@if(!$doc->confirms->received || !$doc->confirms->read || !$doc->confirms->doc_implemented || !$doc->confirms->destroyed)
                                            bg-red-300
                                        @endif">
                                            <td>{{$doc->document_no}}</td>
                                            <td>{{$doc->title}}</td>
                                            <td>{{$doc->department}}</td>
                                            <td>{{$doc->status}}</td>
                                            <td><i wire:click="confirmDetails({{$doc->id}})" data-toggle="modal" data-target=".bd-example-modal-lg" class="fas fa-eye text-green-500 hover:text-green-700 cursor-pointer"></i></td>
                                            <td><a href="{{route('document.withaccess.stream',$doc)}}" target="_blank">{{ Str::limit($doc->file,25) }}</a></td>
                                            <td>{{$doc->revison_status}}</td>
                                            <td>{{$doc->location}}</td>
                                            <td>{{$doc->creator->job_title}}</td>
                                            <td>{{$doc->personIncharge->job_title}}</td>
                                            <td>{{$doc->HOD->job_title}}</td>
                                            <td>{{$doc->HOD_comment}}</td>
                                            <td>{{$doc->QC->job_title}}</td>
                                            <td>{{$doc->QC_comment}}</td>
                                            <td>{{$doc->MD->job_title}}</td>
                                            <td>{{$doc->MD_comment}}</td>
                                            <td>{{$doc->Imp->job_title}}</td>
                                            <td>{{$doc->implementor_comment}}</td>
                                            <td>{{$doc->implementation_date}}</td>
                                            @if(auth()->user()->QC)
                                            <td>
                                                @if($doc->status == 'Implemented')
                                                <ul>
                                                    @foreach($doc->access as $role)
                                                    <li>{{$role->user->job_title}} <i wire:click.prevent="removeRole({{$role->id}})" class="fas fa-trash cursor-pointer text-red-500 hover:text-red-700"></i></li>
                                                    @endforeach
                                                    @if($assign_access == $doc->id)
                                                    <div class="mt-3">
                                                        <select wire:model.defer="user_to_have_access" class="border-2 transition duration-500 border-gray-200 text-xs focus:border-green-300 focus:ring-green-400 rounded-md">
                                                            <option value="">-- Users --</option>
                                                            @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->job_title}}</option>
                                                            @endforeach
                                                        </select>
                                                        <i wire:click.prevent="AssignRole" class="fas fa-save cursor-pointer text-green-500 hover:text-green-700"></i>
                                                    </div>
                                                    @else
                                                    <li><button wire:click.prevent="chosenDoc({{$doc->id}})" class="mt-2 btn btn-primary btn-xs">Add User</button></li>
                                                    @endif
                                                </ul>
                                                @endif
                                            </td>
                                            @endif
                                            <td>
                                                <ul>
                                                    @foreach($doc->links as $link)
                                                    <li>{{$link->parent->title ?? ''}}: <a href="{{route('document.withaccess.stream',$link->parent)}}">{{$link->parent->document_no ?? ''}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            @if(auth()->user()->QC)
                                            <td>
                                                @if($doc->status == 'Implemented')
                                                <button wire:click.prevent="GoToLinking({{$doc->id}})" class="btn btn-warning btn-xs ">
                                                    Proceed To Linking
                                                </button>
                                                @endif
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="font-bold font-serif">Nothing to show</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-end">
                                {{$documents->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div wire:ignore.self class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-green-500 font-serif" id="exampleModalLongTitle">Users response to Implementation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless table-responsive">
                        <thead>
                            <tr class="text-green-500 font-serif tracking-wide bg-gray-100">
                                <th scope="col">Name</th>
                                <th scope="col">Received</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Read & Understood</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Communicated</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Destroyed Previous</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Imp Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($userConfirms))
                            <tr class="text-center font-serif">
                                <td>{{ $userConfirms->user->job_title  }}</td>
                                <td>{{ ($userConfirms->confirms->received) ? "Yes" : "No" }}</td>
                                <td>{{ $userConfirms->confirms->received_comment }}</td>
                                <td>{{ ($userConfirms->confirms->read) ? "Yes" : "No" }}</td>
                                <td>{{ $userConfirms->confirms->read_comment }}</td>
                                <td>{{ ($userConfirms->confirms->doc_implemented) ? "Yes" : "No" }}</td>
                                <td>{{ $userConfirms->confirms->doc_implemented_comment }}</td>
                                <td>{{ ($userConfirms->confirms->destroyed) ? "Yes" : "No" }}</td>
                                <td>{{ $userConfirms->confirms->destroyed_comment }}</td>
                                <td>{{ $userConfirms->confirms->start_date }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</div>