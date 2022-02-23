<?php

//qst, qst_type, qst_opt

$diff_types = ["Tekst", "Ja/nei", "Avkrysning", "Flervalg", "Numerisk", "Fil"];
$types_opt  = [2, 3];

echo '
<script>
function autoSubmit() {
    document.getElementById("theForm").submit.click();
}
</script>
';

echo '<section><form action="form_generator.php" method="post" id="theForm">';

$rep = count($qst);
for ($i = 0; $i < $rep; $i++) {
    echo '
        <div><input type=text name="qst' . $i . '" value="' . $qst[$i] . '" placeholder="Spørsmål (fjernes om rubrikken er tom ved oppdatering)">
        <select name="qst_type' . $i . '" onChange="autoSubmit();">
    ';
    for ($x = 0; $x < count($diff_types); $x++) {
        if ($qst_type[$i] == $x) {$selected = "selected";} else {$selected = "";} //Add selected to the option if its the previously chosen option

        echo '<option value="' . $x . '" ' . $selected . '>' . $diff_types[$x] . '</option>';
    }
    echo '</select>';

    if (in_array($qst_type[$i], $types_opt)) {
        echo '<textarea name="qst_opt' . $i . '" class="optionquestion" placeholder="Valg 1&#10;Valg2&#10;Valg3&#10;..." rows="5">' . $qst_opt[$i] . '</textarea>';
    }
    echo '</div>';

}

echo '
    <input type="hidden" name="event" value="2">
    <input type="submit" name="submit" value="Oppdater">
</form>';

include "new_question.php";

echo '</section>';

?>