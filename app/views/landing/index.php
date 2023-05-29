<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NotesApp</title>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="/images/notes.png" type="image/x-icon" />
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
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
                    Simplify your life and declutter your mind with the seamless
                    note-taking experience of NotesApp. Effortlessly manage your
                    thoughts, tasks, and goals in one place.
                </p>
            </div>
        </div>

        <div class="lg-block d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a class="btn btn-outline-success btn-lg px-4 gap-3" href="/NotesApp/login" role="button">Login</a>
            <a class="btn btn-outline-primary btn-lg px-4" href="/NotesApp/signup" role="button">Signup</a>
        </div>
    </div>
</body>

</html>