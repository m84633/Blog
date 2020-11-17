  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2016-{{ now()->year }} <a href="http://adminlte.io">Hello Blog</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src={{ asset('admin/plugins/jquery/jquery.min.js') }}></script>
<!-- Bootstrap 4 -->
<script src={{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset('admin/dist/js/adminlte.min.js') }}></script>
<!-- AdminLTE for demo purposes -->
<script src={{ asset('admin/dist/js/demo.js') }})></script>

<script src={{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }} ></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
@section('footer')
@show