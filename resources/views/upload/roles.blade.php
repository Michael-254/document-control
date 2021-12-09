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
                            <h5 class="font-bold leading-tight text-green-600 dark:text-gray-100"> Document implementation</h5>
                        </div>
                        <div class="card-body px-2">
                            <div class="content animate__animated animate__zoomIn px-4 py-1">
                                <x-auth-validation-errors :errors="$errors" />
                                <form action="{{route('role.store')}}" method="POST">
                                    @csrf
                                    <!-- Code block starts -->
                                    <div class="container px-6 flex justify-between">
                                        <p class="font-bold leading-tight text-blue-600">Doc No: BGF-{{$doc->depart()}}-{{$doc->document_no}}-00{{$doc->id}}</p>
                                        <input type="hidden" name="document_no" value="BGF-{{$doc->depart()}}-{{$doc->document_no}}-00{{$doc->id}}">
                                        <input type="hidden" name="doc_id" value="{{$doc->id}}">
                                        <p class="font-bold leading-tight text-green-800">
                                            <i class="fas fa-paperclip"></i> {{$doc->file}}
                                        </p>
                                        <i class="fas fa-trash text-red-700 hover:text-orange-500 cursor-pointer"></i>
                                    </div>
                                    <!-- Code block ends -->

                                    <div class="card card-success">
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="text-green-700">Users</label>
                                                        <select class="duallistbox" multiple="multiple" name="user_id[]" required>
                                                            @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->job_title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="flex justify-between pt-2">
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="link" value="no">
                                            <input type="checkbox" name="link" value="yes" class="cursor-pointer custom-control-input" id="customSwitch1">
                                            <label class="text-green-600 custom-control-label" for="customSwitch1">I wish to Proceed to link the document to other Documents</label>
                                        </div>
                                        <x-button>Save</x-button>
                                    </div>
                                    <!-- /.card -->
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
    @section('scripts')
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

        })
    </script>
    @endsection
</x-app-layout>