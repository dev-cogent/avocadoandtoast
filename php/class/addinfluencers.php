<?php

class addInfluencers
{
    
/**
 * [string] $campaignid, [array] influencerinfo. Adding the influnecers to an exisitng campaign. 
 * @param string $campaignid
 * @param array[] $influencerinfo
 * @return bool
 *
 */
    public function addInfluencersToCampaign($campaignid, $influencerinfo)
    {
        $conn = $this->savedDB();
        //array information   array_key   array_info
        foreach ($influencerinfo as $influencerid => $info) {
            $stmt = $conn->prepare("INSERT INTO `$campaignid` (`influencer_id`,`instagram_post`,`instagram_impressions`,`instagram_engagement`,
                            `twitter_post`,`twitter_impressions`,`twitter_engagement`,
                            `facebook_post`,`facebook_impressions`,`facebook_engagement`) 
                            VALUES (?,?,?,?,?,?,?,?,?,?)
                            ON DUPLICATE KEY UPDATE 
                            `instagram_post` = VALUES(instagram_post),
                            `instagram_impressions` = VALUES(instagram_impressions),
                            `instagram_engagement` = VALUES(instagram_engagement),
                            `twitter_post` = VALUES(twitter_post),
                            `twitter_impressions` = VALUES(twitter_impressions),
                            `twitter_engagement` = VALUES(twitter_engagement),
                            `facebook_post` = VALUES(facebook_post),
                            `facebook_impressions` = VALUES(facebook_impressions),
                            `facebook_engagement` = VALUES(facebook_engagement)");
                $stmt->bind_param('ssssssssss', $influencerid, $info['instagrampost'], $info['instagramimpressions'], $info['instagramengagement'],
                                   $info['twitterpost'], $info['twitterimpressions'], $info['twitterengagement'],
                                   $info['facebookpost'], $info['facebookimpressions'], $info['facebookengagement']);

            if ($stmt->execute() === false) {
                
                return false;
            }
                unset($stmt);
        }
        unset($conn);
        $update = $this->createStats($campaignid);
        if ($update === true) {
            return true;
        } else {
            return false;
        }
    }


/**
 * [string] campaignid Creating new stats for the campaign. This includes all total platform impressions, engagement, and posts function
 * @param string $campaignid
 * @return bool
 */
    public function createStats($campaignid)
    {
        $campaignstats = array();
        $conn = $this->savedDB();
        $stmt = $conn->prepare("SELECT `influencer_id`,`instagram_post`,`instagram_impressions`,`instagram_engagement`,
                                `twitter_post`,`twitter_impressions`,`twitter_engagement`,
                                `facebook_post`,`facebook_impressions`, `facebook_engagement` FROM `$campaignid`");
        $stmt->execute();
        $stmt->bind_result($id, $instagrampost, $instagramimp, $instagrameng,
                        $twitterpost, $twitterimp, $twittereng,
                        $facebookpost, $facebookimp, $facebookeng);
        while ($stmt->fetch()) {
            $campaignstats['total_instagram_impressions'] += $instagramimp;
            $campaignstats['total_instagram_engagement'] += $instagrameng;
            $campaignstats['total_twitter_impressions'] += $twitterimp;
            $campaignstats['total_twitter_engagement'] += $twittereng;
            $campaignstats['total_facebook_impressions'] += $facebookimp;
            $campaignstats['total_facebook_engagement'] += $facebookeng;
            $campaignstats['total_impressions'] += $instagramimp + $twitterimp + $facebookimp;
            $campaignstats['total_engagement'] += $instagrameng + $twittereng + $facebookeng;
            $campaignstats['total_post'] += $instagrampost + $twitterpost + $facebookpost;
        }
        unset($conn);
        $update = $this->updateStats($campaignid, $campaignstats);
        if ($update === true) {
            return true;
        } else {
            return false;
        }
    }


/**
 * updateStats function
 *
 * @param string $campaignid
 * @param array $stats
 * @return bool
 */
    public function updateStats($campaignid, $stats)
    {
        $conn = $this->dbinfo();
        $stmt = $conn->prepare("UPDATE `campaign_save_link` SET 
                    `total_instagram_impressions` = ?,
                    `total_twitter_impressions` = ?,
                    `total_facebook_impressions` = ?,
                    `total_impressions` = ?,
                    `total_instagram_engagement` = ?,
                    `total_twitter_engagement` = ?,
                    `total_facebook_engagement` = ?,
                    `total_engagement` = ?,
                    `total_post` = ? 
                     WHERE `campaign_id` = ? ");

        $stmt->bind_param('ssssssssis', $stats['total_instagram_impressions'], $stats['total_twitter_impressions'], $stats['total_facebook_impressions'], $stats['total_impressions'],
                               $stats['total_instagram_engagement'], $stats['total_twitter_engagement'], $stats['total_facebook_engagement'],
                               $stats['total_engagement'], $stats['total_post'], $campaignid);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }






/**
*@param none
*@return array $conn - database connection
*/
    public function dbinfo()
    {
        date_default_timezone_set('EST'); # setting timezone
        $dbusername ='l5o0c8t4_blaze';
        $password = 'Platinum1!';
        $db = 'l5o0c8t4_General_Information';
        $servername = '162.144.181.131';
        $conn = new mysqli($servername, $dbusername, $password, $db);
        $date = new DateTime();
        $last_updated = $date->getTimestamp();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }


/**
*
*@return array database connection.
*/
    public function savedDB()
    {
        date_default_timezone_set('EST'); # setting timezone
        $dbusername ='l5o0c8t4_blaze';
        $password = 'Platinum1!';
        $db = 'l5o0c8t4_save_campaign';
        $servername = '162.144.181.131';
        $conn = new mysqli($servername, $dbusername, $password, $db);
        $date = new DateTime();
        $last_updated = $date->getTimestamp();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
