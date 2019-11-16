<!doctype html>
<html lang="en">

<?php
include("headers.php");
?>


<body>
    <div class="container">
        <?php include("navbar.php"); ?>

        <!-- <button onclick="getData()" class="btn btn-success">Read</button> -->

        <div class="card">

            <div class="card-body">
                <table id="services_table" class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <?php include("footer.php"); ?>

    <script>
        $(document).ready(function() {
            getData();
        })


        function getData() {
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);

                    $("#services_table").find("tr:gt(0)").remove();

                    for (i = 0; i < data.length; i++) {
                        $("#services_table").append(
                            "<tr> <td>" + data[i].id + "</td> <td>" + data[i].name + "</td> <td>" + data[i].category + "</td></tr>"
                        );
                    }
                }
            };
            xmlhttp.open("GET", "getservices.php", true);
            xmlhttp.send();
        }
    </script>
</body>

</html>