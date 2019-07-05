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
      $('[data-id=headers-4-sidebar-toggle]', context).click(function (e) {
        e.preventDefault();
        $('#headers-4-sidebar', context).toggleClass('show');
      });
      $('[data-id=headers-4-sidebar-close]', context).click(function (e) {
        e.preventDefault();
        $('#headers-4-sidebar', context).removeClass('show');
      });    },
  };
})(jQuery);

