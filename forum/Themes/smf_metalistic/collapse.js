function setcookie(name, value, expire)
	{
		var theDate = new Date();
		theDate.setTime(expire);

		if (expire)
			document.cookie = name + "=" + escape(value) + "; expires=" + theDate.toGMTString();
		else
			document.cookie = name + "=" + escape(value);
	}
	function getcookie(name)
	{
		var cookies = document.cookie.split(/[;][ ]?/), temp;

		for (var i = 0; i < cookies.length; i++)
		{
			temp = cookies[i].split("=");
			if (temp[0] == name)
				return temp[1];
		}

		return typeof(undefined) != "undefined" ? undefined : 0;
	}

	function boardIndexCollapse(what)
	{
		var collapseImage = document.getElementById("collapse_" + what);
		var collapseRow = document.getElementById("row_" + what);

		if (!collapseImage)
			return;

		if (collapseRow.style.display == "")
		{
			collapseRow.style.display = "none";
			collapseImage.src = smf_images_url + "/expand.gif";

			setcookie("boardindex" + what, "1", new Date().getTime() + 525600 * 60);
		}
		else
		{
			collapseRow.style.display = "";
			collapseImage.src = smf_images_url + "/collapse.gif";

			setcookie("boardindex" + what, "0", new Date());
		}
	}

	function boardIndexCheck()
	{
		var bars = ["recent", "calendar", "members", "sp1", "users", "pm", "login"];

		for (var i = 0; i < bars.length; i++)
		{
			if (getcookie("boardindex" + bars[i]) == "1")
				boardIndexCollapse(bars[i]);
		}
	}