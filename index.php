<?php

include_once "./database/connexion.php";
include_once "./models/User.php";
$users = User::getUsers($con);
if (isset($_POST) && isset($_POST['submit'])) {
    User::addUser($con, $_POST);
    $users = User::getUsers($con);
} else if (isset($_POST) && isset($_POST['modify'])) {
    User::updateUser($con, $_POST);
    $users = User::getUsers($con);
} else if (isset($_GET['del']) && isset($_GET['id'])) {
    User::removeUser($con, $_GET['id']);
    $users = User::getUsers($con);
} else if (isset($_GET['edit']) && isset($_GET['id'])) {
    $userEdit = User::editUser($con, $_GET['id']);
} else {
    $users = User::getUsers($con);
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-3">
        <h4>User Crud</h4>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full name</th>
                            <th>Email</th>
                            <th>photo</th>
                            <th>options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr class="text-center">
                                <td><?php echo $user['id'];  ?></td>
                                <td><?php echo $user['full_name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['photo'] ? $user['photo'] : '/' ?></td>
                                <td>
                                    <a href="index.php?edit&id=<?php echo $user['id'] ?>">
                                        <i class="fas fa-pencil-alt ml-4"></i>
                                    </a>
                                    <a onclick="return confirm('are you sure')" href="index.php?del&id=<?php echo $user['id'] ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <?php if (isset($_GET['edit']) && !isset($_POST['modify'])) : ?>
                    <form method="POST">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $userEdit['full_name']; ?>">
                        <label for="email" class="form-label">email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $userEdit['email']; ?>">
                        <label for="photo" class="form-label">photo</label>
                        <input type="file" name="photo" class="form-control" value="<?php echo $userEdit['photo']; ?>">
                        <input type="hidden" name="id" value="<?php echo $userEdit['id']; ?>">
                        <button type="submit" name="modify" class="btn btn-primary mt-3">Modify</button>
                    </form>
                <?php else : ?>
                    <form method="POST">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control">
                        <label for="email" class="form-label">email</label>
                        <input type="email" name="email" class="form-control">
                        <label for="photo" class="form-label">photo</label>
                        <input type="file" name="photo" class="form-control">
                        <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button>
                    </form>

                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>