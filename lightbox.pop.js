/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2016 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
!function(document,window,$){"use strict";var Site=window.Site;$(document).ready(function($){Site.run()})},$(".examplePopupAjax").magnificPopup({type:"ajax"}),$(".popup-modal").magnificPopup({type:"inline",preloader:!1,modal:!0}),$(document).on("click",".popup-modal-dismiss",function(e){e.preventDefault(),$.magnificPopup.close()});
