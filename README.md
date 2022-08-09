# PHPCalendar

Class to generate calendars using PHP. Tested with 5.6+.

## Installation

Upload a PHPCalendar.php to your directory and include:

```php
require_once 'PHPCalendar.php';
```

## Usage 

```php
require_once 'PHPCalendar.php'; // include a library
$calendar = new PHPCalendar();
$calendar->month = 9 // set a month (e.g. 9 = September, current month by default)
$calendar->year = 2023 // set a year (current year by default)
$data = $calendar->render(); // get generated data

// Optional
$json_data = json_encode($data); // get a JSON output

// Note: this class supports POST/GET requests. Example:
$_POST['month'] = 9
$_POST['year'] = 2023
$data = $calendar->render(); // Still works
```

## Example output (JSON)

```json
{
  "success":true,
  "days":[
    [
      "2023-08-28",
      "2023-08-29",
      "2023-08-30",
      "2023-08-31",
      "2023-09-01",
      "2023-09-02",
      "2023-09-03"
    ],
    [
      "2023-09-04",
      "2023-09-05",
      "2023-09-06",
      "2023-09-07",
      "2023-09-08",
      "2023-09-09",
      "2023-09-10"
    ],
    [
      "2023-09-11",
      "2023-09-12",
      "2023-09-13",
      "2023-09-14",
      "2023-09-15",
      "2023-09-16",
      "2023-09-17"
    ],
    [
      "2023-09-18",
      "2023-09-19",
      "2023-09-20",
      "2023-09-21",
      "2023-09-22",
      "2023-09-23",
      "2023-09-24"
    ],
    [
      "2023-09-25",
      "2023-09-26",
      "2023-09-27",
      "2023-09-28",
      "2023-09-29",
      "2023-09-30",
      "2023-10-01"
    ]
  ],
  "month":9,
  "year":2023
}
```



## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
