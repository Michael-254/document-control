<x-app-layout>
    <!-- Main content -->
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
                            <div class="content animate__animated animate__zoomIn">
                                <div class="bg-indigo-50 shadow-2xl rounded-3xl px-4 py-4">
                                    <x-auth-validation-errors :errors="$errors" />
                                    <form action="{{route('document.store')}}" method="POST">
                                        @csrf
                                        <div class="row mt-2">
                                            <div class="form-group col-sm-3">
                                                <p class="font-sans text-green-700 mb-2">Document title</p>
                                                <select class="block w-full btn-blue mt-2" name="title" required>
                                                    <option value="">--Select Title--</option>
                                                    <option value="Flow Chart">Flow Chart</option>
                                                    <option value="Procedure">Procedure</option>
                                                    <option value="Work Instruction">Work Instruction</option>
                                                    <option value="Company Record">Company Record</option>
                                                    <option value="Company Policy">Company Policy</option>
                                                    <option value="Reference Document">Reference Document</option>
                                                    <option value="Reference Document">Reference Document</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <p class="font-sans text-green-700 mb-2">Status in revision</p>
                                                <input type="number" name="revision_status" value="{{ old('revision_status') }}" class="btn-blue">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <p class="font-sans text-green-700 mb-2">Process Owner</p>
                                                <select class="block w-full btn-blue mt-2" name="person_incharge" required>
                                                    <option value="">--Select PIC--</option>
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
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans text-green-700 mb-2">Created By</p>
                                                <select class="block w-full btn-blue mt-2" name="document_creator" required>
                                                    <option value="">--Select Creator--</option>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->job_title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <p class="font-sans text-green-700 mb-2">Location of the document </p>
                                                <input type='text' name="location" class="btn-blue" value="{{ old('location') }}" />
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="form-group col-sm-12">
                                                <p class="font-sans text-green-700 mb-2">Comment if any </p>
                                                <textarea name="uploader_comment" rows="2" class="btn-blue">{{ old('uploader_comment') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="form-group col-sm-12">
                                                <input type="file" id="file" name="file">
                                            </div>
                                        </div>
                                        <div class="flex justify-end">
                                            <x-button class="">Save Data</x-button>
                                        </div>
                                    </form>
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
    @endsection
</x-app-layout>