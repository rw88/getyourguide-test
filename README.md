# Project Title: GetYourGuide Test

Given an API endpoint containing product availabilities, It retrieves the product_ids of the products that are available to be booked given a period of time and the requested number of travellers.


### Prerequisites

PHP 5.6 or greater must be installed

### Usage Example

php solution.php api_url start_time end_time num_travallers

All four arguments are required. Check the description of each argument.

@params
api_url (a full formatted URL - example: http://www.mocky.io/v2/58ff37f2110000070cf5ff16_
start_time (start time filter, format YYYY-MM-DDTHH:II) Note: the start time must be smaller than the end time
end_time (end time filter, format YYYY-MM-DDTHH:II) Note: the end time must be greater than the start time
num_travelleprs (number of travellers filter, an integer number from 1 to 30)



Full Example
php solution.php http://www.mocky.io/v2/58ff37f2110000070cf5ff16 2017-07-07T10:30 2017-07-07T17:40 20

It outputs 
[{"product_id":679,"available_starttimes":["2017-07-07T10:30","2017-07-07T14:45"]}]


## Authors

* **Robert W L Souza** - *Initial work* - [PurpleBooth](https://github.com/rw88)

## License

This project is licensed under the MIT License
