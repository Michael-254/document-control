<x-app-layout>
    <div class="content">
        <div class="container">

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="font-bold text-green-500 card-title">Assigning Rights and Communication</h3>
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
                                        <div class="form-group col-sm-6">
                                            <p class="font-sans font-bold text-green-500 mb-2">Uploaded By</p>
                                            <p class="text-gray-500 pt-1">{{$document->user->job_title}}</p>
                                        </div>
                                        <div class="form-group col-sm-6">
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

                                    <form action="{{route('imp.update',$document)}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class="row px-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="text-green-500 font-sans font-bold">Users to have access</label>
                                                    <select class="duallistbox" multiple="multiple" name="user_id[]" required>
                                                        @foreach($users as $user)
                                                        <option class="text-blue-600 font-serif" value="{{$user->id}}">{{$user->job_title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- /.form-group -->
                                            </div>
                                            <!-- /.col -->
                                        </div>

                                        <div class="row pt-1 px-3">
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">Date of Communication</p>
                                                <div class='input-group date'>
                                                    <input type='text' readonly class="btn-blue" name="implementation_date" value="{{ date('Y-m-d') }}" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans text-green-700 mb-2">Comment if any </p>
                                                <textarea name="implementor_comment" rows="2" class="btn-blue">{{ old('implementor_comment') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row pt-3 px-4">
                                            <div class="custom-control custom-switch">
                                                <input type="hidden" name="link" value="no">
                                                <input type="checkbox" name="link" value="yes" class="cursor-pointer custom-control-input" id="customSwitch1">
                                                <label class="text-green-600 custom-control-label" for="customSwitch1">I wish to Proceed to link the document to other Documents</label>
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
    @section('scripts')
    <script>
        $(function() {
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()
        })
    </script>
    @endsection
</x-app-layout>