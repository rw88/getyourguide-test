<?php

/**
 * A class that maps all cli commands for this app
 */

namespace GetYourGuideTest\DTO;

class CLICallDTO {
  private $apiUrl;
  private $startTime;
  private $endTime;
  private $numTravellers;

  public function setAPIUrl($apiUrl) {
      $this->apiUrl = $apiUrl;
  }

  public function getAPIUrl() {
      return $this->apiUrl;
  }

  public function setStartTime($startTime) {
      $this->startTime = $startTime;
  }

  public function getStartTime() {
      return $this->startTime;
  }

  public function getStartTimeDT() {
      return \DateTime::createFromFormat ('Y-m-d\TH:i', $this->getStartTime() , new \DateTimeZone(APP_TIMEZONE));
  }

  public function setEndTime($endTime) {
      $this->endTime = $endTime;
  }

  public function getEndTime() {
      return $this->endTime;
  }

  public function getEndTimeDT() {
      return \DateTime::createFromFormat ('Y-m-d\TH:i', $this->getEndTime() , new \DateTimeZone(APP_TIMEZONE));
  }

  public function setNumTravellers($numTravellers) {
      $this->numTravellers = $numTravellers;
  }

  public function getNumTravellers() {
      return $this->numTravellers;
  }



}
