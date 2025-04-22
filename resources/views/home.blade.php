@extends('layout.layout')

@section('title', 'Home')

@section('content')
<div class="container">
    <h1>Recent Posts</h1>

    @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Add New Post</a>
    @endauth

    <div class="d-flex justify-content-end mb-3">
    <form method="GET" action="{{ route('home') }}">
        <select name="sort" onchange="this.form.submit()" class="form-select w-auto">
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest First</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest First</option>
        </select>
    </form>
</div>

    @foreach ($posts as $post)
    <div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->description }}</p>
        <small class="text-muted">
            Posted on {{ $post->created_at->format('d M Y - H:i') }}
            @if($post->user_id == auth()->id())
                (You)
            @endif
        </small>
    </div>
</div>
    @endforeach
</div>
@endsection
