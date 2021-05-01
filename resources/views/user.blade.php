@extends('layouts.app')
@section('content')
<style>
    ul,
    #myUL {
        list-style-type: none;
    }

    #myUL {
        margin: 0;
        padding: 0;
    }

    .caret {
        cursor: pointer;
        -webkit-user-select: none;
        /* Safari 3.1+ */
        -moz-user-select: none;
        /* Firefox 2+ */
        -ms-user-select: none;
        /* IE 10+ */
        user-select: none;
    }

    .caret::before {
        content: "\25B6";
        color: black;
        display: inline-block;
        margin-right: 6px;
    }

    .caret-down::before {
        -ms-transform: rotate(90deg);
        /* IE 9 */
        -webkit-transform: rotate(90deg);
        /* Safari */

        transform: rotate(90deg);
    }

    .nested {
        display: none;
    }

    .active {
        display: block;
    }
</style>
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
        <br>
        <div class="row">
            <h2>
                Posts and subpost related to the current user
            </h2>
        </div>
        <br>
        <div class="row border p-3">
            <ul id="myUL">
                @php($UserPost = Helper::getUserPosts())
                @foreach($UserPost as $UserPosts)
                @foreach($UserPosts->posts as $posts)
                <li><span class="caret"><a href="#">{{$posts->title}}</a></span>
                    <ul class="nested">
                        @foreach($posts->subposts as $subposts)
                        <li><span class="caret"><a href="#">{{ $subposts->title }}</a></span></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
                @endforeach
            </ul>
        </div>
        <br>
        <div class="row">
            <h2>
                Sub post its parent post and its user
            </h2>
        </div>
        <br>
        <div class="row border p-3">
            <ul id="myUL">
                @php($subpost = Helper::getSubPostDetails())
                @foreach($subpost as $subposts)
                <li><span class="caret">{{ $subposts->title }}</span>
                    @foreach($subposts->posts as $post)
                    <ul class="nested">
                        <li><span class="caret">{{ $posts->title }}</span>
                            <ul class="nested">
                                <li>{{ $posts->user->name }}</li>
                            </ul>
                        </li>
                    </ul>
                    @endforeach
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }
</script>
@endsection