    <!-- jQuery 2.1.4 -->
<!-- jQuery 2.2.0 -->
        <script src="<?=base_url();?>js/plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
                <script src="<?=base_url();?>js/jquery-ui.min.js"></script>

<!--         <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
 -->        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?=base_url()?>js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <!--<script src="<?=base_url()?>js/plugins/morris/morris.min.js"></script>-->
        <!-- Sparkline -->
        <script src="<?=base_url()?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?=base_url()?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?=base_url()?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?=base_url()?>js/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
<!--         <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
 -->        <script src="<?=base_url()?>js/plugins/daterangepicker/moment.min.js"></script>

 -->        <script src="<?=base_url()?>js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="<?=base_url()?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?=base_url()?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?=base_url()?>js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="<?=base_url()?>js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=base_url()?>js/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="<?=base_url()?>js/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url()?>js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?=base_url()?>js/pages/dashboard.js"></script>
        <script src="<?=base_url()?>js/TweenMax.min.js"></script>
        <script src="<?=base_url()?>js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="<?=base_url()?>js/jquery.jfeed.pack.js"></script>

        <script src="<?=base_url()?>js/jquery.newsWidget.min.js"></script>
        <script>
            jQuery(document).ready(function() { 
                if($("#mainNewsWidget").length > 0){
                        $("#mainNewsWidget").newsWidget({
                                    currentNewsWidth: 550,
                                    currentNewsHeight:280,
                                    numberOfNews :2,   
                                    widgetHeight: 540, 
                                    fullArticleType : "widget" ,
                                    navBtns: "right",
                                    closedNewsWidth:500,
                                    closedNewsPosition:"right", 
                                    closedNewsOffset:50, 
                                    maxLetters : 330,
                                    widgetOpenType: "fadeDown", 
                                    widgetOpenDelay: 0.5,          
                                    widgetOpenDuration: 0.5,
                                    fullArticleOpen: "fadeDown",   
                                    fullArticleClose: "fadeDown",   
                                    fullArticleOpenDelay: 0.1, 
                                    fullArticleAnimationDuration:0.5,  
                                    animationsDuration:0.4,  
                                    easeing: "Expo.easeOut",
                                    currentNewsHoverType : 1 ,
                                    linkText:"Read: " ,  
                                    titleInLink : "after",
                                    linkTarget : "blank", 
                                    readMoreTxt: "Continue Reading ..", 
                                    feed: "none",
                                    feedReadMoreType: "insite" ,
                                    feedMaxNum: 10 
                            });
                }     
            });
                
        </script>

        <!-- AdminLTE for demo purposes -->
  </body>
</html>
