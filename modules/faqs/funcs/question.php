<?php

/**
 * @Project OF NUKEVIET 4.x
 * @Author NV-HCM (hcm.nukeviet.vn)
 * @Copyright (C) 2011 NV-HCM. All rights reserved
 * @Createdate Oct 22, 2016  11:24:58 AM 
 */
 
if ( ! defined( 'NV_IS_MOD_FAQ' ) )
{
    die( 'Stop!!!' );
}

if ( ! defined( 'NV_IS_USER' ) )
{
    $redirect = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name."&amp;".NV_OP_VARIABLE."=".$op;
    Header( "Location: " . NV_BASE_SITEURL . "index.php?" . NV_NAME_VARIABLE . "=users&" . NV_OP_VARIABLE . "=login&nv_redirect=" . nv_base64_encode( $redirect ) );
    die();
}

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$table = "".NV_PREFIXLANG . "_" . $module_data . "_rows";
$data = array( 
    "id" => 0, "catid" => 0, "title" => "", "question" => "", "answer" => "",
	"","addtime" => NV_CURRENTTIME, "viewer" => 0,"user_answer"=>0, "user_question" => $user_info['userid'],
	"status" =>0,"alias"=>"","keywords"=>"","edittime"=>NV_CURRENTTIME, "name"=>$user_info['full_name'],"email"=>$user_info['email'],
);

if ( $nv_Request->get_int( 'save', 'post' ) == 1 )
{
	
    $data['catid'] = $nv_Request->get_int( 'catid', 'post', 0 );
    $data['title'] = $nv_Request->get_string( 'title', 'post', '', 0 );
    $alias = $nv_Request->get_string( 'alias', 'post', '' );
    $data['alias'] = ( $alias == "" ) ? change_alias( $data['title'] ) : change_alias( $alias );
    $data['question'] = $nv_Request->get_string( 'question', 'post', '' );
    $code = $nv_Request->get_string( 'fcode', 'post', '' );
	if ( empty( $data['title'] ) ) $error = $lang_module['content_title_error'];
	elseif ( empty( $data['question'] ) ) $error = $lang_module['content_error'];
	elseif ( ! nv_capcha_txt( $code ) )
	{
	    $error = $lang_global['securitycodeincorrect'];
	}
    else
    {
		
        $sql = "SELECT MAX(weight) AS new_weight FROM " . NV_PREFIXLANG . "_" . $module_data . "_rows WHERE catid=" . $data['catid'];
        $result = $db->query($sql);
		$new_weight = $result->fetchColumn();
		$new_weight = ( int )$new_weight;
		++$new_weight;
		$sql = "INSERT INTO " . NV_PREFIXLANG . "_" . $module_data . "_rows VALUES (
		NULL, 
		" . $data['catid'] . ", 
		" . $db->quote($data['title']) . ", 
		" . $db->quote($data['alias']) . ", 
		" . $db->quote($data['question']) . ", 
		'', 
		" . $new_weight . ", 
		0,
		0," . NV_CURRENTTIME . ")";

		if (! $db->insert_id($sql)) {
			$is_error = true;
			$error = $lang_module['errorsave'];
		} else {
			update_keywords($data['catid']);
			Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name);
			exit();
		}
    }
}

$xtpl = new XTemplate( "question.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'TEMPLATE', $module_info['template'] );
$xtpl->assign( 'DATA', $data );
if (!empty($error)) 
{
	$xtpl->assign( 'error', $error );
	$xtpl->parse( 'main.error' );
}
foreach ( $data = $global_faqs_cat as $data )
{
    $data['select'] = ( $data['id'] == $catid ) ? 'selected="selected"' : "";
    $xtpl->assign( 'ROW', $data );
    $xtpl->parse( 'main.loop' );
}
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );