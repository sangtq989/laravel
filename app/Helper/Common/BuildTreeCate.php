<?php 
namespace App\Helper\Common;
/**
 * 
 */
class BuildTreeCate  
{
	public static function layoutTreeCategory($categories = [])
	{
		//xu ly buildTree categories
		$data=[];
		$arrCheck=[];
		//xu ly tree cap 0
		foreach ($categories as $key => $val) {
			if ($val['parrent_id'] ==0 ) {
				$arrCheck[]=$val['id'];
				$val['subChilds'] = [];
				$data[$val['id']] = $val;
			}
		}
		//xu ly tree cap 1
		foreach ($categories as $k => $item) {
			// if (!in_array($item['id'], $arrCheck)) {
				//lay ra nhung du lieu ko bi trung voi cha cua no
				if ($item['parrent_id'] > 0) {
					if (isset($data[$item['parrent_id']])) {
						//kiem tra lai 1 lan nua la co ton tai con nam trong khong cua tree cap 0
						$arrCheck = $item['id'];
						$item['subChilds'] = [];
						$data[$item['parrent_id']]['subChilds'][$item['id']] =$item;
					}
				}
			
		}
		return $data;
	}
}