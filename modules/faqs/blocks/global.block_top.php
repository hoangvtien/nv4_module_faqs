<?php
/**
 * @Project OF NUKEVIET 4.x
 * @Author NV-HCM (hcm.nukeviet.vn)
 * @Copyright (C) 2011 NV-HCM. All rights reserved
 * @Createdate Oct 22, 2016  11:24:58 AM 
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if ( ! nv_function_exists( 'nv_faqs_top' ) )
{
    function nv_block_config_faqs_top ( $module, $data_block, $lang_block )
    {
        global $db, $language_array, $site_mods;
        $mod_data = $site_mods[$module]['module_data'];
        $html = "";
        $html .= "<tr>";
        $html .= "	<td>" . $lang_block['num'] . "</td>";
        $html .= "	<td><input type=\"text\" name=\"config_num\" size=\"5\" value=\"" . $data_block['num'] . "\"/></td>";
        $html .= "<td></tr>";
        return $html;
    }
    function nv_block_config_faqs_top_submit ( $module, $lang_block )
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
        $return['config']['num'] = $nv_Request->get_int( 'config_num', 'post', 0 );
        return $return;
    }
    function nv_faqs_top ( $block_config )
    {
        global $module_info, $site_mods, $db, $global_config;
        $module = $block_config['module'];
        $mod_data = $site_mods[$module]['module_data'];
        $mod_file = $site_mods[$module]['module_file'];
        $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $mod_data . "_rows WHERE status=1 ORDER BY viewer ASC LIMIT 0," . $block_config['num'];
        $result = $db->query( $sql );

        if ( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/" . $mod_file . "/block_top.tpl" ) )
        {
            $block_theme = $global_config['site_theme'];
        }
        else
        {
            $block_theme = "default";
        }
        // Ket noi ngon ngu cua module
		if (file_exists(NV_ROOTDIR . '/modules/' . $block_config['module'] . '/language/block.global.block_top_' . NV_LANG_INTERFACE . '.php')) {
			require NV_ROOTDIR . '/modules/' . $block_config['module'] . '/language/block.global.block_top_' . NV_LANG_INTERFACE . '.php';
		} elseif (file_exists(NV_ROOTDIR . '/modules/' . $block_config['module'] . '/language/en.php')) {
			require NV_ROOTDIR . '/modules/' . $block_config['module'] . '/language/en.php';
		}
        $xtpl = new XTemplate( "block_top.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/" . $mod_file );
        $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
        $xtpl->assign( 'THEME', $block_theme );
        $xtpl->assign( 'LANG', $lang_block );
        while ( $data = $result->fetch() )
        {
            $data['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module . "&amp;" . NV_OP_VARIABLE . "=view/" . $data['alias'] . "-" . $data['id'] . "";
            $data['addtime'] = nv_date( "l - d/m/Y  H:i", $data['addtime'] );
            $xtpl->assign( 'ROW', $data );
			$xtpl->assign( 'ADDQ', NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module . "&amp;" . NV_OP_VARIABLE . "=question" );
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
    $content = nv_faqs_top( $block_config );
}
