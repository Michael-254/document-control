<x-app-layout>

    <div class="content">
        <div class="container">
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="font-bold text-green-500 card-title">HOD Review</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="content animate__animated animate__zoomIn">
                                <div class="bg-indigo-50 shadow-2xl rounded-3xl px-4 py-4">
                                    <table id="example2" class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr class="text-green-700 font-bold">
                                                <td>Date Created</td>
                                                <td>Type</td>
                                                <td>Document No</td>
                                                <td>Creator</td>
                                                <td>Process Owner</td>
                                                <td>Status</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($documents as $doc)
                                            <tr>
                                                <td>{{$doc->date_created}}</td>
                                                <td>{{$doc->title}}</td>
                                                <td>{{$doc->document_no}}</td>
                                                <td>{{$doc->creator->job_title}}</td>
                                                <td>{{$doc->personIncharge->job_title}}</td>
                                                <td>{{$doc->status}}</td>
                                                <td>
                                                    <a href="{{route('hod.review',$doc)}}">
                                                        <i class="fas fa-eye text-blue-600 hover:text-blue-800 cursor-pointer"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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