<?php
if (!defined("allow entry"))
	require('hackingattempt.php');

function showRates() {
	echo
<<<EOD
<p>Although we strive to be as faithful to the classic versions of MapleStory, we do have higher EXP, meso, and drop rates than the official server did when v0.62 was out.</p>
<p>Drop rates are higher because finding the drop chances for each individual drop for each monster is an imperfect science, so we increased the chance of any item dropping so it's not so obvious when, say Slime Bubbles and Squishy Liquids are equally rare, because they both now drop all the time. We cannot easily extract this info from any source since clients do not hold the drop data for monsters - they are only stored on Nexon's servers, which, for obvious reasons, will not reveal the stats to us no matter what. Drop chances are interpolated based on data collected from hours of playing on Nexon's service.</p>
<p>Likewise, meso ranges are also not available on clients, so meso rates have to be increased so the errors are not as perceptible. Though sites like Hidden-Street.net have player-collected meso ranges available, a web scraping solution will be kludgy as it will have to be updated whenever the site layout is updated and will fail when the site is unavailable. Downloading and processing a webpage is simply too slow for on-demand fetching, and Hidden-Street will notice a huge bandwidth usage for one IP address, a questionable act for recurring cases, if we were to process all the data at once and store it somewhere locally (this will also waste space for monsters that are either unpopular or monsters that Nexon inserted into client data, but cannot actually be found on any maps, not to mention that data will not be kept up to date and will have to be updated frequently).</p>
<p>EXP ranges had to be increased because of these reason, since it wouldn't make sense for players to collect more items and mesos at a certain level than when they would pick up on the official v0.62 service. As a result, gameplay is generally accelerated compared to the official service, but is still decently balanced. In addition, no one can deny that the official v0.62 was a grindfest, so we made it a bit easier for players used to the faster leveling in post-Big Bang MapleStory to adjust, and easier to stay competitive with other "GMS-like" private servers.</p>
EOD;
}
?>