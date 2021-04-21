@extends('layouts.app')
@section('content')
<div class="container">
    <div class="dashboard-content">
        <div class="row">
            <h2>Edit Products</h2>
        </div>
        <form class="bg-white p-3" action="{{ url('edit-post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(session('success'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{session('success')}}</strong>
            </div>
            @endif
            <input type="hidden" name="id" value="{{ $post->id }}">
            <div class="form-group">
                <label for="">Post title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Post sub title</label>
                <input type="text" name="sub_title" value="{{ $post->sub_title }}" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter Sub title">
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
                <textarea class="form-control @error('post_details') is-invalid @enderror" name="post_details" rows="6" placeholder="Write something about post.">{{ $post->post_details }}</textarea>
                @error('post_details')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-check">
                <input name="check_box" type="checkbox" class="form-check-input @error('check_box') is-invalid @enderror" id="exampleCheck1" checked>
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
    </div>
</div>
@endsection