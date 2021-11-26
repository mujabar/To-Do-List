<?php
    $errors = "";
    $db = mysqli_connect('localhost', 'root', '', 'tdl-3000');
    if(isset($_POST['submit'])){
        $task = $_POST['task'];
        if (empty($task)){
            $errors = "You must fill in the task";
        }else{
            mysqli_query($db, "INSERT INTO deku (task) VALUES ('$task')");
            header('location: index.php');
        }
    }
    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM deku WHERE id=$id");
        header('location: index.php');
    }
    $deku = mysqli_query($db, "SELECT * FROM deku");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>TDL-3000</title>
        <link rel="stylesheet" type= "text/css" href="style.css">
    </head>
    <body>
        <div class="heading">
            <h2>TO DO LIST</h2>
        </div>
        <form method="POST" action="index.php">
        <?php if (isset($errors)){?>
            <p><?php echo $errors; ?></p>
        <?php } ?>
            <input type="text" name="task" class="task_input">
            <button type="submit" class="add_btn" name="submit">Add Task</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; while ($row = mysqli_fetch_array($deku)){ ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td class="task"><?php echo $row['task']; ?></td>
                    <td class="delete">
                        <a href="index.php?del_task=<?php echo $row['id'] ?>">x</a>
                    </td>
                </tr>
            <?php $i++; } ?>
            </tbody>
        </table>
    </body>
</html>