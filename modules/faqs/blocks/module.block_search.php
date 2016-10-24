<?php
/**
 * @Project OF NUKEVIET 4.x
 * @Author NV-HCM (hcm.nukeviet.vn)
 * @Copyright (C) 2011 NV-HCM. All rights reserved
 * @Createdate Oct 22, 2016  11:24:58 AM 
 */
if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if ( ! nv_function_exists( 'nv_faqs_search' ) )
{
    function nv_faqs_search ( $block_config )
    {
        global $global_config, $module_name,$module_file,$module_data,$lang_module,$global_faqs_cat,$nv_Request;
        $mod_data = $module_data;
        $mod_file = $module_file;
        $q = $nv_Request->get_string( 'q', 'get', '' );
        $catid = $nv_Request->get_string( 'catid', 'get', '' );
        if ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/" . $mod_file . "/block_search.tpl" ) )
        {
            $block_theme = $global_config['site_theme'];
        }
        else
        {
            $block_theme = "default";
        }
        $xtpl = new XTemplate( "block_search.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/" . $mod_file );
        $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
        $xtpl->assign( 'THEME', $block_theme );
        $xtpl->assign( 'LANG', $lang_module );
        $xtpl->assign( 'q', $q );
        $xtpl->assign( 'question', "" . NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=question" );

        foreach ( $data = $global_faqs_cat as $data )
        {
        	$data['select'] = ( $data['id'] == $catid )? 'selected="selected"' : "";
        	$xtpl->assign( 'ROW', $data );
            $xtpl->parse( 'main.loop' );
        }
        $xtpl->parse( 'main' );
        return $xtpl->text( 'main' );
    }
}

if ( defined( 'NV_SYSTEM' ) )
{
    global $site_mods, $module_name;
    $module = $block_config['module'];
    $content = nv_faqs_search( $block_config );
}
