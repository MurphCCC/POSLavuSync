<html>
<head>
<style>
ul, li {list-style: none;}
li.post_id {display: none;}

li.menu_item_name {
    font-size: 3em;
    text-align: center;
}
li.menu_item_description {
    font-size: 2em;
}
.menu_container {
    width: 50%;
    padding-left: 25%;
}
span.menu_item_price {
    position: relative;
    float: right;
    top: -1.5em;
    font-size: 1.5em;
    font-weight: 700;
}
img {width:75%; height:50%;}
</style>
</head>

<ul class='specials_menu'>
        <?php
            $con = new mysqli("localhost","root", "N0bigdeal", "wordpress");

            $execItems = $con->query("SELECT * FROM `img_temp`");


            while($infoItems = $execItems->fetch_array()){
                echo    "
				<div class='menu_container'>
                                <li class='post_id'>".$infoItems['id']."</li>
                                <li class='menu_item_name'>".$infoItems['post_title']."</li>
				<li id='featured_image' class='featured_image'><img src='http://m58cafe.calvarychatt.com/wp-content/uploads/".$infoItems['thumbnail_url']."'></li></div>
				<span class='menu_item_price'>$".$infoItems['price']."</span>
                                <li class='menu_item_description'>".$infoItems['post_content']."</li>
				</div><!-- /container -->
                            </ul>
                        ";

            }

        ?>
    </tbody>
</table>
