"use strict";

;(function(jQuery, window, document, undefined)
{
	jQuery(".inputfile").each( function()
	{
		var $input = jQuery(this), $label = $input.next("label"), labelVal = $label.html();

		jQueryinput.on("change", function(e)
		{
			var fileName = "";

			if(this.files && this.files.length > 1)
			{
				fileName = (this.getAttribute("data-multiple-caption") || "").replace("{count}", this.files.length);
			}
			else if(e.target.value)
			{
				fileName = e.target.value.split("\\").pop();
			}

			if(fileName)
			{
				$label.find("span").html(fileName);
			}
			else
			{
				$label.html(labelVal);
			}
		});

		$input
		.on("focus", function()
		{
			$input.addClass("has-focus");
		})
		.on("blur", function()
		{
			$input.removeClass("has-focus" );
		});
	});
})(jQuery, window, document);