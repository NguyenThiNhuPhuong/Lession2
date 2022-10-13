<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?=$data['user']['role']?></title>
</head>
<body>
<div class="container">

    <nav class="navbar navbar-expand-lg navbar-light">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link btn btn-primary" href="">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/Lession2/Home/logout">Log out</a>
                </li>
            </ul>


        </div>
        <a class="navbar-brand" href="#">
            <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBeWtwREE9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--6a961a174c57d5a6a4debb065f73f12095e9485b/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJYW5CbkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--091b576187e678c126e08874e5757891d97541a7/lampart-logo.jpg"
                 width="80" height="80" alt="logo">
        </a>
    </nav>
    <div class="row justify-content-center" style="margin-top: 80px">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fullname</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Operations</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($data['user']['role']=='Admin') {
                foreach ($data['list'] as $item)
                    echo
                        '<tr>

                <th scope="row">' . $item['id'] . '</th>
                <td>' . $item['fullname'] . '</td>
                <td>' . $item['email'] . '</td>
                <td>' . $item['role'] . '</td>
                <td>
                   <a><i class="fa fa-pencil-square-o"></i></a>
                   <a> <i class="fa fa-minus-circle"></i></a>
                   <a> <i class="fa fa-file"></i></a>
                   <a href="/Lession2/Home/detail/'. $item['id'].'"><i class="fa fa-eye"></i></a>
                </td>
            </tr>';
            }else{
                    echo
                        '<tr>

                <th scope="row">' . $data['user']['id'] . '</th>
                <td>' . $data['user']['fullname'] . '</td>
                <td>' . $data['user']['email'] . '</td>
                <td>' . $data['user']['role'] . '</td>
                <td>
                   <a><i class="fa fa-pencil-square-o"></i></a>
                   <a> <i class="fa fa-minus-circle"></i></a>
                   <a> <i class="fa fa-file"></i></a>
                   <a href="/Lession2/Home/detail/'. $data['user']['id'].'"><i class="fa fa-eye"></i></a>
                </td>
            </tr>';
            }
            ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
    <footer style="margin-top: 50px">
        <p class="">Coppy right @2022-NguyenThiNhuPhuong</p>
    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
</div>
</body>
</html>