<?php

echo '<input type="number" name="q' . $row["id"] . '" min="0" max="100" pattern=" 0+\.[0-9]*[1-9][0-9]*$" name="itemConsumption" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';

?>