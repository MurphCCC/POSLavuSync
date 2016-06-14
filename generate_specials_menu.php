<?php
	$db = mysqli_connect('host','user','password','db')
        or die('Error connecting to server.');


$initial_dump = "SELECT post_title, inv_count, track, post_content, meta_value, price FROM wp_posts table1 LEFT JOIN wp_postmeta table2 ON table1.id = table2.post_id AND post_type = 'erm_menu_item' AND track = 1 AND inv_count >=1 AND meta_key = '_thumbnail_id' WHERE meta_value IS NOT NULL INTO OUTFILE '/tmp/img_temp.csv' FIELDS TERMINATED BY ':'";
$update = "UPDATE img_temp a, wp_postmeta b SET a.thumbnail_url = b.meta_value WHERE b.meta_key = '_wp_attached_file' AND b.post_id = a.id";
$db->query($initial_dump);

	shell_exec('/usr/bin/mysqlimport -u user -pPASSWORD -h HOST --fields-terminated-by=: --verbose --local wordpress /tmp/img_temp.csv');

$db->query($update);
//	shell_exec('rm /tmp/img_temp.csv')

?>

<?php
//Flush our temporary table and terminate connection
//$flush = "TRUNCATE TABLE lavu_temp";

//$db->query($flush);


$db->close();
?>
