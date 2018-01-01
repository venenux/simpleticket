/*!
 * @copyright 2016 Josh Richard <https://joshrichard.net/licenses/mit>
 * @see <https://github.com/c0nfus3d/osticket-mods/tree/master/open-ticket-refresher>
 */

(function($) {
  var idleAction, titleFlash;

  /** Current open ticket count */
  var CurrentlyOpen = (typeof $("#subnav3").html() === 'undefined') ? null : $("#subnav3").html().split("(")[1].slice(0, -1);

  /** @see http://stackoverflow.com/a/901144/1078169 */
  var GetQueryString = function(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  };

  /** Change the page title */
  var flashTitle = function(pageTitle, messageTitle) {
    if (document.title == pageTitle)
        document.title = messageTitle;
    else
        document.title = pageTitle;
  };

  /** Reset the idle timer */
  var idleReset = function() {
      clearTimeout(idleAction);
      idleAction = setTimeout(function () {
        window.location = "tickets.php?count=" + CurrentlyOpen + ((GetQueryString('status') !== null) ? "&status=" + GetQueryString('status') : '');
      }, 500000);
  };

  var run = function() {
    /** Run only when viewing open tickets */
    if(window.location.pathname == "/scp/tickets.php" && ((GetQueryString('status') === null && GetQueryString('id') === null) || GetQueryString('status') == "open")) {
    	idleReset();

    	/** There are new tickets available */
    	if(GetQueryString('count') !== null && CurrentlyOpen > GetQueryString('count')) {
    		/** Flash the page title */
    		titleFlash = setInterval(function(){ flashTitle('Staff Control Panel', 'New Ticket!'); }, 1000);

    		/** Stop flashing the page title when the user is active again */
    		$('html').bind('click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
    			clearInterval(titleFlash);
    		});
    	}

    	/** On any action, reset the idle timer */
    	$('html').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
            	idleReset();
    	});
    }
  };

  $(document).on('pjax:complete', function() {
    run();
  });

  run();
}(jQuery));
