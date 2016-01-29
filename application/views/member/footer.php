	</div>
    <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>/assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

     <script src="<?php echo base_url();?>/assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>/assets/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
        $(".checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    </script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    <script>
        $(document).ready(function(){
            $('#userform').on('submit', function(form){
                $("#submit").css("display","none");
                $("#loading").css("display","block");
                $("#hasil").css("display","none");
                $.post($('#userform').attr('action'), $('#userform').serialize(), function(data){
                    if(data == "-1")
                    {
                        location.reload();
                    }
                    else
                    {
                        $("#hasil").css("display","block");
                        $('#hasil').html(data);
                        $("#submit").css("display","block");
                        $("#loading").css("display","none");
                    }
                });
                return false;
            });
        });
    </script>
    <script type="text/javascript">
         $(document).ready(function(){
            $("#refresh").click(function(){
                location.reload();
            });
        });
    </script>
</body>
</html>

