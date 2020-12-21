$(document).ready(function() {
    console.log('JQuery geladen');

    $('.delete_button').click(function() {
        console.log($(this).parent().data('id')); //attr('data-id')
        let entry = $(this).parent(); // speichert 'this' in der variable entry, alternativ auch 'let self = this'
        let myData = {entrynumber : $(this).parent().data('id')};

        $.ajax({
            type: "POST", // welche Methode
            data: myData, // welche daten sollen mitgesendet werden.
            url: 'delete_note.php', // die Url die aufgerufen wird.
            success: function(phpData) {
                console.log(phpData.trim()); // trim löscht leerzeichen am anfang und am ende eines strings.
                if(phpData.trim() == 'true') {
                    $(entry).remove();
                                       
                } else {
                    $('main').append('<div class="popup">Eintrag konnte nicht gelöscht werden<div class="popup_button button">OK</div></div>');
                    $('.popup_button').click(function() {
                        $(this).parent().remove();
                    });
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $('#formaddentries').submit(function(event){
        event.preventDefault(); // verhindert das das default ausgeführt wird.
        let formData = ($(this).serialize());

        $.ajax({
            type: "POST",
            data: formData,
            url: 'add_note.php',
            success: function(phpData) {
                console.log(phpData);
                if(phpData.trim() == 'true') {
                    location.reload();
                } else {
                    $('main').append('<div class="popup">Eintrag konnte nicht erstellt werden<div class="popup_button button">OK</div></div>');
                    $('.popup_button').click(function() {
                        $(this).parent().remove();
                    });
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $('#loginbutton').submit(function(event){
        event.preventDefault(); // verhindert das das default ausgeführt wird.
        let formData = ($(this).serialize());

        $.ajax({
            type: "POST",
            data: formData,
            url: 'login.php',
            success: function(phpData) {
                console.log(phpData);
                if(phpData.trim() == 'true') {
                    location.reload();
                } else {
                    $('main').append('<div class="popup">Login Fehlgeschlagen</div>');
                    $('.popup_button').click(function() {
                        $(this).parent().remove();
                    });
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $('.edit_button').click(function() {

        if($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            $('input[name="entrynumber"]').val('');
            $('textarea[name="entry_text"]').val('');
            $('input[type="submit"]').val('Notiz hinzufügen');
        } else {
            
        $('.entry.active').removeClass('active');

        $(this).parent().addClass('active');

        //text der in der Notiz steht und die entrynumber
        console.log($(this).parent().data('id'));
        console.log($(this).parent().find('p:nth-child(3)').text());

        $('input[name="entrynumber"]').val($(this).parent().data('id'));
        $('textarea[name="entry_text"]').val($(this).parent().find('p:nth-child(3)').text());
        $('input[type="submit"]').val('Notiz bearbeiten');
        

        }        
    });

    




      
      
});