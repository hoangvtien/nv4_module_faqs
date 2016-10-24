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

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$page = $nv_Request->get_int("page",'get',0);
$q = $nv_Request->get_string( 'q', 'get', '' );
$catid = $nv_Request->get_string( 'catid', 'get', '' );
$where = "";
$base_url = "" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=" . $op;
$table = "" . NV_PREFIXLANG . "_" . $module_data . "_rows";
if (!empty($q)) $where .= " AND ( title LIKE '%".$q."%' ) OR ( question LIKE '%".$q."%' ) ";
if ($catid>0) $where .= " AND ( catid =".$catid." ) ";
$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . $table . " WHERE status=1 ".$where." ORDER BY id DESC LIMIT " . $page . "," . $per_page;
$result = $db->sql_query( $sql );
$result_all = $db->sql_query( "SELECT FOUND_ROWS()" );
list( $numf ) = $db->sql_fetchrow( $result_all );
$all_page = ( $numf ) ? $numf : 1;
$data_content = array();
$i = $page + 1;
while ( $row = $db->sql_fetchrow( $result, 2 ) )
{
    $row['no'] = $i;
    $data_content[] = $row;
    $i ++;
}
$html_pages = nv_faqs_page2( $base_url, $all_page, $per_page, $page );
$contents = call_user_func( "view_listall", $data_content, $html_pages );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );