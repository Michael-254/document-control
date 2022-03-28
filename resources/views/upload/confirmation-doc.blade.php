<x-app-layout>
    @section('styles')
    <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    @endsection
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

                                    <div class="row pt-3 px-3">
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">Communication Date</p>
                                            <p class="text-gray-500 pt-1">{{$document->implementor_date}}</p>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">Communicator Title</p>
                                            <p class="text-gray-500 pt-1">{{$document->Imp->job_title}}</p>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <p class="font-sans font-bold text-green-500 mb-2">Commmunicator Comment</p>
                                            <p class="text-gray-500 pt-1">{{$document->implementor_comment}}</p>
                                        </div>
                                    </div>

                                    <form action="{{route('confirm.update',$document)}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <div class="row px-3">
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">I have received the Document</p>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio text-green-500 focus:ring-gray-50" name="received" value="1" {{ ($document->confirms->received) ? "checked" : "" }}>
                                                        <span class="ml-2 text-green-500">Yes</span>
                                                    </label>
                                                    <label class="inline-flex items-center ml-2">
                                                        <input type="radio" class="form-radio text-red-600 focus:ring-gray-50" name="received" value="0" {{ (!$document->confirms->received) ? "checked" : "" }}>
                                                        <span class="ml-2 text-red-600">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">Comment if any</p>
                                                <textarea name="received_comment" rows="2" class="btn-blue">{{ old('received_comment') }}{{$document->confirms->received_comment ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">I have read and Understood the Document</p>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio text-green-500 focus:ring-gray-50" name="read" value="1" {{ ($document->confirms->read) ? "checked" : "" }}>
                                                        <span class="ml-2 text-green-500">Yes</span>
                                                    </label>
                                                    <label class="inline-flex items-center ml-2">
                                                        <input type="radio" class="form-radio text-red-600 focus:ring-gray-50" name="read" value="0" {{ (!$document->confirms->read) ? "checked" : "" }}>
                                                        <span class="ml-2 text-red-600">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">Comment if any</p>
                                                <textarea name="read_comment" rows="2" class="btn-blue">{{ old('read_comment') }}{{$document->confirms->read_comment ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row px-3">
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">I have Communicated and Implemented the Document</p>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio text-green-500 focus:ring-gray-50" name="doc_implemented" value="1" {{ ($document->confirms->doc_implemented) ? "checked" : "" }}>
                                                        <span class="ml-2 text-green-500">Yes</span>
                                                    </label>
                                                    <label class="inline-flex items-center ml-2">
                                                        <input type="radio" class="form-radio text-red-600 focus:ring-gray-50" name="doc_implemented" value="0" {{ (!$document->confirms->doc_implemented) ? "checked" : "" }}>
                                                        <span class="ml-2 text-red-600">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">Comment if any</p>
                                                <textarea name="doc_implemented_comment" rows="2" class="btn-blue">{{ old('doc_implemented') }}{{$document->confirms->doc_implemented_comment ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row px-3">
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">I have Destroyed former Docs both hard and soft</p>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio text-green-500 focus:ring-gray-50" name="destroyed" value="1" {{ ($document->confirms->destroyed) ? "checked" : "" }}>
                                                        <span class="ml-2 text-green-500">Yes</span>
                                                    </label>
                                                    <label class="inline-flex items-center ml-2">
                                                        <input type="radio" class="form-radio text-red-600 focus:ring-gray-50" name="destroyed" value="0" {{ (!$document->confirms->destroyed) ? "checked" : "" }}>
                                                        <span class="ml-2 text-red-600">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">Comment if any</p>
                                                <textarea name="destroyed_comment" rows="2" class="btn-blue">{{ old('destroyed_comment') }}{{$document->confirms->destroyed_comment ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row pt-1 px-3">
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans font-bold text-green-500 mb-2">Date of Implementation</p>
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="btn-blue" name="start_date" value="{{$document->confirms->start_date ?? ''}}" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
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
            //DatePicker
            $('#datetimepicker1').datepicker({
                format: "yyyy-mm-dd",
                weekStart: 0,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                orientation: "auto"
            })
        })
    </script>
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    @endsection
</x-app-layout>