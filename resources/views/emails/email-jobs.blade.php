<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
</head>

<body>
	<p>{{ $intro }}</p>

	<div>
		{!! '<p>'.$content.'</p>' !!}
		<a href="{{ $link }}">{!! '<p>'. $link.'</p>'!!}</a>
	    <br>
		<small class="text-sm">
			Thanks,<br>
			Enjoy!<br>
			Quality Control Team<br>
			Better Globe Forestry LTD.
		</small>
		<br>
		<hr style="color:#e6e6e6" />
		<p style="color:#e6e6e6"><small>This email has been sent to you as a registered member of <a href="https://betterglobeforestry.com" style="color:#e6e6e6">betterglobeforestry.com</a></small></p>
		<p style="color:#e6e6e6"><small>&copy; {{ \Carbon\Carbon::now()->format('Y') }} Copyright Better Globe Forestry LTD. All rights reserved.</small></p>
	</div>
</body>

</html>