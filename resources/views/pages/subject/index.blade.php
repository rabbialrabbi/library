@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>All Subject List</h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All Subject List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="subjectTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>
                                                <i class="action-icon fa fa-edit text-success" onclick="editModal({{$subject->id}})"></i>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editSubject" tabindex="-1" role="dialog" aria-labelledby="editSubjectTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Subject </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="#">Settings</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form data-parsley-validate class="form-horizontal form-label-left" method="post" id="editSubjectForm">
                            @csrf
                            @method('patch')
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Subject Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="name" required="required" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item">
                                <div class="col-md-6 col-sm-6 offset-md-3 text-right">
                                    <button class="btn btn-primary text-white" data-dismiss="modal" aria-label="Close">Cancel</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let subjects = @json($subjects);

        $(document).ready(function () {
            $('#subjectTable').DataTable({
                "responsive": true,
                "autoWidth": false
            })
        })

        function editModal(id) {
            let subject = subjects.find(function (subject) {
                return subject.id == id
            })
            let baseUrl = $('meta[name="app-url"]').attr('content');
            $('#editSubjectForm').attr('action', baseUrl + '/subject/' + subject.id)
            $('#name').val(subject.name)
            $('#editSubject').modal('show')
        }
    </script>
@endpush
