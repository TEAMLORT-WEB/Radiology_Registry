function displaywindow(head_content, data_content) {
    $.Dialog
    ({
        flat: false,
        shadow: true,
        draggable: true,
        title: 'window_title',
        content: '',
        resizable: true,
        modal: false,
        width: '50%',
        onShow: function (_dialog) {
            var content = '<table classes="table striped bordered">';


            content += "<thead>";
            content += "<tr>";
            for (i = 0; i < head_content.length; i++) {
                content += "<th classes='text-left'>";
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
}
function edit(doctor_id,patient_id,editoradd) {
                
    $.Dialog({
        shadow: true,
        overlay: false,
        draggable: true,
        icon: '<span classes="icon-wrench"></span>',
        title: editoradd,
        width: 'auto',
        height: 'auto',
        padding: 30,
        content: 'This Window is draggable by caption.',
        onShow: function () {
                            
            var strVar = "";
            strVar += "<form id=\"form1\" method =\"post\"> ";
            strVar += "    <p>Doctor Id:" +doctor_id+" <p><input name =\"normal_doctor_id\" type=\"hidden\" value="+doctor_id+"\/><\/p>"; <\/p> ";
            strVar += "    <p>Patient Id: <input name =\"info_patient_id\" type=\"text\" placeholder="+patient_id+" \/><\/p> ";
            strVar += "    <p><input name =\"old_patient_value\" type=\"hidden\" value="+patient_id+"\/><\/p>";
            strVar += "    <p><input name =\"condition\" type=\"hidden\" value="+editoradd+"\/><\/p>";
            strVar += "    <p><input name =\"submit_edit\" type=\"submit\"\/><\/p>";
            strVar += "</form>";
                
                
            $.Dialog.title("Perform Administrative Action");
            $.Dialog.content(strVar);
        }
                
    });
}