<!DOCTYPE html>
<html>
	<head>
    @include("front.layouts.head")
	@yield("header-section")
        {!! ModelHelper::getDataFromSetting('google-analytics') !!}
        {!! ModelHelper::getDataFromSetting('google-tag-master') !!}
        {!! ModelHelper::getDataFromSetting('facebook-pixel-code') !!}
        {!! ModelHelper::getDataFromSetting('other-thing-on-head') !!} 
	</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">

    

    	{!! ModelHelper::getDataFromSetting('after-body-open-tag') !!}
	  @include("front.layouts.header")


	  @yield('container')

	@include("front.layouts.footer")	

@yield("footer-section")
    	{!! ModelHelper::getDataFromSetting('chat-bot') !!}
</body>
</html>