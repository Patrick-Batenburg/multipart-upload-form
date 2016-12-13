function makeFileList()
{
	var ul = document.getElementById("fileList");
	var input = document.getElementById("file-1");

	while (ul.hasChildNodes())
	{
		ul.removeChild(ul.firstChild);
	}

	for (var i = 0; i < input.files.length; i++)
	{
		var li = document.createElement("li");
		li.innerHTML = input.files[i].name;
		ul.appendChild(li);
	}

	if(!ul.hasChildNodes())
	{
		var li = document.createElement("li");
		li.innerHTML = "Geen bestanden geselecteerd";
		ul.appendChild(li);
	}
}