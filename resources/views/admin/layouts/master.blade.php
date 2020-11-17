<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('admin.partials.head')
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	@include('admin.partials.header')

	@include('admin.partials.sidebar')

	@section('content')

	@show

	@include('admin.partials.footer')

</body>	
</html>
