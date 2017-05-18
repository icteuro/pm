<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>p.m. and issue tracker</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
 @include('layouts.header')

<div id="wrapper">
    <!-- menu start -->
    <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page_name" href="index.php">P.M And Issue Tracker</a>
        </div>
       
      @include('layouts/top_menu')
      @include('layouts/sidebar_menu')
        
    </nav><!-- menu end -->
    
 	<div id="page-wrapper">
		@yield('content')
    </div>
</div>
 @include('layouts.footer')
