<?php
/**
 * Validation class for DTO\CLICallDTO class
 */
namespace GetYourGuideTest\Validations;

use GetYourGuideTest\DTO\CLICallDTO;

class CLICallValidation {

  private $call;
  private $errors = array();

  /**
   * 
   * @param CLICallDTO $call
   */
  public function __construct(CLICallDTO $call) {
    $this->call = $call;
  }
  
  /**
   * It performes the validation
   * 
   * @return boolean
   */
  public function check() {
    if (filter_var($this->call->getApiUrl(), \FILTER_VALIDATE_URL) === false) {
        $this->errors[] = "Provide a valid API URL for the first argument";
    }

    $startTimeDT = \DateTime::createFromFormat ('Y-m-d\TH:i', $this->call->getStartTime(), new \DateTimeZone(APP_TIMEZONE));
    if (!$startTimeDT) {
        $this->errors[] = "Provide a valid start time for the second argument (e.g 2017-01-01T19:30)";
    }

    $endTimeDT = \DateTime::createFromFormat ('Y-m-d\TH:i', $this->call->getEndTime(), new \DateTimeZone(APP_TIMEZONE));
    if (!$endTimeDT) {
        $this->errors[] = "Provide a valid end time for the third argument (e.g 2017-01-01T19:30)";
    }

    if($startTime && $endTime && $startTime > $endTime) {
      $this->errors[] = "For argument 2 and 3, end time must be greater than the start time";
    }

    if (filter_var($this->call->getNumTravellers(), \FILTER_VALIDATE_INT) === false ||
        !($this->call->getNumTravellers() >= 1 && $this->call->getNumTravellers() <= 30)
    )
    {
        $this->errors[] = "Provide a valid number of travelers for the fourth argument (Enter values between 1 and 30)";
    }

    return empty($this->errors);
  }



  /**
   * It returns a formatted string for the encoutered errors during the validation check
   * 
   * @return string
   */
  public function __toString() {
    if(empty($this->errors)) {
        return "";
    }


    $output = "";
    $output .= "##########\n";
    foreach($this->errors as $error) {
        $output .= "Error: {$error}\n";
    }

    $output .= "\n";
    $output .= "Example:  php solution.php http://www.mocky.io/v2/58ff37f2110000070cf5ff16 2017-11-20T09:30 2017-11-23T19:30 3\n";
    $output .= "##########\n";

    return $output;
  }


}
