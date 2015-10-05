<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty number_format modifier plugin
 *
 * Type:     modifier
 * Name:     number_format
 * Purpose:  format number via Format_Number in phprechnung.inc.php
 */

function smarty_modifier_number_format($number)
{
	return Format_Number($number);
}

/* vim: set expandtab: */

?>
