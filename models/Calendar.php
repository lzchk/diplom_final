<?php

namespace app\models;
use yii\helpers\VarDumper;

class Calendar
{
    public static $months = array(
        1 => 'Января',
        2 => 'Февраля',
        3 => 'Марта',
        4 => 'Апреля',
        5 => 'Мая',
        6 => 'Июня',
        7 => 'Июля',
        8 => 'Августа',
        9 => 'Сентября',
        10 => 'Октября',
        11 => 'Ноября',
        12 => 'Декабря'
    );

    public static $week = array(
        1 => 'Понедельник',
        2 => 'Вторник',
        3 => 'Среда',
        4 => 'Четверг',
        5 => 'Пятница',
        6 => 'Суббота',
        7 => 'Воскресенье'
    );

    public static $events = array(
        '1.01' => 'Новогодние каникулы',
        '2.01' => 'Новогодние каникулы',
        '3.01' => 'Новогодние каникулы',
        '4.01' => 'Новогодние каникулы',
        '5.01' => 'Новогодние каникулы',
        '6.01' => 'Новогодние каникулы',
        '7.01' => 'Новогодние каникулы',
        '8.01' => 'Новогодние каникулы',
        '23.02' => 'День защитника Отечества',
        '08.03' => 'Международный женский день',
        '01.05' => 'Праздник Весны и Труда',
        '09.05' => 'День Победы',
        '12.06' => 'День России',
        '4.11' => 'День России',
        '31.12' => 'Новый год',

        '15.11.2022' => 'СДО',
        '19.11.2022' => 'СДО',
        '21.11.2022' => 'СДО',
        '28.11.2022' => 'СДО',
    );

    /**
     * Вывод календаря на один месяц.
     */
    public static function getMonth($month, $year, $events = array())
    {
        $month = intval($month);
        $out = '
		<div class="calendar-item">
			<div class="calendar-head">' . self::$months[$month] . ' ' . $year . '</div>
			<table>
				<tr>
					<th>Пн</th>
					<th>Вт</th>
					<th>Ср</th>
					<th>Чт</th>
					<th>Пт</th>
					<th>Сб</th>
					<th>Вс</th>
				</tr>';

        $day_week = date('N', mktime(0, 0, 0, $month, 1, $year));
        $day_week--;

        $out .= '<tr>';

        for ($x = 0; $x < $day_week; $x++) {
            $out .= '<td></td>';
        }

        $days_counter = 0;
        $days_month = date('t', mktime(0, 0, 0, $month, 1, $year));

        for ($day = 1; $day <= $days_month; $day++) {
            $today = getdate(strtotime($year. "-" .$month."-".$day));
            if (date('j.n.Y') == $day . '.' . $month . '.' . $year) {
                $class = 'today';
            } elseif (time() > strtotime($day . '.' . $month . '.' . $year)) {
                $class = 'last';
            }
            if ($today['weekday'] == 'Sunday' ) {
                $class = 'day-off';
            }
            else {
                $class = '';
            }

            $event_show = false;
            $event_text = array();
            if (!empty($events)) {
                foreach ($events as $date => $text) {
                    $date = explode('.', $date);
                    if (count($date) == 3) {
                        $y = explode(' ', $date[2]);
                        if (count($y) == 2) {
                            $date[2] = $y[0];
                        }

                        if ($day == intval($date[0]) && $month == intval($date[1]) && $year == $date[2]) {
                            $event_show = true;
                            $event_text[] = $text;
                        }
                    } elseif (count($date) == 2) {
                        if ($day == intval($date[0]) && $month == intval($date[1])) {
                            $event_show = true;
                            $event_text[] = $text;
                        }
                    } elseif ($day == intval($date[0])) {
                        $event_show = true;
                        $event_text[] = $text;
                    }
                }
            }

            if ($event_show) {
                $out .= '<td class="calendar-day ' . $class . ' event">' . $day;
                if (!empty($event_text)) {
                    $out .= '<div class="calendar-popup">' . implode('<br>', $event_text) . '</div>';
                }
                $out .= '</td>';
            } else {
                $out .= '<td class="calendar-day ' . $class . '">' . $day . '</td>';
            }

            if ($day_week == 6) {
                $out .= '</tr>';
                if (($days_counter + 1) != $days_month) {
                    $out .= '<tr>';
                }
                $day_week = -1;
            }

            $day_week++;
            $days_counter++;
        }

        $out .= '</tr></table></div>';
        return $out;
    }
}

?>