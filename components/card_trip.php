<?php

if (!function_exists("cardTrip")) {
    function cardTrip($trip)
    {
        echo <<<HTML
            <div class="card hover dark">
                <img src="./assets/images/polo.jpg" alt="car">
                <div class="gradient"></div>
                <div class="tags top">
                    <span><img src="./assets/images/icons/users.svg" alt="seats icon">3 places</span>
                    <span><img src="./assets/images/icons/clock.svg" alt="clock icon">06/06 à 14h00</span>
                </div>
                <div class="trip">
                    <span>IUT de Troyes</span>
                    <img src="./assets/images/icons/arrow-dotted.svg" alt="arrow dotted icon">
                    <span>Meltdown</span>
                </div>
            </div>
        HTML;
    }
}
