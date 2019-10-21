var currentTasks = 1;

function ocmGetCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function ocmSetCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}

(function($) {
  $.fn.hasAttr = function(name) {
    return this.attr(name) !== undefined;
  },
    $.fn.radioButton = function() {
      return this.each(function() {
        if ($(this).prop("tagName") == 'SELECT') {
          $(this).each(function() {
            var length = $(this).find('option').length;
            if (length > 0 && length < 6) {
              var select = this;
              var html = '<div class="btn-group radio-buttons" data-toggle="buttons" style="' + ($(this).hasClass('radio-full') ? 'width: 100%;' : 'min-width: 20%;') + '">';

              $(this).find('option').each(function() {
                html += '<label class="btn btn-default' + (($(select).hasClass('signed') || length == 2) ? ($(this).val() < 1 ? ' disable' : ' enable') : ' unsigned') + (($(this).val() == $(select).find('option:selected').first().val()) ? ' active' : '') + ' radio-button" onclick="' + ($(select).hasAttr('onchange') ? $(select).prop('onchange') + ';' : '') + '$(\'#' + $(select).prop('id') + '\').val(\'' + $(this).val() + '\');" style="width: ' + (100 / length).toString() + '%">';
                html += '<input type="radio" id="' + $(select).prop('id') + '-' + $(this).val() + '" value="' + $(this).val() + '" autocomplete="off" ' + (($(this).hasAttr('selected') || $(this).val() == $(select).find('option:selected').first().val()) ? 'checked' : '') + '> ' + $(this).html();
                html += '</label>';
              });

              html += '</div>';

              $(html).insertBefore(this);

              $(this).prop('style', 'display: none;').removeClass('radio');
            }
          });
        } else if ($(this).prop("tagName") == 'LABEL') {
          $('label.radio-inline').each(function() {
            var length = $(this).parent().find('label.radio-inline').length;
            if (length < 6) {
              $(this).parent().attr('data-toggle', 'buttons-temp');

              $(this).removeClass('radio-inline').addClass('btn btn-default radio-button');

              if ($(this).find('input[type="radio"]:first').val() == '0') {
                $(this).addClass('disable');
              } else {
                $(this).addClass('enable');
              }

              if ($(this).find('input[type="radio"]:checked').length > 0) {
                $(this).addClass('active');
              }
            }
          });
        }

        $('div[data-toggle=\'buttons-temp\']').each(function() {
          var html = '<div class="btn-group radio-buttons" data-toggle="buttons" style="' + ($(this).hasClass('radio-full') ? 'width: 100%;' : 'min-width: 20%;') + '">' + $(this).html() + '</div>';
          $(this).removeAttr('data-toggle').html(html);
        });

        $(this).find('div.radio-buttons label.radio-button').each(function() {
          var length = $(this).parent().find('label.radio-button').length;
          $(this).prop('style', 'width: ' + (100 / length).toString() + '%; overflow: hidden;');
        });
      });
    },
    $.fn.superSelect = function() {
      return this.each(function() {
        $(this).selectpicker({
          actionsBox: true,
          selectAllText: jslanguage.text_select_all,
          deselectAllText: jslanguage.text_unselect_all,
          noneSelectedText: jslanguage.text_none,
        });
      });
    }
})(window.jQuery);

// Initialize objects
$(document).ready(function() {
  $('.bootstrap-ocm select.radio').radioButton();
  $('.bootstrap-ocm label.radio-inline').radioButton();
  $('.bootstrap-ocm select.superselect').superSelect();

  // Init tabs
  var ocmTab = ocmGetCookie('ocm-tab');
  if ($('.bootstrap-ocm #panel-body ul.main > li > a[href="#tab-' + ocmTab + '"]').length) {
    $('.bootstrap-ocm #panel-body ul.main > li > a[href="#tab-' + ocmTab + '"]').tab('show');
  } else {
    $('.bootstrap-ocm #panel-body ul.main > li > a').first().tab('show');
  }

  // Tabs click trigger
  $('.bootstrap-ocm ul.nav.main li a').click(function() {
    ocmSetCookie('ocm-tab', $(this).attr('href').substr(5));
  });

  // Tabs button switching
  $('.bootstrap-ocm ul.nav.main li').click(function() {
    $('#ocm-buttons .removable').remove();
    if ($(this).find('.buttons button, .buttons a').length > 0) {
      $(this).find('.buttons button, .buttons a').addClass('removable');
      $('#ocm-buttons').prepend($(this).find('.buttons').html());
      $('#ocm-buttons *[data-toggle="tooltip"]').tooltip();
    }
  });

  // Tab buttons display
  $('.bootstrap-ocm ul.nav.main li.active').click();
  $('#ocm-buttons *[data-toggle="tooltip"]').tooltip();
});

