<?php

echo '
<section>
    <form action="form_generator.php" method="post" class="basic">
        <label>Tittel</label><input type="text" name="title" placeholder="For eksempel: IT konsulent" value="' . $basic[$types[0]] . '">
        <label>Fargetema</label><input type="color" name="color" value="' . $basic[$types[1]] . '">
        <label>Beskrivelse</label><textarea name="description" placeholder="For eksempel: For deg som elsker IT og høyt lønnet arbeid." rows="5">' . $basic[$types[2]] . '</textarea>
        <label>Nøkkelord</label><input type="text" name="keywords" placeholder="For eksempel: Tech, Fysisk arbeid, ..." value="' . $basic[$types[3]] . '">
        <label>Lokasjon</label><input type="text" name="location" placeholder="For eksempel: Stavanger" value="' . $basic[$types[4]] . '">
        <input type="hidden" name="event" value="1">
        <input type="submit" name="submit" value="Oppdater">
    </form>
</section>
';


?>