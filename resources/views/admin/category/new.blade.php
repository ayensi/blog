@extends('admin.layout.master')
@section('content')
    <form method="post" action="{{route('admin.newCategoryIndex')}}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category name</label>
            <input style="background-color: black;color: white" type="text" class="form-control" id="name" name="name" aria-describedby="text">
        </div>
        <div class="mb-3">
            <label for="isSubCategory" class="form-label">Is it a sub category?</label>
            <input style="background-color: black;color: white;text-align: left" type="checkbox" class="form-control" id="isSubCategory" name="isSubCategory">
        </div>
        <div class="mb-3">
            <label style="display: none" id="parentCategoryLabel" for="parentCategory" class="form-label">Choose parent category</label>
            <select style="display: none" id="parentCategory" name="parentCategory" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->category_name }} </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    <script>
        $(document).ready(function(){
            $('#isSubCategory').on('change', function(){
                if($(this).is(":checked")){
                    $('#parentCategoryLabel').show();
                    $('#parentCategory').show();
                    $("#parentCategory").attr('required', '');
                }
                else{
                    $('#parentCategoryLabel').hide();
                    $('#parentCategory').hide();
                    $("#parentCategory").removeAttr('required', '');
                }
            });
        });
    </script>
@endsection
