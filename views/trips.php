<header class="green small">
    <div class="container">
        <h1 class="center">Prenez un billet pour vos trajet </h1>
        <form class="form-header">
            <div>
                <label for="departure">Départ</label>
                <input type="text" name="departure" id="departure" placeholder="Départ">
            </div>
            <div>
                <label for="arrival">Arrivée</label>
                <input type="text" name="arrival" id="arrival" placeholder="Arrivée">
            </div>
            <div>
                <label for="date_hour">Date et heure</label>
                <input type="text" name="date_hour" id="date_hour" placeholder="Date et heure">
            </div>
            <button class="btn" type="submit">Rechercher</button>
        </form>
    </div>
</header>

<?= isset($_SESSION['message']) ? '<p>' . $_SESSION['message'] . '</p>' : '' ?>
<?= isset($_SESSION['tripLog']) ? '<p class="message error">' . $_SESSION['tripLog'] . '</p>' : '' ?>
<?= isset($_SESSION['user']['id']) ? '<button id="trip_reveal" class="btn green"><i class="fa-solid fa-circle-plus"></i> Nouveau trajet</button>' : '' ?>

<form id="trip_form" action="trips_create.php" method="post">

    <p>Définir le point de rendez-vous</p>
    <div>
        <label for="departure_city">Ville de départ</label>
        <input type="text" id="departure_city" name="departure_city" placeholder="Ville de départ">
    </div>
    <div>
        <select name="departure_options" id="departure_options">
        <option value="other">Hors parkings de l'IUT</option>
            <option value="p1">Parking IUT 1</option>
            <option value="p2">Parking IUT 2</option>
        </select>
    <svg id="p1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="300" x="0px" y="0px" viewBox="0 0 531.9 763.8" style="enable-background:new 0 0 531.9 763.8;" xml:space="preserve">
        <style type="text/css">
            .st0{fill:#FFFFFF;stroke:#DDDDDD;stroke-width:5;stroke-miterlimit:10;}
            .st1{fill:#DDDDDD;}
            .st2{fill:#FFFFFF;stroke:#22BB68;stroke-width:5;stroke-miterlimit:10;}
        </style>
        <path class="st0" d="M391.6,240.8v34.3c0,2.6-2.1,4.6-4.6,4.6h-34.3c-2.6,0-4.6,2.1-4.6,4.6V300c0,2.6-2.1,4.6-4.6,4.6H78.8
            c-2.6,0-4.6-2.1-4.6-4.6V172.3c0-2.6,2.1-4.6,4.6-4.6h264.6c2.6,0,4.6,2.1,4.6,4.6v59.2c0,2.6,2.1,4.6,4.6,4.6h34.3
            C389.5,236.2,391.6,238.2,391.6,240.8z"/>
        <path class="st0" d="M174.9,139L78,76.1c-2.1-1.4-2.7-4.3-1.4-6.4l28.9-44.5c1.4-2.1,4.3-2.7,6.4-1.4l96.8,62.9
            c2.1,1.4,2.7,4.3,1.4,6.4l-28.9,44.5C179.9,139.7,177,140.4,174.9,139z"/>
        <path class="st0" d="M294.6,330v210c0,2.6-2.1,4.6-4.6,4.6H153c-2.6,0-4.6-2.1-4.6-4.6v-91.1c0-2.6-2.1-4.6-4.6-4.6h-15.3
            c-2.6,0-4.6,2.1-4.6,4.6v72.5c0,2.6-2.1,4.6-4.6,4.6H9.7c-2.6,0-4.6-2.1-4.6-4.6v-72.5c0-2.6,2.1-4.6,4.6-4.6h89.6
            c2.6,0,4.6-2.1,4.6-4.6v-36.6c0-2.6,2.1-4.6,4.6-4.6H191c2.6,0,4.6-2.1,4.6-4.6V330c0-2.6,2.1-4.6,4.6-4.6H290
            C292.5,325.3,294.6,327.4,294.6,330z"/>
        <g>
            <path class="st1" d="M105.1,246.2h-6v-21.4h6V246.2z"/>
            <path class="st1" d="M117.8,246.5c-2.5,0-4.5-0.4-6.2-1.1c-1.6-0.8-2.8-1.8-3.6-3.2c-0.8-1.4-1.2-3-1.2-4.9v-12.4h6v12
                c0,1,0.1,1.8,0.4,2.4c0.3,0.6,0.7,1,1.5,1.2c0.7,0.2,1.7,0.4,3.1,0.4c1.4,0,2.4-0.1,3.1-0.4c0.7-0.2,1.2-0.6,1.4-1.2
                c0.3-0.6,0.4-1.4,0.4-2.4v-12h6v12.4c0,1.9-0.4,3.5-1.2,4.9c-0.8,1.4-2,2.5-3.6,3.2C122.4,246.1,120.3,246.5,117.8,246.5z"/>
            <path class="st1" d="M151.2,230.2h-21.2v-5.4h21.2V230.2z M143.7,246.2h-6v-21.4h6V246.2z"/>
            <path class="st1" d="M164.5,246.5c-1.6,0-3-0.3-4.2-1s-2-1.6-2.6-2.9c-0.6-1.3-0.9-2.8-0.9-4.5c0-1.7,0.3-3.2,0.9-4.5
                c0.6-1.2,1.4-2.2,2.5-2.9c1.1-0.7,2.4-1,4-1c1.9,0,3.3,0.4,4.3,1.2s1.6,1.9,1.8,3.2h0.9v3.7h-0.6c0-1.1-0.3-1.9-1-2.2
                c-0.7-0.3-1.6-0.5-3-0.5c-0.9,0-1.7,0.1-2.2,0.3s-0.9,0.5-1.2,0.9s-0.4,1-0.4,1.7c0,0.7,0.1,1.3,0.4,1.7c0.2,0.4,0.6,0.7,1.2,0.9
                c0.6,0.2,1.3,0.3,2.2,0.3c0.9,0,1.6-0.1,2.2-0.2c0.6-0.1,1-0.4,1.3-0.8s0.4-1,0.4-1.8h0.6l0.4,3.7h-1c-0.3,1.6-0.9,2.8-1.9,3.5
                S166.4,246.5,164.5,246.5z M176.6,246.2H171v-4.5l-0.4-0.4v-16.5h6V246.2z"/>
            <path class="st1" d="M187.5,246.5c-1.8,0-3.4-0.3-4.8-0.8c-1.4-0.6-2.5-1.5-3.3-2.7c-0.8-1.2-1.2-2.9-1.2-4.9
                c0-1.7,0.4-3.2,1.2-4.5c0.8-1.2,1.9-2.2,3.2-2.9c1.4-0.7,3-1,4.8-1c1.9,0,3.5,0.3,4.8,0.9s2.4,1.5,3.2,2.7c0.7,1.2,1.1,2.6,1.1,4.4
                c0,0.3,0,0.5,0,0.8c0,0.2,0,0.5-0.1,0.8h-14.3v-3h9.9l-1.3,1.9c0-0.2,0-0.4,0-0.6s0-0.4,0-0.6c0-1-0.3-1.7-0.8-2
                c-0.5-0.4-1.4-0.6-2.7-0.6c-1.4,0-2.3,0.2-2.8,0.6c-0.5,0.4-0.7,1.2-0.7,2.3v1.5c0,1.1,0.2,1.9,0.7,2.3c0.5,0.4,1.4,0.6,2.8,0.6
                c1.2,0,2-0.1,2.4-0.3c0.4-0.2,0.6-0.6,0.6-1V240h6v0.4c0,1.2-0.4,2.3-1.1,3.2c-0.7,0.9-1.7,1.6-3.1,2.2S189.4,246.5,187.5,246.5z"
                />
            <path class="st1" d="M223.3,230.2h-21.2v-5.4h21.2V230.2z M215.7,246.2h-6v-21.4h6V246.2z"/>
            <path class="st1" d="M230.7,246.2h-6v-16.1h5.6v4.6l0.4,0.2V246.2z M230.7,236.6h-1.1v-2.3h1.1c0.1-0.9,0.4-1.7,0.9-2.4
                c0.4-0.7,1-1.2,1.7-1.6c0.7-0.4,1.6-0.6,2.7-0.6c1.2,0,2.2,0.2,2.9,0.7c0.7,0.5,1.3,1.1,1.6,2c0.3,0.8,0.5,1.8,0.5,2.9v3.2h-6v-1.9
                c0-0.7-0.1-1.2-0.4-1.4c-0.3-0.3-0.8-0.4-1.6-0.4c-0.8,0-1.4,0.1-1.7,0.4C230.9,235.5,230.7,235.9,230.7,236.6z"/>
            <path class="st1" d="M251.2,246.5c-1.9,0-3.5-0.3-4.9-1c-1.4-0.7-2.5-1.6-3.3-2.9c-0.8-1.3-1.2-2.8-1.2-4.5c0-1.7,0.4-3.2,1.2-4.5
                c0.8-1.2,1.9-2.2,3.3-2.9c1.4-0.7,3.1-1,4.9-1c1.9,0,3.5,0.3,4.9,1c1.4,0.7,2.5,1.6,3.3,2.9c0.8,1.2,1.2,2.7,1.2,4.5
                c0,1.7-0.4,3.2-1.2,4.5c-0.8,1.3-1.9,2.2-3.3,2.9C254.7,246.2,253,246.5,251.2,246.5z M251.2,241.2c1.4,0,2.3-0.2,2.8-0.7
                c0.5-0.4,0.7-1.2,0.7-2.4c0-1.2-0.2-2-0.7-2.4c-0.5-0.4-1.4-0.7-2.8-0.7c-1.4,0-2.3,0.2-2.8,0.7c-0.5,0.4-0.7,1.3-0.7,2.4
                c0,1.2,0.2,2,0.7,2.4C248.9,241,249.8,241.2,251.2,241.2z"/>
            <path class="st1" d="M265.6,251.6h-2.9v-5.4h4.7c0.5,0,0.9-0.1,1.1-0.2c0.3-0.1,0.4-0.4,0.6-0.7l0.4-1.1l-0.6,2.7l-8.2-16.9h6.8
                l2.8,6.3l1.2,3.7h0.4l1.1-3.8l2.4-6.3h6.7l-7.6,16.8c-0.6,1.3-1.3,2.2-2,2.9c-0.8,0.7-1.7,1.2-2.8,1.5
                C268.5,251.5,267.1,251.6,265.6,251.6z"/>
            <path class="st1" d="M291.7,246.5c-1.8,0-3.4-0.3-4.8-0.8c-1.4-0.6-2.5-1.5-3.3-2.7c-0.8-1.2-1.2-2.9-1.2-4.9
                c0-1.7,0.4-3.2,1.2-4.5c0.8-1.2,1.9-2.2,3.2-2.9s3-1,4.8-1c1.9,0,3.5,0.3,4.8,0.9c1.4,0.6,2.4,1.5,3.2,2.7c0.7,1.2,1.1,2.6,1.1,4.4
                c0,0.3,0,0.5,0,0.8s0,0.5-0.1,0.8h-14.3v-3h9.9l-1.3,1.9c0-0.2,0-0.4,0-0.6s0-0.4,0-0.6c0-1-0.3-1.7-0.8-2
                c-0.5-0.4-1.4-0.6-2.7-0.6c-1.4,0-2.3,0.2-2.8,0.6c-0.5,0.4-0.7,1.2-0.7,2.3v1.5c0,1.1,0.2,1.9,0.7,2.3c0.5,0.4,1.4,0.6,2.8,0.6
                c1.2,0,2-0.1,2.4-0.3c0.4-0.2,0.6-0.6,0.6-1V240h6v0.4c0,1.2-0.4,2.3-1.1,3.2c-0.7,0.9-1.7,1.6-3.1,2.2
                C295.1,246.3,293.5,246.5,291.7,246.5z"/>
            <path class="st1" d="M311,246.5c-2.8,0-5-0.5-6.5-1.6c-1.5-1-2.2-2.5-2.2-4.4v-0.1h6v0.3c0,0.4,0.2,0.7,0.6,0.8
                c0.4,0.1,1.1,0.2,2.2,0.2c1,0,1.7-0.1,2-0.2c0.3-0.1,0.4-0.3,0.4-0.6c0-0.3-0.1-0.4-0.3-0.5c-0.2-0.1-0.7-0.2-1.4-0.3l-4.7-0.5
                c-1.7-0.2-2.9-0.6-3.8-1.4c-0.9-0.8-1.3-1.9-1.3-3.2c0-1,0.3-1.8,0.8-2.6c0.5-0.8,1.4-1.4,2.7-1.9c1.2-0.5,2.8-0.7,4.8-0.7
                c1.9,0,3.5,0.2,4.7,0.7c1.3,0.4,2.2,1.1,2.9,2s1,2,1,3.3v0.1h-6v-0.2c0-0.3-0.1-0.5-0.2-0.7s-0.4-0.3-0.8-0.4
                c-0.4-0.1-1-0.1-1.8-0.1c-1,0-1.6,0.1-1.8,0.2c-0.2,0.1-0.4,0.4-0.4,0.7c0,0.2,0.1,0.4,0.4,0.5s0.8,0.2,1.8,0.4l3.2,0.4
                c2.3,0.3,4,0.8,4.9,1.6c0.9,0.8,1.3,1.9,1.3,3.2c0,1-0.3,1.9-1,2.7s-1.6,1.4-2.8,1.8C314.3,246.3,312.8,246.5,311,246.5z"/>
        </g>
        <g>
            <path class="st1" d="M112.7,73.5l-5-3.3l11.7-18l6.8,4.4l-1.5,9.6l-1.2,5.8l0.3,0.2l4.7-3.5l8-5.4l6.8,4.4l-11.7,18l-5-3.3l4.8-7.4
                l2.1-2.9l-0.3-0.2l-3,2.3l-6.8,4.6l-6.1-4l1.4-8.1l0.9-3.7l-0.3-0.2l-1.8,3.1L112.7,73.5z"/>
            <path class="st1" d="M138.3,90.1l-5-3.3l11.7-18l6.8,4.4l-1.5,9.6l-1.2,5.8l0.3,0.2l4.7-3.5l8-5.4l6.8,4.4l-11.7,18l-5-3.3l4.8-7.4
                l2.1-2.9l-0.3-0.2l-3,2.3l-6.8,4.6l-6.1-4l1.4-8.1l0.9-3.7l-0.3-0.2l-1.8,3.1L138.3,90.1z"/>
            <path class="st1" d="M163.8,106.7l-5-3.3l11.7-18l5,3.3L163.8,106.7z"/>
        </g>
        <g class="parking">
            <path id="p1z1" class="st2" d="M481.3,201L220.8,31.8c-2.5-1.6-3.2-5-1.6-7.5l11.6-17.8c1.6-2.5,5-3.2,7.5-1.6L498.8,174 c2.5,1.6,3.2,5,1.6,7.5l-11.6,17.8C487.2,201.9,483.9,202.6,481.3,201z"/>
            <path id="p1z3" class="st2" d="M527.5,230.8v242.1c0,3-2.4,5.5-5.5,5.5h-21.2c-3,0-5.5-2.4-5.5-5.5V230.8c0-3,2.4-5.5,5.5-5.5H522 C525.1,225.3,527.5,227.8,527.5,230.8z"/>
            <path id="p1z4" class="st2" d="M436.6,535.5L176,704.8c-2.5,1.6-5.9,0.9-7.5-1.6l-11.6-17.8c-1.6-2.5-0.9-5.9,1.6-7.5l260.6-169.2 c2.5-1.6,5.9-0.9,7.5,1.6l11.6,17.8C439.9,530.5,439.1,533.9,436.6,535.5z"/>
            <path id="p1z2" class="st2" d="M463.2,251.7v242.1c0,3-2.4,5.5-5.5,5.5h-21.2c-3,0-5.5-2.4-5.5-5.5V251.7c0-3,2.4-5.5,5.5-5.5h21.2 C460.7,246.2,463.2,248.6,463.2,251.7z"/>
            <path id="p1z5" class="st2" d="M471.8,589.8L211.2,759c-2.5,1.6-5.9,0.9-7.5-1.6l-11.6-17.8c-1.6-2.5-0.9-5.9,1.6-7.5l260.6-169.2 c2.5-1.6,5.9-0.9,7.5,1.6l11.6,17.8C475.1,584.8,474.4,588.1,471.8,589.8z"/>
        </g>
    </svg>
    <svg id="p2" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="300" x="0px" y="0px" viewBox="0 0 553.3 697.3" style="enable-background:new 0 0 553.3 697.3;" xml:space="preserve">
        <style type="text/css">
            .st3{fill:#DDDDDD;}
            .st4{fill:#FFFFFF;stroke:#3FAF67;stroke-width:5;stroke-miterlimit:10;}
        </style>
        <path class="st3" d="M317.5,147.2C319.5,148.8,318,147.6,317.5,147.2c-0.3-0.3-0.7-0.6-1-1c-0.6-0.6-1.3-1.2-1.8-1.8
            c-0.6-0.6-1.2-1.3-1.7-1.9c-0.3-0.4-0.6-0.8-0.9-1.1c1.6,1.8,0.5,0.7,0.2,0.2c-2.1-2.9-3.9-6.1-5.3-9.5c0.3,0.6,0.5,1.2,0.8,1.8
            c-2.2-5.2-3.6-10.7-4.3-16.3c0.1,0.7,0.2,1.3,0.3,2c-1.1-8.6-0.6-17.2,0.5-25.7c-0.1,0.7-0.2,1.3-0.3,2c1.6-12,4.5-23.9,6.2-35.9
            c1.7-11.9,2.3-23.8,0.1-35.6c-1.2-6.4-3.4-12.7-6.6-18.5c-1.9-3.4-6.9-4.8-10.3-2.7c-3.5,2.2-4.7,6.6-2.7,10.3
            c0.9,1.6,1.7,3.3,2.4,5c-0.3-0.6-0.5-1.2-0.8-1.8c2,4.8,3.3,9.9,4,15.1c-0.1-0.7-0.2-1.3-0.3-2c1.2,9,0.7,18.1-0.5,27
            c0.1-0.7,0.2-1.3,0.3-2c-2.2,16-6.4,31.6-7.6,47.7c-1,13.6,0.9,27.6,7,39.9c3.5,7.1,8.6,13,14.8,17.8c1.4,1.1,4.1,1.2,5.8,0.8
            c1.7-0.5,3.6-1.8,4.5-3.4c0.9-1.7,1.4-3.8,0.8-5.8C320.3,149.7,319.1,148.5,317.5,147.2L317.5,147.2z"/>
        <g class="parking">
            <path id="p2z1" class="st4" d="M167.8,353.3L32,489.1c-2.2,2.2-5.8,2.2-8.1,0L9.2,474.5c-2.2-2.2-2.2-5.8,0-8.1L145,330.6 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C170,347.5,170,351.1,167.8,353.3z"/>
            <path id="p2z2" class="st4" d="M346.6,174.5L210.8,310.3c-2.2,2.2-5.8,2.2-8.1,0l-14.7-14.7c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C348.9,168.6,348.9,172.2,346.6,174.5z"/>
            <path id="p2z4" class="st4" d="M396.1,223.9L260.3,359.7c-2.2,2.2-5.8,2.2-8.1,0L237.5,345c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C398.3,218,398.3,221.7,396.1,223.9z"/>
            <path id="p2z3" class="st4" d="M217.2,402.8L81.4,538.6c-2.2,2.2-5.8,2.2-8.1,0l-14.7-14.7c-2.2-2.2-2.2-5.8,0-8.1L194.5,380 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C219.4,396.9,219.4,400.5,217.2,402.8z"/>
            <path id="p2z5" class="st4" d="M243.7,429.3L107.9,565.1c-2.2,2.2-5.8,2.2-8.1,0l-14-14c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14,14C245.9,423.4,245.9,427,243.7,429.3z"/>
            <path id="p2z6" class="st4" d="M422.6,250.4L286.8,386.2c-2.2,2.2-5.8,2.2-8.1,0l-14-14c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14,14C424.8,244.6,424.8,248.2,422.6,250.4z"/>
            <path id="p2z10" class="st4" d="M497.9,325.7L362.1,461.5c-2.2,2.2-5.8,2.2-8.1,0l-14.7-14.7c-2.2-2.2-2.2-5.8,0-8.1L475.2,303 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C500.2,319.9,500.2,323.5,497.9,325.7z"/>
            <path id="p2z8" class="st4" d="M470.5,298.3L334.7,434.1c-2.2,2.2-5.8,2.2-8.1,0L312,419.5c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C472.7,292.5,472.7,296.1,470.5,298.3z"/>
            <path id="p2z7" class="st4" d="M291.6,477.2L155.8,613c-2.2,2.2-5.8,2.2-8.1,0l-14.7-14.7c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C293.9,471.3,293.9,475,291.6,477.2z"/>
            <path id="p2z9" class="st4" d="M319.1,504.6L183.3,640.4c-2.2,2.2-5.8,2.2-8.1,0l-14.7-14.7c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C321.3,498.8,321.3,502.4,319.1,504.6z"/>
            <path id="p2z12" class="st4" d="M546.7,374.5L410.9,510.3c-2.2,2.2-5.8,2.2-8.1,0l-14.7-14.7c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C548.9,368.6,548.9,372.2,546.7,374.5z"/>
            <path id="p2z11" class="st4" d="M367.8,553.3L232,689.1c-2.2,2.2-5.8,2.2-8.1,0l-14.7-14.7c-2.2-2.2-2.2-5.8,0-8.1l135.8-135.8 c2.2-2.2,5.8-2.2,8.1,0l14.7,14.7C370,547.5,370,551.1,367.8,553.3z"/>
        </g>
        <path class="st3" d="M92.4,611.9l11,11c1.4,1.4,0.7,3.7-1.1,4.2l-39.8,10.7c-1.9,0.5-3.6-1.2-3.1-3.1l10.7-39.8
            c0.5-1.9,2.8-2.5,4.2-1.1l11,11c1,1,2.6,1,3.5,0l44.5-44.5c1-1,2.6-1,3.5,0h0c1,1,1,2.6,0,3.5l-44.5,44.5
            C91.4,609.3,91.4,610.9,92.4,611.9z"/>
    </svg>

        <label for="departure_address">Adresse de départ</label>
        <input type="text" id="departure_address" name="departure_address" placeholder="Adresse de départ">
    </div>
    <div>
        <input type="datetime-local" id="departure_date" name="departure_date">
    </div>
    <p>Définir le point d'arrivée</p>
    <div class="form-group">
        <div>
            <label for="destination_city">Ville de destination</label>
            <input type="text" id="destination_city" name="destination_city" placeholder="Ville d'arrivée">
        </div>
        <div>
            <label for="destination_address">Adresse de destination</label>
            <input type="text" id="destination_address" name="destination_address" placeholder="Adresse de destination">
        </div>
    </div>
    <div>
        <label for="seats">Nombre de passagers</label>
        <input type="number" id="seats" name="seats" min="1" max="99" placeholder="nombre de passagers">
    </div>

    <button type="submit" class="btn green">Valider le trajet</button>
</form>

<script src="assets/js/trip_parking.js"></script>

<section>
    <div class="container">
        <div class="grid cols-3 mt-md">
            <?php
            /* include('./components/card_trip.php');
            for ($i = 0; $i < 4; $i++) {
                cardTrip();
            } */
            $db = dbConnect();

            $query = $db->query('SELECT trips.id AS trip_id, vehicles.id AS vehicle_id, trips.*, users.*, vehicles.* FROM trips INNER JOIN users ON trips.user_id = users.id INNER JOIN vehicles ON trips.vehicle_id = vehicles.id ORDER BY trips.created_at DESC');
            $trips = $query->fetchAll();
            ?>
            <?php foreach ($trips as $trip) : ?>
                <?php if($trip['seats'] > 0) : ?>
                    <div class="card hover dark">
                        <img class="full" src="assets/images/vehicles/<?= $trip['image'] ?>" alt="car" style="max-width: 400px;">
                        <div class="gradient"></div>
                        <div class="tags top">
                            <span><img src="./assets/images/icons/users.svg" alt="seats icon"><?= $trip['seats'] ?> places</span>
                            <span><img src="./assets/images/icons/clock.svg" alt="clock icon"><?= $trip['departure_at'] ?></span>
                            <span class="trip2"><img src="./assets/images/avatars/<?= $trip['picture'] ?>" alt="profile picture" style="width: 40px; border-radius: 50%;"><p><?= $trip['first_name'] . " " . $trip['last_name']?></p></span>
                        </div>
                        <div class="trip">
                            <span><?= $trip['departure_city'] != $trip['destination_city'] ? $trip['departure_city'] : $trip['departure_city'] . ", " . $trip['departure_address'] ?></span>
                            <img src="./assets/images/icons/arrow-dotted.svg" alt="arrow dotted icon">
                            <span><?= $trip['departure_city'] != $trip['destination_city'] ? $trip['destination_city'] : $trip['destination_city'] . ", " . $trip['destination_address'] ?></span>
                        </div>
                        <div class="trip2">
                            <span><?= $trip['departure_city'] . ", " . $trip['departure_address'] ?></span>
                            <img src="./assets/images/icons/arrow-dotted.svg" alt="arrow dotted icon">
                            <span><?= $trip['destination_city'] . ", " . $trip['destination_address'] ?></span>
                            <?php
                                if(isAuthenticated()) {
                                    if($trip['user_id'] !== $_SESSION['user']['id']) {
                                        echo '<a href="reservation.php?trip_id=' . $trip['trip_id'] . '" class="btn">Réserver</a>';
                                    } else {
                                        echo '<a href="edit_trip.php?trip_id=' . $trip['trip_id'] . '" class="btn">Modifier</a>';
                                    }
                                }
                            ?>
                        </div>
                        <style>
                            .trip2 {
                                display: none;
                            }
                        </style>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
  let previousCard = null;

  document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', () => {
      if (previousCard !== null) {
        previousCard.style.gridColumn = '';
        previousCard.style.gridRow = '';
        const previousTrip1 = previousCard.querySelector('.trip');
        const previousTrip2 = previousCard.querySelectorAll('.trip2');
        previousTrip1.style.display = '';
        previousTrip2.forEach(trip => {
          trip.style.display = '';
          trip.style.alignItems = '';
        });
      }

      card.style.gridColumn = '1 / span 3';
      card.style.gridRow = '1';

      const trip1 = card.querySelector('.trip');
      const trip2 = card.querySelectorAll('.trip2');

      trip1.style.display = 'none';
      trip2.forEach(trip => {
        trip.style.display = 'flex';
        trip.style.alignItems = 'center';
      });

      previousCard = card;
    });
  });
</script>
</section>

<?php
    unset($_SESSION['message']);
    unset($_SESSION['tripLog']);
?>