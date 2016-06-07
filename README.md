# POSLavuSync
Looking for a way to sync an instore digital menu display with our pos system.

I have been looking into the possibility of having our Digital Menu board auto update when an item sells out in the POS system.  My thinking is that you can keep track of the 86 count and when it hits zero you can trigger a script that will either remove or hide that menu item from the server.  Thanks to some help from the Lavu Developers concerning the API, I have worked out how to pull down the menu_items listed as specials and filter them down to what we need, namely the name, id, whether it is being tracked by 86 count and the 86 count itself.  What I haven't yet figured out is how to best use this information to keep the menuboard in sync with the POS system.

- I have my results filtered down to JSON which I could then use to create an array but I don't have much experience with Javascript or Jquery.

- Another thought that crossed my mind was somehow adding this information to a local database and tracking it that way.  

Our filtered JSON looks like this:

{
    "results": {
        "row": [
            {
                "id": "9990",
                "inv_count": "0",
                "name": "HAM AND VEG SOUP",
            },
            {
                "id": "9991",
                "inv_count": "1",
                "name": "ALL AMERICAN CHICK",
            },
            {
                "id": "9992",
                "inv_count": "4",
                "name": "WINGS",
                "track_86_count": "86count",
            },
            {
                "id": "9993",
                "inv_count": "0",
                "name": "FARM58 STIR FRY",
            },
            {
                "id": "9994",
                "inv_count": "0",
                "name": "GROUPER",
            },
            {
                "id": "9995",
                "inv_count": "7",
                "name": "SIRLOIN",
                "track_86_count": "86count",
            },
            {
                "id": "9996",
                "inv_count": "0",
                "name": "CAROLINA QUARTER",
                "track_86_count": "86count",
            }
        ]
    }
}

Each menu_item is assigned a unique id number through the POS system when it is created.  If the item is set to be tracked by 86 count then we see the property of 86count.  I would like to somehow tie the item_id from POSLavu with the item_id on the menuboard.


**  Basically thinking something similiar to this:

If track_86_count=86_count and inv_count=0 then do something.

06/07/16 - I have made progress on getting the data formatted into a more usable form.  I have edited the php script so that it now pulls down the XML from the API, strips out all unused rows, then converts everything to a csv file that we can then compare with our mysql database.  
