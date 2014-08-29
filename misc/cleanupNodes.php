<?php
/**
 * Cleanups old multisite nodes
 */

require_once(dirname(dirname(__FILE__)) . '/engine/start.php');
elgg_set_ignore_access(true);

$user = new minds\entities\user('mark');

$nodes = elgg_get_entities(array('subtype'=>'node', 'limit'=>10000, 'owner_guid'=>$user->guid));
$keep = array('www.word.am');

foreach($nodes as $node){
	$node->delete();
	if(!$node->domain){
		echo "Removing $node->guid - its a dud! \n";
		$node->delete();
		continue;
	}
	echo "$node->domain \n";
	if(in_array($node->domain, $keep)){
		echo "found $node->domain \n";
		continue;
	}

}