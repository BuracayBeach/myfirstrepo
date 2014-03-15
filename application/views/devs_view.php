<link rel="stylesheet" href="<?php echo base_url(); ?>css/fly_sidemenu.css">
<div class="sidemenu">
    <a href="http://www.bucketlistly.com">BucketListly</a>
    <a href="http://www.mycolorscreen.com">MyColorScreen</a>
    <a href="http://www.thepetedesign.com">The Pete Design</a>
    <a href="http://www.thepetedesign.com/#design">Free jQuery Plugins</a>
    <a href="http://www.blog.bucketlistly.com">My Blog</a>
</div>
<div id="devs_button"></div>
<script src="<?php echo base_url(); ?>js/jquery.fly_sidemenu.min.js"></script>
<script>
    $(document).ready( function() {
        $(".sidemenu").fly_sidemenu({
            btnContent: "<h1>The Team</h1>", // This option let you define what appears inside the side menu button. You can add your custom icon here. This option accepts all HTML tags. The default value is "=" string.
            position: "left", // This option will let you define where the sidebar will appear on the page. Available options are "top", "left", "right", "bottom". The default value is "left"
            customSelector: "div", // In case you do not want to use lists, simply define your own css selector here. The default value is "li".
            hideButton: false // You can disable the auto creation of toggle button by changing this to true. The default value is false.
        });
    });
</script>