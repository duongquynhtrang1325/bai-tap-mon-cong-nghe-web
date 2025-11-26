<?php
function loadFlowers() {
    include 'data.php';
    return $flowers;
}

function saveFlowers($flowers) {
    $content = "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>";
    file_put_contents("data.php", $content);
}
?>
