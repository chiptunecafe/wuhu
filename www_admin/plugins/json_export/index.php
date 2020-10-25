<?php
include("../../bootstrap.inc.php");
header('Content-Type: text/json');

$data = array();

$compos = SQLLib::selectRows("select id,name,dirname from compos order by start");
foreach ($compos as $compo) {
    $entries = SQLLib::selectRows(sprintf_esc(
        "select title,author,comment,orgacomment,filename from compoentries where compoid = %d order by playingorder",
        $compo->id
    ));

    $compodata = array();
    $compodata["directory_name"] = $compo->dirname;
    $compodata["display_name"] = $compo->name;
    $compodata["entries"] = $entries;

    array_push($data, $compodata);
}

echo json_encode($data);

?>
