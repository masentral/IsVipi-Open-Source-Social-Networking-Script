<?php
		global $site_url;
		global $siteMapP;
		global $p_title;
		global $p_id;
        // include class
		//include ISVIPI_ADMIN_INC_BASE.'adminFunc.php';
        include ISVIPI_ADMIN_INC_BASE.'SitemapGenerator.php';

        // create object
        $sitemap = new SitemapGenerator($site_url.'/');

        // add urls
		siteMapPages();
		$sitemap->addUrl($site_url,          date('c'),  'daily',    '1');
		while ($siteMapP->fetch()){
		   $sub = str_replace(" ", "_", $p_title);
		   $sub = html_entity_decode($sub);
        $sitemap->addUrl("".$site_url.'/p/'.$sub.'-p'.$p_id.'#.'.rand(0, 9999)."",                date('c'),  'daily',    '1');
		}
        $sitemap->addUrl($site_url.'/login',          date('c'),  'daily',    '0.5');
		$sitemap->addUrl($site_url.'/auth/forgot_password',          date('c'),  'daily',    '0.5');

        // create sitemap
        $sitemap->createSitemap();

        // write sitemap as file
        $sitemap->writeSitemap();

        // update robots.txt file
        $sitemap->updateRobots();

        // submit sitemaps to search engines
        $sitemap->submitSitemap();
		$_SESSION['sitemap'] = TRUE;
		echo "<meta http-equiv='refresh' content='3'>";
        ?>