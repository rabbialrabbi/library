@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Book Self List</h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Book Self List</h2>
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

                                <table id="bookSelfTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>Capacity</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($bookSelves as $bookSelf)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$bookSelf->title}}</td>
                                            <td>{{$bookSelf->location}}</td>
                                            <td>{{$bookSelf->part}}</td>
                                            <td>
                                                <i class="action-icon fa fa-edit text-success" onclick="editModal({{$bookSelf->id}})"></i>
                                                {{--                                                <button class="btn btn-success" data-toggle="modal" data-target="#editJamaat" >Edit</button>--}}
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
    <div class="modal fade" id="editBookSelf" tabindex="-1" role="dialog" aria-labelledby="editBookSelfTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Book Self </h2>
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
                        <form data-parsley-validate class="form-horizontal form-label-left" method="post" id="editBookSelfForm">
                            @csrf
                            @method('patch')
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align text-left" for="title">Book Self Title <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" id="title" required="required" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align text-left" for="location">Book Self Location
                                </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <textarea type="text" id="location" class="form-control" name="location"></textarea>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align text-left" for="part">Part
                                </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="number" id="part" class="form-control" name="part">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align text-left" for="part">
                                </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <div class="row" id="partDetails">
                                    </div>
                                </div>

                            </div>
                            <div class="ln_solid"></div>
                            <div class="item">
                                <div class="col-md-6 col-sm-6 offset-md-3 text-right">
                                    <button class="btn btn-primary" type="reset">Reset</button>
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
        let bookSelves = @json($bookSelves);
        $(document).ready(function () {
            $('#bookSelfTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {"orderable": false, "targets": [4]}
                    ]
            })
            $('#part').keyup(function () {
                updateSelfDetails()
            })
            $('#part').change(function () {
                updateSelfDetails()
            })
        })

        function editModal(id) {
            let bookSelf = bookSelves.find(function (bookSelf) {
                return bookSelf.id == id
            })
            let baseUrl = $('meta[name="app-url"]').attr('content');
            $('#editBookSelfForm').attr('action', baseUrl + '/book-self/' + bookSelf.id)
            $('#title').val(bookSelf.title)
            $('#location').val(bookSelf.location)
            $('#part').val(bookSelf.part)

            let html = getPartDetailsHtml(bookSelf.part_details)
            $('#partDetails').html(html)
            $('#editBookSelf').modal('show')
            console.log(bookSelf)
        }

        function getPartDetailsHtml(part_details) {
            let html = ``
            let partDetails = part_details.length

            let selfPart = parseInt(partDetails > 0 ? partDetails : 1)
            for (let i = 1; i <= selfPart; i++) {
                html += `
                <div class="col-sm-3 mb-3">
                    <input type="text" id="part" class="form-control" name="part_details[]" value="${part_details[i-1]}" required>
                </div>
                `
            }
            html += `</div>`

            return html
        }
        function updateSelfDetails() {
            let letter = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z']


            let selfPart = parseInt($('#part').val() > 0 ? $('#part').val() : 1)
            let bal = letter.slice(0, selfPart);
            let html = getPartDetailsHtml(bal)

            $('#partDetails').html(html)
        }
    </script>
@endpush
