# Bringing everything together

#!/bin/bash

dir=[script_directory]

#Run our php script to pull down the featured specials table and save it as an xml file

/usr/bin/php $dir/fetch.php;
sleep 2;

#Convert our xml to json and prettify it
/usr/local/bin/xml2json --input $dir/results.xml --output $dir/results.json --pretty;
sleep 2;

#Run our Json through sed to strip out everything we don't need.

cat $dir/results.json | sed -f $/dir/script.sed > sortedresults;
sleep 2;

#Now make sure we clean up after ourselves.

rm $dir/results.*
