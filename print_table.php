<?php
function get_profile_detail() {
	$detail = array(
      'ID' =>  '卡片ID' ,
      'Name' =>  '卡片名字' ,
      'Player' =>  '卡片拥有者' ,
      'Occupation' =>  '职业',
      'Age' =>  '年龄' ,
      'Sex' =>  '性别' ,
      'Residence' =>  '住处' ,
      'Birthplace' =>  '出生地' ,
      'STR' =>  '力量' ,
      'CON' =>  '体质',
      'SIZ' =>  '体型',
      'DEX' =>  '敏捷',
      'APP' =>  '外貌' ,
      'INTT' =>  '智力' ,
      'POWW' =>  '意志' ,
      'EDU' =>  '教育',
      'LUCK' =>  '幸运' ,
      'MOV' =>  '移动力' ,
      'HP' =>  '生命值' ,
      'MP' =>  '魔法值' ,
      'SAN' =>  '理智值' ,
      'Accounting' =>  '会计' ,
      'Anthropology' =>  '人类学' ,
      'Appraise' =>  '估价' ,
      'Archacology' =>  '考古学' ,
      'Art' =>  '艺术' ,
      'Charm' =>  '魅惑' ,
      'Climb' =>  '攀爬' ,
      'CreditRating' =>  '信用评级',
      'CthulhuMythos' =>  '克苏鲁神话',
      'Disguise' =>  '乔装' ,
      'Dodge' =>  '闪避' ,
      'DriveAuto' =>  '汽车驾驶' ,
      'ElecRepair' =>  '电器维修' ,
      'FastTalk' =>  '话术' ,
      'FightingBrawl' =>  '格斗：斗殴' ,
      'FirearmsHandgun' =>  '火器：手枪' ,
      'FirearmRifle' =>  '火器：来复枪' ,
      'FirstAid' =>  '急救' ,
      'History' =>  '历史' ,
      'Intimidate' =>  '恐吓' ,
      'Jump' =>  '跳跃' ,
      'LuanageOther' =>  '语言：其他' ,
      'Luanage' =>  '语言' ,
      'Law' =>  '法律' ,
      'LibraryUse' =>  '图书馆使用' ,
      'Listen' =>  '聆听' ,
      'Locksmith' =>  '锁匠' ,
      'MechRepair' =>  '机械维修' ,
      'Medicine' =>  '医学' ,
      'NaturalWorld' =>  '自然学',
      'Nawigate' =>  '导航' ,
      'Occult' =>  '神秘学' ,
      'HeavyMachine' =>  '操作重型机械' ,
      'Persuade' =>  '说服' ,
      'Pilot' =>  '驾驶' ,
      'Psychology' =>  '心理学' ,
      'Psychoanalysis' =>  '精神分析' ,
      'Ride' =>  '骑术' ,
      'Science' =>  '科学' ,
      'SleightHand' =>  '妙手' ,
      'Survival' =>  '生存' ,
      'Swain' =>  '游泳' ,
      'Throw' =>  '投掷' ,
      'Track' =>  '追踪' ,
      'PD' =>  '个人描述',
      'Belief' =>  '思想与信念',
      'People' =>  '重要之人' ,
      'Location' =>  '意义非凡之地' ,
      'Treasured' =>  '宝贵之物',
      'Trait' =>  '特质' ,
      'Injuries' =>  '伤口和疤痕',
      'Phobias' =>  '恐惧症和狂躁症' ,
      'Spell' =>  '符咒' ,
      'Encounters' =>  '遭遇' ,
      'SpendingLevel' =>  '消费水平' ,
      'Cash' =>  '现金' ,
      'Assets' =>  '资产' ,
      'userID' =>  '用户ID' ,
      'sheetID' =>  '卡片ID' 
      );
        return $detail;
    }
function pretty_table_userdata($table,$start = 0 ,$len =1)
{
	$end = $start + $len;
//	echo $end;
	echo 
	'    <style>
        #div1{
            width: 500px;
        }
        .table {
            width: 50%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .turn{
            word-break: break-all;
        }
    </style>';
    echo '<table border="1" width="700" align="center">';
    echo '<tr bgcolor="#dddddd">';
    	
	$i1 = 0;
	foreach(get_profile_detail() as $value)
	{
		if($i1 >= $start && $i1 < $end) {
			echo "<th>$value</th>";
		}
		$i1++;
	}
	echo "<th>详情</th><th>修改</th><th>删除</th>";
	
//  echo '<th>编号</th><th>姓名</th><th>公司</th><th>地区</th><th>电话</th><th>EMALL</th>';
    echo '</tr>';
    $i2 =0;
    $id = 0;
    foreach ($table as $key=>$value)
    {		
    	echo '<tr>';
	//foreach里面嵌套一个for循环也是可以的
	        /*for($n=0;$n<count($value);$n++)
	        {
	            echo "<td>$value[$n]</td>";
	        }*/
	//foreach里面嵌套foreach
        foreach($value as $mn)
        {
	        if($i2 >= $start && $i2 < $end)
	    	{
				echo "<td>{$mn}</td>";
			}
			$i2++;

        }
        $datail = '<a href = "detail.php?id='.$id.'">详情</a>';
	    $update = '<a href = "update.php?id='.$id.'">修改</a>';
	    $delete = '<a href = "delete.php?id='.$id.'">删除</a>';
	    echo "<td>$datail</td><td>$update</td><td>$delete</td>";
        echo '</tr>';
        $i2 =0;
        $id++;
    }

    echo '</table>';
}
function pretty_table_detail($table,$start = 0 ,$len =1,$id = 0)
{
	$end = $start + $len;
//	echo $end;
	echo 
	'    <style>
        #div1{
            width: 500px;
        }
        .table {
            width: 50%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .turn{
            word-break: break-all;
        }
    </style>';
    echo '<table border="1" width="700" align="center">';
    echo '<tr bgcolor="#dddddd">';
    	
	$i1 = 0;
	foreach(get_profile_detail() as $value)
	{
		if($i1 >= $start && $i1 < $end) {
			echo "<th>$value</th>";
		}
		$i1++;
	}
	
//  echo '<th>编号</th><th>姓名</th><th>公司</th><th>地区</th><th>电话</th><th>EMALL</th>';
    echo '</tr>';
    $i2 =0;
	$i3 =0;
    foreach ($table as $key=>$value)
    {		
    	if($i3!= $id){        $i3++;continue;}
    	echo '<tr>';
	//foreach里面嵌套一个for循环也是可以的
	        /*for($n=0;$n<count($value);$n++)
	        {
	            echo "<td>$value[$n]</td>";
	        }*/
	//foreach里面嵌套foreach
        foreach($value as $mn)
        {
	        if($i2 >= $start && $i2 < $end)
	    	{
				echo "<td>{$mn}</td>";
			}
			$i2++;

        }
        echo '</tr>';
        $i2 =0;

    }

    echo '</table>';
}
?>