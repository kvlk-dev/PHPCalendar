<?php

/**
 * @property int $next_month_first_day
 * @property int $days_in_next_month
 * @property int $next_year
 * @property int $next_month
 * @property int $previous_month_week
 * @property int $previous_month_last_day
 * @property int $days_in_previous_month
 * @property int $previous_year
 * @property int $previous_month
 * @property int $days_in_month
 * @property int $month_first_day
 * @property int $year
 * @property int $month
 */
class PHPCalendar {
    public function __construct()
    {
        $month = date('m');
        $year = date('Y');
        if(isset($this->month)) $month = intval($this->month);
        if(isset($this->year)) $year = intval($this->year);
        $this->month = (int)$month;
        $this->year = (int)$year;
        $this->month_first_day = (int)date('N', strtotime($year.'-'.$month.'-01'));
        $this->days_in_month = (int)date('t', strtotime($year.'-'.$month.'-01'));
        $this->previous_month = ($month == 1) ? 12 : $this->month - 1;
        $this->previous_year = ($month == 1) ? $this->year - 1 : $this->year;
        $this->days_in_previous_month = (int)date('t', strtotime($this->previous_year.'-'.$this->previous_month.'-01'));
        $this->previous_month_last_day = (int)date('N', strtotime($this->previous_year.'-'.$this->previous_month.'-'.$this->days_in_previous_month));
        $this->previous_month_week = $this->days_in_previous_month - $this->month_first_day + 1;
        $this->next_month = ($month == 12) ? 1 : $this->month + 1;
        $this->next_year = ($month == 12) ? $this->year + 1 : $this->year;
        $this->days_in_next_month = (int)date('t', strtotime($this->next_year.'-'.$this->next_month.'-01'));
        $this->next_month_first_day = (int)date('N', strtotime($this->next_year.'-'.$this->next_month.'-01'));
    }
    public function render(){
        $response = ['success' => true];
        $json = [];
        $day_of_month = 1;
        $day_of_next_month = 1;
        for($w = 0; $w <= 4; $w++) {
            $json[$w] = [];
            $week = [];
            if($w == 0) {

                for($d = 1; $d < $this->month_first_day; $d++) {
                    $day = $this->previous_month_week + $d;
                    $week[] = date('Y-m-d', strtotime($this->previous_year.'-'.$this->previous_month.'-'.$day));
                }
                for ($d = $this->month_first_day; $d <= 7; $d++) {
                    $week[] = date('Y-m-d', strtotime($this->year.'-'.$this->month.'-'.$day_of_month));
                    $day_of_month++;
                }
            } elseif($w == 4) {
                for ($d = 1; $d <= 7; $d++) {
                    if($day_of_month > $this->days_in_month) {
                        $week[] = date('Y-m-d', strtotime($this->next_year.'-'.$this->next_month.'-'.$day_of_next_month));
                        $day_of_next_month++;
                    } else {
                        $week[] = date('Y-m-d', strtotime($this->year.'-'.$this->month.'-'.$day_of_month));
                        $day_of_month++;
                    }
                }
            } else {
                for($d = 1; $d <= 7; $d++) {
                    $week[] = date('Y-m-d', strtotime($this->year.'-'.$this->month.'-'.$day_of_month));
                    $day_of_month++;
                }
            }
            $json[$w] = $week;

        }
        $response['days'] = $json;
        $response['month'] = $this->month;
        $response['year'] = $this->year;
        return json_encode($response);
    }

}