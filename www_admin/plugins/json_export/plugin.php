<?php
/*
Plugin name: JSON Export
Description: Exports compo information for external slideviewers
*/

function jsonexport_addmenu($data) {
    $data["links"]["./plugins/json_export/index.php"] = "JSON Export";
}

add_hook("admin_menu", "jsonexport_addmenu");
?>
