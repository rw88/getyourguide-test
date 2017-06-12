<?php
/**
 * Just a regular helper class for non-standard methods
 */

namespace GetYourGuideTest\Helpers;

use GetYourGuideTest\DTO\CLICallDTO;

class CLICallHelper {

    /**
     * It generates a new CLICallDTO object based on PHP argv
     * 
     * @param array $argv - stantard argv from PHP cli
     * @return CLICallDTO
     */
    public static function generateApiCalDTOFromArgv($argv) {
        list($apiUrl, $startTime, $endTime, $numTravellers) = array_slice($argv, 1);

        $call = new CLICallDTO();
        $call->setApiUrl($apiUrl);
        $call->setStartTime($startTime);
        $call->setEndTime($endTime);
        $call->setNumTravellers($numTravellers);

        return $call;
    }

}
