<x-app-layout>

    <div class="content">
        <div class="container">

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="font-bold text-green-500 card-title">Quality Cordinator Review</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="content animate__animated animate__zoomIn px-4 py-1">
                                <x-auth-validation-errors :errors="$errors" />
                                <div class="bg-indigo-50 shadow-2xl rounded-3xl">
                                    <h2 class="text-center text-blue-600 text-2xl font-bold pt-6">Doc No: {{$document->document_no}}</h2>
                                    <div class="w-5/6 m-auto">
                                        <p class="text-center text-gray-500 pt-1">Doc Name: <a href="#">{{$document->file}}</a></p>
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
                                            <p class="font-sans font-bold text-green-500 mb-2">Uploader Comments</p>
                                            <p class="text-gray-500 pt-1">{{$document->uploader_comment}}</p>
                                        </div>
                                    </div>

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

                                    <form action="{{route('md.update',$document)}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class="row px-3">
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">MD Decision</p>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio text-green-500 focus:ring-gray-50" name="status" value="MD accepted">
                                                        <span class="ml-2 text-green-500">Accept</span>
                                                    </label>
                                                    <label class="inline-flex items-center ml-2">
                                                        <input type="radio" class="form-radio text-red-600 focus:ring-gray-50" name="status" value="MD rejected">
                                                        <span class="ml-2 text-red-600">Reject</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">Comment if any</p>
                                                <textarea name="MD_comment" rows="2" class="btn-blue">{{ old('MD_comment') }}{{$document->MD_comment ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="flex justify-end px-3">
                                            <x-button>Save</x-button>
                                        </div>

                                    </form>
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