<?php
require_once 'db_connection.php';
?>

<!DOCTYPE html>
<html>

<head>
    <img src="TPC BANNER.png" style="width: 1510px; height: 200px;" alt="Description">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            min-width: 250px;
            margin-bottom: 500px;
            background-image: url('tpclogo.png') ;
             background-repeat: no-repeat;
             background-position: center;
             background-size: cover;
            
        }

        /* Include the padding and border in an element's total width and height */
        * {
            box-sizing: border-box;
        }

        /* Remove margins and padding from the list */
        ul {
            margin: 0;
            padding: 0;
        }

        /* Style the list items */
        ul li {
            cursor: pointer;
            position: relative;
            padding: 12px 8px 12px 40px;
            list-style-type: none;
            background: #eee;
            font-size: 18px;
            transition: 0.2s;
            opacity: 0.9;

            /* make the list items unselectable */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Set all odd list items to a different color (zebra-stripes) */
        ul li:nth-child(odd) {
            background: #155c3480;
        }

        /* Darker background-color on hover */
        ul li:hover {
            background: #dddddd4d;
        }

        /* When clicked on, add a background color and strike out text */
        ul li.checked {
            background: #888;
            color: #fff;
            text-decoration: line-through;
        }

        /* Style the header */
        .header {
            background-color: #36f4a8;
            padding: 30px 40px;
            color: BLACK;
            text-align: center;
            opacity: 0.9;
        }

        /* Clear floats after the header */
        .header:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style the input */
        input {
            margin: 0;
            border: none;
            border-radius: 10;
            width: 75%;
            padding: 10px;
            float: left;
            font-size: 16px;
        }

        /* Style the "Add" button */
        .addBtn {
            padding: 10px;
            width: 25%;
            background: #044f03;
            color: #10f250;
            float: left;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 10px;
        }

        .addBtn:hover {
            background-color: #bbb;
        }

        .todolist {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>

    <div id="myDIV" class="header">
        <form action="todolist_insert_data.php" method="post">
            <h2 style="margin:5px">JEFFREYS TO DO LIST</h2>
            <input type="text" id="myInput" name="todolist" placeholder="ENTER WHAT YOU DESIRES" required>
            <button class="addBtn" type="submit">Add</button>
        </form>
    </div>

    <ul id="myUL">

        <?php

        $sql = "SELECT * FROM todolist";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['status'] == 0) {
        ?>
                    <li class='todolist'>
                        <?php echo $row['todo']; ?>
                        <div style="display: flex;">
                            <form action="todolist_update_data.php" method="post">
                                <input type="text" name="id" value="<?php echo $row['id']; ?>" readonly hidden>
                                <input type="text" name="status" value="<?php echo $row['status']; ?>" readonly hidden>
                                <button type="submit">&#10003;</button>
                            </form>
                            <form action="todolist_delete_data.php" method="post">
                                <input type="text" name="id" value="<?php echo $row['id']; ?>" readonly hidden>
                                <input type="text" name="status" value="<?php echo $row['status']; ?>" readonly hidden>
                                <button type="submit">delete</button>
                            </form>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class='todolist checked'>
                        <?php echo $row['todo']; ?>
                        <div style="display: flex;">
                            <form action="todolist_update_data.php" method="post">
                                <input type="text" name="id" value="<?php echo $row['id']; ?>" readonly hidden>
                                <input type="text" name="status" value="<?php echo $row['status']; ?>" readonly hidden>
                                <button type="submit">&#10005;</button>
                            </form>
                            <form action="todolist_delete_data.php" method="post">
                                <input type="text" name="id" value="<?php echo $row['id']; ?>" readonly hidden>
                                <button type="submit">delete</button>
                            </form>
                        </div>
                    </li>
        <?php
                }
            }
        } else {
            echo "<li>0 results</li>";
        }
        ?>
    </ul>

</body>

</html>