@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>All Jamaat List</h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All Jamaat List</h2>
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

                                <table id="jamaatTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($jamaats as $jamaat)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$jamaat->name}}</td>
                                            <td>
                                                <i class="action-icon fa fa-edit text-success" onclick="editModal({{$jamaat->id}})"></i>
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
    <div class="modal fade" id="editJamaat" tabindex="-1" role="dialog" aria-labelledby="editJamaatTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Jamaat </h2>
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
                        <form data-parsley-validate class="form-horizontal form-label-left" method="post" id="editJamaatForm">
                            @csrf
                            @method('patch')
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Jamaat Name <span class="required">*</span>
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
        let jamaats = @json($jamaats);
        $(document).ready(function () {
            $('#jamaatTable').DataTable({
                "responsive": true,
                "autoWidth": false
            })
        })

        function editModal(id) {
            let jamaat = jamaats.find(function (jamaat) {
                return jamaat.id == id
            })
            let baseUrl = $('meta[name="app-url"]').attr('content');
            $('#editJamaatForm').attr('action', baseUrl + '/jamaat/' + jamaat.id)
            $('#name').val(jamaat.name)
            $('#editJamaat').modal('show')
        }
    </script>
@endpush
