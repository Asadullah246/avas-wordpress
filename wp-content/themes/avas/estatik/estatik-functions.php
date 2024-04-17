<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
*/

global $tx;

/* ---------------------------------------------------------
  Estatik Functions
------------------------------------------------------------ */

/* ----------------------------------------------------------------
    Estatik archive page Sidebar / No Sidebar
----------------------------------------------------------------- */
if(!function_exists('tx_estatik_sidebar_no_sidebar')) :
  function tx_estatik_sidebar_no_sidebar() {
    if (class_exists('ReduxFramework')) {
      global $tx;
      if($tx['estatik-sidebar-select'] == null || $tx['estatik-sidebar-select'] == 'estatik-sidebar-none') {
        echo 12;
      } else {
       echo 8;
      }
    }else{
      echo 8;
    }

  }
endif;

/* ----------------------------------------------------------------
    Estatik single page Sidebar / No Sidebar
----------------------------------------------------------------- */
if(!function_exists('tx_estatik_single_sidebar_no_sidebar')) :
  function tx_estatik_single_sidebar_no_sidebar() {
    if (class_exists('ReduxFramework')) {
      global $tx;
      if($tx['estatik-single-sidebar-select'] == null || $tx['estatik-single-sidebar-select'] == 'estatik-single-sidebar-none') {
        echo 12;
      } else {
       echo 8;
      }
    }else{
      echo 8;
    }

  }
endif;