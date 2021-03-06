<x-app-layout>

    <div class="content">
        <div class="container">

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="font-bold text-green-500 card-title">Document implementation</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="content animate__animated animate__zoomIn px-4 py-1">
                                <x-auth-validation-errors :errors="$errors" />
                                <div class="bg-indigo-50 shadow-2xl rounded-3xl">
                                    <h2 class="text-center text-blue-600 text-2xl font-bold pt-6">Doc No: {{$document->document_no}}</h2>
                                    <div class="w-5/6 m-auto">
                                        <p class="text-center text-gray-500 pt-1">Doc Name: <a href="{{route('document.stream',$document)}}" target="_blank">{{$document->file}}</a></p>
                                        <p class="text-center text-gray-500 pt-1">Dept: {{$document->department}}</p>
                                    </div>
                                    <div class="row pt-3 px-3">
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans font-bold text-green-500 mb-2">Document title</p>
                                            <p class="text-gray-500 pt-1">{{$document->title}}</p>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans font-bold text-green-500 mb-2">Revison Status</p>
                                            <p class="text-gray-500 pt-1">{{$document->revision_status}}</p>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans font-bold text-green-500 mb-2">Process Owner</p>
                                            <p class="text-gray-500 pt-1">{{$document->personIncharge->job_title}}</p>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans font-bold text-green-500 mb-2">Created By</p>
                                            <p class="text-gray-500 pt-1">{{$document->creator->job_title}}</p>
                                        </div>
                                    </div>
                                    <div class="row pt-3 px-3">
                                        <div class="form-group col-sm-12">
                                            <p class="font-sans font-bold text-green-500 mb-2">my Comments</p>
                                            <p class="text-gray-500 pt-1">{{$document->uploader_comment}}</p>
                                        </div>
                                    </div>

                                    @if($document->HOD_revisor != '')
                                    <div class="row pt-3 px-3">
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">HOD Review Date</p>
                                            <p class="text-gray-500 pt-1">{{$document->HOD_date}}</p>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">HOD Title</p>
                                            <p class="text-gray-500 pt-1">{{$document->HOD->job_title}}</p>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">HOD Comment</p>
                                            <p class="text-gray-500 pt-1">{{$document->HOD_comment}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($document->QC_revisor != '')
                                    <div class="row pt-3 px-3">
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">QC Review Date</p>
                                            <p class="text-gray-500 pt-1">{{$document->QC_date}}</p>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">QC Title</p>
                                            <p class="text-gray-500 pt-1">{{$document->QC->job_title}}</p>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">QC Comment</p>
                                            <p class="text-gray-500 pt-1">{{$document->QC_comment}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($document->MD_approver != '')
                                    <div class="row pt-3 px-3">
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">Approver Review Date</p>
                                            <p class="text-gray-500 pt-1">{{$document->MD_date}}</p>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">Approver Title</p>
                                            <p class="text-gray-500 pt-1">{{$document->MD->job_title}}</p>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">Approver Comment</p>
                                            <p class="text-gray-500 pt-1">{{$document->MD_comment}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($document->implementor != '')
                                    <div class="row pt-3 px-3">
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans font-bold text-green-500 mb-2">Implementor Date</p>
                                            <p class="text-gray-500 pt-1">{{$document->implementor_date}}</p>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans font-bold text-green-500 mb-2">Implementor Title</p>
                                            <p class="text-gray-500 pt-1">{{$document->Imp->job_title}}</p>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans font-bold text-green-500 mb-2">Implementor Comment</p>
                                            <p class="text-gray-500 pt-1">{{$document->implementor_comment}}</p>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans font-bold text-green-500 mb-2">Date the Document will start Operations</p>
                                            <p class="text-gray-500 pt-1">{{$document->implementation_date}}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($document->status == 'HOD rejected')
                                    <div class="flex justify-end py-3 px-3">
                                       <a href="{{route('document.edit',$document)}}"><button class="btn btn-primary btn-xs">Edit Document</button></a> 
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

</x-app-layout>