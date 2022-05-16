@extends('admin.layout.master')
@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('admin.newArticleIndex')}}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Article name</label>
            <input style="background-color: black;color: white" type="text" class="form-control" id="name" name="name" aria-describedby="text">
        </div>
        <div class="mb-3">
            <label  for="category" class="form-label">Categories</label>
            <br>
            @foreach ($categories as $category )

                    <label style="font-weight: bold" class="checkbox">{{$category->category_name}}</label>
                        <input type="checkbox" name="categories[]"
                               id="{{ $category->name }}"
                               value="{{ $category->id }}"
                        >
                        <span>

            </span>
                    </label>

    <br>
            @endforeach
        </div>
      <div class="mb-3">
          <label for="name" class="form-label">Article</label>
           <textarea name="articlecontent"></textarea>
     </div>
        <div class="mb-3">
            <input type="file" name="image" placeholder="Choose image" id="image">
            @error('image')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
