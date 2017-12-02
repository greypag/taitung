scnShortcodeMeta = {
	attributes : [ {
		label : "Type",
		id : "type",
		help : "Select which type of pricing table you would like to use.",
		controlType : "select-control",
		selectValues : [ 'type1', 'type2' ],
		defaultValue : 'type1',
		defaultText : 'type1'
	},
	{
		label : "Style",
		id : "space",
		help : "Select spacing you would like to for pricing table.",
		controlType : "select-control",
		selectValues : [ 'space', 'no-space' ],
		defaultValue : 'space',
		defaultText : 'space'
	},
	{
		label : "Columns",
		id : "content",
		controlType : "column-control"
	}],
	customMakeShortcode : function(b) {
		var a = b.data, type = b.type, space = b.space;
		
		if (!a)
			return "";
		b = a.numColumns;
		var c = a.content;
		a = [ "0", "one", "two", "three", "four", "five", 'six' ];
		var x = [ "0", "0", "half", "third", "fourth", "fifth", 'sixth' ];
		var f = x[b];
		c = c.split("|");
		var g = g2 = "";
		var colors = ['purple', 'gold', 'pink', 'purple', 'gold', 'pink', 'purple', 'gold', 'pink'];
		
		for ( var h in c) {
			var d = jQuery.trim(c[h]);
			if (d.length > 0) {
				var e = a[d.length] + '_' + f;
				if (b == 4 && d.length == 2)
					e = "one_half";

				var z = e;
				var selected = "";
				if (h == 0) {
					e += " first";
					selected = "selected";
				}

				if(type == 'type2') {
					g += "[dt_sc_"
							+ e
							+ "] "
							+ "<br>[dt_sc_pricing_table_item_two heading='Summer stay for Single couple @ $250.00 for 2 Nights' thumb_image='http://placehold.it/395x250&text=Thumb' subtitle='Comfy Catherenes Home @ Genes Block Travanza' logo='http://placehold.it/253x48&text=Logo' color='" + colors[h] + "' button_size='too-small'  button_text='Buy Now' button_link='#']<br/><br/>"
							+ "Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit and seltd tasm cursus nunc."
							+ "<br/><br/>[/dt_sc_pricing_table_item_two]<br>" + " [/dt_sc_" + z
							+ "] <br/>";
				} else {
					g += "[dt_sc_"
							+ e
							+ "] "
							+ "<br>[dt_sc_pricing_table_item heading='Heading' button_text='Buy Now' button_link='#' price='$15' per='month' "
							+ selected + "]<br>" + "<ul>" + "<li>Text</li>"
							+ "<li>Text</li>" + "<li>Text</li>" + "</ul>"
							+ "[/dt_sc_pricing_table_item]<br>" + " [/dt_sc_" + z
							+ "] <br/>";
				}
			}
		}

		return "[dt_sc_pricing_table type='" + type + "' space='" + space + "']<br>" + g + "<br>[/dt_sc_pricing_table]";
	}
};