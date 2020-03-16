@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        Profile
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for=""><b style="font-size: 120%">User Information</b></label>
                                </div>
                                <div>
                                    <div>
                                        <label for=""><b>Name:</b></label>
                                        <span>{{$userProfile->full_name}}</span>
                                    </div>
                                    <div>
                                        <label for=""><b>Phone:</b></label>
                                        <span>{{$userProfile->phone_number}}</span>
                                    </div>
                                    <div>
                                        <label for=""><b>Address:</b></label>
                                        <span>{{$userProfile->address}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-2">
                                    <label for=""> <b style="font-size: 120%">Account information:</b></label>
                                </div>
                                <div>
                                    <div>
                                        <label for=""><b>Username:</b></label>
                                        <span>{{$userProfile->username}}</span>
                                    </div>
                                    <div>
                                        <label for=""><b>Email:</b></label>
                                        <span>{{$userProfile->email}}</span>
                                    </div>
                                    <div>
                                        <label for=""><b>Role:</b></label>
                                        <span>{{\App\Helpers\GlobalHelper::checkAdminRole() ? 'Admin' : ''}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer row">
                        <div class="col-md-6 mb-2">
                            <a class="btn btn-info col-md-12" href="{{route('user.edit-form', $userProfile->id)}}">Edit information</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-info col-md-12" href="{{route('admin.profile.change-password-form', ['id' => $userProfile->id])}}">Change password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
