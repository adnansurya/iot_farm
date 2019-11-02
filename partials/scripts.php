
<!-- Jquery Core Js -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap/js/bootstrap.js"></script>

<!-- DataTables Plugin Js -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>


<!-- Slimscroll Plugin Js -->
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="plugins/node-waves/waves.js"></script>

<!-- Custom Js -->
<script src="js/admin.js"></script>

<!-- Demo Js -->
<script src="js/demo.js"></script>

<script>   
    function setNavigation() {        
        var path =  window.location.href.substr(window.location.href.lastIndexOf("/")+1);                      
        $(".list a").each(function () {
           
            var href = $(this).attr('href');               
            if (path == href) {                
                $(this).parent().addClass('active');
            }else{
                $(this).parent().removeClass('active');
            }
        });
    }
    $(function () {
        setNavigation();
    });
</script>

