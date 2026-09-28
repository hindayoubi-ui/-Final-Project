<?php

session_start();

require('../conn.php');

// var_dump($_POST);
// exit;

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // var_dump($username);
    // var_dump($password);
    // exit;

    $sql = "SELECT * FROM users WHERE usersname = ?";

    $stmt = $conn->prepare($sql);

    // var_dump($stmt);
    // exit;

    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    // var_dump($result);
    // exit;

    $user = $result->fetch_assoc();

    // var_dump($user);
    // exit;

    if ($user) {

        if (password_verify($password, $user['password'])) {

            $_SESSION['users_id'] = $user['users_id'];
            $_SESSION['usersname'] = $user['usersname'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {

                echo "<script>
                        alert('Login successful!');
                        window.location.href = 'template/dist/index.php';
                      </script>";

                exit;

            } else {

                session_unset();
                session_destroy();

                echo "<script>
                        alert('You do not have permission to access the Admin Dashboard!');
                        window.location.href = 'login.php';
                      </script>";

                exit;
            }

        } else {

            echo "<script>
                    alert('Wrong password!');
                    window.location.href = 'login.php';
                  </script>";

            exit;
        }

    } else {

        echo "<script>
                alert('Username not found!');
                window.location.href = 'login.php';
              </script>";

        exit;
    }

} else {

    echo "Please fill all fields.";

}

?>