<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>MY TASK : Create Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="menu">
        <?php include 'menu.php';?>
    </div>
    <div class="wrapper">
        <h2>Create Task</h2>
        <p>Please fill in necessary information.</p>
        <form name="create_task" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($due_date_err)) ? 'has-error' : ''; ?>">
                <label>Due Date (e.g.: yyyy-mm-dd)</label>
                <input type="text" name="due_date" class="form-control" value="<?php echo $duedate; ?>">
                <span class="help-block"><?php echo $due_date_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($due_time_err)) ? 'has-error' : ''; ?>">
                <label>Due Time (e.g.: hh:mm:ss)</label>
                <input type="text" name="due_time" class="form-control">
                <span class="help-block"><?php echo $due_time_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                <label>Description</label>
                <input type="text" name="description" class="form-control">
                <span class="help-block"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="create" value="Create">
            </div>
        </form>
    </div>
    <?php
    $user = $_GET["user"];
    echo "HELLO";
    echo $user;

    // session_start();
    // echo "USER ID!!!: ";
    // echo $_SESSION['user'];
    // $userid = $_SESSION['user'];
    // echo $userid;

    ob_start();
    include 'login.php';
    ob_end_clean();
    

    $db = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=test");

    var_dump($result);
    print_r($row);

    if (isset($_POST['create'])) {
        $result = pg_query($db, "INSERT INTO tasks (owner_id, due_date, due_time, description) VALUES ('$userid', '$_POST[due_date]','$_POST[due_time]', '$_POST[description]')");
        echo "HELLO WE REACHED HERE!!";
        echo "<h1>Hello " . $_GET["user"] . "</h1>";
        if (!$result) {
                echo "Failed to create the task!";
                var_dump($result);
            } else {
                echo "Successfully created the task!";
                var_dump($result);
            }
    }
    ?>
</body>
</html>