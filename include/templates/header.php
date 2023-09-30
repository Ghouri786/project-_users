<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <?php
    if ($current_page === 'admin') {
        echo '<link rel="stylesheet" href="' . base_url . '/include/assests/css/admin.css">';
    } else if ($current_page === 'edit') {
        echo '<link rel="stylesheet" href="' . base_url . '/include/assests/css/edit.css">';
    } else if ($current_page === 'member') {
        echo '<link rel="stylesheet" href="' . base_url . '/include/assests/css/member-style.css">
             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">';
    }else{
        echo '<link rel="stylesheet" href="' . base_url . '/include/assests/css/style.css">';
    }
    ?>

</head>
<body>
