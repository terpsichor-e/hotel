require('./bootstrap');

$(() => {
    $('.datetimepicker').each(function () {
        const $this = $(this);
        let options = {
            format: 'DD.MM.YYYY HH:mm ',
            minDate: moment(),
            useCurrent: false,
        };
        let locale;
        if ((locale = $('html').attr('lang'))) {
            options.locale = locale;
        }
        if ($this.data('time')) {
            let time = $this.data('time').split(':');
            let defaultDate = moment().hour(time[0]).minute(time[1]);
            if (defaultDate < moment()) {
                defaultDate.add(1, 'd');
            }

            options.defaultDate = defaultDate;
        }
        if ($this.data('after')) {
            options.minDate = $($this.data('after')).data('DateTimePicker').date();
            if (options.defaultDate && options.defaultDate < options.minDate) {
                options.defaultDate = options.defaultDate.add(1, 'd');
            }
            $($this.data('after')).on("dp.change", function (e) {
                const picker = $this.data('DateTimePicker');
                picker.minDate(e.date);
                if(picker.date() < e.date) {
                    picker.date(picker.date().add(e.date.valueOf()).subtract(e.oldDate.valueOf()));
                }
            });
        }
        $this.datetimepicker(options);
    });

    let booking_available_xhr;
    $('form.booking').on('change dp.change', '[name="room_class"],[name="arrival_at"],[name="departure_at"]', function () {
        const $this = $(this),
            form = $this.closest('form'),
            room_class = form.find('#room_class'),
            room_class_group = room_class.closest('.form-group'),
            info_container = form.find('.info-container'),
            price = info_container.find('#price'),
            left = info_container.find('#left'),
            data = {
                room_class: room_class.val(),
                arrival_at: form.find('#arrival_at').val(),
                departure_at: form.find('#departure_at').val(),
            };
        if (booking_available_xhr !== undefined) {
            booking_available_xhr.abort();
        }
        booking_available_xhr = $.get(form.data('available'), data)
            .done(function (result) {
                try {
                    console.log(result);
                    room_class_group.removeClass('has-error')
                        .find('.form-control-error').remove();
                    if (result.available) {
                        price.text(result.price);
                        left.text(result.left);
                        if(!info_container.is(':visible')) {
                            info_container.slideDown();
                        }
                    } else {
                        info_container.slideUp();
                        room_class_group.addClass('has-error')
                            .append(
                                $('<div></div>', {class: 'form-control-error'})
                                    .text(result.message)
                            );
                    }
                } finally {
                    booking_available_xhr = undefined;
                }
            });
    })
        .find('#room_class').trigger('change');


});