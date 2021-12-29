<?php

class User
{

    static public function addUser($con, $data)
    {
        $req = "INSERT INTO users (full_name,email,photo) VALUES (?,?,?)";
        $query = $con->prepare($req);
        $query->execute([$data['name'], $data['email'], $data['photo']]);
        header('location:index.php');
    }

    static public function getUsers($con)
    {
        $req = "SELECT * FROM users";
        $query = $con->prepare($req);
        $query->execute();
        $results = $query->fetchAll();
        return $results;
    }

    static public function removeUser($con, $id)
    {
        $req = "DELETE FROM users WHERE id=?";
        $query = $con->prepare($req);
        $query->execute([$id]);
    }

    static public function editUser($con, $id)
    {
        $req = "SELECT * FROM users WHERE id=?";
        $query = $con->prepare($req);
        $query->execute(array($id));
        $results = $query->fetch();
        return $results;
    }

    static public function updateUser($con, $data)
    {
        $req = "UPDATE users SET full_name=?, email=?, photo=? WHERE id=?";
        $query = $con->prepare($req);
        $query->execute([$data['name'], $data['email'], $data['photo'], $data['id']]);
    }
}
