document.onkeydown = keydown;
	
	function keydown(evt)
	{
		if (!evt) evt = event;
		if (evt.altKey && evt.keyCode == 49) //ALT + 1
		{
			window.location.href = "index.php?search";
		}
		if (evt.altKey && evt.keyCode == 50) //ALT + 2
		{
			window.location.href = "index.php?login";
		}
		if (evt.altKey && evt.keyCode == 51) //ALT + 3
		{
			window.location.href = "index.php?registration";
		}
		if (evt.altKey && evt.keyCode == 52) //ALT + 4
		{
			window.location.href = "household_create";
		}
		if (evt.altKey && evt.keyCode == 53) //ALT + 5
		{
			window.location.href = "household";
		}
	}