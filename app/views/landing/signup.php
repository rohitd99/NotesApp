<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NotesApp</title>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script defer src="/js/script.js"></script>
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
                    <h1 class="fs-3 fw-bold">Signup Form</h1>
                    <a href="/NotesApp/" class="home-link">
                        <i class="fa-sharp fa-solid fa-circle-xmark fa-lg" style="color: #73538d"></i></a>
                </div>
                <div class="card-body">
                    <form action="" method="POST" id="form" novalidate>
                        <label for="username" class="form-label py-2">Username</label>
                        <input type="text" name="username" id="username" class="form-control <?php if (isset($errors['username'])) {
                                                                                                    echo "is-invalid";
                                                                                                } else {
                                                                                                    if ($visited)
                                                                                                        echo "is-valid";
                                                                                                }
                                                                                                ?>" value="<?php echo $data['username'] ?>" required />
                        <div class="invalid-feedback" id="username-validation"><?php if (isset($errors['username'])) {
                                                                                    echo $errors['username'];
                                                                                }
                                                                                ?></div>
                        <label for="email" class="form-label py-2">Email</label>
                        <input type="email" name="email" id="email" class="form-control <?php if (isset($errors['email'])) {
                                                                                            echo "is-invalid";
                                                                                        } else {
                                                                                            if ($visited)
                                                                                                echo "is-valid";
                                                                                        }
                                                                                        ?>" value="<?php echo $data['email'] ?>" required />
                        <div class="invalid-feedback" id="email-validation"><?php if (isset($errors['email'])) {
                                                                                echo $errors['email'];
                                                                            }
                                                                            ?></div>
                        <label for="password" class="form-label py-2">Password</label>
                        <input type="password" name="password" id="password" class="form-control <?php if (isset($errors['password'])) {
                                                                                                        echo "is-invalid";
                                                                                                    } else {
                                                                                                        if ($visited)
                                                                                                            echo "is-valid";
                                                                                                    }
                                                                                                    ?>" value="<?php echo $data['password'] ?>" required />
                        <div class="invalid-feedback" id="password-validation"><?php if (isset($errors['password'])) {
                                                                                    echo $errors['password'];
                                                                                }
                                                                                ?></div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-primary submit-btn mt-4 px-5">
                                Signup
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p class="px-3">
                        Already have an account ? <a href="/NotesApp/login">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>