<?php
include("../../bootstrap.inc.php");
header('Content-Type: text/json');

$data = array();

$compos = SQLLib::selectRows("select id,name from compos order by start");
foreach ($compos as $compo) {
    $entries = SQLLib::selectRows(sprintf_esc(
        "select title,author,comment,orgacomment,filename from compoentries where compoid = %d order by playingorder",
        $compo->id
    ));

    $data[$compo->name] = $entries;
}

echo json_encode($data);

?>
