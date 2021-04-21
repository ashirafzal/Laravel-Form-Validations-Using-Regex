@extends('layouts.app')
@section('content')
<div class="container">
    <div class="dashboard-content">
        <div class="row">
            <h2>Create Products</h2>
        </div>
        <form class="bg-white p-3" method="POST" action="create-post" enctype="multipart/form-data">
            @csrf
            @if(session('success'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{session('success')}}</strong>
            </div>
            @endif
            <div class="form-group">
                <label for="">Post title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Post sub title</label>
                <input type="text" name="sub_title" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter Sub title">
                @error('sub_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Post Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Post Details</label>
                <textarea class="form-control @error('post_details') is-invalid @enderror" name="post_details" rows="6" placeholder="Write something about post."></textarea>
                @error('post_details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-check">
                <input name="check_box" type="checkbox" class="form-check-input @error('check_box') is-invalid @enderror" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check this to submit post</label>
                @error('check_box')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit Post</button>
        </form>
        <br><br>
        <div class="row">
            <table class="table table-striped border bg-light">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Sub Title</th>
                        <th scope="col">Post Details</th>
                    </tr>
                </thead>
                <tbody>
                    @php($posts = Helper::posts())
                    @foreach($posts as $posts)
                    <tr>
                        <th scope="row">{{ $posts->id }}</th>
                        <td>{{ $posts->title }}</td>
                        <td>{{ $posts->sub_title }}</td>
                        <td>{{ $posts->post_details }}</td>
                        <td><a class="btn btn-primary" href="post/{{ $posts->id }}">Edit</a></td>
                        <td><a class="btn btn-danger" href="destroy/{{ $posts->id }}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection