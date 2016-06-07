## Simple PHP script to query the LavuPOS API and return one of our menus.  This script will query the main Menu_Items ## table and return the column containing our featured specials.  As you can see from the post variables we are honing ## in on the Category_id column with the id of 112.  This is the one that contains our featured specials.  This 
## information can be further obtained via trial and error.  I had some help from the development team in order to find ## this information.  
## 
## The API is set to return the results in xml format, we will save that to a file and then run some server side 
## scripts to further process it.

<?php
        $file = "results.xml";
	$header = "<?xml version='1.0' encoding='UTF-8'?>";
        $api_url = "https://api.poslavu.com/cp/reqserv/";
        $api_dataname = [api_dataname];
        $api_key = [api_key];
        $api_token = [api_token];

        $postvars = "dataname=$api_dataname&key=$api_key&token=$api_token";
        $postvars .= "&table=menu_items&column=category_id&value=112&valid_xml=1";

        function display_api_response($str)
        {
		$str = str_replace("<","&lt;",$str);
                $str = str_replace(">","&gt;",$str);
                $str = str_replace("\n","<br>",$str);
                $str = str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$str);
                return $str;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        $response = curl_exec($ch);
        curl_close ($ch);

	echo display_api_response($response);
	file_put_contents($file, $response);
	
	shell_exec('cat results.xml | sed -f pre.sed > filtered.xml');
?>

<?php
if (file_exists($filtered)) {
    $xml = simplexml_load_file($filtered);
$f = fopen('results.csv', 'w');
foreach ($xml->row as $row) {
    fputcsv($f, get_object_vars($row),',','"');
}
fclose($f);
}

        shell_exec('cat results.csv | sed -f post.sed > final.csv');
        shell_exec('rm results.* filtered.xml');
?>
