<section class="module module-e5c406">
    <?php
    $articleDatenschutz = rex_article::get(rex_global_settings::getValue("article_datenschutz"));
    $cookieConsentSettings = new BootstrapCookieConsentSettings();
    $showMaps = $cookieConsentSettings->getSetting("maps") || rex_post("showMaps", "bool");
    $showAllMaps = rex_post("showAllMaps", "bool");
    if ($showAllMaps) {
        $cookieConsentSettings->setSetting("maps", true);
    }
    if(!$showMaps) {
        $datenschutzUrl = $articleDatenschutz->getUrl();
        $showMapsCode = "
<form method='post' action='#anreise'>
    <p class='mb-2'>Mit dem Laden der Karte akzeptieren Sie die Datenschutzerklärung von Google.</p>
    <p class='mb-2'><a href='$datenschutzUrl'>Mehr erfahren</a></p>
    <div class='form-check py-1 mb-3'>
      <input class='form-check-input' type='checkbox' value='1' name='showAllMaps' id='showAllMaps'>
      <label class='form-check-label' for='showAllMaps'>
        Alle Karten auf dieser Website anzeigen
      </label>
    </div>
    <button type='submit' name='showMaps' value='1' class='btn btn-primary'>Karte laden</button>
</form>
        "; ?>
        <div class="maps-disabled" style="width: 100%; height: 600px;">
            <?= $showMapsCode ?>
        </div>
        <?php
    } else {
    ?>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2509.66210188776!2d12.789353!3d51.022391!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a716626c4c0853%3A0x9ea92e65ec8415fc!2sLandgasthof%20S%C3%B6rnzig%20-%20WAD%20Bildungsakademie%20GmbH!5e0!3m2!1sde!2sde!4v1748510009405!5m2!1sde!2sde"
            width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <?php } ?>
</section>