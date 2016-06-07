# sed script to be ran on our csv results.

s/\(.\)/_\l\1/g
s/_//g
s/"//g
s/\b\(.\)/\u\1/g
1 i\ID,Name,Price,Inv_Count,Tracked
s/86count/true/g
