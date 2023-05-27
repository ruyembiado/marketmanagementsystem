<?php

@include 'config.php';

?>

<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet">

<div id="map"></div>
<!-- Add database stored coordinates as value in textarea like below -->

<textarea id="coordinateVal">
                    <?php 
                    $stall = "SELECT longitude, latitude FROM stall";
                    $result = mysqli_query($conn, $stall);
                    while($row = mysqli_fetch_assoc($result)){
                            $longitude = $row['longitude'];
                            $latitude = $row['latitude'];
                        // echo "$latitude|$longitude,";
                       
                    }
                    echo "100|100,2|2,0|0";
                    ?>
                </textarea>

<!-- Coordinate values of points are seperated by " , " . X & Y of each point are seperated by " | " respectively -->

<!--Extra HTML code-->
<ul><b>Points marking India's :</b>
    <li>North</li>
    <li>East</li>
    <li>West</li>
    <li>South</li>
</ul>
<script>
var s = document.getElementById('coordinateVal').value;
var g = s.split(',');

var frag = document.createDocumentFragment(),
    element = 'div',
    clsName = 'sections';

for (var i = 0; i < g.length; i++) {
    var box = document.createElement(element);
    box.className = clsName
    var coordinates = g[i].split("|");
    box.setAttribute('style', 'left:' + coordinates[0] + 'px;top:' + coordinates[1] + 'px;');
    // Append the child into the Fragment
    frag.appendChild(box);
}
