<?
/**
 * @var $schedule \app\models\Schedule
 */

use yii\helpers\VarDumper;
?>
<div class="schedule">
    <div class="weather flex-row">
        <?php

        // API ключ
        use yii\db\Expression;

        $apiKey = "fe57b721fd47b8600afac45a7829c1ea";
        // Город погода которого нужна
        $city = "St. Petersburg";
        // Ссылка для отправки
        $url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . "&lang=ru&units=metric&appid=" . $apiKey;
        // Создаём запрос
        $ch = curl_init();

        // Настройка запроса
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        // Отправляем запрос и получаем ответ
        $data = json_decode(curl_exec($ch));

        // Закрываем запрос
        curl_close($ch);


        //для расписания по дням
        $after = '';

        if(count($schedule) < 5){
            $count = 5 - count($schedule);
            for($i = $count; $i <= 5; $i++){
                $after = $after."<div class='schedule_body'>$i</div>";
            }

        }
        ?>

        <div class="weather_name">Санкт-Петербург:</div>
        <div class="weather_temp"><?php echo round($data->main->temp_min); ?>°C <img src="img/weather.svg"></div>
        <!--            <div class="weather_img"><img src="img/weather.svg"></div>-->
        <!--            <h2>Погода в городе --><?php //echo $data->name; ?><!--</h2>-->
        <!--            <p>Погода: --><?php //echo $data->main->temp_min; ?><!--°C</p>-->
        <!--            <p>Влажность: --><?php //echo $data->main->humidity; ?><!-- %</p>-->
        <!--            <p>Ветер: --><?php //echo $data->wind->speed; ?><!-- км/ч</p>-->
    </div>

    <div class="schedule-of-classes">
        <div class="schedule_header flex-row">
            <div class="schedule_date">
                <?= $dayOfTheWeek ?>, <?=date("d")?> <?=$dayOfTheMonth?>
            </div>
            <div class="number-week">
                <?php
                $week = date('W');
                if($week%2 == 0) {
                    echo "Числитель";
                } else {
                    echo "Знаменатель";
                }
                ?>
            </div>
        </div>
        <div class="schedule_body">
            <?php
            for ($i=0;$i<5; $i++){
                $item = $schedule[$i];
                $num = (($i+1)." пара: ");
                if (is_null($item)){
                    echo $num.' - ';
                    echo ($item->num_lesson).'<br>';
                } else {
                    echo '<div class="class flex-row">'.'<div class="flex-row">'.$num.'<div class="disc">'.' '.$item->discipline->name.'</div>'.'</div>'.' '.'<div class="room">'.' '.$item->room->number.'<br>'.'</div>'.'</div>';
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="time-schedule">
    <div class="time_header">Расписание</div>
    <div class="time_schedule">
        <?php
        //расписание звонков 1-2 курсов
        $time_sch_1_2_course = array (
            1 => '9.00 – 10.30',
            2 => '10.50 – 12.20',
            3 => '13.05 – 14.35',
            4 => '14.50 - 16.20',
            5 => '16.35 – 18.05',
        );
        //расписание звонков 3-4-5 курсов
        $time_sch_3_4_5_course = array (
            1 => '9.00 – 10.30',
            2 => '10.50 – 12.20',
            3 => '12.35 – 14.05',
            4 => '14.50 - 16.20',
            5 => '16.35 – 18.05',
        );

        $course = abs((substr((int)date("Y"),-1)+10) - substr("39-03",1))+1;
        //    echo $course;
        if (($course == 1)||($course == 2)) {
            $i = 1;
            foreach ($time_sch_1_2_course as $item) {
                echo '<div class="time flex-row">'.'<div>'.$i." пара:"." ".'</div>'.'<div>'. $item.'<br>'.'</div>'.'</div>';
                $i++;
            }
        } else {
            $i = 1;
            foreach ($time_sch_3_4_5_course as $item) {
                echo '<div class="time flex-row">'.'<div>'.$i." пара:"." ".'</div>'.'<div>'. $item.'<br>'.'</div>'.'</div>';
                $i++;
            }
        }
        ?>
    </div>

</div>