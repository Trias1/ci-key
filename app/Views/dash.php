<!-- File: app/Views/home/index.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Welcome to the Home Page</h1>

    <?php if ($userInfo) : ?>
        <p>Hello, <?php echo $userInfo['preferred_username']; ?>!</p>
        <p>Email: <?php echo $userInfo['email']; ?></p>
        <!-- Tambahkan informasi pengguna lainnya sesuai kebutuhan -->
        <a href="<?php echo base_url('Home/logout'); ?>">Logout</a>
    <?php else : ?>
        <p>User information not available.</p>
        <a href="<?php echo base_url('Home/login'); ?>">Login</a>
    <?php endif; ?>
</body>

</html>