<?php

/**
 * @Project OF NUKEVIET 4.x
 * @Author NV-HCM (hcm.nukeviet.vn)
 * @Copyright (C) 2011 NV-HCM. All rights reserved
 * @Createdate Oct 22, 2016  11:24:58 AM 
 */

if (! defined('NV_IS_MOD_FAQ')) {
    die('Stop!!!');
}

/**
 * theme_main_faq()
 * 
 * @param mixed $list_cats
 * @return
 */
function theme_main_faq($list_cats)
{
    global $global_config, $lang_module, $lang_global, $module_info, $module_name, $module_file;

    $xtpl = new XTemplate("main_page.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file . "/");
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('WELCOME', $lang_module['faq_welcome']);
    $xtpl->parse('main.welcome');

    foreach ($list_cats as $cat) {
        if (! $cat['parentid']) {
            $cat['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $cat['alias'];
            $cat['name'] = "<a href=\"" . $cat['link'] . "\">" . $cat['title'] . "</a>";
            $xtpl->assign('SUBCAT', $cat);
            if (! empty($cat['description'])) {
                $xtpl->parse('main.subcats.li.description');
            }
            $xtpl->parse('main.subcats.li');
        }
    }
    $xtpl->parse('main.subcats');

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * theme_cat_faq()
 * 
 * @param mixed $list_cats
 * @param mixed $catid
 * @param mixed $faq
 * @return
 */
function theme_cat_faq($list_cats, $catid, $faq)
{
    global $global_config, $lang_module, $lang_global, $module_info, $module_name, $module_file;

    $xtpl = new XTemplate("main_page.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file . "/");
    $xtpl->assign('LANG', $lang_module);

    if (! empty($list_cats[$catid]['description'])) {
        $xtpl->assign('WELCOME', $list_cats[$catid]['description']);
        $xtpl->parse('main.welcome');
    }

    if (! empty($list_cats[$catid]['subcats'])) {
        foreach ($list_cats[$catid]['subcats'] as $subcat) {
            $cat = $list_cats[$subcat];
            $cat['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&amp;" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $cat['alias'];
            $cat['name'] = "<a href=\"" . $cat['link'] . "\">" . $cat['title'] . "</a>";
            $xtpl->assign('SUBCAT', $cat);
            if (! empty($cat['description'])) {
                $xtpl->parse('main.subcats.li.description');
            }
            $xtpl->parse('main.subcats.li');
        }
        $xtpl->parse('main.subcats');
    }

    if (! empty($faq)) {
        foreach ($faq as $row) {
            $xtpl->assign('ROW', $row);
            $xtpl->parse('main.is_show_row.row');
        }

        $xtpl->assign('IMG_GO_TOP_SRC', NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_name . '/');

        foreach ($faq as $row) {
            $xtpl->assign('ROW', $row);
            $xtpl->parse('main.is_show_row.detail');
        }

        $xtpl->parse('main.is_show_row');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function view_faqs ( $data_content,$data_other=array() )
{
    global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info,$global_faqs_cat;
    $xtpl = new XTemplate( "view.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
    $xtpl->assign( 'TEMPLATE', $module_info['template'] );
    $xtpl->assign( 'DATA', $data_content );
    if ( !empty($data_content['otherpath']) ) $xtpl->parse( 'main.linko' );
    if ( !empty($data_content['file_src']) ) $xtpl->parse( 'main.file' );
    if ( !empty($data_content['embed']) ) $xtpl->parse( 'main.embed' );
    if ( !empty($global_faqs_cat[$data_content['catid']]) ) 
    {
    	$xtpl->assign( 'cat_title', $global_faqs_cat[$data_content['catid']]['title'] );
    	$xtpl->assign( 'cat_link', $global_faqs_cat[$data_content['catid']]['link'] );
    }
    if (!empty($data_other))
    {
    	foreach ( $data_other as $row )
        {
            $row['link'] = NV_BASE_SITEURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=view/" . $row['alias'] . "-" . $row['id'];
            $row['addtime'] = nv_date( "l - d/m/Y  H:i", $row['addtime'] );
            $xtpl->assign( 'ROW', $row );
            $xtpl->parse( 'main.loop' );
        }
    }
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}
