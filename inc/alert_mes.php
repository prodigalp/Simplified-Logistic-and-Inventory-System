<?php

function alert_mes($str, $loc)
{
    echo ("
        <script>
        alert('$str');
        window.location='$loc';
        </script>
    
    ");
}
