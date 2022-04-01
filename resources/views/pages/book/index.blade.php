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
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$book->book_no}}</td>
                                            <td>{{$book->title}}</td>
                                            <td>{{$book->part}}</td>
                                            <td>{{$book->bookSelf->title}} - {{$book->taak}}</td>
                                            <td>
                                                @if($book->borrow_status)
                                                    <button class="btn btn-danger" disabled>Reserved</button>
                                                @else
                                                    <button class="btn btn-success" disabled>Available</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$book->borrow_status)
                                                    <a href="javascript:void(0)" class="mr-2" onclick="showBorrowModal({{$book->id}})"><i class="action-icon fa fa-book text-success"></i></a>

                                                @else
                                                    <a href="{{route('book.return',['book'=>$book->id])}}" class="mr-2"><i class="action-icon fa fa-mail-forward text-danger"></i></a>
                                                @endif
                                                <a href="{{route('book.show',['book'=>$book->id])}}" class="mr-2" ><i class="action-icon fa fa-file-text text-success"></i></a>
{{--                                                    <i class="fas fa-expand-alt"></i>--}}
                                                <a href="javascript:void(0)" class="mr-2" onclick="editModal({{$book->id}})" ><i class="action-icon fa fa-edit text-success"></i></a>
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

    <!-- Edit Book Modal -->
    <div class="modal fade" id="editBook" role="dialog" aria-labelledby="editBookTitle" aria-hidden="true">
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
                        <form data-parsley-validate class="form-horizontal form-label-left" method="post" id="editBookForm" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="title">Book Title <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 ">
                                    <input type="text" id="title" required="required" class="form-control" name="title">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="book_no">Book No <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 ">
                                    <input type="text" id="book_no" required="required" class="form-control" name="book_no">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="part">Book Part <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 ">
                                    <input type="text" id="part" required="required" class="form-control" name="part">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="language_id">Book Language <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 ">
                                    <select name="language_id" id="language_id" class="form-control" required>
                                        <option value="">Select Language</option>
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{$language->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="jamaat_id">Book Jamaat <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 ">
                                    <select name="jamaat_id" id="jamaat_id" class="form-control" required>
                                        <option value="">Select Jamaat</option>
                                        @foreach($jamaats as $jamaat)
                                            <option value="{{$jamaat->id}}">{{$jamaat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="name">Book Self <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 ">
                                    <select name="jamaat_id" id="jamaat_id" class="form-control" required>
                                        <option value="">Select Jamaat</option>
                                        @foreach($bookSelves as $self)
                                            <option value="{{$self->id}}">{{$self->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="name">Book Taak <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 ">
                                    <select name="taak" id="taak" class="form-control" required>
                                        <option value="">Select Taak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="name">Book Image <span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-7 ">
                                    <input type="file" id="image" name="image"
                                           class="form-control @error('image') is-invalid @enderror"
                                           placeholder="Please Enter Card No">
                                </div>
                            </div>
                            <div class="author-list">

                            </div>
                            <div class="item form-group author-list">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="author_id">Author <span class="required">*</span> <i class="fa fa-plus-square text-success" style="cursor: pointer" id="addAuthor"></i></label>
                                <div class="col-md-7 col-sm-7 ">
                                    <select class="form-control  @error('author_id') is-invalid @enderror select2" name="author_id[]" id="author_id" style="width: 100%">
                                        <option value="">Choose Author</option>
                                        @foreach($authors as $author)
                                            <option value="{{$author->id}}"
                                                    @If(old('author_id') == $author->id) selected @endif>{{$author->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('author_id') <span
                                        class="text-danger float-right">{{$errors->first('author_id')}}</span>
                                    @enderror
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

    <!-- Book Borrow Modal -->
    <div class="modal fade" id="borrowBookModal" role="dialog" aria-labelledby="borrowBookTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Assign Book </h2>
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
                        <ul class="list-unstyled msg_list">
                            <li>
                                <a>
                                    <span class="image">
                                        <img src="{{asset('/asset/images/BOOKS.jpg')}}" alt="Book" id="assignBookImage"/>
                                    </span>
                                    <span>
                                        <span id="assignBookTitle">John Smith</span>
                                        <span class="time" id="assignBookPart">2 Part</span>
                                    </span>
                                    <span class="message">
                                        Book No <span id="assignBookNo">1</span>. The Book is written by <span id="assignBookWriter">Ashraf Ali Thanovi</span> in <span id="assignBookLanguage">Urdu</span> language. You will find the book at self <span id="assignBookSelf">Self 1</span> Taak <span id="assignBookTaak">A</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <form data-parsley-validate class="form-horizontal form-label-left" method="post"
                              id="editBookForm" action="{{route('book.assign')}}" method="post">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Borrowed by: <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="hidden" name="book_id" value="" id="book_id">
                                    <select class="form-control  @error('member_id') is-invalid @enderror select2" name="member_id" id="member_id" style="width: 100%">
                                        <option value="">Select Member</option>
                                        @foreach($members as $member)
                                            <option value="{{$member->id}}"
                                                    @If(old('member_id') == $member->id) selected @endif>{{$member->first_name}} {{$member->last_name}} ( {{$member->card_id}})</option>
                                        @endforeach
                                    </select>
                                    @error('member_id') <span
                                        class="text-danger float-right">{{$errors->first('member_id')}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item">
                                <div class="col-md-6 col-sm-6 offset-md-3 text-right">
                                    <button class="btn btn-primary text-white" data-dismiss="modal" aria-label="Close">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-success">Assigned</button>
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
        let books = @json($books);
        $(document).ready(function () {
            $('#bookTable').DataTable({
                "responsive": true,
                "autoWidth": false
            })

            $('#addAuthor').click(function () {
                let authorField = `
                            <div class="item form-group author-list">
                                <label class="col-form-label col-md-4 col-sm-4 label-align" for="author_id">Author <span class="required">*</span> <i class="fa fa-minus-square text-danger" style="cursor: pointer" id="addAuthor"></i></label>
                                <div class="col-md-7 col-sm-7 ">
                                    <select class="form-control  @error('author_id') is-invalid @enderror select2" name="author_id[]" id="author_id">
                                        <option value="">Choose Author</option>
                                        @foreach($authors as $author)
                <option value="{{$author->id}}"
                                                    @If(old('author_id') == $author->id) selected @endif>{{$author->name}}</option>
                                        @endforeach
                </select>
@error('author_id') <span
                                        class="text-danger float-right">{{$errors->first('author_id')}}</span>
                                    @enderror
                </div>
            </div>
`
                $('.author-list').last().after(authorField);

                $('#editBook').on('click','.fa-minus-square',function () {
                    $(this).closest('.author-list').remove()
                })
            })

        })

        function editModal(id) {
            let book = books.find(function (book) {
                return book.id == id
            })
            let baseUrl = $('meta[name="app-url"]').attr('content');
            $('#editBookForm').attr('action', baseUrl + '/book/' + book.id)
            $('#name').val(book.name)
            $('#editBook').modal('show')
        }

        function showBorrowModal(id) {
            $('#book_id').val(id)
            $('#borrowBookModal').modal('show')
        }
    </script>
@endpush
