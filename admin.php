<?php
session_start();

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("Location: login.php");
    exit();
}

require_once "connect.php";

$sql = "SELECT * FROM messages ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Messages</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Visitor Messages 💌</h1>

    <p>Welcome, Eman! Here are your visitors' messages.</p>

    <a href="login.php?logout=1">Logout 🔒</a>

    <?php if ($result && mysqli_num_rows($result) > 0) { ?>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <section>

                <h3>
                    <?php echo htmlspecialchars($row["name"]); ?>
                </h3>

                <p>
                    <strong>Email:</strong>
                    <?php echo htmlspecialchars($row["email"]); ?>
                </p>

                <p>
                    <strong>Message:</strong>
                    <?php echo nl2br(htmlspecialchars($row["message"])); ?>
                </p>

                <small>
                    Sent on:
                    <?php echo htmlspecialchars($row["created_at"]); ?>
                </small>

            </section>

        <?php } ?>

    <?php } elseif ($result) { ?>

        <section>
            <h2>No messages yet! 💗</h2>
            <p>Your visitors' messages will appear here.</p>
        </section>

    <?php } else { ?>

        <section>
            <p>Unable to load messages. Please try again.</p>
        </section>

    <?php } ?>

</body>
</html>