<?php $is_admin = isset($_SESSION) && isset($_SESSION['type']) && $_SESSION['type']=='admin'; ?>

<div id="announcements_container" class="<?php  if($is_admin) echo 'admin'; else echo 'notAdmin';?>">
    <div id="announcement_carousel" class="carousel slide <?php if(!$is_admin) echo 'hideable'; ?>" data-ride="carousel">
       
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
         <!-- Carousel indicators -->
        
    </div>

</div>
<script src="<?php echo base_url() ?>js/announcements_table_generator.js"></script>
