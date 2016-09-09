<?php

/**
 * MediaWiki Chklist extension
 *
 * @file
 * @ingroup Extensions
 * @version 0.1.2
 * @author Shadowritter
 * @link http://www.mediawiki.org/wiki/Extension:Chklist Documentation and http://www.shadowritter.net
 */
 
if ( !defined( 'MEDIAWIKI' ) ) {
   die( "This is not a valid entry point to MediaWiki.\n" );
}
 
// Extension credits that will show up on Special:Version
$wgExtensionCredits['parserhook'][] = array(
   'path' => __FILE__,
   'name' => 'Chklist',
   'version' => '0.1.1',
   'author' => array( 'Shadowritter', ),
   'description' => 'Add checkbox on your wiki page',
   'url' => 'https://www.mediawiki.org/wiki/Extension:Chklist',
);

$wgExtensionFunctions[] = "chkList";
 
function chkList()
{
  global $wgParser;
  $wgParser->setHook( "chklist", "create_list" );
}
 
function create_list($input)
{
  $i = 1;
  $temp = explode('[', $input);
  $str = "";
  while ($temp[$i] != NULL)
  {
    $isCheck = "";
    $content = explode(']', $temp[$i++]);
				
    // If array key begin with x then input is checked
    if (substr($content[0], 0, 1) == 'x')
      $isCheck = "checked";
					
    $str .= "<div><input disabled type='checkbox'" . $isCheck . ">" . $content[1] . "</div>";
  }
  return $str;
}
