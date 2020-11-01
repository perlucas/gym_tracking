class DatepickersManager
{
    static getMonthNames() {
        return [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ];
    }

    static getMinDayNames() {
        return [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ];
    }

    static setUp() {
        $('[data-datepicker-on]').each(
            function () {
                let pickerOptions = {
                    monthNames: DatepickersManager.getMonthNames(),
                    dayNamesMin: DatepickersManager.getMinDayNames()
                };
                
                pickerOptions.dateFormat = 'dd/mm/yy';

                if ($(this).data('datepickerTarget')) {
                    pickerOptions.altField = $(this).data('datepickerTarget');
                    pickerOptions.altFormat = 'yy-mm-dd';
                }
                else {
                    pickerOptions.dateFormat = 'yy-mm-dd';
                }

                $(this).datepicker(pickerOptions);
            }
        );
    }
}

$(document).ready(DatepickersManager.setUp);