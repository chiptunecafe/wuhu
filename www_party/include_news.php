<?php
if (!defined("ADMIN_DIR")) exit();
?>
<article class='news'>
<?php
$news = SQLLib::selectRows("select * from intranet_news order by `date` desc");
foreach($news as $n) {
?>
<h3><?=_html($n->eng_title)?></h2>
<span class="postdate"><?=date("Y-m-d",strtotime($n->date))?></span>
<p><?=$n->eng_body?></p>
<?php
}
?>
</article>
