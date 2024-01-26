@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="card-body" style="min-height: 80vh;">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="card">
                                    <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 text-white">Change Password</h5>
                                    </div>
                                    <form action="{{ route('change.password.store') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group my-3">
                                                <label for="old_password">Old Password <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="old_password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    placeholder="Enter Old Password">
                                                @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group my-3">
                                                <label for="password">New Password <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Enter New Password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group my-3">
                                                <label for="password_confirmation">Confirm Password <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    placeholder="Enter Confirm Password">
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group my-3">
                                                <input type="submit" class="form-control btn btn-primary"
                                                    placeholder="Change">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
