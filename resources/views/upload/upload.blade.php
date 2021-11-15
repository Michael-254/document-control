<x-app-layout>
    <!-- Main content -->
    @section('styles')
    <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    @endsection
    <div class="content">
        <div class="container">

            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class=" font-bold card-title text-success">Upload a Document</h3>
                        </div>
                        <div class="card-body px-2">
                            <div class="content animate__animated animate__zoomIn px-4 py-1">
                                <x-auth-validation-errors :errors="$errors" />
                                <form action="{{route('document.store')}}" method="POST">
                                    @csrf
                                    <div class="row mt-2">
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans text-green-700 mb-2">Document title</p>
                                            <select class="block w-full btn-blue mt-2" name="title" required>
                                                <option value="">--Select Title--</option>
                                                <option value="Flow charts">Flow charts</option>
                                                <option value="Company policy">Company policy</option>
                                                <option value="Work instruction">Work instruction</option>
                                                <option value="Procedure">Procedure</option>
                                                <option value="Company Records">Company Records</option>
                                                <option value="Reference Documents">Reference Documents</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans text-green-700 mb-2">Date Created</p>
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' name="date_created" class="btn-blue" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans text-green-700 mb-2">Status in revision</p>
                                            <input type="text" name="revision_status" class="btn-blue">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans text-green-700 mb-2">Person in charge</p>
                                            <select class="block w-full btn-blue mt-2" name="person_incharge" required>
                                                <option value="">--Select PIC--</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->job_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans text-green-700 mb-2">Document Creator</p>
                                            <select class="block w-full btn-blue mt-2" name="document_creator" required>
                                                <option value="">--Select Creator--</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->job_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans text-green-700 mb-2">Who checked/revised</p>
                                            <select class="block w-full btn-blue mt-2" name="revisor" required>
                                                <option value="">--Select Reviser--</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->job_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans text-green-700 mb-2">Who approved</p>
                                            <select class="block w-full btn-blue mt-2" name="approver" required>
                                                <option value="">--Select Approver--</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->job_title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <p class="font-sans text-green-700 mb-2">Department</p>
                                            <select class="block w-full btn-blue mt-2" name="department" required>
                                                <option value="">--Select Department--</option>
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
                                    <div class="row mt-2">
                                        <div class="form-group col-sm-12">
                                            <p class="font-sans text-green-700 mb-2">Location of the document </p>
                                            <input type='text' name="location" class="btn-blue" />
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="form-group col-sm-12">
                                            <input type="file" id="file" name="file">
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <x-button>Save</x-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    @section('scripts')
    <script>
        const inputElement = document.querySelector('input[id="file"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '/tempUpload',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                }
            },
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datepicker({
                format: "mm/dd/yyyy",
                weekStart: 0,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                orientation: "auto"
            });
        });
    </script>
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    @endsection
</x-app-layout>