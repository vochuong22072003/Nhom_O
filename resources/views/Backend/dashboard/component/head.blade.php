<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Nhóm O - Dashboard</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('Backend/css/customsize.css') }}" rel="stylesheet">

@if(isset($config['css'])&& is_array($config['css']))
    @foreach($config['css'] as $key => $val)
        <link href="{{ asset($val) }}" rel="stylesheet">
    @endforeach
@endif
<script>
    var BASE_URL = '{{ env('APP_URL') }}'
    var SUFFIX = '{{ config('apps.general.suffix') }}'
</script>