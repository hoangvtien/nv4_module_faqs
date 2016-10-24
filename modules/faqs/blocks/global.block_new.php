<?php
/**
 * @Project OF NUKEVIET 4.x
 * @Author NV-HCM (hcm.nukeviet.vn)
 * @Copyright (C) 2011 NV-HCM. All rights reserved
 * @Createdate Oct 22, 2016  11:24:58 AM 
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if ( ! nv_function_exists( 'nv_faqs_new' ) )
{
    function nv_faqs_new ( $block_config )
    {
        global $module_info, $site_mods, $db, $global_config;
		// Ket noi ngon ngu cua module
		if (file_exists(NV_ROOTDIR . '/modules/' . $block_config['module'] . '/language/block.global.block_new_' . NV_LANG_INTERFACE . '.php')) {
			require NV_ROOTDIR . '/modules/' . $block_config['module'] . '/language/block.global.block_new_' . NV_LANG_INTERFACE . '.php';
		} elseif (file_exists(NV_ROOTDIR . '/modules/' . $block_config['module'] . '/language/en.php')) {
			require NV_ROOTDIR . '/modules/' . $block_config['module'] . '/language/en.php';
		}
        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];
        $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $mod_data . "_rows WHERE status=1 ORDER BY id DESC LIMIT 1";
        $result = $db->query( $sql );
        
        if ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/" . $mod_file . "/block_new.tpl" ) )
        {
            $block_theme = $global_config['site_theme'];
        }
        else
        {
            $block_theme = "default";
        }
        $xtpl = new XTemplate( "block_new.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/" . $mod_file );
        if ( file_exists(NV_ROOTDIR . '/modules/' . $mod_file . '/language/'.NV_LANG_DATA.'.php')) 
        {
        	require_once ( NV_ROOTDIR . '/modules/' . $mod_file . '/language/'.NV_LANG_DATA.'.php' );
        }
        $xtpl->assign( 'LANG', $lang_block );
        $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
        $xtpl->assign( 'THEME', $block_theme );
        while ( $data = $result->fetch() )
        {
            $data['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module . "&amp;" . NV_OP_VARIABLE . "=view/" . $data['alias'] . "-" . $data['id'] . "";
            $data['question'] = nv_clean60( $data['question'], 160 );
            $data['title1'] = nv_clean60( $data['title'], 60 );
			$data['addtime'] = nv_date( "l - d/m/Y  H:i", $data['addtime'] );
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
    $content = nv_faqs_new( $block_config );
}