// Delegate
$(document).delegate('.bootstrap-ocm form.superform input', 'keydown', function(event) {
  if (event.keyCode == 13) {
    return true;
  }
});

$(document).delegate('.bootstrap-ocm form', 'submit', function() {
  if (currentTasks > 0) {
    alert(jslanguage.error_loading);
  }
  return (currentTasks == 0);
});

// Super Form
$(document).delegate('.bootstrap-ocm form.superform', 'submit', function(e) {
  var userform = this;

  var superform = $("<form method=\"POST\" class=\"superform-run\"></form>")
    .attr('action', $(this).attr('action'))
    .append($("<input type=\"hidden\" name=\"ocm-serializedData\">").val($(this).serialize()))
    .submit(function() {
      if ($(userform).hasClass('superform-ajax')) {
        $.ajax({
          type: $(userform).attr('method'),
          url: $(userform).attr('action'),
          data: $(userform).serialize(),
          dataType: 'json',
          beforeSend: function() {
            currentTasks++;

            if ($('.bootbox-confirm').length > 0) {
              $('.bootbox-confirm').attr('id', 'modal-loading');
            }
            $('#modal-loading .modal-header h4').html(jslanguage.text_loading);
            $('#modal-loading .modal-body').html('<div class="text-center"><i class="fa fa-spin fa-spinner"></i> ' + jslanguage.text_wait + '</div>');
            $('#modal-loading .modal-footer').html('<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">OK</button>');
            $('#modal-loading .modal-footer button:last-child').focus();
          },
          success: function(json) {
            $(superform).detach();

            $('#modal-loading .modal-header h4').html(jslanguage.text_done);

            var html = '';
            $.each(json.messages, function(index, message){
              html += '<div class="alert ' + message.class + '"><i class="fa ' + message.icon + '"></i>' + message.text + '</div>';
            });
            $('#modal-loading .modal-body').html(html);
          },
          complete: function() {
            currentTasks--;
          },
          error: function(event, jqxhr, settings, thrownError) {
            $(superform).detach();

            $('#modal-loading .modal-body').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>' + jslanguage.error_undefined + '</div>');
          },
        });
      } else {
        if ($(userform).hasAttr('superform-confirm')) {
          bootbox.confirm({
            title: jslanguage.text_confirmation,
            message: ($(this).hasAttr('superform-confirm-message') ? $(this).attr('superform-confirm-message') : jslanguage.text_confirm),
            callback: function(result) {
              if (result) {
                $(userform).removeAttr('superform-confirm');
                $(superform).submit();
                return false;
              }
            }
          });
          $('.bootbox').appendTo('#content');
        } else {
          return true;
        }
      }

      return false;
    })
    .appendTo($('body'));

  if ($(userform).hasClass('superform-ajax')) {
    if ($(this).hasAttr('superform-confirm')) {
      bootbox.confirm({
        title: jslanguage.text_confirmation,
        message: ($(this).hasAttr('superform-confirm-message') ? $(this).attr('superform-confirm-message') : jslanguage.text_confirm),
        callback: function(result) {
          if (result) {
            $(superform).submit();
            return false;
          } else {
            $(superform).detach();
          }
        }
      });
      $('.bootbox').appendTo('#content');
    } else {
      var html = '';
      html += '<div class="bootstrap-ocm">';
      html += '  <div id="modal-loading" class="modal">';
      html += '    <div class="modal-dialog">';
      html += '      <div class="modal-content">';
      html += '        <div class="modal-header">';
      html += '          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
      html += '          <h4 class="modal-title"></h4>';
      html += '        </div>';
      html += '        <div class="modal-body"></div>';
      html += '        <div class="modal-footer"></div>';
      html += '      </div';
      html += '    </div>';
      html += '  </div>';
      html += '</div>';
      $('body').append(html);
      $('#modal-loading').modal('show');
      $(superform).submit();
    }
  } else {
    $(superform).submit();
  }

  return false;
});

// Window load
$(window).load(function() {
  // Break busy state
  currentTasks--;

  // Display out buttons
  //$('#ocm-buttons').show();
});