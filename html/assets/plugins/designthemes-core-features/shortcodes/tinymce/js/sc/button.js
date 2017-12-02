scnShortcodeMeta = {
	attributes : [
			{
				label : "Style",
				id : "type",
				help : "Select which type of button you would like to use.",
				controlType : "select-control",
				selectValues : [ 'type1', 'type2'],
				defaultValue : 'type1',
				defaultText : 'type1'
			},

			{
				label : "Icon Style",
				id : "iconstyle",
				help : "Select which type of icon style button you would like to use.",
				controlType : "select-control",
				selectValues : [ 'no-icon', 'with-icon','with-hover-effect'],
				defaultValue : 'no-icon',
				defaultText : 'No Icon'
			},

			{
				label : "Icon",
				id : "icon",
				help : "Add Font Awesome Icon to button ( fa-home) ",
			},

			{
				label : "Title",
				id : "content",
				help : "The button title.",
			},
			{
				label : "Link",
				id : "link",
				help : "Optional link (e.g. http://google.com).",
			},
			{
				label : "Size",
				id : "size",
				help : "Values: &lt;empty&gt; for normal size, small, large, xl.",
				controlType : "select-control",
				selectValues : [ 'small', 'medium', 'large', 'xlarge' ],
				defaultValue : 'medium',
				defaultText : 'medium (Default)'
			},
			{
				label : "Background Color",
				id : "bgcolor",
				help : 'Or you can also choose your own color to use as the background for your button',
				controlType : "color-control"
			},
			{
				label : 'Variation',
				id : 'variation',
				help : 'Choose one of our predefined color skins to use with your list.',
				controlType : "select-control",
				selectValues : [ '','avocado','black','blue','blueiris','blueturquoise','brown','burntsienna','chillipepper','emerald','eggplant','electricblue','graasgreen','gray','green','orange','palebrown','pink','radiantorchid','red','skyblue','violet','wetasphalt','yellow'],
				defaultValue : '',
				defaultText : 'Select'
			},
			{
				label : "Text Color",
				id : "textcolor",
				help : 'You can change the color of the text that appears on your button.',
				controlType : "color-control"
			},
			{
				label : "Target",
				id : 'target',
				help : 'Setting the target to _blank will open your page in a new tab when the reader clicks on the button.',
				controlType : "select-control",
				selectValues : [ '_blank', '_new', '_parent', '_self', '_top' ],
				defaultValue : '_blank',
				defaultText : '_blank (Default)'
			} ],
	defaultContent : "Click me!",
	shortcode : "dt_sc_button"

};