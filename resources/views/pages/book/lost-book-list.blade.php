@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>All Book List</h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All Book List</h2>
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

                                <table id="bookTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Book No</th>
                                        <th>Name</th>
                                        <th>Part</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($lostBooks as $book)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$book->book_no}}</td>
                                            <td>{{$book->title}}</td>
                                            <td>{{$book->part}}</td>
                                            <td>{{$book->bookSelf->title}} - {{$book->taak}}</td>
                                            <td>
                                                <button class="btn btn-danger" disabled>Lost</button>
                                            </td>
                                            <td>
                                                <a href="{{route('lost.retrieve',['book'=>$book->id])}}" class="mr-2"><i class="action-icon fa fa-mail-forward text-danger"></i></a>
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
    @endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#bookTable').DataTable({
                "responsive": true,
                "autoWidth": false
            })

        })
    </script>
@endpush
