<?php

/**
 * It filters the response from the API call based on the passed CLI arguments
 */

namespace GetYourGuideTest\BLL;

use GetYourGuideTest\DTO\CLICallDTO;

class APIResponseParser {

    private $call;
    private $apiResponse;

    /**
     * 
     * @param \GetYourGuideTest\BLL\CliCallDTO $call
     * @param string $apiResponse - output returned from API call
     */
    public function __construct(CliCallDTO $call, $apiResponse) {
        $this->call = $call;
        $this->apiResponse = $apiResponse;
    }

    /**
     * Filters all response date according to data in CLICallDTO object
     * 
     * @return type
     */
    public function parse() {
        $jsonApiResponse = json_decode($this->apiResponse);

        $results = array();

        $startTimeFilterDT = $this->call->getStartTimeDT();
        $endTimeFilterDT = $this->call->getEndTimeDT();

        foreach ($jsonApiResponse->product_availabilities as $product) {

            // Filter by number of travellers
            if ($this->call->getNumTravellers() > $product->places_available) {
                continue;
            }

            $activityStartTimeDT = \DateTime::createFromFormat(APP_DATEFORMAT, $product->activity_start_datetime, new \DateTimeZone(APP_TIMEZONE));

            // Get activity end time -  added minutes to get end time
            $activityEndTimeDT = clone $activityStartTimeDT;
            $activityEndTimeDT->modify(sprintf('+%d minutes', $product->activity_duration_in_minutes));


            // Skip non-matching start and end dates            
            if (!(($startTimeFilterDT <= $activityStartTimeDT) && ($endTimeFilterDT >= $activityEndTimeDT))) {
                continue;
            }

            // Store new results
            $results[] = [
                'product_id' => $product->product_id,
                'available_starttimes' => [
                    $activityStartTimeDT->format(APP_DATEFORMAT),
                    $activityEndTimeDT->format(APP_DATEFORMAT)
                ]
            ];
        }


        // output
        return json_encode($results);
    }

}
