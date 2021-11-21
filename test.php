<?php
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "research") or die(mysqli_error());
$query = "SELECT COUNT(topic) as count FROM research WHERE topic='research'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output = "Number of rows" . $row['count'];
}
$sql = "SELECT * FROM research";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        tr,
        td {
            text-align: center;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="body-container" style="padding: 20px;">
        <?php
        echo $output;
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Research</th>
                <th>Degree Level</th>
                <th>Topic</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
         <td>" . $row['id'] . "</td>
         <td>" . $row['title'] . "</td>
         <td>" . $row['research_type'] . "</td>
         <td>" . $row['degree_level'] . "</td>
         <td>" . $row['topic'] . "</td>
         </tr>";
            }
            ?>
        </table>
    </div>

</body>

</html>