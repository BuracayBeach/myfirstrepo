<div id="announcements_container" class="<?php if(isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type']=='admin') echo 'admin'; else echo 'notAdmin';?>">
    <div id="announcement_carousel" class="carousel slide hideable" data-ride="carousel">
        <!-- Carousel indicators -->
        <ol class="carousel-indicators">
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">

        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#announcement_carousel" data-slide="prev">
            <span><</span>
        </a>
        <a class="carousel-control right" href="#announcement_carousel" data-slide="next">
            <span>></span>
        </a>
    </div>
</div>
<script src="<?php echo base_url() ?>js/announcements_table_generator.js"></script>
