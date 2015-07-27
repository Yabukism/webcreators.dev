jQuery(document).ready(function($) {
    Timeline_Admin = {
        _default: {
            id:               0,
            name:             'untitled timeline',
            max:              20,
            loadmore:         0,
            responsive_width: 600,
            blog_categories:  '',
            animation:        1,
            lightbox:         1,
            order:            'desc',
            separator:        'year',
            column_mode:      'dual',
            data_type:        'custom',
            data:             {}
        },

        _element_data:          {},
        _editing_row_id:        null,
        _editing_element_index: null,

        _container: null,

        init: function() {
            Timeline_Admin._container = $('table.timeline-list > tbody');

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            // fetch data
            $.post(ajaxurl, {action: 'get_timeline'}, function(response) {
                Timeline_Admin.build(response);
            });

            $.post(ajaxurl, {action: 'get_timeline_theme'}, function(theme) {
                theme = theme || 'default';
                $('select[name="theme"]').val(theme);
            });

            // events
            $('select[name="theme"]').on('change', Timeline_Admin.Events.onThemeChange);

            $(document).on('click', '#timeline-add-button',              Timeline_Admin.Events.onAdd);
            $(document).on('click', '#timeline-delete-button',           Timeline_Admin.Events.onDelete);
            $(document).on('click', '#timeline-copy-button',             Timeline_Admin.Events.onCopy);

            $(document).on('click', 'button.row-save',                   Timeline_Admin.Events.onSave);
            $(document).on('click', 'div.get-code',                      Timeline_Admin.Events.onGetCode);
            $(document).on('click', '.configure-toggle',                 Timeline_Admin.Events.onConfigure);
            $(document).on('click', 'input.timeline-config-tab',         Timeline_Admin.Events.onConfigureType);
            $(document).on('click', 'div.timeline-element-label',        Timeline_Admin.Events.onElementClick);
            $(document).on('click', 'div.timeline-element-label > span', Timeline_Admin.Events.onElementDelete);
            $(document).on('click', 'div.shortcode',                     Timeline_Admin.Events.onShortcodeClick);
            $(document).on('click',                                      Timeline_Admin.Events.onDocumentClick);

            $(document).on('keyup', 'input.numeric',                     Timeline_Admin.Events.onNumericInputChange);
        },

        build: function(data) {
            $(data).each(function(index, timeline) {
                Timeline_Admin.buildRow(timeline);
            });
        },

        buildRow: function(data, at_front) {
            var row_id = data.id;

            var row = $('<tr data-id="' + row_id + '">').html(
                '<td><input type="checkbox" class="row-select"></td>' +
                '<td><input type="text" name="name_' + row_id + '" value="' + data.name + '" style="width:120px;"></td>' +
                '<td>' +
                    '<label><input type="checkbox" name="animation_' + row_id + '"><span>Yes</span></label>' +
                '</td>' +
                '<td>' +
                    '<label><input type="checkbox" name="lightbox_' + row_id + '">Yes</label>' +
                '</td>' +
                '<td>' +
                    '<select name="dateFormat_' + row_id + '">' +
                        '<option value="DD MMMM YYYY">09 December 2014</option>' +
                        '<option value="DD MMMM YYYY HH:mm">09 December 2014 17:20</option>' +
                        '<option value="DD MMMM YYYY h:mm A">09 December 2014 5:20 PM</option>' +
                        '<option value="DD MMM YYYY">09 Dec 2014</option>' +
                        '<option value="DD MMM YYYY HH:mm">09 Dec 2014 17:20</option>' +
                        '<option value="DD MMM YYYY h:mm A">09 Dec 2014 5:20 PM</option>' +
                        '<option value="DD/MM/YYYY">09/12/2014</option>' +
                        '<option value="DD/MM/YYYY HH:mm">09/12/2014 17:20</option>' +
                        '<option value="DD/MM/YYYY h:mm A">09/12/2014 5:20 PM</option>' +
                        '<option value="DD/MM/YY">09/12/14</option>' +
                        '<option value="DD/MM/YY HH:mm">09/12/14 17:20</option>' +
                        '<option value="DD/MM/YY h:mm A">09/12/14 5:20 PM</option>' +

                        '<option value="MMMM DD YYYY">December 09 2014</option>' +
                        '<option value="MMMM DD YYYY HH:mm">December 09 2014 17:20</option>' +
                        '<option value="MMMM DD YYYY h:mm A">December 09 2014 5:20 PM</option>' +
                        '<option value="MMM DD YYYY">Dec 09 2014</option>' +
                        '<option value="MMM DD YYYY HH:mm">Dec 09 2014 17:20</option>' +
                        '<option value="MMM DD YYYY h:mm A">Dec 09 2014 5:20 PM</option>' +
                        '<option value="MM/DD/YYYY">12/09/2014</option>' +
                        '<option value="MM/DD/YYYY HH:mm">12/09/2014 17:20</option>' +
                        '<option value="MM/DD/YYYY h:mm A">12/09/2014 5:20 PM</option>' +
                        '<option value="MM/DD/YY">12/09/14</option>' +
                        '<option value="MM/DD/YY HH:mm">12/09/14 17:20</option>' +
                        '<option value="MM/DD/YY h:mm A">12/09/14 5:20 PM</option>' +

                        '<option value="YYYY MMMM DD">2014 December 09</option>' +
                        '<option value="YYYY MMMM DD HH:mm">2014 December 09 17:20</option>' +
                        '<option value="YYYY MMMM DD h:mm A">2014 December 09 5:20 PM</option>' +
                        '<option value="YYYY MMM DD">2014 Dec 09</option>' +
                        '<option value="YYYY MMM DD HH:mm">2014 Dec 09 17:20</option>' +
                        '<option value="YYYY MMM DD h:mm A">2014 Dec 09 5:20 PM</option>' +
                        '<option value="YYYY/MM/DD">2014/12/09</option>' +
                        '<option value="YYYY/MM/DD HH:mm">2014/12/09 17:20</option>' +
                        '<option value="YYYY/MM/DD h:mm A">2014/12/09 5:20 PM</option>' +
                        '<option value="YY/MM/DD">14/12/09</option>' +
                        '<option value="YY/MM/DD HH:mm">14/12/09 17:20</option>' +
                        '<option value="YY/MM/DD h:mm A">14/12/09 5:20 PM</option>' +

                        '<option value="YYYY MMMM">2014 December</option>' +
                        '<option value="MMMM YYYY">December 2014</option>' +
                        '<option value="YYYY/MM">2014/12</option>' +
                        '<option value="MM/YYYY">12/2014</option>' +

                        '<option value="YYYY">2014</option>' +
                    '</select>' +
                '</td>' +
                '<td>' +
                    '<select name="separator_' + row_id + '">' +
                        '<option value="">None</option>' +
                        '<option value="year" selected="selected">Year</option>' +
                        '<option value="month">Month</option>' +
                        '<option value="month_year">Month/Year</option>' +
                    '</select>' +
                '</td>' +
                '<td>' +
                    '<select name="column_mode_' + row_id + '">' +
                        '<option value="dual">Dual</option>' +
                        '<option value="left">Left</option>' +
                        '<option value="right">Right</option>' +
                        '<option value="center">Center</option>' +
                    '</select>' +
                '</td>' +
                '<td>' +
                    '<select name="order_' + row_id + '">' +
                        '<option value="desc">DESC</option>' +
                        '<option value="asc">ASC</option>' +
                    '</select>' +
                '</td>' +
                '<td><input type="number" name="max_' + row_id + '" min="0" max="999" value="' + data.max + '" /></td>' +
                '<td><input type="number" name="loadmore_' + row_id + '" min="0" max="999" value="' + data.loadmore + '" /></td>' +
                '<td><input type="number" name="responsive_width_' + row_id + '" min="1" max="9999" value="' + data.responsive_width + '" /></td>' +
                '<td class="input">' +
                    '<button type="button" class="button button-primary row-save">Save</button>&nbsp;' +
                    '<div class="button button-primary get-code">Get Code<div class="shortcode"></div></div>&nbsp;' +
                    '<div class="configure-toggle"></div>' +
                '</td>'
            );

            Timeline_Admin.checkbox(row, row_id, 'animation',   data.animation);
            Timeline_Admin.checkbox(row, row_id, 'lightbox',    data.lightbox);

            Timeline_Admin.select(row, row_id, 'dateFormat',  data.dateFormat);
            Timeline_Admin.select(row, row_id, 'separator',   data.separator);
            Timeline_Admin.select(row, row_id, 'column_mode', data.column_mode);
            Timeline_Admin.select(row, row_id, 'order',       data.order);

            if (at_front) {
                row.prependTo(Timeline_Admin._container);
            } else {
                row.appendTo(Timeline_Admin._container);
            }

            Timeline_Admin.buildConfigRow(data, row);

            return row;
        },

        buildConfigRow: function(data, row) {
            var row_id = data.id;
            var config_data = data.data;

            if (!Timeline_Admin._element_data[row_id]) {
                Timeline_Admin._element_data[row_id] = [];
            }

            var config = '';

            var elements = '<button type="button" class="button button-primary timeline-element-label-add">Add</button>';
            $(config_data.element).each(function(index, element_data) {
                elements += '<div class="timeline-element-label" data-index="' + index + '"><span>x</span>' + element_data.date + ' ' + element_data.title + '</div>';
                Timeline_Admin._element_data[row_id][index] = element_data;
            });

            var year_options = '';
            var year_start   = (new Date()).getFullYear() + 10;
            var year_stop    = 0000;
            for (var i = year_start; i >= year_stop; i--) {
                var year = ('0000' + i).slice(-4);
                year_options += '<option value="' + year + '">' + year + '</option>';
            }

            var day_options = '';
            for (var i = 1; i <= 31; i++) {
                var day = i >= 10 ? i : '0' + i;
                day_options += '<option value="' + day + '">' + day + '</option>';
            }

            var hour_options = '';
            for (var i = 0; i <= 23; i++) {
                var hour = i >= 10 ? i : '0' + i;
                hour_options += '<option value="' + hour + '">' + hour + '</option>';
            }

            var minute_options = '';
            for (var i = 0; i <= 59; i++) {
                var minute = i >= 10 ? i : '0' + i;
                minute_options += '<option value="' + minute + '">' + minute + '</option>';
            }


            var categories = '';
            if (blog_categories) {
                $.each(blog_categories, function(cat_id, cat_name) {
                    categories += '<label><input type="checkbox" value="' + cat_id + '" name="blog_category"><span>' + Timeline_Admin.htmlentities(cat_name) + '</span></label>&nbsp;&nbsp;';
                });
            }

            config += '<div class="timeline-config">' +
                          '<label><input type="radio" class="timeline-config-tab" name="element_type_' + row_id + '" value="custom"' + (data.data_type == 'custom' ? ' checked="checked"' : '') + ' /><span>Custom</span></label>&nbsp;&nbsp;' +
                          '<label><input type="radio" class="timeline-config-tab" name="element_type_' + row_id + '" value="blog"' + (data.data_type == 'blog' ? ' checked="checked"' : '') + ' /><span>Blog Posts</span></label>&nbsp;&nbsp;' +
                          '<label><input type="radio" class="timeline-config-tab" name="element_type_' + row_id + '" value="facebook"' + (data.data_type == 'facebook' ? ' checked="checked"' : '') + ' /><span>Facebok</span></label>&nbsp;&nbsp;' +
                          '<label><input type="radio" class="timeline-config-tab" name="element_type_' + row_id + '" value="twitter"' + (data.data_type == 'twitter' ? ' checked="checked"' : '') + ' /><span>Twitter</span></label>' +
                          '<div class="timeline-config-form timeline-config-form-facebook"' + (data.data_type == 'facebook' ? ' style="display:block;"' : '') + '>' +
                              '<div class="label">Facebook APP ID: (https://developers.facebook.com/apps/)</div>' +
                              '<div class="input"><input type="text" name="facebook_app_id_' + row_id + '" /></div>' +
                              '<div class="label">Access Token: (https://graph.facebook.com/oauth/access_token?client_id=<b>{app-id}</b>&client_secret=<b>{app-secret}</b>&grant_type=client_credentials)</div>' +
                              '<div class="input"><input type="text" name="facebook_access_token_' + row_id + '" /></div>' +
                              '<div class="label">Page ID:</div>' +
                              '<div class="input"><input type="text" name="facebook_page_id_' + row_id + '" /></div>' +
                          '</div>' +
                          '<div class="timeline-config-form timeline-config-form-twitter"' + (data.data_type == 'twitter' ? ' style="display:block;"' : '') + '>' +
                              '<div class="label">Twitter Search Key:</div>' +
                              '<div class="input"><input type="text" name="twitter_search_key_' + row_id + '" /></div>' +
                          '</div>' +
                          '<div class="timeline-config-form timeline-config-form-blog"' + (data.data_type == 'blog' ? ' style="display:block;"' : '') + '>' +
                               '<p><b>Note: Timeline plugin uses Excerpts to display blog posts in timeline events. Please make sure excerpts are assigned to all blog posts.</b></p>' +
                               '<p>Excerpts are used to shorten your blog posts so that only part of the entry — usually the introduction or a summary of the post — is displayed, instead of the entire entry.</p>' +
                               '<p>Depending on the theme you have activated, excerpts you assign may be displayed on your homepage, RSS feed, or archives page. Your theme will also determine whether or not your excerpt is followed by a link that points readers to the full-length post.</p>' +
                               '<p>Click here <a href="http://en.support.wordpress.com/splitting-content/excerpts/">http://en.support.wordpress.com/splitting-content/excerpts/</a> to see how to use Excerpts in WordPress.</p>' +
                               '<div class="label">Categories:</div>' +
                               '<div class="input">' + categories + '</div>' +
                          '</div>' +
                          '<div class="timeline-config-form timeline-config-form-custom"' + (data.data_type == 'custom' ? ' style="display:block;"' : '') + '>' +
                              '<div class="timelint-elements">' + elements + '</div>' +
                              '<div class="timeline-config-form-custom-options">' +
                                  '<div etype="blog_post gallery iframe">' +
                                      '<div class="label">Type:</div>' +
                                      '<div class="input">' +
                                          '<select name="type">' +
                                                '<option value="blog_post">Post</option>' +
                                                '<option value="gallery">Gallery</option>' +
                                                '<option value="iframe">iFrame</option>' +
                                          '</select>' +
                                      '</div>' +
                                  '</div>' +
                                  '<div etype="blog_post gallery iframe">' +
                                      '<div>' +
                                          '<div class="label">Date: (Format: 2014-12-29 17:20)</div>' +
                                          '<div class="input">' +
                                              '<select name="date_year">' + year_options + '</select>' +
                                              '<select name="date_month">' +
                                                  '<option value="01">Jan</option>' +
                                                  '<option value="02">Feb</option>' +
                                                  '<option value="03">Mar</option>' +
                                                  '<option value="04">Apr</option>' +
                                                  '<option value="05">May</option>' +
                                                  '<option value="06">Jun</option>' +
                                                  '<option value="07">Jul</option>' +
                                                  '<option value="08">Aug</option>' +
                                                  '<option value="09">Sep</option>' +
                                                  '<option value="10">Oct</option>' +
                                                  '<option value="11">Nov</option>' +
                                                  '<option value="12">Dec</option>' +
                                              '</select>' +
                                              '<select name="date_day">' + day_options + '</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                              '<select name="date_hour">' + hour_options + '</select>' +
                                              '<span> : </span>' +
                                              '<select name="date_minute">' + minute_options + '</select>' +
                                          '</div>' +
                                      '</div>' +
                                  '</div>' +
                                  '<div etype="blog_post gallery iframe">' +
                                      '<div>' +
                                          '<div class="label">Title:</div>' +
                                          '<div class="input"><input type="text" name="title" /></div>' +
                                      '</div>' +
                                  '</div>' +
                                  '<div etype="blog_post gallery">' +
                                      '<div>' +
                                          '<div class="label">Image: (Put each image url on a new line)</div>' +
                                          '<div class="input"><textarea name="images"></textarea></div>' +
                                      '</div>' +
                                  '</div>' +
                                  '<div etype="blog_post gallery">' +
                                      '<div>' +
                                          '<div class="label">Content:</div>' +
                                          '<div class="input"><textarea name="content"></textarea></div>' +
                                      '</div>' +
                                  '</div>' +
                                  '<div etype="blog_post">' +
                                      '<div>' +
                                          '<div class="label">Read More Link:</div>' +
                                          '<div class="input"><input type="text" name="readmore" /></div>' +
                                      '</div>' +
                                  '</div>' +
                                  '<div etype="gallery iframe">' +
                                      '<div>' +
                                          '<div class="label">Height:</div>' +
                                          '<div class="input"><input type="text" name="height" class="numeric" /></div>' +
                                      '</div>' +
                                  '</div>' +
                                  '<div etype="iframe">' +
                                      '<div>' +
                                          '<div class="label">iFrame URL:</div>' +
                                          '<div class="input"><input type="text" name="url" /></div>' +
                                      '</div>' +
                                  '</div>' +
                                  '<br>' +
                                  '<input type="button" class="button button-primary save-element" value="Save" /> ' +
                                  '<input type="button" class="button cancel-element" value="Cancel" />' +
                              '</div>' +
                          '</div>' +
                      '</div>';

            var config_row = $('<tr class="configure" data-id="' + row_id + '">').html('<td colspan="' + row.children().length + '">' + config + '</td>');

            var option_container = config_row.find('.timeline-config-form-custom-options');

            config_row.find('input[name="facebook_app_id_' + row_id + '"]').val(config_data.facebook_app_id);
            config_row.find('input[name="facebook_access_token_' + row_id + '"]').val(config_data.facebook_access_token);
            config_row.find('input[name="facebook_page_id_' + row_id + '"]').val(config_data.facebook_page_id);
            config_row.find('input[name="twitter_search_key_' + row_id + '"]').val(config_data.twitter_search_key);

            if (data.blog_categories === '') {
                config_row.find('input[name="blog_category"]').prop('checked', true);
            } else {
                config_row.find('input[name="blog_category"]').each(function() {
                    if ($.inArray($(this).val(), data.blog_categories.split(',')) !== -1) {
                        $(this).prop('checked', true);
                    }
                });
            }

            config_row.find('select[name="type"]').on('change', function(e) {
                var type = $(this).val();
                option_container.children('div').hide().filter('[etype*="' + type + '"]').show();
            });

            config_row.find('.save-element').on('click', function(e) {
                Timeline_Admin._element_data[row_id][Timeline_Admin._editing_element_index] = {
                    type:       config_row.find('[name="type"]').val(),
                    date:       config_row.find('[name="date_year"]').val() + '-' + config_row.find('[name="date_month"]').val() + '-' + config_row.find('[name="date_day"]').val() + ' ' + config_row.find('[name="date_hour"]').val() + ':' + config_row.find('[name="date_minute"]').val(),
                    title:      config_row.find('[name="title"]').val(),
                    height:     config_row.find('[name="height"]').val(),
                    readmore:   config_row.find('[name="readmore"]').val(),
                    url:        config_row.find('[name="url"]').val(),
                    content:    config_row.find('[name="content"]').val(),
                    images:     config_row.find('[name="images"]').val() ? config_row.find('[name="images"]').val().replace(/[\n|\r\n]{2,}/g, '\r\n').split(/\n|\r\n/) : []
                };
                option_container.hide();

                config_row.find('.timeline-element-label[data-index="' + Timeline_Admin._editing_element_index + '"]')
                    .removeClass('open')
                    .text(Timeline_Admin._element_data[row_id][Timeline_Admin._editing_element_index].date + ' ' + config_row.find('[name="title"]').val())
                    .append($('<span>').text('x'));
            });

            config_row.find('.cancel-element').on('click', function(e) {
                config_row.find('.timeline-element-label[data-index="' + Timeline_Admin._editing_element_index + '"]').removeClass('open');
                option_container.hide();
            });

            config_row.find('.timeline-element-label-add').on('click', function(e) {
                option_container.show();
                option_container.children('div').hide().filter('[etype*="blog_post"]').show();
                option_container.find('input[name="title"]').focus();

                var date = new Date();
                var _pad = function(value) {
                    if (value < 10) {
                        return '0' + value;
                    } else {
                        return value;
                    }
                };

                var default_date = date.getFullYear() + '-' + _pad(date.getMonth() + 1) + '-' + _pad(date.getDate());
                var new_index = Timeline_Admin._element_data[row_id].length;

                Timeline_Admin._element_data[row_id].push({
                    'type':   'blog_post',
                    'date':   default_date + ' 00:00:00',
                    'title':  ''
                });

                $('<div class="timeline-element-label" data-index="' + new_index + '">').html('<span>x</span>' + default_date + ' 00:00').hide().appendTo($(this).parent()).fadeIn();

                Timeline_Admin.setElementValue(row_id, new_index);
            });

            config_row.insertAfter(row);

            return config_row;
        },

        setElementValue: function(row_id, element_index) {
            var configure_row    = Timeline_Admin._container.find('tr.configure[data-id="' + row_id + '"]');
            var option_container = configure_row.find('.timeline-config-form-custom-options').show();

            if (option_container.length && Timeline_Admin._element_data[row_id] && Timeline_Admin._element_data[row_id][element_index]) {
                Timeline_Admin._editing_element_index = element_index;
                Timeline_Admin._editing_row_id = row_id;

                var element_data = Timeline_Admin._element_data[row_id][element_index];

                var _setValue = function(tag, name, value) {
                    option_container.find(tag + '[name="' + name + '"]').val(value ? value : '');
                };

                option_container.children('div').hide().filter('[etype*="' + element_data.type + '"]').show();

                var m = new moment(element_data.date);

                _setValue('select',   'type',        element_data.type);

                _setValue('select',   'date_year',   m.format('YYYY'));
                _setValue('select',   'date_month',  m.format('MM'));
                _setValue('select',   'date_day',    m.format('DD'));
                _setValue('select',   'date_hour',   m.format('HH'));
                _setValue('select',   'date_minute', m.format('mm'));

                _setValue('input',    'title',       element_data.title);
                _setValue('input',    'url',         element_data.url);
                _setValue('input',    'height',      element_data.height);
                _setValue('input',    'readmore',    element_data.readmore);
                _setValue('textarea', 'content',     element_data.content);

                if (element_data.images) {
                    _setValue('textarea', 'images',   element_data.images.join('\r\n'));
                }
            }

            configure_row.find('.timeline-element-label').removeClass('open');
            configure_row.find('.timeline-element-label[data-index="' + element_index + '"]').addClass('open');
        },

        select: function(container, row_id, label, value) {
            container.find('select[name="' + label + '_' + row_id + '"]').val(value);
        },

        radio: function(container, row_id, label, value) {
            if (value == 1) {
                container.find('#' + label + '_yes_' + row_id).prop('checked', true);
            } else {
                container.find('#' + label + '_no_' + row_id).prop('checked', true);
            }
        },

        checkbox: function(container, row_id, label, value) {
            container.find('[name="' + label + '_' + row_id + '"]').prop('checked', (value == 1));
        },

        getRowData: function(row_id) {
            var row = Timeline_Admin._container.find('tr[data-id="' + row_id + '"]');
            var configure_row = row.next();

            var blog_categories = [];
            configure_row.find('input[name="blog_category"]:checked').each(function() {
                blog_categories.push($(this).val());
            });

            var data = {
                id:               0,
                name:             row.find('input[name="name_' + row_id + '"]').val(),
                dateFormat:       row.find('select[name="dateFormat_' + row_id + '"]').val(),
                max:              parseInt(row.find('input[name="max_' + row_id + '"]').val(), 10),
                loadmore:         parseInt(row.find('input[name="loadmore_' + row_id + '"]').val(), 10),
                responsive_width: parseInt(row.find('input[name="responsive_width_' + row_id + '"]').val(), 10),
                animation:        row.find('input[name="animation_' + row_id + '"]').prop('checked') ? 1 : 0,
                lightbox:         row.find('input[name="lightbox_' + row_id + '"]').prop('checked') ? 1 : 0,
                order:            row.find('select[name="order_' + row_id + '"]').val(),
                separator:        row.find('select[name="separator_' + row_id + '"]').val(),
                column_mode:      row.find('select[name="column_mode_' + row_id + '"]').val(),
                data_type:        configure_row.find('.timeline-config-tab:checked').val(),
                blog_categories:  blog_categories.length ? blog_categories.join(',') : '',
                data:             {
                    facebook_app_id:       configure_row.find('input[name="facebook_app_id_' + row_id + '"]').val(),
                    facebook_access_token: configure_row.find('input[name="facebook_access_token_' + row_id + '"]').val(),
                    facebook_page_id:      configure_row.find('input[name="facebook_page_id_' + row_id + '"]').val(),
                    twitter_search_key:    configure_row.find('input[name="twitter_search_key_' + row_id + '"]').val(),
                    element:               Timeline_Admin._element_data[row_id]
                }
            };

            return data;
        },

        doSave: function(row_id, callback) {
            var row_data = Timeline_Admin.getRowData(row_id);

            $.post(ajaxurl, {action: 'save_timeline', id: row_id, data: row_data}, function(response) {
                if (callback !== undefined) {
                    callback(response);
                }
            });
        },

        doAdd: function() {
            var row_data = Timeline_Admin._default;

            $.post(ajaxurl, {action: 'add_timeline', data: row_data}, function(response) {
                row_data.id = response.id;
                Timeline_Admin.buildRow(row_data, true).find('input[type="text"]:first').focus();
            });
        },

        doDelete: function(row_id) {
            Timeline_Admin._container.find('tr[data-id="' + row_id + '"]').remove();

            $.post(ajaxurl, {action: 'delete_timeline', id: row_id}, function(response) {
            });
        },

        doCopy: function(row_ids) {
            $.post(ajaxurl, {action: 'copy_timeline', ids: row_ids.join(',')}, function(response) {
                $(response).each(function(index, timeline) {
                    Timeline_Admin.buildRow(timeline, true);
                });
            });
        },

        saveTheme: function(theme) {
            $.post(ajaxurl, {action: 'save_timeline_theme', theme: theme}, function(response) {
                $('#theme-save-success').fadeIn();

                setTimeout(function() {
                    $('#theme-save-success').fadeOut();
                }, 2000);
            });
        },

        htmlentities: function(text_str) {
            return text_str.toString().replace(/&/g, '&amp;').replace(/\"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\xa0/g, '&nbsp;');
        },

        Events: {
            onNumericInputChange: function(e) {
                var value = $(this).val().trim();

                if (value.match(/[^0-9]/)) {
                    $(this).val(value.replace(/[^0-9]/g, ''));
                }
            },

            onThemeChange: function(e) {
                var theme = $(this).val();

                Timeline_Admin.saveTheme(theme);
            },

            onAdd: function(e) {
                Timeline_Admin.doAdd();
            },

            onGetCode: function(e) {
                e.stopPropagation();

                var row_id = $(this).parents('tr:first').data('id');
                var shortcode = '[melonhtml5-timeline id="' + row_id + '"]';

                $('.timeline-list .shortcode').hide();
                $(this).children('.shortcode').text(shortcode).show();
            },

            onSave: function(e) {
                var button = $(this);
                button.prop('disabled', true).addClass('disabled');

                var timeout = (new Date()).getTime();
                var delay   = 1000;

                window.setTimeout(function() {
                    timeout = true;
                }, delay);

                var row_id = $(this).parents('tr:first').data('id');
                Timeline_Admin.doSave(row_id, function(response) {
                    var _complete = function() {
                        button.prop('disabled', false).removeClass('disabled');
                    };

                    if (timeout === true) {
                        _complete();
                    } else {
                        window.setTimeout(_complete, delay - ((new Date()).getTime() - timeout));
                    }
                });
            },

            onConfigure: function(e) {
                var row = $(this).parents('tr:first');

                if (row.hasClass('open')) {
                    row.removeClass('open');
                    row.next('tr.configure').hide();
                } else {
                    row.addClass('open');
                    row.next('tr.configure').show();
                }
            },

            onConfigureType: function() {
                var data_type = $(this).val();

                $(this).parents('.timeline-config').find('.timeline-config-form').hide();
                $(this).parents('.timeline-config').find('.timeline-config-form-' + data_type).show();
            },

            onDelete: function(e) {
                var checkbox = Timeline_Admin._container.find('input.row-select:checked');
                if (checkbox.length) {
                    if (window.confirm('Are you sure you want to delete the selected timeline?')) {
                        checkbox.each(function() {
                            var row_id = $(this).parents('tr:first').data('id');
                            Timeline_Admin.doDelete(row_id);
                        });
                    }
                }
            },

            onCopy: function(e) {
                var checkbox = Timeline_Admin._container.find('input.row-select:checked');
                if (checkbox.length) {
                    var row_ids = [];
                    checkbox.each(function() {
                        var row_id = $(this).parents('tr:first').data('id');
                        row_ids.push(row_id);
                    });

                    Timeline_Admin.doCopy(row_ids);
                }
            },

            onElementDelete: function(e) {
                e.stopPropagation();

                var button        = $(this).parent();
                var element_index = button.data('index');
                var row_id        = button.parents('tr.configure').data('id');

                if (window.confirm('Are you sure you want to delete the element?')) {
                    if (Timeline_Admin._editing_element_index == element_index && Timeline_Admin._editing_row_id == row_id) {
                        button.parents('.timeline-config-form-custom').find('.timeline-config-form-custom-options').hide();
                    }
                    button.remove();

                    Timeline_Admin._element_data[row_id].splice(element_index, 1);
                }
            },

            onElementClick: function(e) {
                var element_index = $(this).data('index');
                var row_id        = $(this).parents('tr.configure').data('id');

                Timeline_Admin.setElementValue(row_id, element_index);
            },

            onShortcodeClick: function(e) {
                e.stopPropagation();
            },

            onDocumentClick: function() {
                $('.timeline-list .shortcode').hide();
            }
        }
    };

    Timeline_Admin.init();
});