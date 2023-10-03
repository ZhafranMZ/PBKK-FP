<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Media Social</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .custom-sidebar {
            position: fixed; /* Set the sidebar to a fixed position */
            top: 40px; /* Position it at the top of the viewport */
            left: 0; /* Position it at the left of the viewport */
            bottom: 0; /* Stretch it to the bottom of the viewport */
            width: 220px; /* Set the width of the sidebar */
            background-color: #f8f9fa; /* Add a background color */
            border-right: 1px solid #ccc; /* Add a border to the right side */
            overflow-y: auto; /* Enable scrolling for the sidebar if content exceeds its height */
        }

        /* Adjust the main content area to add space for the fixed sidebar */
        .main-content {
            margin-left: 240px; /* Adjust the margin to match the width of the sidebar */
            margin-top: 40px; /* Adjust the top margin to match the top position of the sidebar */
            padding: 15px; /* Add some padding to the main content */
        }
    </style>
</head>
<body>
    <div class="container-fluid bg-light">
        <div class="row">
        <div class="col-md-3 col-lg-2 d-flex flex-column p-3 bg-light custom-sidebar">
                <!--Gambar sesuai gambar profil-->
                <img src="{{ asset('images/AyamKecap.jpeg') }}" alt="Example Image" style="border-radius: 25%;" width="50" height="50">
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link link-dark">
                            Home
                        </a>
                        <a href="#" class="nav-link link-dark">
                            Search
                        </a>
                        <a href="#" class="nav-link link-dark">
                            Notifications
                        </a>
                        <a href="#" class="nav-link link-dark">
                            Profile
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <br><br>
                <div class="row">
                    <div class="col-md-5 text-center">
                        <!--Gambar sesuai gambar profil-->
                        <img src="{{ $user->profile_pic }}" alt="Example Image" style="border-radius: 50%;" width="180" height="180">
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col">
                                <!--Nama diambil dari database-->
                                <span style="font-size: x-large;">{{$user->name}}</span>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary rounded-pill">Edit Profile</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <!--Jumlah Post diambil dari database-->                              
                                <span style="font-size: medium;">8 Posts</span>
                            </div>
                            <div class="col-md-3">
                                <!--Jumlah Followers diambil dari database-->
                                <span style="font-size: medium;">{{$user->follower}} Followers</span>
                            </div>
                            <div class="col-md-3">
                                <!--Jumlah Followings diambil dari database-->
                                <span style="font-size: medium;">{{$user->following}} Followings</span>
                            </div>
                        </div>
                            <!--Isi Text diambil dari database-->
                            <p>Hi I'm a Human</p>
                    </div>
                </div>
                <br><hr><br>
                <!--Jumlah Post sesuai Database-->
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="#"> <!--Href ke post yang sesuai-->
                            <img src="{{ asset('images/AyamGorengKrispi.jpeg') }}" alt="Example Image" width="250" height="250">
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="#"> <!--Href ke post yang sesuai-->
                            <img src="{{ asset('images/AyamGorengLengkuas.jpeg') }}" alt="Example Image" width="250" height="250">
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="#"> <!--Href ke post yang sesuai-->
                            <img src="{{ asset('images/AyamKecap.jpeg') }}" alt="Example Image" width="250" height="250">
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="#"> <!--Href ke post yang sesuai-->
                            <img src="{{ asset('images/CahKangkungCumi.jpg') }}" alt="Example Image" width="250" height="250">
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="#"> <!--Href ke post yang sesuai-->
                            <img src="{{ asset('images/OsengTeriKentang.jpg') }}" alt="Example Image" width="250" height="250">
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="#"> <!--Href ke post yang sesuai-->
                            <img src="{{ asset('images/SupJagungSosis.jpeg') }}" alt="Example Image" width="250" height="250">
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="#"> <!--Href ke post yang sesuai-->
                            <img src="{{ asset('images/OsengTeriKentang.jpg') }}" alt="Example Image" width="250" height="250">
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="#"> <!--Href ke post yang sesuai-->
                            <img src="{{ asset('images/SupJagungSosis.jpeg') }}" alt="Example Image" width="250" height="250">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
