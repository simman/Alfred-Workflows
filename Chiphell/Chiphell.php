<?php
/**
 *  Chiphell For Alfred Workflows
 *  @author simman
 *  @copyright simman.cc
 */
require_once('workflows.php');
$wf = new Workflows();
$orig = intval("{query}");

$chh_url = "http://www.chiphell.com/forum.php?fid=".$orig."&mod=rss";

$data = $wf->request( $chh_url );
$xml = simplexml_load_string($data);
$result_data_array = $xml->channel;

foreach ($result_data_array->item as $val)
{
	$icon = "icon.png";
	$wf->result( $int++.'.'.time(), $val->link , $val->title, 'author:'.$val->author.'    pubDate:'.$val->pubDate, $icon );
}

if ( count( $result_data_array->item ) == 0 ):
    $wf->result( 'Chiphell_500', '请确保指令和网络链接正常', '没有响应，请再试一次。', '请确保指令和网络链接正常', 'icon.png' );
endif;

echo $wf->toxml();


//$first_channel = array(
//				array(
//					array('name' => '电脑', 'id' => 'gid=3')
//					array('name' => '业界新闻', 'id' => 'fid=80')
//					array('name' => 'CPU/内存/主板/超频', 'id' => 'fid=36')
//					array('name' => '顶级图形卡', 'id' => 'fid=4')
//					array('name' => '散热器/机箱/电源', 'id' => 'fid=42')
//					array('name' => '水冷/MOD', 'id' => 'fid=127')
//					array('name' => '外设', 'id' => 'fid=147')
//					array('name' => 'NAS/SSD/HDD', 'id' => 'fid=103')
//					array('name' => '硬件Show', 'id' => 'fid=53')
//					array('name' => '新手装机', 'id' => 'fid=41')
//					),
//				array(array('name' => '掌设', 'id' => 'gid=186')),
//				array(array('name' => '摄影', 'id' => 'gid=101')),
//				array(array('name' => '汽车', 'id' => 'gid=174')),
//				array(array('name' => '单车', 'id' => 'gid=169')),
//				array(array('name' => '模型', 'id' => 'gid=179')),
//				array(array('name' => '败家', 'id' => 'gid=210')),
//				array(array('name' => '视听', 'id' => 'gid=238')),
//				array(array('name' => '美食', 'id' => 'gid=240')),
//				array(array('name' => '生活区', 'id' => 'gid=15')),
//				array(array('name' => '硬件交易区', 'id' => 'gid=72'))
//);

