<?php
/**
 * @Project OF NUKEVIET 4.x
 * @Author NV-HCM (hcm.nukeviet.vn)
 * @Copyright (C) 2011 NV-HCM. All rights reserved
 * @Createdate Oct 22, 2016  11:24:58 AM 
 */

if ( ! defined( 'NV_IS_MOD_FAQ' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];

$id = 0;
if ( ! empty( $array_op[1] ) )
{
    $temp = explode( '-', $array_op[1] );
    if ( ! empty( $temp ) )
    {
        $id = intval( end( $temp ) );
    }
}
$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_rows WHERE id = '" . $id . "' AND status=1 ";
$result = $db->query( $sql );

$data_content = $result->fetch();
if ( empty($data_content) ) die('stop!!');

$page_title = $data_content['title'];

$sql = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_rows SET viewer=viewer+1 WHERE id = '" . $id . "'";
$result = $db->query( $sql );

$data_content['addtime'] = nv_date( "l - d/m/Y  H:i", $data_content['addtime'] );

$data_other = array();
$sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_rows WHERE status=1 AND catid=".$data_content['catid']." AND id!= ".$data_content['id']." ORDER BY RAND() LIMIT 12";
$result = $db->query( $sql );
while ( $row = $result->fetch() )
{
	$data_other[] = $row;
}

$contents = view_faqs($data_content,$data_other);

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );