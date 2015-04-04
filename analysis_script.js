function displaywindow(window_title, head_content, data_content) {
    alert(window_title);
    $.Dialog
    ({
        flat: false,
        shadow: true,
        draggable: true,
        title: window_title,
        content: '',
        resizable: true,
        modal: false,
        width: '50%',
        onShow: function (_dialog) {
            alert(window_title);
            var content = '<table class="table striped bordered">';


            content += "<thead>";
            content += "<tr>";
            for (i = 0; i < head_content.length; i++) {
                content += "<th class='text-left'>";
                content += head_content[i];
                content += "</th>";
            }
            content += "<\/tr>";
            content += "<\/thead>";




            content += "<tbody >";

            for (i = 0; i < data_content.length; i++) {
                content += "<tr>";
                for (j = 0; j < data_content[i].length; j++) {
                    content += "<td>";
                    content += data_content[i][j];
                    content += "</td>";
                }
                content += "<\/tr>";
            }

            content += "<\/tbody>";
            content += '</table>';
            $.Dialog.content(content);
            $.Metro.initInputs();
        }


    });
    alert(window_title);
}