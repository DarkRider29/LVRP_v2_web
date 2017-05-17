////////////////////////////////////////////////////////////////////////////////////
// EZ_BBcode v1.0
// By supraname 
////////////////////////////////////////////////////////////////////////////////////
if (typeof jQuery != 'undefined') { 

////////////////////////////////////////////////////////////////////////////////////
// Jquery Selection Tool
//
// Original script: A-TOOLS (http://plugins.jquery.com/project/a-tools)
// By Andrey Kramarev
////////////////////////////////////////////////////////////////////////////////////
	var caretPositionAmp = new Array();
	function init() {
		if(navigator.appName == "Microsoft Internet Explorer") {
			obj = document.getElementsByTagName('TEXTAREA');
			var input;
			var i = 0;
			for (var i = 0; i < obj.length; i++) {
				input = obj[i];
				caretPositionAmp[i] = input.value.length;
				input.onmouseup = function() { // for IE because it loses caret position when focus changed
					input = document.activeElement;
					for (var i = 0; i < obj.length; i++) {
						if (obj[i] == input) {
							break;
						}
					}
					input.focus();
					var s = document.selection.createRange();
					var re = input.createTextRange();
					var rc = re.duplicate();
					re.moveToBookmark(s.getBookmark());
					rc.setEndPoint("EndToStart", re);
					caretPositionAmp[i] = rc.text.length;
				}
				input.onkeyup = function() {
					input = document.activeElement;
					for (var i = 0; i < obj.length; i++) {
						if (obj[i] == input) {
							break;
						}
					}
					input.focus();
					var s = document.selection.createRange();
					var re = input.createTextRange();
					var rc = re.duplicate();
					re.moveToBookmark(s.getBookmark());
					rc.setEndPoint("EndToStart", re);
					caretPositionAmp[i] = rc.text.length;
				}
			}
		}
	}

	window.onload = init;

	jQuery.fn.extend({
		getSelection: function() {  // function for getting selection, and position of the selected text
			var input = this.jquery ? this[0] : this;
			var start;
			var end;
			var part;
			var number = 0;
			input.onmousedown = function() { // for IE 
				if (document.selection && typeof(input.selectionStart) != "number") {
					document.selection.empty();
				} else {
					window.getSelection().removeAllRanges();
				}
			}
			if (document.selection) {
				// part for IE and Opera
				var s = document.selection.createRange();
				var minus = 0;
				var position = 0;
				var minusEnd = 0;
				var re;
				var rc;
				var obj = document.getElementsByTagName('TEXTAREA');
				var pos = 0;
				for (pos; pos < obj.length; pos++) {
					if (obj[pos] == input) {
						break;
					}
				}
				if (input.value.match(/\n/g) != null) {
						number = input.value.match(/\n/g).length;// number of EOL simbols
				}
				if (s.text) {
					part = s.text;
					// OPERA support
					if (typeof(input.selectionStart) == "number") {
						start = input.selectionStart;
						end = input.selectionEnd;
						// return null if the selected text not from the needed area
						if (start == end) {
							return { start: start, end: end, text: s.text, length: end - start };
						}
					} else {
						// IE support
						re = input.createTextRange();
						rc = re.duplicate();
						firstRe = re.text;
						re.moveToBookmark(s.getBookmark());
						secondRe = re.text;
						rc.setEndPoint("EndToStart", re);
						// return null if the selectyed text not from the needed area
						if (firstRe == secondRe && firstRe != s.text || rc.text.length > firstRe.length) {
							return { start: caretPositionAmp[pos], end: caretPositionAmp[pos], text: "", length: 0 };
						}
						start = rc.text.length; 
						end = rc.text.length + s.text.length;
					}
					// remove all EOL to have the same start and end positons as in MOZILLA
					if (number > 0) {
						for (var i = 0; i <= number; i++) {
							var w = input.value.indexOf("\n", position);
							if (w != -1 && w < start) {
								position = w + 1;
								minus++;
								minusEnd = minus;
							} else if (w != -1 && w >= start && w <= end) {
								if (w == start + 1) {
									minus--;
									minusEnd--;
									position = w + 1;
									continue;
								}
								position = w + 1;
								minusEnd++;
							} else {
								i = number;
							}
						}
					}
					if (s.text.indexOf("\n", 0) == 1) {
						minusEnd = minusEnd + 2;
					}
					start = start - minus;
					end = end - minusEnd;
					
					return { start: start, end: end, text: s.text, length: end - start };
				}
				input.focus ();
				if (typeof(input.selectionStart) == "number") {
					start = input.selectionStart;
				} else {
					s = document.selection.createRange();
					re = input.createTextRange();
					rc = re.duplicate();
					re.moveToBookmark(s.getBookmark());
					rc.setEndPoint("EndToStart", re);
					start = rc.text.length;
				}
				if (number > 0) {
					for (var i = 0; i <= number; i++) {
						var w = input.value.indexOf("\n", position);
						if (w != -1 && w < start) {
							position = w + 1;
							minus++;
						} else {
							i = number;
						}
					}
				}
				start = start - minus;
				if (start == 0 && typeof(input.selectionStart) != "number") {
					start = caretPositionAmp[pos];
					end = caretPositionAmp[pos];
				}
				return { start: start, end: start, text: s.text, length: 0 };
			} else if (typeof(input.selectionStart) == "number" ) {
				start = input.selectionStart;
				end = input.selectionEnd;
				part = input.value.substring(input.selectionStart, input.selectionEnd);
				return { start: start, end: end, text: part, length: end - start };
			} else { return { start: undefined, end: undefined, text: undefined, length: undefined }; }
		},

		// function for the replacement of the selected text
		replaceSelection: function(inputStr) {
			var input = this.jquery ? this[0] : this; 
			//part for IE and Opera
			var start;
			var end;
			var position = 0;
			var rc;
			var re;
			var number = 0;
			var minus = 0;
			var mozScrollFix = ( input.scrollTop == undefined ) ? 0 : input.scrollTop;
			var obj = document.getElementsByTagName('TEXTAREA');
			var pos = 0;
			for (pos; pos < obj.length; pos++) {
				if (obj[pos] == input) {
					break;
				}
			}
			if (document.selection && typeof(input.selectionStart) != "number") {
				var s = document.selection.createRange();
				
				// IE support
				if (typeof(input.selectionStart) != "number") { // return null if the selected text not from the needed area
					var firstRe;
					var secondRe;
					re = input.createTextRange();
					rc = re.duplicate();
					firstRe = re.text;
					re.moveToBookmark(s.getBookmark());
					secondRe = re.text;
					try {
						rc.setEndPoint("EndToStart", re);
					}
					catch(err) {
						return this;
					}
					if (firstRe == secondRe && firstRe != s.text || rc.text.length > firstRe.length) {
						return this;
					}
				}
				if (s.text) {
					part = s.text;
					if (input.value.match(/\n/g) != null) {
						number = input.value.match(/\n/g).length;// number of EOL simbols
					}
					// IE support
					start = rc.text.length; 
					// remove all EOL to have the same start and end positons as in MOZILLA
					if (number > 0) {
						for (var i = 0; i <= number; i++) {
							var w = input.value.indexOf("\n", position);
							if (w != -1 && w < start) {
								position = w + 1;
								minus++;
								
							} else {
								i = number;
							}
						}
					}
					s.text = inputStr;
					caretPositionAmp[pos] = rc.text.length + inputStr.length;
					re.move("character", caretPositionAmp[pos]);
					document.selection.empty();
					input.blur();
				}
				return this;
			} else if (typeof(input.selectionStart) == "number" && // MOZILLA support
					input.selectionStart != input.selectionEnd) {
				
				start = input.selectionStart;
				end = input.selectionEnd;
				input.value = input.value.substr(0, start) + inputStr + input.value.substr(end);
				position = start + inputStr.length;
				input.setSelectionRange(position, position); 
				input.scrollTop = mozScrollFix;
				return this;
			}
			return this;
		},

		//Set Selection in text
		setSelection: function(startPosition, endPosition) {
			startPosition = parseInt(startPosition);
			endPosition = parseInt(endPosition);
			
			var input = this.jquery ? this[0] : this; 
			input.focus ();
			if (typeof(input.selectionStart) != "number") {
				re = input.createTextRange();
				if (re.text.length < endPosition) {
					endPosition = re.text.length+1;
				}
			}
			if (endPosition < startPosition) {
				return this;
			}
			if (document.selection) { 
				var number = 0;
				var plus = 0;
				var position = 0;
				var plusEnd = 0;
				if (typeof(input.selectionStart) != "number") { // IE
					re.collapse(true); 
					re.moveEnd('character', endPosition); 
					re.moveStart('character', startPosition); 
					re.select(); 
					return this;
				} else if (typeof(input.selectionStart) == "number") {      // Opera
					if (input.value.match(/\n/g) != null) {
						number = input.value.match(/\n/g).length;// number of EOL simbols
					}
					if (number > 0) {
						for (var i = 0; i <= number; i++) {
							var w = input.value.indexOf("\n", position);
							if (w != -1 && w < startPosition) {
								position = w + 1;
								plus++;
								plusEnd = plus;
							} else if (w != -1 && w >= startPosition && w <= endPosition) {
								if (w == startPosition + 1) {
									plus--;
									plusEnd--;
									position = w + 1;
									continue;
								}
								position = w + 1;
								plusEnd++;
							} else {
								i = number;
							}
						}
					}
					startPosition = startPosition + plus;
					endPosition = endPosition + plusEnd;
					input.selectionStart = startPosition; 
					input.selectionEnd = endPosition;
					input.focus ();
					return this;
				} else {
					input.focus ();
					return this;
				}
			}
			else if (input.selectionStart || input.selectionStart == 0) {   // MOZILLA support
				input.focus ();
				window.getSelection().removeAllRanges();
				input.selectionStart = startPosition; 
				input.selectionEnd = endPosition; 
				input.focus ();
				return this;
			} 
		},

		// insert text at current caret position
		insertAtCaretPos: function(inputStr) {
			var input = this.jquery ? this[0] : this; 
			var start;
			var end;
			var position;
			var s;
			var re;
			var rc;
			var point;
			var minus = 0;
			var number = 0;
			var mozScrollFix = ( input.scrollTop == undefined ) ? 0 : input.scrollTop; 
			var obj = document.getElementsByTagName('TEXTAREA');
			var pos = 0;
			for (pos; pos < obj.length; pos++) {
				if (obj[pos] == input) {
					break;
				}
			}
			input.focus();
			if (document.selection && typeof(input.selectionStart) != "number") {
				if (input.value.match(/\n/g) != null) {
					number = input.value.match(/\n/g).length;// number of EOL simbols
				}
				point = parseInt(caretPositionAmp[pos]);
				if (number > 0) {
					for (var i = 0; i <= number; i++) {
						var w = input.value.indexOf("\n", position);
						if (w != -1 && w <= point) {
							position = w + 1;
							point = point - 1;
							minus++;
						} 
					}
				}
			}
			caretPositionAmp[pos] = parseInt(caretPositionAmp[pos]);

			// IE
			input.onkeyup = function() { // for IE because it loses caret position when focus changed
				if (document.selection && typeof(input.selectionStart) != "number") {
					input.focus();
					s = document.selection.createRange();
					re = input.createTextRange();
					rc = re.duplicate();
					re.moveToBookmark(s.getBookmark());
					rc.setEndPoint("EndToStart", re);
					caretPositionAmp[pos] = rc.text.length;
				}
				
			}

			input.onmouseup = function() { // for IE because it loses caret position when focus changed
				if (document.selection && typeof(input.selectionStart) != "number") {
					input.focus();
					s = document.selection.createRange();
					re = input.createTextRange();
					rc = re.duplicate();
					re.moveToBookmark(s.getBookmark());
					rc.setEndPoint("EndToStart", re);
					caretPositionAmp[pos] = rc.text.length;
				}
			}

			if (document.selection && typeof(input.selectionStart) != "number") {
				s = document.selection.createRange();
				if (s.text.length != 0) {
					return this;
				}
				re = input.createTextRange();
				textLength = re.text.length;
				rc = re.duplicate();
				re.moveToBookmark(s.getBookmark());
				rc.setEndPoint("EndToStart", re);
				start = rc.text.length; 
				if (caretPositionAmp[pos] > 0 && start ==0) {
					minus = caretPositionAmp[pos] - minus;
					re.move("character", minus);
					re.select();
					s = document.selection.createRange();
					caretPositionAmp[pos] += inputStr.length;
				} else if (!(caretPositionAmp[pos] >= 0) && textLength ==0) {
					s = document.selection.createRange();
					caretPositionAmp[pos] = inputStr.length + textLength;
				} else if (!(caretPositionAmp[pos] >= 0) && start ==0) {
					re.move("character", textLength);
					re.select();
					s = document.selection.createRange();
					caretPositionAmp[pos] = inputStr.length + textLength;
				} else if (!(caretPositionAmp[pos] >= 0) && start > 0) { 
					re.move("character", 0);
					document.selection.empty();
					re.select();
					s = document.selection.createRange();
					caretPositionAmp[pos] = start + inputStr.length;
				} else if (caretPositionAmp[pos] >= 0 && caretPositionAmp[pos] == textLength) { 
					if (textLength != 0) {
						re.move("character", textLength);
						re.select();
					} else {
						re.move("character", 0);
					}
					s = document.selection.createRange();
					caretPositionAmp[pos] = inputStr.length + textLength;
				} else if (caretPositionAmp[pos] >= 0 && start != 0 && caretPositionAmp[pos] >= start) { 
					minus = caretPositionAmp[pos] - start;
					re.move("character", minus);
					document.selection.empty();
					re.select();
					s = document.selection.createRange();
					caretPositionAmp[pos] = caretPositionAmp[pos] + inputStr.length; 
				} else if (caretPositionAmp[pos] >= 0 && start != 0 && caretPositionAmp[pos] < start) { 
					re.move("character", 0);
					document.selection.empty();
					re.select();
					s = document.selection.createRange();
					caretPositionAmp[pos] = caretPositionAmp[pos] + inputStr.length; 
				} else { 
					document.selection.empty();
					re.select();
					s = document.selection.createRange();
					caretPositionAmp[pos] = caretPositionAmp[pos] + inputStr.length; 
				} 
				s.text = inputStr; 
				input.focus();

				return this;
			} else if (typeof(input.selectionStart) == "number" && // MOZILLA support
					input.selectionStart == input.selectionEnd) {
				position = input.selectionStart + inputStr.length;
				start = input.selectionStart;
				end = input.selectionEnd;
				input.value = input.value.substr(0, start) + inputStr + input.value.substr(end);
				input.setSelectionRange(position, position); 
				input.scrollTop = mozScrollFix; 
				return this;
			}
			return this;
		},

		// Set caret position
		setCaretPos: function(inputStr) {
			var input = this.jquery ? this[0] : this; 
			var s;
			var re;
			var position;
			var number = 0;
			var minus = 0;
			var w;
			var obj = document.getElementsByTagName('TEXTAREA');
			var pos = 0;
			for (pos; pos < obj.length; pos++) {
				if (obj[pos] == input) {
					break;
				}
			}
			input.focus();
			if (parseInt(inputStr) == 0) {
				return this;
			}
			//if (document.selection && typeof(input.selectionStart) == "number") {
			if (parseInt(inputStr) > 0) {
				inputStr = parseInt(inputStr) - 1;
				if (document.selection && typeof(input.selectionStart) == "number" && input.selectionStart == input.selectionEnd) {
					if (input.value.match(/\n/g) != null) {
						number = input.value.match(/\n/g).length;// number of EOL simbols
					}
					if (number > 0) {
						for (var i = 0; i <= number; i++) {
							w = input.value.indexOf("\n", position);
							if (w != -1 && w <= inputStr) {
								position = w + 1;
								inputStr = parseInt(inputStr) + 1;
							} 
						}
					}
				}
			} 
			else if (parseInt(inputStr) < 0) {
				inputStr = parseInt(inputStr) + 1;
				if (document.selection && typeof(input.selectionStart) != "number") {
					inputStr = input.value.length + parseInt(inputStr);
					if (input.value.match(/\n/g) != null) {
						number = input.value.match(/\n/g).length;// number of EOL simbols
					}
					if (number > 0) {
						for (var i = 0; i <= number; i++) {
							w = input.value.indexOf("\n", position);
							if (w != -1 && w <= inputStr) {
								position = w + 1;
								inputStr = parseInt(inputStr) - 1;
								minus += 1;
							} 
						}
						inputStr = inputStr + minus - number;
					}
				} else if (document.selection && typeof(input.selectionStart) == "number") {
					inputStr = input.value.length + parseInt(inputStr);
					if (input.value.match(/\n/g) != null) {
						number = input.value.match(/\n/g).length;// number of EOL simbols
					}
					if (number > 0) {
						inputStr = parseInt(inputStr) - number;
						for (var i = 0; i <= number; i++) {
							w = input.value.indexOf("\n", position);
							if (w != -1 && w <= (inputStr)) {
								position = w + 1;
								inputStr = parseInt(inputStr) + 1;
								minus += 1;
							} 
						}
					}
				} else { inputStr = input.value.length + parseInt(inputStr); }
			} else { return this; }
			// IE
			if (document.selection && typeof(input.selectionStart) != "number") {
				s = document.selection.createRange();
				if (s.text != 0) {
					return this;
				}
				re = input.createTextRange();
				re.collapse(true);
				re.moveEnd('character', inputStr);
				re.moveStart('character', inputStr);
				re.select();
				caretPositionAmp[pos] = inputStr;
				return this;
			} else if (typeof(input.selectionStart) == "number" && // MOZILLA support
					input.selectionStart == input.selectionEnd) {
				input.setSelectionRange(inputStr, inputStr); 
				return this;
			}
			return this;
		},

		countCharacters: function(str) {
			var input = this.jquery ? this[0] : this;
			if (input.value.match(/\r/g) != null) {
				return input.value.length - input.value.match(/\r/g).length;
			}
			return input.value.length;
		},

		setMaxLength: function(max, f) {
			this.each(function() {
				var input = this.jquery ? this[0] : this;
				var type = input.type;
				var isSelected;    
				var maxCharacters;
				// remove limit if input is a negative number
				if (parseInt(max) < 0) {
					max=100000000;
				}
				if (type == "text") {
					input.maxLength = max;
				}
				if (type == "textarea" || type == "text") {
					input.onkeypress = function(e) {
						var spacesR = input.value.match(/\r/g);
						maxCharacters = max;
						if (spacesR != null) {
							maxCharacters = parseInt(maxCharacters) + spacesR.length;
						}
						// get event
						var key = e || event;
						var keyCode = key.keyCode;
						// check if any part of text is selected
						if (document.selection) {
							isSelected = document.selection.createRange().text.length > 0;
						} else {
							isSelected = input.selectionStart != input.selectionEnd;
						}
						if (input.value.length >= maxCharacters && (keyCode > 47 || keyCode == 32 ||
								keyCode == 0 || keyCode == 13) && !key.ctrlKey && !key.altKey && !isSelected) {
							input.value = input.value.substring(0,maxCharacters);
							if (typeof(f) == "function") { f() } //callback function
							return false;
						}
					}
					input.onkeyup = function() { 
						var spacesR = input.value.match(/\r/g);
						var plus = 0;
						var position = 0;
						maxCharacters = max;
						if (spacesR != null) {
							for (var i = 0; i <= spacesR.length; i++) {
								if (input.value.indexOf("\n", position) <= parseInt(max)) {
									plus++;
									position = input.value.indexOf("\n", position) + 1;
								}
							}
							maxCharacters = parseInt(max) + plus;
						} 
						if (input.value.length > maxCharacters) {  
							input.value = input.value.substring(0, maxCharacters); 
							if (typeof(f) == "function") { f() }
							return this;
						}
					}
				} else { return this; }
			})
			return this;
		}
	}); 


////////////////////////////////////////////////////////////////////////////////////
// Jquery Color picker part
//
// Original script: Colour Picker 2.0 (http://andreaslagerkvist.com/jquery/colour-picker/)
// By Andreas Lagerkvist
////////////////////////////////////////////////////////////////////////////////////
	jQuery.fn.colourPicker = function (conf) {
		// Config for plug
		var config = jQuery.extend({
			id:			'jquery-colour-picker',	// id of colour-picker container
			ico:		'ico.gif',				// SRC to colour-picker icon
			title:		'Pick a colour',		// Default dialogue title
			inputBG:	false,					// Whether to change the input's background to the selected colour's
			speed:		200					// Speed of dialogue-animation
		}, conf );

		// Inverts a hex-colour
		var hexInvert = function (hex) {
			var r = hex.substr(0, 2);
			var g = hex.substr(2, 2);
			var b = hex.substr(4, 2);

			return 0.212671 * r + 0.715160 * g + 0.072169 * b < 0.5 ? 'ffffff' : '000000'
		};

		// Add the colour-picker dialogue if not added
		var colourPicker = jQuery('#' + config.id);

		if (!colourPicker.length) {
			colourPicker = jQuery('<div id="' + config.id + '"></div>').appendTo(document.body).hide();

			// Remove the colour-picker if you click outside it (on body)
			jQuery(document.body).click(function(event) {
				if (!(jQuery(event.target).is('#' + config.id) || jQuery(event.target).parents('#' + config.id).length)) {
					colourPicker.hide(config.speed);
				}
			});
		}

		// For every select passed to the plug-in
		return this.each(function () {
			// Insert icon
			var select	= jQuery(this);
			var icon	= jQuery('<img src="' + config.ico + '" alt="' + ez_bbcode_ico_color + '" title="' + ez_bbcode_title_ico_color + '" class="ez_bbcode_ico_color" />').insertAfter(select);
			var loc		= '';

			// Build a list of colours based on the colours in the select
			jQuery('option', select).each(function () {
				var option	= jQuery(this);
				var hex		= option.val();
				var title	= option.text();

				loc += '<li><a href="#" title="' 
						+ title 
						+ '" rel="' 
						+ hex 
						+ '" style="background: #' 
						+ hex 
						+ '; colour: ' 
						+ hexInvert(hex) 
						+ ';">' 
						+ title 
						+ '</a></li>';
			});

			// Remove select
			select.remove();

			// When you click the icon
			icon.click(function () {
				// Show the colour-picker next to the icon and fill it with the colours in the select that used to be there
				var iconPos	= icon.offset();
				var heading	= config.title ? '<span>' + config.title + '</span>' : '';

				colourPicker.html(heading + '<ul>' + loc + '</ul>').css({
					position: 'absolute', 
					left: iconPos.left + 'px', 
					top: iconPos.top + 'px'
				}).show(config.speed);

				// When you click a colour in the colour-picker
				jQuery('a', colourPicker).click(function () {
					// The hex is stored in the link's rel-attribute
					var hex = jQuery(this).attr('rel');

					// Bccode Part //////////////////////////////////////////////////////////////////////////
					sel = $("textarea[name=req_message]").getSelection();
						if (sel.length < 1){
						$("textarea[name=req_message]").insertAtCaretPos('[color=#'+hex+'][/color]');
						pos_final = sel.start + 16;
						$("textarea[name=req_message]").setCaretPos(pos_final);
						}
						else {
						str = '[color=#'+hex+']'+sel.text+'[/color]';
						$("textarea[name=req_message]").replaceSelection(str);
						pos_final = sel.start + str.length + 1;
						$("textarea[name=req_message]").setCaretPos(pos_final);
						}
					// Bccode Part //////////////////////////////////////////////////////////////////////////

					// Hide the colour-picker and return false
					colourPicker.hide(config.speed);
					
					return false;
				});

				return false;
			});
		});
	};


////////////////////////////////////////////////////////////////////////////////////
// EZ BBcode V1.0
//
// Original script: EZ BBcode
// By Supraname
////////////////////////////////////////////////////////////////////////////////////

	// Variable declaration
	var sel = null;
	var str = null;
	var alt = null;
	var re = new RegExp("\\\[.*\\\]$");
	var saisie = null;
	var bbcode = null;
	var pos_insel = null;
	var pos_final = null;
	
	function fi_alt(test){
		if (test.match(re)){
		return test.match(re);
		}
		else {
		return false;
		}
	}

	// Main Function
	$(document).ready(function() {
		// Show the div if Jquery is loaded
		$("#ez_bbcode_menu").show();
		
		// Colorpicker part
		$("#ez_bbcode_select_color").colourPicker({
		ico:	'./ez_bbcode/icon/color_ico.png', 
		title:	ez_bbcode_select_color+': '
		});
			
		// Other part
		$("img.ez_bbcode_ico").click(function(){
		alt = $(this).attr("alt");
		sel = $("textarea[name=req_message]").getSelection();

			// Prompt condition for link, email img and quote
			if (str.indexOf('#2') != '-1' & str.indexOf('#1') != '-1'){
				if (sel.length < 1){
				saisie = prompt(alt+":", "");
					if (saisie != null) {
					str = str.replace("#2",saisie);
					pos_insel = str.indexOf("#1");
					str = str.replace("#1", "");
					$("textarea[name=req_message]").insertAtCaretPos(str);
					pos_final = sel.start + pos_insel + 1;
					$("textarea[name=req_message]").setCaretPos(pos_final);
					}
				}
				else {
				saisie = prompt(alt+":", "");
					if (saisie != null) {
					str = str.replace("#2",saisie);
					str = str.replace("#1", sel.text);
					$("textarea[name=req_message]").replaceSelection(str);
					pos_final = sel.start + str.length + 1;
					$("textarea[name=req_message]").setCaretPos(pos_final);
					}
				}
			}
			// Normal condition
			else if (str.indexOf('#1') != '-1' & str.indexOf('#c') == '-1'){
				if (sel.length < 1){
				pos_insel = str.indexOf("#1");
				str = str.replace("#1", sel.text);
				$("textarea[name=req_message]").insertAtCaretPos(str);
				pos_final = sel.start + pos_insel + 1;
				$("textarea[name=req_message]").setCaretPos(pos_final);
				}
				else {
				str = str.replace("#1", sel.text)
				$("textarea[name=req_message]").replaceSelection(str);
				pos_final = sel.start + str.length + 1;
				$("textarea[name=req_message]").setCaretPos(pos_final);
				}
			}
			// Smiley condition
			else if (str.indexOf('#1') == '-1' & str.indexOf('#2') == '-1' & str.indexOf('#c') == '-1') {
			$("textarea[name=req_message]").insertAtCaretPos(str);
			pos_final = sel.start + str.length + 1;
			$("textarea[name=req_message]").setCaretPos(pos_final);
			}
		});
	});
}