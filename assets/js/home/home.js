class TraineesManager
{
    static setUp() {
        $('#traineeRef').autocomplete({
            source: [
                { label: 'Santiago Rivero - 39088088', value: 1 },
                { label: 'Nico Doncheff - 39066088', value: 2 },
                { label: 'Lionel Messi - 39044555', value: 3 },
                { label: 'Martin Palermo - 34455666', value: 4 },
                { label: 'Juan Riquelme - 39044888', value: 5 },
            ],
            classes: {
                "ui-autocomplete": "custom-autocomplete ff-1"
            },
            select: function (event, ui) {
                event.preventDefault();
                $('#traineeRef').val(ui.item.label);
                $('#traineeId').val(ui.item.value);
            }
        });
    }
}

$(document).ready(TraineesManager.setUp);