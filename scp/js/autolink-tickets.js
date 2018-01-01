/*!
 * @copyright 2016 Josh Richard <https://joshrichard.net/licenses/mit>
 * @see <https://github.com/c0nfus3d/osticket-mods/tree/master/autolink-ticket-references>
 */

(function($){
  var autoLinkTickets = function() {
    if(typeof $("#ticket_thread").html() !== 'undefined') {
      $("#ticket_thread").html($("#ticket_thread").html().replace(/(ticket#|ticket\s#)([0-9])+/ig, function(m, c, o, s) {
        return "<a href='redirect.php?id=" + m.split("#")[1].trim() + "'><strong>" + m + "</strong></a>";
      }));
    }
  };

  $(document).on('pjax:complete', function() {
    autoLinkTickets();
  });

  autoLinkTickets();
}(jQuery));
