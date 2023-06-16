<?php

if (!function_exists("cardTrip")) {
    function cardTrip($trip = null, $dark = false, $url = null)
    {
        if ($trip === null) {
            $zones = [
                'IUT de Troyes',
                'Meltdown',
                'Gare de Troyes',
                'RU Les Lombards',
                'Burger King',
                'McDonalds',
                'Quick',
                'KFC',
                'Cinema CGR',
                'Bowling des 3 Seine',
                'Le Cube',
                'Pont-Sainte-Marie',
                'Stade de l\'Aube',
                'Nigloland',
                'Lac d\'Orient',
                'Hôtel de Ville',
                'Bowl de Troyes',
            ];
            $images = [
                '206.jpeg',
                'clio3.jpg',
                'polo.jpg',
                'twingo.jpg',
                'twingo1.jpg',
                'clio2.jpg',
                'ford_ka.jpeg',
                'c3.jpg',
                '208.jpg'
            ];
            $countZone = count($zones);
            $trip = [
                'seats' => 4,
                'date' => date('d/m à H\hi', rand(time(), time() + 86400 * 7)),
                'from' => $zones[rand(0, $countZone - 1)],
                'to' => $zones[rand(0, $countZone - 1)],
                'image' => $images[rand(0, count($images) - 1)]
            ];
            while ($trip['from'] === $trip['to']) {
                $trip['to'] = $zones[rand(0, $countZone - 1)];
            }
        } else {
            $trip['date'] = date('d/m à H\hi', strtotime($trip['departure_at']));
            if ($trip['from'] === $trip['to']) {
                $trip['from'] = $trip['departure_address'];
                $trip['to'] = $trip['arrival_address'];
            }
        }
        $dark = $dark ? 'dark' : 'dark:dark';
        $htmlElement = $url ? 'a' : 'div';
        $href = $url ? "href=\"$url\"" : '';
        foreach ($trip as $key => $value) {
            $trip[$key] = htmlspecialchars($value);
        }
        echo <<<HTML
            <$htmlElement $href class="card hover $dark">
                <img class="full" src="/assets/images/{$trip['image']}" alt="car">
                <div class="gradient"></div>
                <div class="tags top">
                    <span><img src="/assets/images/icons/users.svg" alt="seats icon">{$trip['seats']} places</span>
                    <span><img src="/assets/images/icons/clock.svg" alt="clock icon">{$trip['date']}</span>
                </div>
                <div class="trip">
                    <span>{$trip['from']}</span>
                    <img src="/assets/images/icons/arrow-dotted.svg" alt="arrow dotted icon">
                    <span>{$trip['to']}</span>
                </div>
            </$htmlElement>
        HTML;
    }
}
