@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Add New Self</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add New Self </h2>
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
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('book-self.store')}}" method="post">
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Self Title<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" title="title" name="title">
                                @error('title') <span
                                    class="text-danger float-right">{{$errors->first('title')}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Self Location
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea type="text" id="location" class="form-control @error('location') is-invalid @enderror" name="location"></textarea>
                                @error('location') <span
                                    class="text-danger float-right">{{$errors->first('location')}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="capacity">Part
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="number" id="part" class="form-control @error('capacity') is-invalid @enderror" name="part" value="5" required>
                                @error('capacity') <span
                                    class="text-danger float-right">{{$errors->first('capacity')}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="capacity">
                            </label>
                            <div class="col-sm-6 col-md-6">
                                <div class="row" id="partName">

                                </div>

                            </div>


                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3 text-right">
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Add</button>
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
            updateSelfDetails()
            $('#part').keyup(function () {
                updateSelfDetails()
            })
            $('#part').change(function () {
                updateSelfDetails()
            })
        })
        function updateSelfDetails() {
            let letterSetA = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z']


            let html = ``

            let selfPart = parseInt($('#part').val() > 0 ? $('#part').val() : 1)
            for (let i = 1; i <= selfPart; i++) {
                html += `
                <div class="col-2 mb-3">
                                        <input type="text" id="capacity" class="form-control" name="part_details[]" value="${letterSetA[i-1]?letterSetA[i-1]:''}" required>

                </div>
                `
            }
            html += `</div>`

            $('#partName').html(html)
        }
    </script>
@endpush
