(function ($) {
  "use strict";

  Drupal.behaviors.tcLightHeaders = {
    /**
     * @param context
     *   The context for which the behavior is being executed.
     * @param settings
     *   An array of settings.
     */
    attach: function (context, settings) {
      $('[data-id=headers-4-sidebar-toggle] img', context).click(function (e) {
        $('#headers-4-sidebar', context).toggleClass('show');
      });
      $('[data-id=headers-4-sidebar-close]', context).click(function (e) {
        $('#headers-4-sidebar', context).removeClass('show');
      });    },
  };
})(jQuery);

