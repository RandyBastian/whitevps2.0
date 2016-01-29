</div><div class="space"></div><div class="block-bottom">
            <!-- Colored devider -->
            <div class="devider-color"></div>

            <!-- Footer section -->
            <footer class="footer footer--simple">
                <div class="container">
                    <div class="copy">
                        White-VPS, 2015. All rights reserved.
                    </div>
        

                </div><!-- end container -->
            </footer>
            <!-- end footer section -->
        </div></div><!-- /#page -->


    <!-- Load JS here for greater good =============================-->
    <!-- jQuery 1.10.1--> 
        <script src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
        <!-- Bootstrap 3--> 
        <script src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
        <!-- Header (space animation) -->
        <script src="<?php echo base_url();?>/assets/frontend/external/animated-header/js/TweenLite.min.js"></script>
        <script src="<?php echo base_url();?>/assets/frontend/external/animated-header/js/EasePack.min.js"></script>
        <script src="<?php echo base_url();?>/assets/frontend/external/animated-header/js/rAF.js"></script>
        <script src="<?php echo base_url();?>/assets/frontend/external/animated-header/js/header-animate.js"></script>	
        <!-- Waypoints -->
        <script src="<?php echo base_url();?>/assets/frontend/external/waypoint/waypoints.min.js"></script>	
		<!-- Modernizr -->
		<script src="<?php echo base_url();?>/assets/frontend/external/modernizr/modernizr.custom.js"></script>
		<!-- Mobile menu -->
		<script src="<?php echo base_url();?>/assets/frontend/external/z-nav/jquery.mobile.menu.js"></script>
        <!-- Magnific popup - responsive popup plugin -->
         <script src="<?php echo base_url();?>/assets/frontend/external/magnific-popup/jquery.magnific-popup.min.js"></script>
        <!-- Count comimg soon -->
        <script src="<?php echo base_url();?>/assets/frontend/external/count/count.down.js"></script>
        <!-- Form -->
        <script src="<?php echo base_url();?>/assets/frontend/js/form.js"></script>
		<!-- Custom -->
        <script src="<?php echo base_url();?>/assets/frontend/js/custom.js"></script>
<!--
        <script>
        $(document).ready(function(){
            $('#search-domain').on('submit', function(form){
                $("#submit").css("display","none");
                $("#loading").css("display","block");
                $.post($('#search-domain').attr('action'), $('#search-domain').serialize(), function(data){
                    $('#result').html(data);
                    $("#submit").css("display","block");
                    $("#loading").css("display","none");
                });
                return false;
            });
        });
    </script>
-->
    <script>
            $(document).ready(function() {
                navAnim(".waypoint");   
                mobile_menu('.z-nav__list');
                cart(".cart");
                sequenceExp('.sequence');
                galleryPopup(".gallery-wrapper");
                count(".comming");

                //counters

                countDownHour("Oct 1, 2014", "Oct 12, 2014", "discount-1");
                countDownHour("Oct 1, 2014", "Oct 11, 2014", "discount-2");
                countDownHour("Oct 1, 2014", "Oct 13, 2014", "discount-3");

                countDownHour("Oct 1, 2014", "Oct 11, 2014", "timer-1");
                countDownHour("Oct 1, 2014", "Oct 10, 2014", "timer-2");
                countDownHour("Oct 1, 2014", "Oct 13, 2014", "timer-3");
                countDownHour("Oct 1, 2014", "Oct 14, 2014", "timer-4");  
            });
        </script>
        <!-- Histats.com  START (hidden counter)-->
        <script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
        <a href="http://www.histats.com" target="_blank" title="web site hit counter" ><script  type="text/javascript" >
        try {Histats.start(1,3053472,4,0,0,0,"");
        Histats.track_hits();} catch(err){};
        </script></a>
        <noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?3053472&101" alt="web site hit counter" border="0"></a></noscript>
        <!-- Histats.com  END  -->
</body></html>