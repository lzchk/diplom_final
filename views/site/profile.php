<?php
/**
 * @var $calendarString Calendar::getMonth string
 */

require_once ('../models/Schedule.php');
?>


<div class="title">
    Профиль
</div>


<div class="flex-row space-between">

    <div class="user-account">

        <div class="user-header">
            <?php
            $today = getdate();
            $hour = $today['hours'];

            $welcome = ''; // инициализация переменной для приветствия ($welcome можно здесь и не обьявлять)

            if ($hour > 0 && $hour < 6) {
                $welcome = 'Доброй ночи, Эмилия!';
            } elseif ($hour >= 6 && $hour < 12) {
                $welcome = 'Доброе утро, Эмилия!';
            } elseif ($hour >= 12 && $hour < 18) {
                $welcome = 'Добрый день, Эмилия!';
            } elseif ($hour >= 18 && $hour < 23) {
                $welcome = 'Добрый вечер, Эмилия!';
            } else {
                $welcome = 'Доброй ночи, Эмилия!';
            }
            echo $welcome;
            ?>
        </div>

        <div class="user row">
            <div class="user_info flex-row">
                <img src="img/account_photo.png" alt="account_photo">
                <div class="user-info flex-column">
                    <div class="user_group">39-03</div>
                    <div class="flex-row">
                        <div class="user-left">
                            <div class="user_name">ФИО: Кларк Эмилия Валерьевна</div>
                            <div class="user_data">Статус: студентка</div>
                        </div>
                        <div class="user-right">
                            <div class="user_data">Email:   clarc@mail.ru</div>
                            <div class="user_data">Номер:  +7 (911) 999-99-99</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="learning-progress flex-column">
        <?php
        //                function date_progress($start, $end, $date = null) {
        //                    $date = $date ?: time();
        //                    return (($date - $start) / ($end - $start)) * 100;
        //                }

        $start = strtotime("2022-09-01");
        $end = strtotime("2023-06-30");
        $now = date("Y-m-d");
        $today = strtotime($now);

        $total_days = ($end - $start) / (60 * 60 * 24);
        $past_day = ($today - $start) / (60 * 60 * 24);
        $days_left = $total_days - $past_day;
        $percent = 100 * $past_day / $total_days;

        $result = round($percent, 0);
        ?>

        <div class="circle">
            <div class="pie" style="--p:<?= $result ?>;--b:1.4vw;--c:#4184F4; top: -1.4vw;left: -1.3vw;">
                <?= $result ?>%
            </div>
            <!--                    <div class="days flex-row">-->
            <!--                        <div class="point"></div>-->
            <!--                        <div>пройдено: --><? //= $past_day ?><!-- дней</div>-->
            <!--                    </div>-->
            <!--                    <hr>-->
        </div>
        <div class="days">
            <div class="flex-row">
                <div class="point"></div>
                <div>Осталось: <?= $days_left ?> дней</div>
            </div>
            <hr>
            <div>Пройдено: <?= $past_day ?> дней</div>
        </div>
    </div>
</div>


<div class="flex-row space-between" style="margin-top: 2.6vw;">
    <div class="calendar">
        <div class="indicators flex-row">
            <div class="indicator flex-row">
                <div class="weekend"></div>
                Выходной день
            </div>

            <div class="indicator flex-row">
                <div class="sdo"></div>
                СДО
            </div>

            <div class="indicator flex-row">
                <div class="study"></div>
                Учебный день
            </div>
        </div>

        <div class="calendar-content">
<!--            --><?// var_dump($deadlineWork); ?>
            <?= $calendarString ?>
        </div>
    </div>
            <?=  $this->render('_profile_calendar',[
                'calendarString' => $calendarString,
                'schedule' => $schedule,
                'month' => $month,
                'dayOfTheWeek' => $dayOfTheWeek,
                'dayOfTheMonth' => $dayOfTheMonth,
                'deadlineWork' => $deadlineWork
            ])
            ?>

</div>

<div class="flex-row space-between" style="margin-top: 2.6vw;">
    <div class="dead-line">
        <div class="hand-over-to">сдать до:</div>
        <div class="dead-line_date">
            <?php
            $week = array(
                1 => 'Пн',
                2 => 'Вт',
                3 => 'Ср',
                4 => 'Чт',
                5 => 'Пт',
                6 => 'Сб',
                7 => 'Вс',
            );
            $date_by = substr($deadlineWork->date_by,-2,2);
            echo ($week[date('w')]).', '.$date_by;

            ?>
        </div>
        <div class="flex-row">
            <hr class="dead_hr">
            <div>
                <div class="type-of-work">
                    <?= $deadlineWork->typeWork->name ?>
                </div>
                <div class="topic">
                    <?= $deadlineWork->topic?>
                </div>
            </div>
        </div>
    </div>

    <div class="buildings">
        <div class="buildings_name">Корпуса</div>
        <div class="build flex-row">
            <div class="build-left">
                <?php
                $build = array(
                    1 => "ул. Балтийская, д. 35",
                    2 => "Охотничий пер., д. 7",
                    3 => "ул. Балтийская, д. 26",
                );

                $i = 1;
                foreach ($build as $item) {
                    echo '<div class="build flex-row">'.'<div>'.$i."  - "." ".'</div>'.'<div>'. $item.'<br>'.'</div>'.'</div>';
                    $i++;
                }
                ?>
            </div>

            <div class="build-right">
                <?php
                $build1 = array(
                    4 => "ул. Швецова, д. 22",
                    5 => "ул. Курляндская, д. 39",
                    6 => "ул. Моховая , д. 6",
                );

                $i = 4;
                foreach ($build1 as $item) {
                    echo '<div class="flex-row">'.'<div>'.$i."  - "." ".'</div>'.'<div>'. $item.'<br>'.'</div>'.'</div>';
                    $i++;
                }
                ?>
            </div>
        </div>

    </div>

    <div class="Saturdays-time-schedule">
        <div class="time_header_Sat">
            <div class="Saturdays_time_header">Расписание</div>
            <div class="Saturdays">в субботу</div>
        </div>
        <div class="Saturdays_schedule">
            <?php
//            var_dump($deadlineWork);

            //расписание в субботу
            $Saturdays_time_schedule = array (
                1 => '9.00 – 10.30',
                2 => '10.45 – 12.15',
                3 => '12.45 – 14.15',
                4 => '14.30 - 16.00',
            );
            $i = 1;
            foreach ($Saturdays_time_schedule as $item) {
                echo '<div class="time flex-row">'.'<div>'.$i." пара:"." ".'</div>'.'<div>'. $item.'<br>'.'</div>'.'</div>';
                $i++;
            }
            ?>
        </div>
    </div>
</div>
