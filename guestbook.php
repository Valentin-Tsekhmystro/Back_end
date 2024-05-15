<?php
session_start();

echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">';
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';

echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['name'], $_POST['text'])) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $text = $_POST['text'];

        $comment = [
            'email' => $email,
            'name' => $name,
            'text' => $text,
            'timestamp' => time()
        ];

        $file = 'comments.csv';
        $jsonString = json_encode($comment) . "\n";
        file_put_contents($file, $jsonString, FILE_APPEND);
    }
}

$comments = [];
$file = 'comments.csv';
if (file_exists($file)) {
    $fileContent = file_get_contents($file);
    $lines = explode("\n", $fileContent);
    foreach ($lines as $line) {
        if (!empty($line)) {
            $comments[] = json_decode($line, true);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Guestbook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <br>
    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            <i class="fas fa-book"></i> GuestBook form
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user"></i> Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="text"><i class="fas fa-comment"></i> Comment:</label>
                            <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card card-primary">
        <div class="card-header bg-body-secondary text-dark">
            <i class="fas fa-comments"></i> Comments
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <?php foreach ($comments as $comment) : ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-user"></i> <?= $comment['name'] ?> (<?= $comment['email'] ?>)</h5>
                                <p class="card-text"><?= $comment['text'] ?></p>
                                <p class="card-text">
                                    <small class="text-muted"><i class="fas fa-clock"></i> <?= date('Y-m-d H:i:s', $comment['timestamp']) ?></small>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>