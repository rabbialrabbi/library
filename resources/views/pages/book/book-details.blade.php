@extends('layouts.app')

@push('style')
    <style>
        #assignBookTitle{
            color: green;
        }
    </style>
@endpush
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Book Details</h3>
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
                    <div class="row justify-content-center">
                        <div class="col-3 text-center">
                            <img src="{{asset('/asset/images/BOOKS.jpg')}}" alt="Book" id="assignBookImage" height="260"/>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-6"><h2>{{$book->title}}</h2></div>
                                <div class="col-4"><h2>Book No : {{$book->book_no}}</h2></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    Written By :
                                    @foreach($book->author as $author)
                                        <span class="d-block">{{$author->name}}</span>
                                    @endforeach
                                </div>
                                <div class="col-3">Language : {{$book->language->name}}</div>
                                <div class="col-3">Location :
                                    <span class="d-block">{{$book->bookSelf->title}}, Taak - {{$book->taak}}</span>
                                    <span class="d-block">{{$book->bookSelf->location}}</span>
                                </div>
                                <div class="col-3">Add at : {{$book->created_at ? $book->created_at->format('d-m-Y') : ''}}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3">
                                    @if($book->borrow_status)
                                        <span class="d-block">Status : <span class="badge badge-danger">Reserved</span></span>
                                        <span class="d-block">Borrowed By {{$book->current_borrower->first_name}} {{$book->current_borrower->last_name}}</span>
                                    @else
                                        <span class="d-block">Status : <span class="badge badge-success">Available</span></span>
                                    @endif

                                </div>
                                <div class="col-3">Part : {{$book->part}}</div>
                                <div class="col-3">Jamaat : {{$book->jamaat->name}}</div>
                                <div class="col-3"><a href="{{route('lost.store',['book'=>$book->id])}}" class="btn btn-danger btn-lg text-white" style="width: 80%">Lost</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="card-box table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Borrow At</th>
                                        <th>Return At</th>
                                        <th>Name</th>
                                        <th>Jamaat</th>
                                        <th>Member Type</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($book->member as $member)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$member->pivot->borrow_at}}</td>
                                            <td>{{$member->pivot->return_at}}</td>
                                            <td>{{$member->first_name .' '. $member->last_name}}</td>
                                            <td>{{$member->jamaat->name}}</td>
                                            @if($member->member_type == 1)
                                                <td>Student</td>
                                            @else
                                                <td>Teacher</td>
                                            @endif
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
    <div class="modal fade" id="editBook" tabindex="-1" role="dialog" aria-labelledby="editBookTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Book </h2>
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
                        <form data-parsley-validate class="form-horizontal form-label-left" method="post" id="editBookForm">
                            @csrf
                            @method('patch')
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Book Name <span class="required">*</span>
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
        {{--let books = @json($books);--}}
        $(document).ready(function () {
            $('#bookTable').DataTable({
                "responsive": true,
                "autoWidth": false
            })
        })

        {{--function editModal(id) {--}}
        {{--    let book = books.find(function (book) {--}}
        {{--        return book.id == id--}}
        {{--    })--}}
        {{--    let baseUrl = $('meta[name="app-url"]').attr('content');--}}
        {{--    $('#editBookForm').attr('action', baseUrl + '/book/' + book.id)--}}
        {{--    $('#name').val(book.name)--}}
        {{--    $('#editBook').modal('show')--}}
        {{--}--}}
    </script>
@endpush
