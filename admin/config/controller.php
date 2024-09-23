<?php

// query select data
function query($query)
{
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// create category
function store_category($data)
{
    global $db;

    $title = sanitize($data['title']);
    $slug = sanitize($data['slug']);

    // prepare statement
    $stmt = $db->prepare("INSERT INTO categories (title, slug) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $slug);

    $stmt->execute();

    return $stmt->affected_rows;
}

// delete category
function delete_category($id)
{
    global $db;

    $stmt = $db->prepare("DELETE FROM categories WHERE id_category = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->affected_rows;
}

// ubah category
function ubah_category($data)
{
    global $db;

    $id = (int)$data['id'];
    $title = sanitize($data['title']);
    $slug = sanitize($data['slug']);

    $stmt = $db->prepare("UPDATE categories SET title = ?, slug = ? WHERE id_category = ?");
    $stmt->bind_param("ssi", $title, $slug, $id);
    $stmt->execute();
    return $stmt->affected_rows;
}

// create film
function store_film($data)
{
    global $db;

    $url          = sanitize($data['url']);
    $title          = sanitize($data['title']);
    $slug           = sanitize($data['slug']);
    $description    = sanitize($data['description']);
    $release_date   = sanitize($data['release_date']);
    $studio         = sanitize($data['studio']);
    $category_id    = sanitize((int)$data['category_id']);

    $stmt = $db->prepare("INSERT INTO films (url, title, slug, description, release_date, studio, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $url, $title, $slug, $description, $release_date, $studio, $category_id);
    $stmt->execute();
    // $stmt->close();

    return mysqli_affected_rows($db);
}

// ubah category
function ubah_film($data)
{
    global $db;

    $id = (int)$data['id'];
    $url          = sanitize($data['url']);
    $title          = sanitize($data['title']);
    $slug           = sanitize($data['slug']);
    $description    = sanitize($data['description']);
    $release_date   = sanitize($data['release_date']);
    $studio         = sanitize($data['studio']);
    $category_id    = sanitize((int)$data['category_id']);
    $is_private     = sanitize((int)$data['is_private']);

    $stmt = $db->prepare("UPDATE films SET url = ?, title = ?, slug = ?, description = ?, release_date = ?, studio = ?, category_id = ?, is_private = ? WHERE id_film = ?");
    $stmt->bind_param("ssssssssi", $url, $title, $slug, $description, $release_date, $studio, $category_id, $is_private, $id);
    $stmt->execute();
    return $stmt->affected_rows;
}

// hapus film
function delete_film($id)
{
    global $db;
    $stmt = $db->prepare("DELETE FROM films WHERE id_film = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows;
}

// store user
function store_user($data)
{
    global $db;

    $username = sanitize($data['username']);
    $email = sanitize($data['email']);
    $password = sanitize (password_hash($data['password'], PASSWORD_BCRYPT));

    // prepare statement
    $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    $stmt->execute();

    return $stmt->affected_rows;
}