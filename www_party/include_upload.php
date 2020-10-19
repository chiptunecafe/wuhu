<?php
if (!defined("ADMIN_DIR")) exit();

global $settings;
include_once(ADMIN_DIR . "/thumbnail.inc.php");

function perform(&$msg)
{
  global $settings;
  if (!is_user_logged_in()) {
    $msg = "You got logged out :(";
    return 0;
  }
  $data = array();
  $meta = array("title","author","comment","orgacomment");
  foreach($meta as $m) $data[$m] = $_POST[$m];
  $data["compoID"] = $_POST["compo"];
  $data["userID"] = get_user_id();
  $data["localScreenshotFile"] = $_FILES['screenshot']['tmp_name'];
  $data["localFileName"] = $_FILES['entryfile']['tmp_name'];
  $data["originalFileName"] = $_FILES['entryfile']['name'];
  if (handleUploadedRelease($data,$out))
  {
    return $out["entryID"];
  }

  $msg = $out["error"];
  return 0;
}
if ($_POST) {
  $msg = "";
  $id = perform($msg);
  if ($id) {
    redirect( build_url("EditEntries",array("id"=>(int)$id,"newUploadSuccess"=>time())) );
  } else {
    echo "<div class='failure'>".$msg."</div>";
  }
}

$s = SQLLib::selectRows("select * from compos where uploadopen>0 order by start");
if ($s) {
global $page;
?>
<form action="<?=$_SERVER["REQUEST_URI"]?>" method="post" enctype="multipart/form-data" id='uploadEntryForm'>
<div id="entryform">
<div class='formrow'>
  <label for='compo'>Category:</label>
  <select id='compo' name="compo" required='yes'>
    <option value=''>-- Please select a category:</option>
<?php
foreach($s as $t)
  printf("  <option value='%d'%s>%s</option>\n",$t->id,$t->id==$_POST["compo"] ? ' selected="selected"' : "",$t->name);
?>
  </select>
</div>
<div class='formrow'>
  <label for='title'>Title:</label>
  <input id='title' name="title" type="text" value="<?=_html($_POST["title"])?>" required='yes'/>
</div>
<div class='formrow'>
  <label for='author'>Author: <small>(shown on stream)</small></label>
  <input id='author' name="author" type="text" value="<?=_html($_POST["author"])?>"/>
</div>
<div class='formrow'>
  <label for="comment">Hardware / Software used: <small>(shown on stream)</small></label>
  <textarea name="comment"><?=_html($_POST["comment"])?></textarea>
</div>
<div class='formrow'>
  <label for='orgacomment'>Comment for the organizers: <small>(this will NOT be shown anywhere)</small></label>
  <textarea name="orgacomment" id="orgacomment"><?=_html($_POST["orgacomment"])?></textarea>
</div>
<div class='formrow'>
  <label for='entryfile'>Uploaded file:
  <small>
  (max. <?=ini_get("upload_max_filesize")?> - if you want to upload
  a bigger file, just upload a dummy text file here and ask the organizers!)
  </small></label>
  <input id='entryfile' name="entryfile" type="file" required='yes' />
</div>
<div class='formrow'>
  <label for='screenshot'>Screenshot: <small>(optional - JPG, GIF or PNG!)</small></label>
  <input id='screenshot' name="screenshot" type="file" accept="image/*" />
</div>
<div class='formrow'>
  <input type="submit" value="Go!" />
</div>
</div>
</form>
<?php
} else echo "Sorry, all deadlines are closed!";
?>
