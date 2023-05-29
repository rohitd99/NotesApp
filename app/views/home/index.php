<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NotesApp</title>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="icon" href="/images/notes.png" type="image/x-icon" />
    <link rel="stylesheet" href="/css/style1.css" />
</head>

<body>
    <!-- <?php
            echo "<pre>";
            var_dump($notes);
            echo "</pre>";
            ?> -->
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" data-bs-theme="dark">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand fs-3 fw-bold brand">
                <img src="/images/notes.png" alt="Image of Notes" class="notes-icon" />NotesApp</span>

            <div class="nav-container">
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/NotesApp/about" class="nav-link">About</a>
                        </li>
                        <li class="dropdown user-nav">
                            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user" style="color: #2263d3"></i>
                                <?php echo $username; ?>
                            </button>
                            <ul class="dropdown-menu bg-dark">
                                <li>
                                    <form action="/NotesApp/home/logout" method="post">
                                        <button type="submit" class="dropdown-item text-light" href="#">Logout</button>
                                    </form>
                                </li>
                                <li>
                                    <a class="dropdown-item text-light" href="/NotesApp/home/user/edit">Edit details</a>
                                </li>
                                <li>
                                    <button class="dropdown-item text-light" data-bs-toggle="modal" data-bs-target="#deleteuser-modal">
                                        Delete Account
                                    </button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-sm py-5">
            <form action="" class="form-inline my-2 my-lg-0" method="GET">
                <div class="input-group input-group-sm input search-box">
                    <input class="form-control mr-sm-2 search-box" name="search" id="search" type="search" placeholder="Search for Notes" value="<?php if (isset($search)) {
                                                                                                                                                        echo $search;
                                                                                                                                                    }
                                                                                                                                                    ?>" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
        <div class="container d-flex justify-content-center">
            <a href="/NotesApp/home/notes/create" class="btn btn-outline-success rounded-5">
                <i class="fa-solid fa-circle-plus fa-2xl add-icon"></i>Create Note
            </a>
        </div>
        <div class="container-fluid p-lg-5 card-container">
            <?php foreach ($notes as $note) : ?>
                <div class="card">
                    <div class="card-header text-light bg-dark d-flex justify-content-between">
                        <h2><?php echo $note['title']; ?></h2>
                        <p class="timestamp align-self-end"><?php
                                                            $date = \DateTime::createFromFormat("Y-m-d H:i:s", $note['timestamp']);
                                                            echo date_format($date, "H:i d M Y");
                                                            ?>
                        </p>
                    </div>
                    <div class="card-body">
                        <?php echo $note['description']; ?>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <a href="/NotesApp/home/notes/edit?id=<?php echo $note['noteid'] ?>" class="btn btn-primary mx-2">Edit Note</a>
                        <a href="/NotesApp/home?noteid=<?php echo $note['noteid']; ?>" class="btn btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#deletenote-modal<?php echo $note['noteid']; ?>">
                            Delete Note
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="deletenote-modal<?php echo $note['noteid']; ?>" tabindex="-1" aria-labelledby="modal-title1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title1">
                                    Are you sure you want to delete the note ?

                                </h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-center">
                                <form action="/NotesApp/home/notes/delete" method="POST">
                                    <input type="hidden" name="noteid" id="noteid" value="<?php echo $note['noteid']; ?>">
                                    <button type="submit" class="btn btn-danger mx-2" data-bs-dismiss="modal">Yes</button>
                                </form>
                                <a href="#" class="btn btn-outline-primary mx-2" data-bs-dismiss="modal">No</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="modal fade" id="deleteuser-modal" tabindex="-1" aria-labelledby="modal-title2" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title2">
                            Are you sure you want to delete the account ?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <form action="/NotesApp/home/user/delete" method="POST">
                            <button type="submit" class="btn btn-danger mx-2" data-bs-dismiss="modal">Yes</button>
                        </form>
                        <a href="#" class="btn btn-outline-primary mx-2" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p class="text-center">Created by <a href="#">Rohit Deshpande</a></p>
    </footer>
</body>

</html>