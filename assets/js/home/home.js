class SelectTraineeWidget
{
    static reduceTrainee(trainee) {
        console.log(trainee);
        return {
            value: trainee.id, 
            label: `${trainee.fullname} - ${trainee.dni}`
        };
    }

    static setUp() {
        $('#traineeRef').autocomplete({
            source: function (request, response) {
                $.get({
                    url: `/api/v1/trainees?term=${request.term}`,
                    dataType: 'json',
                    success: function (res) {
                        if (res && Array.isArray(res)) {
                            response(
                                res.map(SelectTraineeWidget.reduceTrainee)
                            );
                        }
                        else {
                            console.info(`Error on response: ${res}`);
                            response([]);
                        }
                    }
                });
            },
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

$(document).ready(SelectTraineeWidget.setUp);