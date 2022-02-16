<x-app-layout>
    <div class="content">
        <div class="container">

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="px-3 py-2  border-b-2 flex justify-between">
                            <h5 class="font-semobold text-green-600 mt-1 px-3">Documents I have access to</h5>
                        </div>
                        <div class="bg-white shadow-lg rounded-md overflow-hidden">
                            <div class="content bg-indigo-50 animate__animated animate__zoomIn px-4 py-3">
                                <div class="row overflow-x-auto">
                                    <table class="table table-hover text-nowrap">
                                        <thead class="text-blue-700">
                                            <tr>
                                                <th>Doc No</th>
                                                <th>Type</th>
                                                <th>Department</th>
                                                <th>Status</th>
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
                                                <th>Impelementor</th>
                                                <th>Impelementor Comment</th>
                                                <th>Implementation Date</th>
                                                <th>Documents Attached</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($documents as $doc)
                                            <tr>
                                                <td>{{$doc->document_no}}</td>
                                                <td>{{$doc->title}}</td>
                                                <td>{{$doc->department}}</td>
                                                <td>{{$doc->status}}</td>
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
                                                <td>
                                                    <ul>
                                                        @foreach($doc->links as $link)
                                                        <li>{{$link->parent->title ?? ''}}: <a href="{{route('document.withaccess.stream',$link->parent)}}">{{$link->parent->document_no ?? ''}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </td>
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
</x-app-layout>