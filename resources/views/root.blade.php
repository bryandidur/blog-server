<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início | Blog</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <style>
        .valign-top { vertical-align: top; }
        .valign-bottom { vertical-align: bottom; }
        .nofollow { cursor: pointer; }
        .side-nav .collapsible-header { padding: 0 32px; }
        .side-nav .collapsible-header i.material-icons { margin: 0; }
        .sidebar .collection-header i.material-icons {  margin-right: 10px; }
        .card-content p.description { margin-bottom: 25px; }
        .card-content p.content { margin-bottom: 25px; }
        .pagination { margin: 50px 0; }
        .footer { padding: 20px; }
        .footer p { margin: 0; }
        .tag-page .header { margin: 50px 0; }
        .category-page .header { margin: 50px 0; }
        .article-page .header { margin: 25px !important; }
        .article-page .card-title { text-align: center; margin: 26px 0 50px 0 !important; }
        .article-page .card-title a,
        .article-page .card-title .date { font-size: 0.9rem }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        <div class="row">
            @yield('content')

            @include('partials.sidebar')
        </div><!-- / .row -->
    </div><!-- / .container -->

    @include('partials.footer')

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script>
        $(function () {
            // Mobile menu init
            $('.button-collapse').sideNav();

            // Dropdown's init
            $('.dropdown-button').dropdown({
                constrainWidth: false,
                belowOrigin: true
            });
        });
    </script>
</body>
</html>
