function createwindow(content) {

    if (document.getElementById('by_p').checked) {

        if (document.getElementById('by_y').checked) {

        } else if (document.getElementById('by_m').checked) {

        } else if (document.getElementById('by_w').checked) {

        }
      
    } else if (document.getElementById('by_t').checked) {

        if (document.getElementById('by_y').checked) {

        } else if (document.getElementById('by_m').checked) {

        } else if (document.getElementById('by_w').checked) {

        }


        
    } else {

        if (document.getElementById('by_y').checked) {

        } else if (document.getElementById('by_m').checked) {

        } else if (document.getElementById('by_w').checked) {

        }

    }

}

function displaywindow(content) {
    $.Dialog({
        flat: false,
        shadow: true,
        title: 'Test window',
        content: '' + content,
        height: 200
    });
}