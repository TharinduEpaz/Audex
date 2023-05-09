<?php 
    class Calendar {

        private $events = [];
        
        
    
        public function add_event($txt, $date, $days = 1, $color = '') {
            $color = $color ? ' ' . $color : $color;
            $this->events[] = [$txt, $date, $days, $color];
        }
    
        public function __toString() {
            $num_days_current = date('t', strtotime(date('Y') . '-' . date('m') . '-' . date('d')));// gives number of dates in the current month
            $num_days_next_month = date('t', strtotime(date('Y') . '-' . date('m')+1 . '-' . date('d')));// gives number of dates in the next month
            $last_day_pevious_month = date('j', strtotime('last day of previous month', strtotime(date('Y') . '-' . date('m') . '-' . date('d'))));// gives the last day of previous month
            // $num_days_next_month_prev = date('j', strtotime('last day of previous month', strtotime(date('d') . '-' . date('m')+1 . '-' . date('Y'))));
            $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
            $first_day_of_week_int = array_search(date('D', strtotime(date('Y') . '-' . date('m') . '-1')), $days);// gives the first day of the month in int according to the array $days
            $html = '<div class="calendar">';
            $html .= '<div class="header">';
            $html .= '<div class="month-year">';
            $html .= date('F Y', strtotime(date('Y') . '-' . date('m') . '-' . date('d')));
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="days">';
            foreach ($days as $day) {
                $html .= '
                    <div class="day_name">
                        ' . $day . '
                    </div>
                ';
            }
            // prints previous month remaining dates ignored
            for ($i = $first_day_of_week_int; $i > 0; $i--) {
                $html .= '
                    <div class="day_num ignore">
                        ' . ($last_day_pevious_month-$i+1) . '
                    </div>
                ';
            }
            for ($i = 1; $i <= $num_days_current; $i++) {
                $selected = '';
                if ($i == date('d')) {
                    $selected = ' selected';
                }
                $html .= '<div class="day_num' . $selected . '">';
                $html .= '<span>' . $i . '</span>';
                foreach ($this->events as $event) {
                    for ($d = 0; $d <= ($event[2]-1); $d++) {
                        if (date('y-m-d', strtotime(date('Y') . '-' . date('m') . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                            $html .= '<div class="event' . $event[3] . '">';
                            $html .= $event[0];
                            $html .= '</div>';
                            // array_shift($event);
                        }
                    }
                }
                $html .= '</div>';
            }
            
            // for ($i = 1; $i <= (42-$num_days_current-max($first_day_of_week_int, 0)); $i++) {
            //     $html .= '
            //         <div class="day_num">
            //             ' . $i . '
            //         </div>
            //     ';
            // }
            $html .= '</div>';
            $html .= '</div>';

            //next month
            $num_days_next_month = date('t', strtotime(date('Y') . '-' . date('m')+1 . '-' . date('d')));// gives number of dates in the next month
            $last_day_pevious_month = date('j', strtotime('last day of previous month', strtotime(date('Y') . '-' . date('m')+1 . '-' . date('d'))));// gives the last day of current month
            $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
            $first_day_of_week_int = array_search(date('D', strtotime(date('Y') . '-' . date('m')+1 . '-1')), $days);// gives the first day of the next month
            
            $html .= '<div class="calendar">';
            $html .= '<div class="header">';
            $html .= '<div class="month-year">';
            $html .= date('F Y', strtotime(date('Y') . '-' . date('m')+1 . '-' . date('d')));

            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="days">';

            foreach ($days as $day) {
                $html .= '
                    <div class="day_name">
                        ' . $day . '
                    </div>
                ';
            }
            //Display the previous months dates
            for ($i = $first_day_of_week_int; $i > 0; $i--) {
                $html .= '
                    <div class="day_num ignore">
                        ' . ($last_day_pevious_month-$i+1) . '
                    </div>
                ';
            }
            for ($i = 1; $i <= $num_days_next_month; $i++) {
                $selected = '';
                $html .= '<div class="day_num' . $selected . '">';
                $html .= '<span>' . $i . '</span>';
                foreach ($this->events as $event) {
                    for ($d = 0; $d <= ($event[2]-1); $d++) {
                        if (date('y-m-d', strtotime(date('Y') . '-' . date('m')+1 . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                            $html .= '<div class="event' . $event[3] . '">';
                            $html .= $event[0];
                            $html .= '</div>';
                        }
                    }
                }
                $html .= '</div>';
            }
            // for ($i = 1; $i <= (42-$num_days_current-max($first_day_of_week_int, 0)); $i++) {
            //     $html .= '
            //         <div class="day_num">
            //             ' . $i . '
            //         </div>
            //     ';
            // }
            $html .= '</div>';
            $html .= '</div>';
            return $html;
        }
    
    }