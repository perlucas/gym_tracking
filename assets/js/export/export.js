class ExportFormatWidget
{
    static setUp() {
        $( "#export_format" ).selectmenu({
            classes: {
                "ui-selectmenu-button": "styled-select line-input ff-1",
                "ui-selectmenu-menu": "styled-select-options ff-1"
            }
        });
    }
}

$(document).ready(ExportFormatWidget.setUp);