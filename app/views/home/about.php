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
                            <a href="/NotesApp/home" class="nav-link" aria-current="page">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active">About</a>
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
                                    <a class="dropdown-item text-light" href="#">Edit details</a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-light" href="#">Delete Account</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid px-4 py-5 text-center landing-content">
            <div class="lg-block d-block mx-auto mb-4">
                <img src="/images/notes.png" alt="Image of Notes" class="landing-notes-img" />
            </div>
            <div class="lg-block">
                <div editable="rich">
                    <h1 class="display-5 fw-bold">Welcome to the NotesApp</h1>
                </div>
            </div>
            <div class="lg-block col-lg-6 mx-auto mb-4">
                <div editable="rich">
                    <p class="lead">
                        A versatile tool designed to streamline your note-taking
                        experience. Our app empowers you to effortlessly create, update,
                        delete, and display notes, all within a clean and intuitive
                        interface. Additionally, offering you the convenience of updating
                        and deleting your account, ensuring complete control over your
                        personal information.
                    </p>
                </div>
            </div>
            <div class="lg-block col-lg-8 mx-auto mb-4">
                <div editable="rich">
                    <h2>Our Key Features</h2>
                    <ul>
                        <li class="feature">
                            Create Notes: Our app allows you to create notes effortlessly,
                            providing you with a digital space to capture your thoughts,
                            ideas, and reminders. Whether you're jotting down meeting
                            minutes or brainstorming for your next project, our intuitive
                            note creation feature makes it a breeze.
                        </li>
                        <li class="feature">
                            Update Notes: We understand that ideas evolve and information
                            changes. With our app, you can easily update your existing
                            notes, ensuring that your thoughts remain current and relevant.
                            Our seamless editing interface enables you to refine your notes
                            without any hassle.
                        </li>
                        <li class="feature">
                            Delete Notes: When a note becomes obsolete or is no longer
                            needed, our app enables you to swiftly delete it. Enjoy the
                            freedom of decluttering your workspace and maintaining a tidy
                            collection of notes, keeping only what truly matters.
                        </li>
                        <li class="feature">
                            Display Notes : Retrieving your notes is effortless. Simply
                            browse through your collection of notes, organized in a way that
                            suits your preferences. Locate the information you need, when
                            you need it, and enjoy a visually pleasing experience.
                        </li>
                        <li class="feature">
                            Update and Delete Account: We respect your privacy and value
                            your autonomy. Our app allows you to update and delete your
                            account whenever necessary. Customize your personal information,
                            modify your preferences, or choose to discontinue using our app
                            with ease. Your control is our priority.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p class="text-center">Created by <a href="#">Rohit Deshpande</a></p>
    </footer>
</body>

</html>