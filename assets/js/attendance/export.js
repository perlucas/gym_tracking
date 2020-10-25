class ExportFormatWidget
{
    static setUp() {
        $( "#export_format" ).selectmenu({
            classes: {
                "ui-selectmenu-button-closed": "miestilo",
                "ui-selectmenu-button-open": "miestilo",
                "ui-selectmenu-button": "miestilo",
            }
        });
    }
}

$(document).ready(ExportFormatWidget.setUp);