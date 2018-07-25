(function ($) {

	$.fn.shareButtons = function (url, options) {

		// The URL is optional. If it is omitted, the plugin
		// will use the URL of the current page.

		if(typeof url === 'object') {
			options = url;
			url = window.location.href;
		}

		options = $.extend({
			twitter : false,
			facebook : false,
			googlePlus : false,
			pinterest: false,
			tumblr: false
		}, options);


		var url_encoded = encodeURIComponent(url);


		// The URLs of the share pages for the supported services

		var shareURLs = {
			'twitter' : 'https://twitter.com/intent/tweet?url=' + url_encoded,
			'facebook' : 'https://facebook.com/sharer.php?u=' + url_encoded,
			'googlePlus' : 'https://plus.google.com/share?url=' + url_encoded,
			'linkedin' : 'http://www.linkedin.com/share/link?url=' + url_encoded,
			'dribbble' : 'http://www.dribbble.com/share/link?url=' + url_encoded,
			'pinterest': 'https://pinterest.com/pin/create/button?url=' + url_encoded
		};

		// Twitter, Tumblr and Pinterest support more options, unique for their services.
		// We handle them here and add them to the sharing URLs.


		// Twitter supports:
		// options.twitter.text - Default text of the tweet. The user can change it.
		// options.twitter.via - A screen name to associate with the Tweet. (By default: none)

		if(options.twitter) {

			if (options.twitter.text) {
				shareURLs['twitter'] += '&text=' + encodeURIComponent(options.twitter.text);
			}

			if (options.twitter.via) {
				shareURLs['twitter'] += '&via=' + encodeURIComponent(options.twitter.via);
			}

		}

		// Tumblr supports:
		// options.tumblr.name - Title of the post (By default: none)
		// options.tumblr.description - Description of the post (By default: none)

		if(options.tumblr) {

			if (options.tumblr.name) {
				shareURLs['tumblr'] += '&name=' + encodeURIComponent(options.tumblr.name);
			}
			
			if (options.tumblr.description) {
				shareURLs['tumblr'] += '&description=' + encodeURIComponent(options.tumblr.description);
			}

		}

		// You can only share images on Pinterest, supplied by the media parameter. It also
		// supports descriptions, which we've included in the URL.

		if(options.pinterest) {

			if (options.pinterest.media) {
				shareURLs['pinterest'] += '&media=' + encodeURIComponent(options.pinterest.media);
			}

			if (options.pinterest.description) {
				shareURLs['pinterest'] += '&description=' + encodeURIComponent(options.pinterest.description);
			}

		}

		// The plugin supports multiple share buttons on the page.
		// Here we loop the supplied elements and initialize it.

		this.each(function(i){

			var elem = $(this);

			// Create a helper <span> elements

			elem.addClass('socialPlugin');
			elem.append('<span class="showSocialButtons ico-share"></span>');
			elem.append('<span class="socials"></span>');

			// Generate the share buttons

			var socialButtonsPopUp = elem.find('.socials');

			if(options.twitter){
				socialButtonsPopUp.append($('<a class="ico-twitter-with-circle twitter" href="' + shareURLs.twitter .twitter + '" ></a></a>'));
			}

			if(options.facebook){
				socialButtonsPopUp.append($('<a class="ico-facebook-with-circle facebook" href="' + shareURLs.facebook .facebook +  '" ></a>'));
			}

			if(options.googlePlus){
				socialButtonsPopUp.append($('<a class="ico-google-with-circle google-plus" href="' + shareURLs.googlePlus .googlePlus +  '" ></a>'));
			}

			if(options.linkedin) {
				socialButtonsPopUp.append($('<a class="ico-linkedin-with-circle linkedin" href="'+ shareURLs.linkedin .linkedin + '" ></a>'));
			}

			if(options.dribbble) {
				socialButtonsPopUp.append($('<a class="ico-dribbble-with-circle dribbble" href="'+ shareURLs.dribbble .dribbble + '" ></a>'));
			}
			if(options.pinterest) {
				socialButtonsPopUp.append($('<a class="ico-pinterest-with-circle pinterest" href="'+ shareURLs.pinterest .pinterest + '" ></a>'));
			}

		});

		var socials = $('.socialPlugin .socials'),
			socialLength = socials.find('a').length,
			marginLeft = '-35';

		// Calculate the width of the social button containers
		socials.width(socialLength * 10).css({'margin-left': marginLeft - ((socialLength-1) * 9)});

		// Toggling the 'opened' css class will trigger the show/hide animation

		$('.showSocialButtons').click(function(){
			$(this).parent().find('.socials').toggleClass('opened');
		});

		// When a social icon is clicked, open a window with the share URL, centered on screen.

		$('.socialPlugin a').click(function(e) {

			e.preventDefault();

			var url = this.href,
				w = 500,
				h = 400,
				left = (screen.width / 2) - (w / 2),
				top = (screen.height / 2) - (h / 2);

			window.open(url, 'Social Share', 'toolbar=no, location=no, directories=no, status=no,' +
				' menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
		});

		// Close the plugin if there is click/touch outside of it

		$(document).off('.social-plugin').on('click.social-plugin touchstart.social-plugin', function(e){
			if(!$(e.target).hasClass('showSocialButtons') && !$(e.target).parent().hasClass('socials')) {
				socials.removeClass('opened');
			}
		});


		// Enable chaining

		return this;
	};
	
})(jQuery);