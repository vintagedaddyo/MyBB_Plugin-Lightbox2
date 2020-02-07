<?php
/*
 * MyBB: Lightbox2
 *
 * File: lightbox2.php
 * 
 * Authors: Sebastian Wunderlich & Vintagedaddyo
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.6
 * 
 */

// Disallow direct access to this file for security reasons

if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$plugins->add_hook("pre_output_page","lightbox2");

function lightbox2_info()
{
    global $lang;

    $lang->load("lightbox2");
    
    $lang->lightbox2_Desc = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' .
        '<input type="hidden" name="cmd" value="_s-xclick">' . 
        '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' .
        '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
        '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' .
        '</form>' . $lang->lightbox2_Desc;

    return Array(
        'name' => $lang->lightbox2_Name,
        'description' => $lang->lightbox2_Desc,
        'website' => $lang->lightbox2_Web,
        'author' => $lang->lightbox2_Auth,
        'authorsite' => $lang->lightbox2_AuthSite,
        'version' => $lang->lightbox2_Ver,
        'compatibility' => $lang->lightbox2_Compat
    );
}


function lightbox2($page)
{
	global $mybb,$db;
	if(THIS_SCRIPT=="showthread.php")
	{
		$result=$db->simple_select("threads","fid","tid='".intval($mybb->input["tid"])."'",array("limit"=>1));
		$thread=$db->fetch_array($result);
		$permissions=forum_permissions($thread["fid"]);
		if(!empty($thread)&&$permissions["candlattachments"]==1)
		{
			$page=str_replace("</head>",'<link rel="stylesheet" type="text/css" href="'.$mybb->settings["bburl"].'/themes/lightbox2/lightbox.css" />
<script type="text/javascript" src="'.$mybb->settings["bburl"].'/jscripts/lightbox2/lightbox.js"></script>
</head>',$page);
			$page=preg_replace('/\<a href="attachment.php\?aid=([0-9]+)" target="_blank"\>\<img/Usi','<a href="attachment.php?aid=$1" rel="lightbox[tid'.intval($mybb->input["tid"]).']"><img',$page);
			return $page;
		}
	}
    if(THIS_SCRIPT=="portal.php")
    	{

		{
			$page=str_replace("</head>",'<link rel="stylesheet" type="text/css" href="'.$mybb->settings["bburl"].'/themes/lightbox2/lightbox.css" />
<script type="text/javascript" src="'.$mybb->settings["bburl"].'/jscripts/lightbox2/lightbox.js"></script>
</head>',$page);
			$page=preg_replace('/\<a href="attachment.php\?aid=([0-9]+)" target="_blank"\>\<img/Usi','<a href="attachment.php?aid=$1" rel="lightbox[tid'.intval($mybb->input["tid"]).']"><img',$page);
			return $page;
		}
	}
}

?>