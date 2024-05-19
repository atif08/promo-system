<!-- JAVASCRIPT -->
<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('/libs/node-waves/node-waves.min.js')}}"></script>
<script src="{{ URL::asset('/libs/waypoints/waypoints.min.js')}}"></script>
<script src="{{ URL::asset('/libs/jquery-counterup/jquery-counterup.min.js')}}"></script>

<script src="{{ asset('libs/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('libs/datatables/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('libs/datatables/dataTables.fixedColumns.min.js') }}"></script>
<script src="{{ asset('js/pages/datatables.init.js') }}"></script>

 @yield('script')

 <!-- App js -->
{{-- <script src="{{ URL::asset('/assets/js/app.min.js')}}"></script>--}}
<script src="{{ URL::asset('/js/app.js')}}"></script>

 @yield('script-bottom')
