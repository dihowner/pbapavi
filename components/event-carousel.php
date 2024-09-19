<?php
if (!empty($events)) {
    $eventImages = [];
    foreach ($events as $event) {
        $eventImages[] = $event['event_banner'];
    }
    ?>

    <div id="default-carousel" class="order-1 lg:order-2 relative w-full ml-auto mb-10 lg:mb-0" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative  h-56 overflow-hidden rounded-xl lg:h-96">
            <?php foreach ($eventImages as $image) { ?>
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="<?php echo UPLOADS_DIR . EVENT_DIR . $image; ?>"
                        class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            <?php } ?>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <?php for ($i = 0; $i < count($eventImages); $i++) { ?>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="<?php echo ($i == 0) ? 'true' : 'false'; ?>"
                    aria-label="Slide <?php echo $i + 1; ?>" data-carousel-slide-to="<?php echo $i; ?>"></button>
            <?php } ?>
        </div>
    </div>
    <?php
} else {
    ?>
    <!-- // echo '<h3>No upcoming event at the moment</h3>'; -->
    <div class='w-full order-1 lg:order-2 h-full flex flex-col gap-3 justify-center items-center'>
        <div class="relative w-full h-full mb-10 lg:mb-0 ">
            <img src="img/coming-soon.jpg" alt="coming soon" class="w-[90%] rounded-xl m-auto">
        </div>
        <h3 class="text-xl lg:text-2xl font-bold">
            <i>No upcoming event at the moment!!!</i>
        </h3>
    </div>
    <?php
}
?>