<?php

if (!function_exists("cardTrip")) {
    function cardTrip($trip = null)
    {
        if ($trip === null) {
            $zones = [
                'IUT de Troyes',
                'Meltdown',
                'Gare de Troyes',
                'RU Les Lombards'
            ];
            $countZone = count($zones);
            $trip = [
                'seats' => rand(1, 4),
                'date' => date('d/m à H\hi', rand(time(), time() + 86400 * 7)),
                'from' => $zones[rand(0, $countZone - 1)],
                'to' => $zones[rand(0, $countZone - 1)],
            ];
            while ($trip['from'] === $trip['to']) {
                $trip['to'] = $zones[rand(0, $countZone - 1)];
            }
        }
        echo <<<HTML
            <div class="card hover dark">
                <img src="./assets/images/polo.jpg" alt="car">
                <div class="gradient"></div>
                <div class="tags top">
                    <span><img src="./assets/images/icons/users.svg" alt="seats icon">3 places</span>
                    <span><img src="./assets/images/icons/clock.svg" alt="clock icon">06/06 à 14h00</span>
                </div>
                <div class="trip">
                    <span>{$trip['from']}</span>
                    <img src="./assets/images/icons/arrow-dotted.svg" alt="arrow dotted icon">
                    <span>{$trip['to']}</span>
                </div>
            </div>
        HTML;
    }
}
