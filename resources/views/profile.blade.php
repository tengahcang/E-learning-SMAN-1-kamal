@extends('layouts.app')

@section('content')

    <body>
        <div class="bg-white p-4 rounded-3 shadow-sm mt-3">
            <h6>Ganti Password</h6>
            <div class="mt-4">
                <div class="profile-container">
                    <form class="profile-form">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Konfirmasi Ulang Password</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        placeholder="Konfirmasi Password">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection
