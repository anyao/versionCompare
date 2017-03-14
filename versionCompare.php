<?php
function versionCompare($a, $b)
{	
	// a,b已存在、非空字符串或者非零
	if (empty($a) || empty($b)) 
		return "errmsg：不可为空。";

	// 字符串必须为用'.'隔开的数字串
	$rule = "/^\d+(\.\d+)*$/";
	$aMat = preg_match($rule, $a);
	$bMat = preg_match($rule, $b);
	if (!$aMat || !$bMat) 
		return "errmsg: 必须为用'.'隔开的数字串。";

    // 移除最后的.0
    $a = explode(".", rtrim($a, ".0")); 
    $b = explode(".", rtrim($b, ".0")); 

    foreach ($a as $depth => $aVal)
    { 
        if (isset($b[$depth])){ 
            if ($aVal > $b[$depth]) return '>'; 
            else if ($aVal < $b[$depth]) return '<';
        }else{
            return '>'; 
        }
    }
    return (count($a) < count($b)) ? '<' : '=';
} 

// test1 a=1.0.0 b=1
echo "1.0.0".versionCompare('1.0.0', '1')."1<br/>";

// test2 a=7.10.2 b=7.2.10
echo "7.10.2".versionCompare('7.10.2', '7.2.10')."7.2.10<br/>";

// test3 a=abc b=7.8.9.10
echo "这个应该是错的--".versionCompare('abc', '7.8.9.10')."<br/>";

//test4 a="" b=1.2.4
echo "这个也应该是错的--".versionCompare('', '1.2.4')."<br/>";

//正确格式的版本号 a=1.2.4 b=6.5.6
echo "1.2.4".versionCompare('1.2.4', '6.5.6')."6.5.6<br/>";
?>