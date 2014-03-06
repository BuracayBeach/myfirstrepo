<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
        <div class="active item">
            <div class="carousel-caption">

                <h3>First slide label</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        <div class="item">
            <div class="carousel-caption">

                <h3>Second slide label</h3>
                <p>Vestibulum quis quam ut magna consequat faucibus.</p>
            </div>
        </div>
        <div class="item">
            <div class="carousel-caption">

                <h3>Third slide label</h3>
                <p>Praesent commodo cursus magna, vel scelerisque nisl.</p>
            </div>
        </div>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<div id="announcements_container"">
    <div id="announcements_table_container" >
    </div>
</div>
<script src="<?php echo base_url() ?>js/announcements_table_generator.js"></script>
