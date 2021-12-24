@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Add New Book</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Book </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-label-left input_mask" action="{{route('book.store')}}" method="post" id="bookAddForm">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 " for="title_id">Title <span class="required">*</span></label>
                                    <div class="col-md-8 col-sm-8">
                                        <select class="form-control  @error('title_id') is-invalid @enderror" name="title_id" id="title_id">
                                            <option value="">Choose Title</option>
                                            @foreach($titles as $title)
                                                <option value="{{$title->id}}"
                                                        @If(old('title_id') == $title->id) selected @endif>{{$title->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('title_id') <span
                                            class="text-danger float-right">{{$errors->first('title_id')}}</span>
                                        @enderror
                                    </div>

                                        <div class="col-md-2 col-sm-2 ">
                                            <div class="form-group row">
                                            <input type="text" id="suffix"  name="suffix" class="form-control" value="Part " required>
                                            </div>
                                        </div>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 " for="self_id">Self <span class="required">*</span></label>
                                    <div class="col-md-10 col-sm-10">
                                        <select class="form-control  @error('self_id') is-invalid @enderror" name="self_id" id="self_id">
                                            <option value="">Choose Book Self</option>
                                            @foreach($bookSelves as $self)
                                                <option value="{{$self->id}}"
                                                        @If(old('self_id') == $self->id) selected @endif>{{$self->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('self_id') <span
                                            class="text-danger float-right">{{$errors->first('self_id')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row has-feedback">
                                    <label class="col-form-label col-md-2 col-sm-2 ">Price <span class="required">*</span></label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input type="number" id="price"  name="price" class="form-control has-feedback-right @error('price') is-invalid @enderror" placeholder="Please Enter Price" value="{{old('price')}}">
                                        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                                        @error('price') <span
                                            class="text-danger float-right">{{$errors->first('price')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2 col-sm-2 ">Purchase Date <span class="required">*</span></label>
                                    <div class="col-md-10 col-sm-10 ">
                                        <input type="date" id="purchase_at"  name="purchase_at" class="form-control @error('purchase_at') is-invalid @enderror" placeholder="Please Enter Price" value="{{old('purchase_at')}}">
                                        @error('purchase_at') <span
                                            class="text-danger float-right">{{$errors->first('purchase_at')}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-form-label col-md-2 col-sm-2 ">Price <span class="required">*</span></label>--}}
{{--                                    <div class="col-md-10 col-sm-10 ">--}}
{{--                                        <input type="file" id="price"  name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Please Enter Card No">--}}
{{--                                        @error('price') <span--}}
{{--                                            class="text-danger float-right">{{$errors->first('price')}}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group row">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-primary">Cancel</button>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#addAuthor').click(function () {
                let authorField = `
                                <div class="col-sm-6 author-list">
                                <div class="form-group row">
                                <label class="control-label col-md-2 col-sm-2 " for="author_id">Author <span class="required">*</span> <i class="fa fa-minus-square text-danger" style="cursor: pointer" id="addAuthor"></i></label>
                                <div class="col-md-10 col-sm-10">
                                <select class="form-control  @error('author_id') is-invalid @enderror" name="author_id[]" id="author_id">
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
                                </div>
        `
                $('.author-list').last().after(authorField);

                $('#bookAddForm').on('click','.fa-minus-square',function () {
                    $(this).closest('.author-list').remove()
                })
            })
        })
    </script>
@endpush
