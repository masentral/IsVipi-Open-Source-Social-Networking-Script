<?php header("Content-Type: application/rss+xml; charset=UTF-8"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title><?php echo $site_title?>'s Members</title>
<description>Browse through our member profiles</description>
<link><?php echo $site_url?></link>
<atom:link href="<?php echo $site_url.'/feed'?>" rel="self" type="application/rss+xml"/>
<?php
$limit ="2";
getFeedMembers($limit);

while ($getmembers->fetch())
{
	getMemberDet($id);
	if(htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8') == ""){$m_thumbnail="no-image.gif";}
?>
   <item>
   <title><?php echo $profile_name; ?></title>
   <description>
   <![CDATA[
   <a href="<?php echo $site_url.'/profile/' ?><?php echo htmlspecialchars($profile_name, ENT_QUOTES, 'utf-8');?>" title="<?php echo htmlspecialchars($m_name, ENT_QUOTES, 'utf-8');?>"><img src="<?php echo $site_url.'/inc/users/thumbs/'.ISVIPI_THUMB_100.htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8');?>"/></a>
   Meet <?php echo $profile_name; ?>, <?php echo $m_gender.'('.$m_age.')'; ?> who resides at <?php echo $m_city.'('.$m_country.')'; ?>. To check out the whole profile please visit <?php echo $site_url.'/profile/'.$profile_name;?>
   ]]>
   </description>
   <guid><?php echo $site_url.'/profile/'.$profile_name;?></guid>
   </item>
<?php
}
?>
</channel>
</rss>