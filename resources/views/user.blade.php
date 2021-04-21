@extends('layouts.app')
@section('content')
<div class="container">
    <div class="dashboard-content">
        <div class="row">
            <h2>Create User</h2>
        </div>
        <form class="bg-white p-3" method="POST" action="create-user">
            @csrf
            @if(session('success'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{session('success')}}</strong>
            </div>
            @endif
            <div class="form-group">
                <label for="">User Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter username">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Number</label>
                <input type="number" name="number" class="form-control @error('number') is-invalid @enderror" placeholder="Enter number">
                @error('number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">You can choose the password option below. Which characters your password should include.</label>
            </div>
            <div class="form-check">
                <input name="a_z" type="checkbox" class="form-check-input @error('a_z') is-invalid @enderror" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">A-Z</label>
                @error('a_z')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-check">
                <input name="numeric" type="checkbox" class="form-check-input @error('numeric') is-invalid @enderror" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">0-9</label>
                @error('numeric')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-check">
                <input name="alpha_numeric" type="checkbox" class="form-check-input @error('alpha_numeric') is-invalid @enderror" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">@!*$</label>
                @error('alpha_numeric')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-check">
                <input name="active" type="checkbox" class="form-check-input @error('active') is-invalid @enderror" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">User active</label>
                @error('active')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create user</button>
        </form>
        <br><br>
        <div class="row">
            <table class="table table-striped border bg-light">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Number</th>
                    </tr>
                </thead>
                <tbody>
                    @php($DemoUser = Helper::DemoUser())
                    @foreach($DemoUser as $DemoUser)
                    <tr>
                        <th scope="row">{{ $DemoUser->id }}</th>
                        <td>{{ $DemoUser->name }}</td>
                        <td>{{ $DemoUser->email }}</td>
                        <td>{{ $DemoUser->number }}</td>
                        <td><a class="btn btn-primary" href="user/{{ $DemoUser->id }}">Edit</a></td>
                        <td><a class="btn btn-warning" href="#">Share</a></td>
                        <td><a class="btn btn-danger" href="Userdestroy/{{ $DemoUser->id }}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection