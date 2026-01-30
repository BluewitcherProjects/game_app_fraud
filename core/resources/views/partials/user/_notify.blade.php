<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 12/02/2022
 * Time: 10:49
 */
?>

@if(Session::has('success'))

    <script type="text/javascript">
        toast("{{Session::get('success')}}","success");
    </script>
@endif

@if(Session::has('fail'))
    <script type="text/javascript">
        toast("{{Session::get('fail')}}","error");
    </script>
@endif
