<?php
require_once('magpierss/rss_fetch.inc');
$previous_items = "1"; //There can only be one
define('MAGPIE_CACHE_ON', 0); //Tell Magpie not to cache
define('MAGPIE_CACHE_AGE', 0); //Mo cache mo problems
$loopcount=1;
while ($title != "#roflbot *exit*") { //kill command

$url = "http://search.twitter.com/search.atom?q=roflbot"; //what are we looking for
$num_items = 1;
$rss = fetch_rss($url);
$items = array_slice($rss->items, 0, $num_items);
echo "...";

// Open last logfile as array so we can check for duplicates //$previous_items = file('rsslogs.txt');
$current_items = array();

foreach ($items as $item) {
$href = $item['link'];
$title = $item['title']; //Really we just care about title but meh
$desc = $item['description']; //just incase we define link and description
$item_checksum = $title; // Use an MD5 hash of the link as unique identifier
// Actually we're not using an MD5 now and I forget why tongue.gif

//echo "..debug: " . $title . $desc . "..";




if ($loopcount >= 30) { //no activity for 5 minutes
echo "I've been idle too long. Doing something new. ";
$bored = rand(1,10);
echo "Randomly picked " . $bored . "\n";
//This is so nasty its not even funny. I had previously done a switch(rnd(1,10)) with cases to set $title but it failed and I ran out of time. Nasty nasty hack job.
if ($bored == 1) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=6 -G > output.txt");
echo "\nCry";
$loopcount=0;
}
if ($bored == 2) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=7 -G > output.txt");
echo "\nSleep";
$loopcount=0;
}
if ($bored == 3) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=14 -G > output.txt");
echo "\nExplode";
$loopcount=0;
}
if ($bored == 4) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=10 -G > output.txt");
echo "\nDance";
$loopcount=0;
}
if ($bored == 5) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=9 -G > output.txt");
echo "\nLove";
$loopcount=0;
}
if ($bored == 6) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=8 -G > output.txt");
echo "\nEat";
$loopcount=0;
}
if ($bored == 7) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=11 -G > output.txt");
echo "\nFight";
$loopcount=0;
}
if ($bored == 8) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=12 -G > output.txt");
echo "\nFail";
$loopcount=0;
}
if ($bored == 9) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=13 -G > output.txt");
echo "\nDrink";
$loopcount=0;
}
if ($bored == 10) {
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=5 -G > output.txt");
echo "\nBlink";
$loopcount=0;
}
}











if ($item_checksum != $previous_items) //if this is a new command
{
//echo "\nNew command: " . $title; //turn off when not debugging
//echo "\n\nTitle=" . $title;
switch ($title) { //process commands
case "roflbot dance":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=10 -G > output.txt");
echo "\nDance";
$loopcount=0;
break;
case "roflbot love":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=9 -G > output.txt");
echo "\nLove";
$loopcount=0;
break;
case "roflbot feed":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=8 -G > output.txt");
echo "\nFeed";
$loopcount=0;
break;
case "roflbot eat":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=8 -G > output.txt");
echo "\nEat";
$loopcount=0;
break;
case "roflbot sleep":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=7 -G > output.txt");
echo "\nSleep";
$loopcount=0;
break;
case "roflbot cry":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=6 -G > output.txt");
echo "\nCry";
$loopcount=0;
break;
case "roflbot fight":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=11 -G > output.txt");
echo "\nFight";
$loopcount=0;
break;
case "roflbot attack":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=11 -G > output.txt");
echo "\nAttack";
$loopcount=0;
break;
case "roflbot fail":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=12 -G > output.txt");
echo "\nFail";
$loopcount=0;
break;
case "roflbot tweet":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=12 -G > output.txt");
echo "\nTweet";
$loopcount=0;
break;
case "roflbot drink":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=13 -G > output.txt");
echo "\nDrink";
$loopcount=0;
break;
case "roflbot drunk":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=13 -G > output.txt");
echo "\nDrunk";
$loopcount=0;
break;
case "roflbot party":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=13 -G > output.txt");
echo "\nParty";
$loopcount=0;
break;
case "roflbot explode":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=14 -G > output.txt");
echo "\nExplode";
$loopcount=0;
break;
case "roflbot die":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=14 -G > output.txt");
echo "\nDie";
$loopcount=0;
break;
case "roflbot gtfo":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=14 -G > output.txt");
echo "\nGTFO";
$loopcount=0;
break;
case "roflbot blink":
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=play -d item=5 -G > output.txt");
echo "\nBlink";
$loopcount=0;
break;
} //end case
} else { /*echo "\nWaiting for new command";*/ }

echo " " . $loopcount;

// Add this item to the new log //$current_items[] = $item_checksum."\n";
$previous_items = $item_checksum;
} // end for each $items as $item

sleep ("10");
$loopcount=$loopcount+1;
} // end while
system("curl --connect-timeout 3 127.0.0.1:8080/old/ -d control=shutdown -G > output.txt");
?>
