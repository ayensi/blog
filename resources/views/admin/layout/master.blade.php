<!doctype html>
<html lang="en">
<head>
    <title>Okan Altun</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/mankfcrebs2rup5yvz2z5xb3vytyzn0r1ni3g805p7tx1s7h/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>

<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
            </button>
        </div>
        <div class="img bg-wrap text-center py-4" style="background-image: url({{asset('images/bg_1.jpg')}});">
            <div class="user-logo">
                <div class="img" style="background-image: url({{asset('images/logo.jpg')}});"></div>
                <h3>Okan Altun</h3>
            </div>
        </div>
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="{{route('admin.dashboard')}}"><span class="fa fa-home mr-3"></span> Home</a>
            </li>
            <li>
                <a href="{{route('admin.categories')}}"><span class="fa fa-bars mr-3"></span> Categories</a>
            </li>
            <li>
                <a href="{{route('admin.articles')}}"><span class="fa fa-newspaper-o mr-3"></span> Articles</a>
            </li>
            <li>
                <a href="{{route('admin.topComments')}}"><span class="fa fa-trophy mr-3"></span> Top Comments</a>
            </li>
            <li>
                <a href="{{route('admin.logout')}}"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
            </li>
        </ul>

    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        @yield('content')
    </div>
</div>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
</body>
</html>
