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
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>

    <div class="login-container my-2">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header text-bg-dark d-flex justify-content-between">
                    <h1 class="fs-3 fw-bold">Edit Note</h1>
                    <a href="/NotesApp/home" class="home-link"><i class="fa-sharp fa-solid fa-circle-xmark fa-lg" style="color: #73538d"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="POST" class="needs-validation" id="editnote-form" novalidate>
                        <label for="title" class="form-label py-2">Title</label>
                        <input type="text" name="title" id="title" class="form-control <?php if (isset($errors['title'])) {
                                                                                            echo "is-invalid";
                                                                                        } else {
                                                                                            if ($visited)
                                                                                                echo "is-valid";
                                                                                        } ?>" value="<?php
                                                                                                        echo $note->getTitle();;
                                                                                                        ?>" placeholder="ExampleTitle" required />
                        <div class="invalid-feedback">Please enter a title</div>
                        <label for="description" class="form-label py-2">Note</label>
                        <textarea name="description" id="note" cols="50" rows="10" class="form-control  <?php if (isset($errors['description'])) {
                                                                                                            echo "is-invalid";
                                                                                                        } else {
                                                                                                            if ($visited)
                                                                                                                echo "is-valid";
                                                                                                        } ?>" placeholder="ExampleNote" required><?php
                                                                                                                                                    echo $note->getDescription(); ?></textarea>
                        <div class="invalid-feedback">Please enter a description</div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-primary submit-btn mt-4 px-5">
                                Edit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            "use strict";

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll(".needs-validation");

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        })();
    </script>
</body>

</html>