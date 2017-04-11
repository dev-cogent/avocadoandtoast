<?php


class twitterScraper
{

/**
 * Getting the main information on a twitter user.
 *
 * @param string $url
 * @return array - array contains image,username,followers,website,bio,fullname,location. Array elements will have those exact names.
 */
    public function getMainInfo($url)
    {
        $arrInfo = array();
        $html = $this->getTwitterHtml($url);

        $information = explode('json-data', $html);
        $jsonInformation = $information[1];
        $arrInfo['followers'] = $this->getFollowers($jsonInformation);
        $arrInfo['image'] = $this->getProfileImage($jsonInformation);
        $arrInfo['fullname'] = $this->getName($jsonInformation);
        $arrInfo['username'] = $this->getScreenName($jsonInformation);
        $arrInfo['bio'] = $this->getBio($jsonInformation);
        $arrInfo['website'] = $this->getWebsite($jsonInformation);
        $arrInfo['location'] = $this->getLocation($jsonInformation);
        $arrInfo['engagement'] = $this->getEngagement($html);
        return $arrInfo;
    }



    public function getTwitterEngagement($url){
        $html = $this->getTwitterHtml($url);
        $information = explode('json-data', $html);
        $jsonInformation = $information[1];
        $engagementInfo = $this->getEngagement($url);
        $engagementJson = json_encode($engagement);
        return $engagementJson;

    }

    /**
     * Getting the twitter followers
     *
     * @param string $jsonInformation
     * @return string followers
     */
    public function getFollowers($jsonInformation){
        $followers = explode('followers_count', $jsonInformation);
        $followers = explode(':', $followers[1]);
        $followers = explode(',', $followers[1]);
        $followers = $this->removeQuotes($followers[0]);
        return $followers;
    }
    
    /**
     * Getting the profile image for twitter
     *
     * @param string $jsonInformation
     * @return string image 400x400
     */
    public function getProfileImage($jsonInformation)
    {
        $image = explode('profile_image_url', $jsonInformation);
        $image = explode(':', $image[1]);
        $image = explode(',', $image[2]);
        $image = str_replace('\\', '', $image[0]);
        $image = str_replace('normal', '400x400', $image);
        $image = 'http:'.$image;
        $image = $this->removeQuotes($image);
        return $image;
    }

    /**
     * getName
     *
     * @param string $jsonInformation
     * @return string name
     */
    public function getName($jsonInformation)
    {
        $name = explode('profile_user', $jsonInformation);
        $name = explode('name', $name[1]);
        $name = explode(':', $name[1]);
        $name = explode(',', $name[1]);
        $name = $this->removeQuotes($name[0]);
        return $name;
    }
    


    /**
     * remove HTML entitles of quotes
     *
     * @param string string
     * @return string new string
     */

    public function removeQuotes($string)
    {
        $string = str_replace('&quot;', '', $string);
        return $string;
    }

    /**
     * getScreenName
     *
     * @param string $jsonInformation
     * @return username
     */
    public function getScreenName($jsonInformation)
    {
        $username = explode('screen_name', $jsonInformation);
        $username = explode(':', $username[1]);
        $username = explode(',', $username[1]);
        $username = $this->removeQuotes($username[0]);
        return $username;
    }

    /**
     * getBio
     *
     * @param string $jsonInformation
     * @return string bio
     */
    public function getBio($jsonInformation)
    {
        $bio = explode('profile_user', $jsonInformation);
        $bio = explode('description', $bio[1]);
        $bio = explode(':', $bio[1]);
        $bio = explode(',', $bio[1]);
        $bio = $this->removeQuotes($bio[0]);
        return $bio;
    }

    /**
     * getWebsite
     *
     * @param string $jsonInformation
     * @return string $website;
     */
    public function getWebsite($jsonInformation)
    {
        $website = explode('profile_user', $jsonInformation);
        $website = explode('url', $website[1]);
        $website = explode(':', $website[1]);
        $website = explode(',', $website[2]);
        $website = str_replace('\\', '', $website[0]);
        $website = $this->removeQuotes($website);
        $website = 'http:'.$website;
        return $website;
    }

    /**
     * getLocation of twitter user
     *
     * @param string $jsonInformation
     * @return string $location
     */
    public function getLocation($jsonInformation)
    {
        $location = explode('profile_user', $jsonInformation);
        $location = explode('location', $location[1]);
        $location = explode(':', $location[1]);
        $location = explode(',', $location[1]);
        $location = $this->removeQuotes($location[0]);
        return $location;
    }


/**
 * getting the HTML by providing the url
 *
 * @param string  $url
 * @return string text
 */
    public function getTwitterHtml($url)
    {
        $ch = curl_init();  // Initialising cURL
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function
    } // end instcurl




/**
 * get Engagement of the last 12 post from twitter
 *
 * @param string $html. It's the whole html
 * @return array
 */
    public function getEngagement($html)
    {
        $checkForRetweet = explode('class="content"', $html);
        unset($checkForRetweet[0]);
        foreach ($checkForRetweet as $key => $tweet) {
            $newtweet = explode('Icon Icon--small Icon--retweeted', $tweet);
            if (count($newtweet) == 2) {
                unset($checkForRetweet[$key+1]);
            }
        }
        $tweetcount = count($checkForRetweet);
        $info = implode(' ', $checkForRetweet);
        $info = explode('data-tweet-stat-count', $info);
        $engagementarr = array();
        $postcount = 0;
        for ($i = 1; $i <= $tweetcount*2; $i++) {
            $engagementarr['total_replies'] += $this->getReplies($info[$i]);
            $i += 1;
            $engagementarr['total_retweet'] += $this->getRetweets($info[$i]);
            $i +=1;
            $engagementarr['total_favorite'] += $this->getLikes($info[$i]);
            $postcount++;

            $engagementarr['posts'] = $postcount;
        }
        $engagementarr['total_engagement'] = $engagementarr['total_favorite'] + $engagementarr['total_retweet'] + $engagementarr['total_replies'];
        $engagementarr['average_engagement'] = intval($engagementarr['total_engagement']/$engagementarr['posts']);
        $engagementarr['average_favorite'] = intval($engagementarr['total_favorite']/$engagementarr['posts']);
        $engagementarr['average_retweet'] = intval($engagementarr['total_retweet']/$engagementarr['posts']);
        $engagementarr['average_replies'] = intval($engagementarr['total_replies']/$engagementarr['posts']);
        return $engagementarr;
    }


/**
 * Getting the latest replies. Counts up to 12 post
 *
 * @param string $info
 * @return void
 */
    public function getReplies($info)
    {
        $replies = explode('=', $info);
        $replies = $replies[1];
        $replies = str_replace('"', '', $replies);
        $replies = explode('>', $replies);
        $replies = $replies[0];
        return $replies;
    }
/**
 * Getting the latest retweets. Counts up to 12 post
 *
 * @param string $info
 * @return void
 */
    public function getRetweets($info)
    {
        $retweets = explode('=', $info);
        $retweets = $retweets[1];
        $retweets = str_replace('"', '', $retweets);
        $retweets = explode('>', $retweets);
        $retweets = $retweets[0];
        return $retweets;
    }
/**
 * Getting the latest likes. Counts up to 12 post
 *
 * @param string $info
 * @return void
 */
    public function getLikes($info)
    {
        $likes = explode('=', $info);
        $likes = $likes[1];
        $likes = str_replace('"', '', $likes);
        $likes = explode('>', $likes);
        $likes = $likes[0];
        return $likes;
    }
}




