<?php  

function csrf() 
{
    echo "<input type='hidden' name='csrf' value='" . $_SESSION['csrf'] . "'>";
}

?>