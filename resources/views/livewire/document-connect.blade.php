   <div class="content">
       <div class="container">

           <!-- /.row -->
           <div class="row">
               <div class="col-md-12">
                   <div class="card card-default">
                       <div class="px-3 py-2  border-b-2 flex justify-between">
                           <h5 class="font-semobold text-green-600 mt-1 px-3">Link Documents</h5>
                           <svg class="mt-0.5 stroke-current h-9 w-9 animate-spin text-gray-400" wire:loading fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                           </svg>
                       </div>
                       <div class="bg-white shadow-lg rounded-md overflow-hidden">
                           <div class="content animate__animated animate__zoomIn px-4 py-1">
                               <div class="sm:flex sm:items-center px-2 py-2">
                                   <div class="text-center sm:text-left sm:flex-grow">
                                       <div class="mb-1">
                                           <p class="text-xl leading-tight">{{$link_document->document_no}}</p>
                                           <p class="text-sm leading-tight text-grey-dark">Name: {{$link_document->file}}</p>
                                           <p class="text-sm leading-tight text-grey-dark">Dept: {{$link_document->department}}</p>
                                           <p class="text-sm leading-tight text-grey-dark">Type: {{$link_document->title}}</p>
                                       </div>
                                   </div>
                               </div>

                               @if($search || $department_filter || $title_filter)
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
                                                   <label class="text-green-700">User with Right:</label>
                                                   <select class="border-2 transition duration-500 border-gray-200 text-xs focus:border-green-300 focus:ring-green-400 rounded-md w-full" style="width: 100%;">
                                                       <option>-- Select User --</option>
                                                       @foreach($users as $user)
                                                       <option value="{{$user->id}}">{{$user->job_title}}</option>
                                                       @endforeach
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

                               <div class="row overflow-x-auto">
                                   <table class="table table-hover text-nowrap">
                                       <thead class="text-blue-700">
                                           <tr>
                                               <th>Doc No</th>
                                               <th>Type</th>
                                               <th>Department</th>
                                               <th>File</th>
                                               <th>Documents Attached To It</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @forelse($documents as $doc)
                                           <tr>
                                               <td>{{$doc->document_no}}</td>
                                               <td>{{$doc->title}}</td>
                                               <td>{{$doc->department}}</td>
                                               <td><a href="#" target="_blank">{{ Str::limit($doc->file,25) }}</a></td>
                                               <td>
                                                   <ul>
                                                       @foreach($doc->links as $link)
                                                       <li>{{$link->parent->title ?? ''}}: <a href="#">{{$link->parent->document_no ?? ''}}</a></li>
                                                       @endforeach
                                                   </ul>
                                               </td>
                                               <?php $array = \Arr::flatten($my_doc); ?>
                                               @if(in_array($doc->id,$array))
                                               <td><a class="cursor-pointer text-yellow-500 focus:text-yellow-700" wire:click.prevent="unLink({{$doc->id}})">Unlink</a></td>
                                               @else
                                               <td><a class="cursor-pointer text-green-600 focus:text-green-800" wire:click.prevent="createLink({{$doc->id}})">Link</a></td>
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
   </div>