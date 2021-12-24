@extends('layouts.app')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>All Member List</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All Member List</h2>
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

                                <table id="memberTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">S/N</th>
                                        <th style="width: 15%">Member Type</th>
                                        <th style="width: 20%">Name</th>
                                        <th style="width: 30%">Card No.</th>
                                        <th style="width: 20%">Jamaat</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            @if($member->member_type == 1)
                                                <td>Student</td>
                                            @else
                                                <td>Teacher</td>
                                            @endif
                                            <td>{{$member->first_name}}</td>
                                            <td>{{$member->card_id}}</td>
                                            <td>{{$member->jamaat->name}}</td>
                                            <td>
                                                <i class="action-icon fa fa-edit text-success" onclick="editMember({{$member->id}})"></i>
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
    <div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="editMemberTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Member </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                </div>
                            </li>
                            <li><a class="" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-label-left input_mask" action="" method="post" id="editMemberForm">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row has-feedback">
                                        <label class="col-form-label col-md-2 col-sm-2 ">First Name <span class="required">*</span></label>
                                        <div class="col-md-10 col-sm-10 ">
                                            <input type="text" id="first_name"  name="first_name" class="form-control has-feedback-right @error('first_name') is-invalid @enderror" placeholder="Please Enter First Name">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                            @error('first_name') <span
                                                class="text-danger float-right">{{$errors->first('first_name')}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row has-feedback">
                                        <label class="col-form-label col-md-2 col-sm-2 ">Last Name</label>
                                        <div class="col-md-10 col-sm-10 ">
                                            <input type="text" id="last_name"  name="last_name" class="form-control has-feedback-right @error('last_name') is-invalid @enderror" placeholder="Please Enter Last Name">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                            @error('last_name') <span
                                                class="text-danger float-right">{{$errors->first('last_name')}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row has-feedback">
                                        <label class="col-form-label col-md-2 col-sm-2 ">Card No <span class="required">*</span></label>
                                        <div class="col-md-10 col-sm-10 ">
                                            <input type="text" id="card_id"  name="card_id" class="form-control has-feedback-right @error('card_id') is-invalid @enderror" placeholder="Please Enter Card No">
                                            <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                                            @error('card_id') <span
                                                class="text-danger float-right">{{$errors->first('card_id')}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 " for="jamaat_id">Jamaat <span class="required">*</span></label>
                                        <div class="col-md-10 col-sm-10">
                                            <select class="form-control  @error('jamaat_id') is-invalid @enderror" name="jamaat_id" id="jamaat_id">
                                                <option value="">Choose option</option>
                                                @foreach($jamaats as $jamaat)
                                                    <option value="{{$jamaat->id}}"  @If(old('jamaat_id') == $jamaat->id) selected @endif>{{$jamaat->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('jamaat_id') <span
                                                class="text-danger float-right">{{$errors->first('jamaat_id')}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="control-label col-md-2 col-sm-2 " for="member_type">Member Type <span class="required">*</span></label>
                                        <div class="col-md-10 col-sm-10">
                                            <select class="form-control  @error('member_type') is-invalid @enderror" name="member_type" id="member_type">
                                                <option value="">Choose option</option>
                                                <option value="1">Student</option>
                                                <option value="2">Teacher</option>
                                            </select>
                                            @error('member_type') <span
                                                class="text-danger float-right">{{$errors->first('member_type')}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="gender"  name="gender" value="1">
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-12 text-right">
                                    <a class="btn btn-primary text-white" data-dismiss="modal" aria-label="Close">Cancel</a>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
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
        let members = @json($members);

        $(document).ready(function () {
            $('#memberTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {"orderable": false, "targets": [5]}
                ],
            })
        })

        function editMember(id) {
            let member = members.find(function (jamaat) {
                return jamaat.id == id
            })
            let baseUrl = $('meta[name="app-url"]').attr('content');
            $('#editMemberForm').attr('action', baseUrl + '/member/' + member.id)
            $('#first_name').val(member.first_name)
            $('#last_name').val(member.last_name)
            $('#card_id').val(member.card_id)
            $('#jamaat_id').val(member.jamaat_id)
            $('#member_type').val(member.member_type)
            $('#editMemberModal').modal('show')
        }
    </script>
@endpush
