(function (window, $)
{
    window._EPYTA_.widen_ytprefs_wiz = window._EPYTA_.widen_ytprefs_wiz || function () {
        setTimeout(function () {
            $("#TB_window").addClass('epyt-thickbox').animate({marginLeft: '-475px', width: '950px'}, 150, 'swing', function () {
                $("#TB_window").get(0).style.setProperty('width', '950px', 'important');
            });

            $("#TB_overlay").addClass('epyt-thickbox');

            $("#TB_window iframe").animate({width: '950px'}, 150);
        }, 750);
    };

    $(document).ready(function () {

        if (window.location.toString().indexOf('https://') === 0)
        {
            window._EPYTA_.wpajaxurl = window._EPYTA_.wpajaxurl.replace("http://", "https://");
        }

        // Create IE + others compatible event handler
        var epeventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var epeventer = window[epeventMethod];
        var epmessageEvent = epeventMethod == "attachEvent" ? "onmessage" : "message";

        // Listen to message from child window
        epeventer(epmessageEvent, function (e)
        {
            var embedcode = "";
            try
            {
                if (e.data.indexOf("youtubeembedplus") === 0)
                {
                    embedcode = e.data.split("|")[1];
                    if (embedcode.indexOf("[") !== 0)
                    {
                        embedcode = "<p>" + embedcode + "</p>";
                    }

                    if (window.tinyMCE !== null && window.tinyMCE.activeEditor !== null && !window.tinyMCE.activeEditor.isHidden())
                    {
                        if (typeof window.tinyMCE.execInstanceCommand !== 'undefined')
                        {
                            window.tinyMCE.execInstanceCommand(
                                    window.tinyMCE.activeEditor.id,
                                    'mceInsertContent',
                                    false,
                                    embedcode);
                        } else
                        {
                            send_to_editor(embedcode);
                        }
                    } else
                    {
                        embedcode = embedcode.replace('<p>', '\n').replace('</p>', '\n');
                        if (typeof QTags.insertContent === 'function')
                        {
                            QTags.insertContent(embedcode);
                        } else
                        {
                            send_to_editor(embedcode);
                        }
                    }
                    tb_remove();


                } else if (e.data.indexOf("youtubeextprop") === 0)
                {
                    var extprop = e.data.split("|")[1];
                    var extpropval = extprop === 'xdash1' ? 1 : 0;
                    if (extpropval != window._EPYTA_.dashpre)
                    {
                        $.ajax({
                            type: "post",
                            dataType: "json",
                            timeout: 30000,
                            url: window._EPYTA_.wpajaxurl,
                            data: {action: 'my_embedplus_dashpre', dashpre: extpropval},
                            success: function (response) {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                            },
                            complete: function () {
                            }
                        });

                    }


                }

            } catch (err)
            {

            }


        }, false);

        $('body').on('click.tbyt', "#ytprefs_wiz_button, .ytprefs_wiz_button_widget_text", function () {
            window._EPYTA_.widen_ytprefs_wiz();
        });
        $(window).resize(window._EPYTA_.widen_ytprefs_wiz);
        
        $(document).on('wp-before-tinymce-init.ytprefs-media_button', function (event, init) {
            $media_buttons = $(init.selector).closest('.wp-editor-wrap').find('.wp-media-buttons');
            if (!$media_buttons.find('.ytprefs_media_link').length)
            {
                $media_buttons.append('<a href="' + encodeURI(window._EPYTA_.wizhref) + '" class="thickbox button ytprefs_media_link ytprefs_wiz_button_widget_text" title="Visual YouTube Search Tool and Wizard - For easier embedding"><span></span> YouTube</a>');
            }
        });
        
    });
})(window, jQuery);