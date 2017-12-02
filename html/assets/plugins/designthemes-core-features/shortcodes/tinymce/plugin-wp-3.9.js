(function() {

	var dummy_conent = "Lorem ipsum dolor sit amet, consectetur"
				+ " adipiscing elit. Morbi hendrerit elit turpis,"
				+ " a porttitor tellus sollicitudin at."
				+ " Class aptent taciti sociosqu ad litora "
				+ " torquent per conubia nostra,"
				+ " per inceptos himenaeos.";

	var dummy_tabs = '<br>[dt_sc_tab title="Tab 1"]'
					+ "<br>" + dummy_conent + "<br>" + '[/dt_sc_tab]' + "<br>"
					+ '[dt_sc_tab title="Tab 2"]' + "<br>"
					+ dummy_conent + "<br>" + '[/dt_sc_tab]' + "<br>"
					+ '[dt_sc_tab title="Tab 3"]' + "<br>"
					+ dummy_conent + "<br>" + '[/dt_sc_tab]<br>';
					
	var dummy_tabs_icon = '<br>[dt_sc_tab title="What is Lorem Ipsum?" icon="home"]'
			+ "<br>" + dummy_conent + "<br>" + '[/dt_sc_tab]' + "<br>"
			+ '[dt_sc_tab title="Where does it come from?" icon="gift"]' + "<br>"
			+ dummy_conent + "<br>" + '[/dt_sc_tab]' + "<br>"
			+ '[dt_sc_tab title="Why do we use it?" icon="support"]' + "<br>"
			+ dummy_conent + "<br>" + '[/dt_sc_tab]<br>';

	var testimonal = '[dt_sc_testimonial name="John Doe" role="Cambridge Telcecom"]'+dummy_conent+'[/dt_sc_testimonial]';
	var clienttest = '[dt_sc_client_testimonial name="Jamie Hunt" role="Creative Artist@Adobe"]'+dummy_conent+'[/dt_sc_client_testimonial]';

	// add DTCoreShortcodePlugin plugin
	tinymce.PluginManager.add("DTCoreShortcodePlugin",function( editor , url ) {
		
		editor.on('init', function() {

			editor.addCommand("scnOpenDialog", function(obj) {
				scnSelectedShortcodeType = obj.identifier;
				jQuery.get(url + "/dialog.php", function(b) {
					jQuery("#scn-dialog").remove();
					jQuery("body").append(b);
					jQuery("#scn-dialog").hide();
					var f = jQuery(window).width();
					b = jQuery(window).height();
					f = 720 < f ? 720 : f;
					f -= 80;
					b -= 84;
					tb_show("Insert Shortcode", "#TB_inline?width=800"+ "&height=400&inlineId=scn-dialog");
					jQuery("#scn-options h3:first").text("Customize the " + obj.title + " Shortcode");
				});
			});
		});
	

		editor.addButton('designthemes_sc_button', {
			title : "DT Shortcodes",
			icon : "dt-icon",
			type: 'menubutton',
			menu: [

				{ text : 'Accordion',
					menu : [
						{ text: 'Default', onclick: function(e){
							e.stopPropagation();
							var content = "[dt_sc_accordion_group]"
								+'<br>[dt_sc_toggle title="Accordion 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+'<br>[dt_sc_toggle title="Accordion 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+'<br>[dt_sc_toggle title="Accordion 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
								+"<br>[/dt_sc_accordion_group]";
								editor.insertContent(content);
							}
						},

						{ text: 'Framed', onclick: function(e){
							e.stopPropagation();
							var content = "[dt_sc_accordion_group]"
								+'<br>[dt_sc_toggle_framed title="Accordion 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+'<br>[dt_sc_toggle_framed title="Accordion 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+'<br>[dt_sc_toggle_framed title="Accordion 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
								+"<br>[/dt_sc_accordion_group]";
							editor.insertContent(content);
							}
						}
					]
				},

				{ text: 'Animation' , onclick: function() {

						editor.windowManager.open({

							title : "Add Animation",
							body : [

								{ type: 'listbox', name:'effect', label:'Choose Effect',values:[
									{ text: 'Flash', value : 'flash' },							{ text: 'Shake', value : 'shake' },							{ text: 'Bounce', value : 'bounce' },
									{ text: 'Tada', value : 'tada' },							{ text: 'Swing', value : 'swing'},							{ text: 'Wobble', value : 'wobble' },
									{ text: 'Pulse', value : 'pulse' },							{ text: 'Flip', value : 'flip' },							{ text: 'Flip In X Axis', value : 'flipInX' },
									{ text: 'Flip Out X Axis', value : 'flipOutX' },			{ text: 'Flip In Y Axis', value : 'flipInY' },				{ text: 'Flip Out Y Axis', value : 'flipOutY' },
									{ text: 'fadeIn', value:'fadeIn'},							{ text: 'fadeInUp', value:'fadeInUp'},						{ text: 'fadeInDown', value:'fadeInDown'},
									{ text: 'fadeInLeft', value:'fadeInLeftfadeInLeft'},		{ text: 'fadeInRight', value:'fadeInRight'},				{ text: 'fadeInUpBig', value:'fadeInUpBig'},
									{ text: 'fadeInDownBig', value:'fadeInDownBig'},			{ text: 'fadeInLeftBig', value:'fadeInLeftBig'},			{ text: 'fadeInRightBig', value:'fadeInRightBig'},
									{ text: 'fadeOut', value:'fadeOut'},						{ text: 'fadeOutUp', value:'fadeOutUp'},					{ text: 'fadeOutDown', value:'fadeOutDown'},
									{ text: 'fadeOutLeft', value:'fadeOutLeft'},				{ text: 'fadeOutRight', value:'fadeOutRight'},				{ text: 'fadeOutUpBig', value:'fadeOutUpBig'},
									{ text: 'fadeOutDownBig', value:'fadeOutDownBig'},			{ text: 'fadeOutLeftBig', value:'fadeOutLeftBig'},			{ text: 'fadeOutRightBig', value:'fadeOutRightBig'},
									{ text: 'bounceIn', value:'bounceIn'},						{ text: 'bounceInUp', value:'bounceInUp'},					{ text: 'bounceInDown', value:'bounceInDown'},
									{ text: 'bounceInLeft', value:'bounceInLeft'},				{ text: 'bounceInRight', value:'bounceInRight'},			{ text: 'bounceOut', value:'bounceOut'},
									{ text: 'bounceOutUp', value:'bounceOutUp'},				{ text: 'bounceOutDown', value:'bounceOutDown'},			{ text: 'bounceOutLeft', value:'bounceOutLeft'},
									{ text: 'bounceOutRight', value:'bounceOutRight'},			{ text:'rotateIn', value:'rotateIn'},						{ text:'rotateInUpLeft', value:'rotateInUpLeft'},		
									{ text:'rotateInDownLeft', value:'rotateInDownLeft'},		{ text:'rotateInUpRight', value:'rotateInUpRight'},			{ text:'rotateInDownRight', value:'rotateInDownRight'},		
									{ text:'rotateOut', value:'rotateOut'},						{ text:'rotateOutUpLeft', value:'rotateOutUpLeft'},			{ text:'rotateOutDownLeft', value:'rotateOutDownLeft'},		
									{ text:'rotateOutUpRight', value:'rotateOutUpRight'},		{ text:'rotateOutDownRight', value:'rotateOutDownRight'},	{ text:'hinge', value:'hinge'},		
									{ text:'rollIn', value:'rollIn'},							{ text:'rollOut', value:'rollOut'},							{ text:'lightSpeedIn', value:'lightSpeedIn'},		
									{ text:'lightSpeedOut', value:'lightSpeedOut'},				{ text:'slideDown', value:'slideDown'},						{ text:'slideUp', value:'slideUp'},		
									{ text:'slideLeft', value:'slideLeft'},						{ text:'slideRight', value:'slideRight'},					{ text:'slideExpandUp', value:'slideExpandUp'},
									{ text:'expandUp', value:'expandUp'},						{ text:'expandOpen', value:'expandOpen'},					{ text:'bigEntrance', value:'bigEntrance'},		
									{ text:'hatch', value:'hatch'},								{ text:'floating', value:'floating'},						{ text:'tossing', value:'tossing'},		
									{ text:'pullUp', value:'pullUp'},							{ text:'pullDown', value:'pullDown'},						{ text:'stretchLeft', value:'stretchLeft'},
									{ text:'stretchRight', value:'stretchRight'}],
								},

								{ type: 'textbox', name:'delay',label : "Time Delay"},
							],
							onsubmit: function(e) {
								editor.insertContent('[dt_sc_animation effect="'+e.data.effect +'" delay="'+ e.data.delay+'"] Add Content to Animate [/dt_sc_animation]');
							}
						});	}
				},

				{ text : 'Button',
					onclick: function(e) {
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "button"});
					}
				},

				{ text: 'Block Quote',
					onclick: function(e) {
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "blockquote"});
					}
				},

				{ text: 'Call Out Button',
					onclick: function() {

						editor.windowManager.open({
							title: "Call Out Buttons",
							body:[

								{
									type: 'listbox',
									name: 'type',
									label:'Type',
									values:[
										{ text: 'Type 1', value: 'type1' },
										{ text: 'Type 2', value: 'type2' },
										{ text: 'Type 3', value: 'type3' },
										{ text: 'Type 4', value: 'type4' },
										{ text: 'Type 5', value: 'type5' },
									],
								},

								{ type:'textbox', name:'button_text', label: 'Button Label'},

								{ type: 'textbox', name: 'link', label: 'Button link', value: '#' },

								{ type: 'textbox', name: 'icon', label: 'Font Awesome Icon', value: 'fa-heart' },

								{
									type: 'listbox',
									name: 'target',
									label:'Target',
									values:[
										{ text: 'Blank', value: '_blank' },
										{ text: 'New', value: '_new' },
										{ text: 'Parent', value: '_parent' },
										{ text: 'Self', value: '_self' },
										{ text: 'Top', value: '_top' },
									],
								},
							],
							onsubmit: function(e){
								editor.insertContent('[dt_sc_callout_box type="'+e.data.type+'" icon="'+e.data.icon+'" link="'+e.data.link+'" target="'+e.data.target+'" button_text="'+e.data.button_text+'"]<h4>Our Technological services has been improved vastly</h4><h5>Come Experience the real life situations of saving life</h5>[/dt_sc_callout_box]');
							}
						});
					}
				 },

				{ text: 'Column Layout', 
					onclick: function(e) {
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "column"});
					}
				},

				{ text: 'Colored Box',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "coloredbox"});
					}
				},

				{ text : 'Contact Info', menu :[

					{ text: 'Address', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_address line1="No: 58 A, East Madison St" line2="Baltimore, MD, USA"/]');
					}},

					{ text: 'Phone', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_phone phone="+1 200 258 2145"/]');
					}},

					{ text: 'Mobile', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_mobile mobile="+91 99941 49897"/]');
					}},

					{ text: 'Fax', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_fax fax="+1 100 458 2345"/]');
					}},

					{ text: 'Email', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_email emailid="yourname@somemail.com"/]');
					}},

					{ text: 'Web', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_web url="http://www.google.com"/]');
					}},
				] },

				{ text : 'Donut Chart', menu:[

					{ text: 'Small', onclick: function(e) {
						e.stopPropagation();
						editor.insertContent('[dt_sc_donutchart_small title="Lorem" bgcolor="#808080" fgcolor="#4bbcd7" percent="70"/]');
					} },


					{ text: 'Medium', onclick: function(e) {
						e.stopPropagation();
						editor.insertContent('[dt_sc_donutchart_medium title="Lorem" bgcolor="#808080" fgcolor="#7aa127" percent="65"/]');
					} },


					{ text: 'Large', onclick: function(e) {
						e.stopPropagation();
						editor.insertContent('[dt_sc_donutchart_large title="Lorem" bgcolor="#808080" fgcolor="#a23b6f" percent="50"/]');
					} },
				] },

				{ text: 'Drop Cap',
					onclick: function( e ){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "dropcap"});
					}
				},

				{ text : 'Dividers', menu:[

					{ text: 'Clear', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_clear]');
					}},

					{ text: 'Bordered Horizontal Rule', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_border]');
					}},

					{ text: 'Horizontal Rule', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr]');
					}},

					{ text: 'Horizontal Rule Medium', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_medium]');
					}},

					{ text: 'Horizontal Rule Large', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_large]');
					}},

					{ text: 'Horizontal Rule with top link', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr top]');
					}},

					{ text: 'Whitespace', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_invisible]');
					}},

					{ text: 'Whitespace Small', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_invisible_small]');
					}},

					{ text: 'Whitespace Medium', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_invisible_medium]');
					}},

					{ text: 'Whitespace Large', onclick: function(e){
						e.stopPropagation();
						editor.insertContent('[dt_sc_hr_invisible_large]');
					}},
				] },

				{ text: 'Full Width Section', 
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "fullwidth"});
					}
				},

				{ text: 'Full Width Video',
					onclick: function(){

						editor.windowManager.open({
							title: "Add Full Width  Video Section",
							body:[
								{ type:'textbox', label:'MP4', name: 'mp4'},
								{ type:'textbox', label:'WEBM', name: 'webm'},
								{ type:'textbox', label:'OGV', name: 'ogv'},
								{ type:'textbox', label:'Poster Image', name: 'poster'},
								{ type:'textbox', name:'backgroundimage', label: 'Background Image'},
								{ type:'textbox', name:'paddingtop', label: 'Padding Top( in px)'},
								{ type:'textbox', name:'paddingbottom', label: 'Padding Bottom( in px)'},
								{ type:'textbox', name:'class', label: 'CSS Class'},
							],
							onsubmit: function(e){
								editor.insertContent('[dt_sc_fullwidth_video mp4="'+e.data.mp4+'" webm="'+e.data.we+'" ogv="'+e.data.ogv+'" poster="'+e.data.po+'" backgroundimage="'+e.data.backgroundimage+'" paddingtop="'+e.data.paddingtop+'" paddingbottom="'+e.data.paddingbottom+'" class="'+e.data.class+'"][/dt_sc_fullwidth_video]');
							}
						});
					}
				}, 

				{ text: 'Icon Boxes', 
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "iconbox"});
					}
				},

				{ text: 'Lists',
					menu :[
						{
							text: 'Ordered List',
							onclick : function() {
								editor.windowManager.open({
									title: "Add New Stylish Ordered List",
									body: [
										{
											type: 'listbox',
											name: 'style',
											label:'Style',
											values:[
												{ text: 'Decimal', value: 'decimal' }, { text: 'Decimals With Leading Zero', value: 'decimal-leading-zero' }, { text:'Lower Alpha', value:'lower-alpha'},
												{ text:'Lower Roman', value:'lower-roman'}, { text:'Upper Alpha', value:'upper-alpha'},{ text:'Upper Roman', value:'upper-roman'}
											],
										},
										{
											type: 'listbox',
											name: 'variation',
											label: 'Variation',

											values:[
												{ text: 'Default', value: '' }, { text: 'Avocado', value: 'avocado' }, { text: 'Black', value: 'black' }, { text: 'Blue', value: 'blue' },
												{ text: 'Blueiris', value: 'blueiris' }, { text: 'Blueturquoise', value: 'blueturquoise' },	{ text: 'Brown', value: 'brown' },
												{ text: 'Burntsienna', value: 'burntsienna' }, { text: 'Chillipepper', value: 'chillipepper' },	{ text: 'Emerald', value: 'emerald' },
												{ text: 'Eggplant', value: 'eggplant' }, { text: 'Electric blue', value: 'electricblue' }, { text: 'Graas green', value: 'graasgreen' },
												{ text: 'Gray', value: 'gray' }, { text: 'Green', value: 'green' }, { text: 'Orange', value: 'orange' }, { text: 'Pale brown', value: 'palebrown' },
												{ text: 'Pink', value: 'pink' }, { text: 'radiantorchid', value: 'radiantorchid' }, { text: 'Red', value: 'red' }, { text: 'Sky Blue', value: 'skyblue' },
												{ text: 'Violet', value: 'violet' },	{ text: 'wetasphalt', value: 'wetasphalt' }, { text: 'Yellow', value: 'yellow' }
											],
										},
									],
									onsubmit: function(e){
										var defaultContent =  "<ol>"
												+ "<li>Lorem ipsum dolor sit </li>"
												+ "<li>Praesent convallis nibh</li>"
												+ "<li>Nullam ac sapien sit</li>"
												+ "<li>Phasellus auctor augue</li></ol>";

										editor.insertContent('[dt_sc_fancy_ol style="'+e.data.style+'" variation="'+e.data.variation+'"]'+ defaultContent+'[/dt_sc_fancy_ol]');
									}
								});
							}
						},

						{
							text: 'Unordered List',
							onclick : function(){
								editor.windowManager.open({
									title: "Add New Stylish Unordered List",
									body: [

										{
											type: 'listbox',
											name: 'style',
											label:'Style',
											values:[
												{ text: 'Arrow', value: 'arrow' },					{ text: 'Rounded Arrow', value: 'rounded-arrow' },			{ text: 'Double Arrow', value: 'double-arrow' },
												{ text: 'Heart', value: 'heart' },					{ text: 'Trash', value: 'trash' },							{ text: 'Star', value: 'star' },
												{ text: 'Tick', value: 'tick' },					{ text: 'Rounded Tick', value: 'rounded-tick' },			{ text: 'Cross', value: 'cross' },
												{ text: 'Rounded Cross', value: 'rounded-cross' },	{ text: 'Rounded Question', value: 'rounded-question' },	{ text: 'Rounded Info', value: 'rounded-info' },
												{ text: 'Delete', value: 'delete' },				{ text: 'Warning', value: 'warning' },						{ text: 'Comment', value: 'comment' },
												{ text: 'Edit', value: 'edit' },					{ text: 'Share', value: 'share' },							{ text: 'Plus', value: 'plus' },
												{ text: 'Rounded Plus', value: 'Rounded Plus' },	{ text: 'Minus', value: 'minus' },							{ text: 'Rounded minus', value: 'rounded-minus' },
												{ text: 'Asterisk', value: 'asterisk' },			{ text: 'Cart', value: 'cart' },							{ text: 'Folder', value: 'folder' },
												{ text: 'Folder Open', value: 'folder-open' },		{ text: 'Desktop', value: 'desktop' },						{ text: 'Tablet', value: 'tablet' },
												{ text: 'Mobile', value: 'mobile' },				{ text: 'Reply', value: 'reply' },							{ text: 'Quote', value: 'quote' },
												{ text: 'Mail', value: 'mail' },					{ text: 'External Link', value: 'external-link' },			{ text: 'Adjust', value: 'adjust' },

												{ text: 'Pencil', value: 'pencil' },				{ text: 'Print', value: 'print' },							{ text: 'Tag', value: 'tag' },
												{ text: 'Thumbs Up', value: 'thumbs-up' },			{ text: 'Thumbs Down', value: 'thumbs-down' },				{ text: 'Time', value: 'time' },
												{ text: 'Globe', value: 'globe' },					{ text: 'Pushpin', value: 'pushpin' },						{ text: 'Map Marker', value: 'map-marker' },
												{ text: 'Link', value: 'link' },					{ text: 'Paper Clip', value: 'paper-clip' },				{ text: 'Download', value: 'download' },
												{ text: 'Key', value: 'key' },						{ text: 'Search', value: 'search' },						{ text: 'Rss', value: 'rss' },
												{ text: 'Twitter', value: 'twitter' },				{ text: 'Facebook', value: 'facebook' },					{ text: 'Linkedin', value: 'linkedin' },
												{ text:'Google Plus', value:'google-plus'}, 		{ text: 'Location', value:'location-arrow'},				{ text: 'Paper Plane', value:'paper-plane'}
											],
										},

										{
											type: 'listbox',
											name: 'variation',
											label: 'Variation',

											values:[
												{ text: 'Default', value: '' }, { text: 'Avocado', value: 'avocado' }, { text: 'Black', value: 'black' }, { text: 'Blue', value: 'blue' },
												{ text: 'Blueiris', value: 'blueiris' }, { text: 'Blueturquoise', value: 'blueturquoise' },	{ text: 'Brown', value: 'brown' },
												{ text: 'Burntsienna', value: 'burntsienna' }, { text: 'Chillipepper', value: 'chillipepper' },	{ text: 'Emerald', value: 'emerald' },
												{ text: 'Eggplant', value: 'eggplant' }, { text: 'Electric blue', value: 'electricblue' }, { text: 'Graas green', value: 'graasgreen' },
												{ text: 'Gray', value: 'gray' }, { text: 'Green', value: 'green' }, { text: 'Orange', value: 'orange' }, { text: 'Pale brown', value: 'palebrown' },
												{ text: 'Pink', value: 'pink' }, { text: 'radiantorchid', value: 'radiantorchid' }, { text: 'Red', value: 'red' }, { text: 'Sky Blue', value: 'skyblue' },
												{ text: 'Violet', value: 'violet' },	{ text: 'wetasphalt', value: 'wetasphalt' }, { text: 'Yellow', value: 'yellow' }
											],
										},
									],
									onsubmit: function(e){
										var defaultContent =  "<ul>"
												+ "<li>Lorem ipsum dolor sit </li>"
												+ "<li>Praesent convallis nibh</li>"
												+ "<li>Nullam ac sapien sit</li>"
												+ "<li>Phasellus auctor augue</li></ul>";

										editor.insertContent('[dt_sc_fancy_ul style="'+e.data.style+'" variation="'+e.data.variation+'"]'+ defaultContent+'[/dt_sc_fancy_ul]');
									}
								});
							}
						},
					]
				},

				{ text:'Pull Quote',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "pullquote"});
					}
				},

				{ text:'Pricing Table',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "pricingtable"});
					}
				},

				{ text: 'Progress Bar',
					menu:[

						{ text:'Active', 
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_progressbar value="45" color="#b6599c" type="progress-striped-active"]Lorem ipsum dolor[/dt_sc_progressbar]');
							}
						},

						{ text:'Standard',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_progressbar value="85" type="standard" color="#9c59b6" textcolor=""]Lorem ipsum dolor[/dt_sc_progressbar]');
							}
						},

						{ text:'Stripe',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_progressbar value="75" type="progress-striped" color="#599cb6" textcolor=""]Lorem ipsum dolor[/dt_sc_progressbar]');
							}
						},
					]
				},
				{ text: 'Tabs',
					menu:[
						{ text:'Horizontal',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent("[dt_sc_tabs_horizontal]" + dummy_tabs + "[/dt_sc_tabs_horizontal]");
							}
						},
						{ text:'Vertical',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent("[dt_sc_tabs_vertical]" + dummy_tabs+ "[/dt_sc_tabs_vertical]");
							}
						},
                        { text: 'Vertical with Icon',
	                        onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent("[dt_sc_tabs_vertical]" + dummy_tabs_icon + "[/dt_sc_tabs_vertical]");
                            }       
                        }
					]
				},

				{ text: 'Title',
					menu:[
						{
							text:'H1',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_h1]Lorem ipsum dolor sit amet[/dt_sc_h1]');
							}
						},

						{
							text:'H2',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_h2]Lorem ipsum dolor sit amet[/dt_sc_h2]');
							}
						},
						{
							text:'H3',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_h3]Lorem ipsum dolor sit amet[/dt_sc_h3]');
							}
						},
						{
							text:'H4',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_h4]Lorem ipsum dolor sit amet[/dt_sc_h4]');
							}
						},
						{
							text:'H5',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_h5]Lorem ipsum dolor sit amet[/dt_sc_h5]');
							}
						},
						{
							text:'H6',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_h6]Lorem ipsum dolor sit amet[/dt_sc_h6]');
							}
						},
						{
							text:'With Icon',
							onclick:function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_title_with_icon title="Lorem ipsum dolor sit amet" subtitle="Lorem ipsum dolor sit amet" icon="fa-gear"/]');
							}
						},
					]
				},

				{ text:'Title Box',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "box"});
					}
				},

				{ text: 'Toggle',
					menu:[
						{
							text: 'Default',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_toggle title="Toggle 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
										+'<br>[dt_sc_toggle title="Toggle 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]"
										+'<br>[dt_sc_toggle title="Toggle 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle]");
							}
						},

						{
							text: 'Framed',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_toggle_framed title="Toggle 1"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
										+'<br>[dt_sc_toggle_framed title="Toggle 2"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]"
										+'<br>[dt_sc_toggle_framed title="Toggle 3"]<br>'+ dummy_conent + "<br>[/dt_sc_toggle_framed]");
							}
						},
					]
				},

				{ text:'Tool tip',
					onclick: function(e){
						e.stopPropagation();
						tinyMCE.activeEditor.execCommand("scnOpenDialog", {title: this.text() ,identifier: "tooltip"});
					}
				},

				{ text:'Others',
					menu:[

						{ text:'Team',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_team name="James Duncan" role="Leading Programme" image="http://placehold.it/125" twitter="#" facebook="#" google="#" linkedin="#"]<br><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>[/dt_sc_team]');
							}
						},

						{ text:'Testimonial',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent(testimonal);
							}
						},

						{ text:'Testimonial Carousel',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_testimonial_carousel]<br>'
									+'<ul>'
									+'<li>'+testimonal+'</li>'
									+'<li>'+testimonal+'</li>'
									+'<li>'+testimonal+'</li>'
									+'</ul>'
									+'<br>[/dt_sc_testimonial_carousel]');
							}
						},

						{ text:'Client Testimonial Carousel',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent('[dt_sc_client_testimonials carousel="true"]<br>'
									+clienttest+'<br>'
									+clienttest+'<br>'
									+clienttest+'<br>'
									+'[/dt_sc_client_testimonials]');
							}
						},
						
						{
                            text: 'Contact Form',
							value: 'contactform',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Contact Form',
									body: [{
										type: 'textbox',
										name: 'to_email',
										label: 'Recipient Email',
										tooltip: 'Enter Recipient Email Address'
									},
									{
										type: 'textbox',
										name: 'success_msg',
										label: 'Success Message',
										tooltip: 'If leaves: "Thanks for Contacting Us, We will call back to you soon."'
									},
									{
										type: 'textbox',
										name: 'error_msg',
										label: 'Error Message',
										tooltip: 'If leaves: "Sorry your message not sent, Try again Later."'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_contact_form';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
						{
                            text: 'Social Profile',
                            value: '<br>[dt_social text="We\'re social everywhere. Come let\'s meet here." /]<br>',
                            onclick: function(e) {
                                e.stopPropagation();
                                editor.insertContent(this.value());
                            }
                        },
						
						{
                            text: 'Blog Posts',
							value: 'blogposts',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Blog Posts',
									body: [{
										type: 'textbox',
										name: 'excerpt_length',
										label: 'Excerpt Length',
										value: '25',
										tooltip: 'Put the value of excerpt length'
									},
									{
										type: 'listbox',
										name: 'show_meta',
										label: 'Show Meta',
										tooltip: 'Enable post meta for posts',
										'values': [
											{text: 'Yes (Default)', value: 'true'}, {text: 'No', value: 'false'}
										]
									},									
									{
										type: 'textbox',
										name: 'limit',
										label: 'Limit',
										tooltip: 'Enter no.of posts to show. By default shows all posts(-1)'
									},
									{
										type: 'textbox',
										name: 'categories',
										label: 'Post Categories',
										tooltip: 'Put the categories you want to display (seperated by commas(,))'
									},
									{
										type: 'listbox',
										name: 'posts_column',
										label: 'Column Type',
										'values': [
											{text: 'One Column', value: 'one-column'}, {text: 'Two Column', value: 'one-half-column'}, {text: 'Three Column', value: 'one-third-column'}, {text: 'Four Column', value: 'one-fourth-column'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_blog_posts';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Gallery Items',
							value: 'galleryitems',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Gallery Items',
									body: [{
										type: 'textbox',
										name: 'limit',
										label: 'Limit',
										tooltip: 'Enter no.of items to show. By default shows all items(-1)'
									},
									{
										type: 'textbox',
										name: 'categories',
										label: 'Gallery Categories',
										tooltip: 'Put the categories you want to display (seperated by commas(,))'
									},
									{
										type: 'listbox',
										name: 'posts_column',
										label: 'Column Type',
										'values': [
											{text: 'Two Column', value: 'one-half-column'}, {text: 'Three Column', value: 'one-third-column'}, {text: 'Four Column', value: 'one-fourth-column'}
										]
									},
									{
										type: 'listbox',
										name: 'filter',
										label: 'Show Filter',
										tooltip: 'Enable gallery categories filter.',
										'values': [
											{text: 'Yes (Default)', value: 'true'}, {text: 'No', value: 'false'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_gallery_items';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },						
						
                        {
                            text: 'Event List',
							value: 'eventlist',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Event List',
									body: [{
										type: 'textbox',
										name: 'limit',
										label: 'Limit',
										tooltip: 'Enter no.of items to show. By default shows all items(-1)'
									},
									{
										type: 'textbox',
										name: 'excerpt_length',
										label: 'Excerpt Length',
										value: '18',
										tooltip: 'Put the value of excerpt length'
									},
									{
										type: 'listbox',
										name: 'post_column',
										label: 'Column Type',
										'values': [
											{text: 'Two Column', value: 'one-half-column'}, {text: 'Three Column', value: 'one-third-column'}, {text: 'Four Column', value: 'one-fourth-column'}
										]
									},
									{
										type: 'listbox',
										name: 'order',
										label: 'Order',
										'values': [
											{text: 'Ascending Order', value: 'ASC'}, {text: 'Descending Order', value: 'DESC'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_events_list';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
						{
							text:'Welcome Content',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent("[dt_welcome_text]<h2>Welcome to Trendy Travel</h2>" + dummy_conent + "[/dt_welcome_text]");
							}
						},
						
                        {
                            text: 'Package List',
							value: 'packagelist',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Package List',
									body: [{
										type: 'textbox',
										name: 'limit',
										label: 'Limit',
										tooltip: 'Enter no.of items to show. By default shows all items(-1)'
									},
									{
										type: 'listbox',
										name: 'carousel',
										label: 'Carousel',
										'values': [
											{text: 'Enable', value: 'true'}, {text: 'Disable', value: 'false'}
										]
									},									
									{
										type: 'listbox',
										name: 'post_column',
										label: 'Column Type',
										'values': [
											{text: 'Two Column', value: 'one-half-column'}, {text: 'Three Column', value: 'one-third-column'}, {text: 'Four Column', value: 'one-fourth-column'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_packages_list';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Map Marker',
							value: 'mapmarker',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Map Marker',
									body: [{
										type: 'textbox',
										name: 'title',
										label: 'Title',
										tooltip: 'Enter title text.'
									},
									{
										type: 'listbox',
										name: 'color',
										label: 'Icon Color',
										'values': [
											{text: 'Green', value: 'green'}, {text: 'Skyblue', value: 'skyblue'}, {text: 'Orange', value: 'orange'}, {text: 'Red', value: 'red'}, {text: 'Blue', value: 'blue'}, {text: 'Violet', value: 'violet'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_marker';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Counting Number',
							value: 'countnumber',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Counting Number',
									body: [{
										type: 'listbox',
										name: 'icon',
										label: 'Icon',
										tooltip: 'Select the icon for section',
										'values': [
											{text: 'Heart', value: 'heart'}, {text: 'Star', value: 'star'}, {text: 'Warning', value: 'warning'}, {text: 'Comment', value: 'comment'},
											{text: 'Edit', value: 'edit'}, {text: 'Share', value: 'share'}, {text: 'Plus', value: 'plus'}, {text: 'Minus', value: 'minus'},
											{text: 'Thumbs Down', value: 'thumbs-down'}, {text: 'Asterisk', value: 'asterisk'}, 
											{text: 'Folder', value: 'folder'}, {text: 'Folder Open', value: 'folder-open'}, {text: 'Desktop', value: 'desktop'}, {text: 'Tablet', value: 'tablet'},
											{text: 'Mobile', value: 'mobile'}, {text: 'Reply', value: 'reply'},
											{text: 'External Link', value: 'external-link'}, {text: 'Adjust', value: 'adjust'}, {text: 'Pencil', value: 'pencil'},
											{text: 'Print', value: 'print'}, {text: 'Tag', value: 'tag'}, {text: 'Thumbs Up', value: 'thumbs-up'},
											{text: 'Globe', value: 'globe'}, {text: 'Map Marker', value: 'map-marker'}, {text: 'Link', value: 'link'},
											{text: 'Download', value: 'download'}, {text: 'Key', value: 'key'},
											{text: 'Search', value: 'search'}, {text: 'RSS', value: 'rss'}, {text: 'Twitter', value: 'twitter'}, {text: 'Facebook', value: 'facebook'},
											{text: 'LinkedIn', value: 'linkedin'}, {text: 'Google Plus', value: 'google-plus'}, {text: 'Beer', value: 'beer'}, {text: 'Circle Alt', value: 'circle-o'}
										]
									},
									{
										type: 'textbox',
										name: 'value',
										label: 'Value',
										tooltip: 'Put the value of counting number (eg: 1540)'
									},
									{
										type: 'textbox',
										name: 'title',
										label: 'Title',
										tooltip: 'Put the title of counting number'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_number_count';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Tour Package List',
							value: 'tourpackagelist',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Tour Package List',
									body: [{
										type: 'textbox',
										name: 'limit',
										label: 'Limit',
										tooltip: 'Enter no.of items to show. By default shows all items(-1)'
									},
									{
										type: 'listbox',
										name: 'carousel',
										label: 'Carousel',
										'values': [
											{text: 'Enable', value: 'true'}, {text: 'Disable', value: 'false'}
										]
									},
									{
										type: 'textbox',
										name: 'excerpt_length',
										label: 'Excerpt Length',
										tooltip: 'Enter length of excerpt text, by default 30.'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_tourpackage_list';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },						
						
                        {
                            text: 'Latest Hotel Reviews',
							value: 'latesthotelreviews',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Latest Hotel Reviews',
									body: [{
										type: 'textbox',
										name: 'limit',
										label: 'Limit',
										tooltip: 'Enter no.of items to show. By default shows all items(-1)'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_latest_hotel_reviews';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Best Destination Place',
							value: 'destinationplace',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Best Destination Place',
									body: [{
										type: 'textbox',
										name: 'place_id',
										label: 'Place ID',
										tooltip: 'Enter the ID for best destination place.'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_destination_place';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Places Carousel',
							value: 'placescarousel',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Places Carousel',
									body: [{
										type: 'textbox',
										name: 'place_ids',
										label: 'Place IDs',
										tooltip: 'Enter places id here (seperated by commas(,))'
									},
									{
										type: 'listbox',
										name: 'carousel',
										label: 'Carousel',
										'values': [
											{text: 'Enable', value: 'true'}, {text: 'Disable', value: 'false'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_best_destination_place';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },

                        {
                            text: 'Hotels Carousel',
							value: 'hotelscarousel',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Hotels Carousel',
									body: [{
										type: 'textbox',
										name: 'hotels_id',
										label: 'Hotels IDs',
										tooltip: 'Enter hotels id here (seperated by commas(,))'
									},
									{
										type: 'listbox',
										name: 'carousel',
										label: 'Carousel',
										'values': [
											{text: 'Enable', value: 'true'}, {text: 'Disable', value: 'false'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_hotels_list';

										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});

										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },

                        {
                            text: 'Support Section',
							value: 'supportsection',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Support Section',
									body: [{
										type: 'textbox',
										name: 'title',
										label: 'Title',
										tooltip: 'Enter the title of support section'
									},
									{
										type: 'textbox',
										name: 'link',
										label: 'Link',
										tooltip: 'Enter the button url.'
									},
									{
										type: 'textbox',
										name: 'phone',
										label: 'Phone',
										tooltip: 'Enter phone no for support section.'
									},
									{
										type: 'textbox',
										name: 'image',
										label: 'Image',
										value: 'http://placehold.it/250x350',
										tooltip: 'Enter the image for the support section.'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_support_section';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ']' + dummy_conent + '[/dt_support_section]';
										editor.insertContent( $out );
									}
								});
							}
                        },

                        {
                            text: 'Recommend Places',
							value: 'recommendedplaces',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Recommend Places',
									body: [{
										type: 'textbox',
										name: 'limit',
										label: 'Limit',
										tooltip: 'Enter no.of items to show. By default shows all items(-1)'
									},
									{
										type: 'listbox',
										name: 'posts_column',
										label: 'Column Type',
										'values': [
											{text: 'Two Column', value: 'one-half'}, {text: 'Three Column', value: 'one-third'}, {text: 'Four Column', value: 'one-fourth'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_recommend_places';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Feature Icon',
							value: 'featureicon',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Feature Icon',
									body: [{
										type: 'listbox',
										name: 'icon',
										label: 'Icon',
										tooltip: 'Select the icon for section',
										'values': [
											{text: 'Heart', value: 'heart'}, {text: 'Star', value: 'star'}, {text: 'Warning', value: 'warning'}, {text: 'Comment', value: 'comment'},
											{text: 'Edit', value: 'edit'}, {text: 'Share', value: 'share'}, {text: 'Plus', value: 'plus'}, {text: 'Minus', value: 'minus'},
											{text: 'Thumbs Down', value: 'thumbs-down'}, {text: 'Asterisk', value: 'asterisk'}, 
											{text: 'Folder', value: 'folder'}, {text: 'Folder Open', value: 'folder-open'}, {text: 'Desktop', value: 'desktop'}, {text: 'Tablet', value: 'tablet'},
											{text: 'Mobile', value: 'mobile'}, {text: 'Reply', value: 'reply'},
											{text: 'External Link', value: 'external-link'}, {text: 'Adjust', value: 'adjust'}, {text: 'Pencil', value: 'pencil'},
											{text: 'Print', value: 'print'}, {text: 'Tag', value: 'tag'}, {text: 'Thumbs Up', value: 'thumbs-up'},
											{text: 'Globe', value: 'globe'}, {text: 'Map Marker', value: 'map-marker'}, {text: 'Link', value: 'link'},
											{text: 'Download', value: 'download'}, {text: 'Key', value: 'key'},
											{text: 'Search', value: 'search'}, {text: 'RSS', value: 'rss'}, {text: 'Twitter', value: 'twitter'}, {text: 'Facebook', value: 'facebook'},
											{text: 'LinkedIn', value: 'linkedin'}, {text: 'Google Plus', value: 'google-plus'}, {text: 'Beer', value: 'beer'}, {text: 'Circle Alt', value: 'circle-o'}
										]
									},									
									{
										type: 'textbox',
										name: 'text',
										label: 'Text',
										tooltip: 'Enter the text of feature section.'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_feature_icon';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Intro Text',
							value: 'introtext',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Intro Text',
									body: [{
										type: 'listbox',
										name: 'type',
										label: 'Type',
										tooltip: 'Select type of section',
										'values': [
											{text: 'Type - 1', value: 'type1'}, {text: 'Type - 2', value: 'type2'}
										]
									}],
									onsubmit: function( e ) {
										var $out = '[dt_intro_text';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ']<h2>Welcome to Trendy Travel</h2>' + dummy_conent + '[/dt_intro_text]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Timeline Posts',
							value: 'timelineposts',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Timeline Posts',
									body: [{
										type: 'textbox',
										name: 'limit',
										label: 'Limit',
										tooltip: 'Enter no.of items to show. By default shows all items(-1)'
									},
									{
										type: 'textbox',
										name: 'categories',
										label: 'Post Categories',
										tooltip: 'Put the categories you want to display (seperated by commas(,))'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_timeline_posts';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						
                        {
                            text: 'Theme IconBox',
							value: 'themeiconbox',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Theme IconBox',
									body: [{
										type: 'listbox',
										name: 'icon',
										label: 'Icon',
										tooltip: 'Select the icon for section',
										'values': [
											{text: 'Heart', value: 'heart'}, {text: 'Star', value: 'star'}, {text: 'Warning', value: 'warning'}, {text: 'Comment', value: 'comment'},
											{text: 'Edit', value: 'edit'}, {text: 'Share', value: 'share'}, {text: 'Plus', value: 'plus'}, {text: 'Minus', value: 'minus'},
											{text: 'Thumbs Down', value: 'thumbs-down'}, {text: 'Asterisk', value: 'asterisk'}, 
											{text: 'Folder', value: 'folder'}, {text: 'Folder Open', value: 'folder-open'}, {text: 'Desktop', value: 'desktop'}, {text: 'Tablet', value: 'tablet'},
											{text: 'Mobile', value: 'mobile'}, {text: 'Reply', value: 'reply'},
											{text: 'External Link', value: 'external-link'}, {text: 'Adjust', value: 'adjust'}, {text: 'Pencil', value: 'pencil'},
											{text: 'Print', value: 'print'}, {text: 'Tag', value: 'tag'}, {text: 'Thumbs Up', value: 'thumbs-up'},
											{text: 'Globe', value: 'globe'}, {text: 'Map Marker', value: 'map-marker'}, {text: 'Link', value: 'link'},
											{text: 'Download', value: 'download'}, {text: 'Key', value: 'key'},
											{text: 'Search', value: 'search'}, {text: 'RSS', value: 'rss'}, {text: 'Twitter', value: 'twitter'}, {text: 'Facebook', value: 'facebook'},
											{text: 'LinkedIn', value: 'linkedin'}, {text: 'Google Plus', value: 'google-plus'}, {text: 'Beer', value: 'beer'}, {text: 'Circle Alt', value: 'circle-o'}
										]
									},									
									{
										type: 'textbox',
										name: 'title',
										label: 'Title',
										tooltip: 'Enter the title for theme icon box.'
									},
									{
										type: 'textbox',
										name: 'text',
										label: 'Text',
										tooltip: 'Enter the text for theme icon box.'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_theme_iconbox';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },

                        {
                            text: 'Hotel Room',
							value: 'hotelroom',
							onclick: function() {
							editor.windowManager.open( {
									title: 'Insert Hotel Room',
									body: [{
										type: 'textbox',
										name: 'room_type',
										label: 'Room Type',
										tooltip: 'Enter type of room.'
									},
									{
										type: 'textbox',
										name: 'persons',
										label: 'Persons',
										tooltip: 'Enter no.of persons.'
									},
									{
										type: 'textbox',
										name: 'facilities',
										label: 'Facilities',
										tooltip: 'Enter facilities details.'
									},
									{
										type: 'textbox',
										name: 'price',
										label: 'Price',
										tooltip: 'Enter the price of room.'
									},
									{
										type: 'textbox',
										name: 'available',
										label: 'Available',
										tooltip: 'Enter availability text.'
									}],
									onsubmit: function( e ) {
										var $out = '[dt_hotel_room';
										
										jQuery.each( e.data, function( key, value ) {
											if(value !== "") {
												$out += ' ' + key + '="'+ value+'"';
											}
										});
										
										$out += ' /]';
										editor.insertContent( $out );
									}
								});
							}
                        },
						{
							text:'Image Map & Pointers',
							onclick: function(e){
								e.stopPropagation();
								editor.insertContent("[dt_image_map_container]<br>" +
													"[dt_image_map_pointer title='Machu Picchu' top='385' left='239' color='red']" + dummy_conent + "[/dt_image_map_pointer]<br>" +
													"[dt_image_map_pointer title='Great Wall of China' top='193' left='788' color='grey']" + dummy_conent + "[/dt_image_map_pointer]<br>" +													
													"[/dt_image_map_container]");
							}
						}
					]
				}
			]
		});
		
	});
})();