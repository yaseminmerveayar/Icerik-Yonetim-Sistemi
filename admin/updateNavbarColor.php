<?php

    if (isset($_POST['navColorSelect'])) {

        $navbarColor = $_POST['navColorSelect'];
        $updateNavColor = $db->prepare("UPDATE `settings` SET value=? WHERE name = ?");    
        $updateNavColor -> execute([$navbarColor,"navbarColor"]);

    }
?>
